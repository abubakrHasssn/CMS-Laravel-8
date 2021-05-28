@extends(auth() ? ( auth()->user()->isAdmin() ? 'layouts/admin' : 'layouts/app' ) : 'layouts/app' )
@section('content')
@include('partials/errors')
    <div class="card card-default">
        <div class="card-header">
            {{isset($post) ? 'Edit Post' : 'Create Post'}}
        </div>
        <div class="card-body">
            <form action="{{isset($post) ? route('posts.update',$post->slug): route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{isset($post) ? $post->title : ''}}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="5" cols="5">{{isset($post) ? $post->description : ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="contents">Content</label>
                    <input id="contents" type="hidden" name="contents" value="{{isset($post) ? $post->contents : ''}}">
                    <trix-editor input="contents"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published AT</label>
                    <input type="text" class="form-control" name="published_at" id="published_at" value="{{isset($post) ? $post->published_at : ''}}">
                </div>
                @if(isset($post))
                <div class="form-group">
                    <img class="img-fluid" src="{{asset("storage/{$post->image}")}}" alt="">
                </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                @if(isset($post))
                                    @if($post->category_id === $category->id)
                                        selected
                                    @endif
                                @endif
                            > {{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                @if($tags->count() > 0)
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select class="form-control tag-selector" name="tags[]" id="tags" multiple>
                        @foreach($tags as $tag)
                        <option value="{{$tag->id}}"
                        @if(isset($post))
                            @if(in_array($tag->id,$post->tags->pluck('id')->toArray()))
                                selected
                            @endif
                        @endif
                        >{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{isset($post) ? 'Update Post' :'Create Post'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at',{
            enableTime : true
        });
        $(document).ready(function() {
            $('.tag-selector').select2();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

