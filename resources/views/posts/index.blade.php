@extends(auth() ? ( auth()->user()->isAdmin() ? 'layouts/admin' : 'layouts/app' ) : 'layouts/app' )

@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{route('posts.create')}}" class="btn btn-success">Add post</a>
</div>
<div class="card card-default">
    <div class="card-header">
        POSTS
    </div>
    <div class="card-body">
        @if($posts->count() > 0)
            <table class="table">
                <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><img class="img-thumbnail" src="{{asset("storage/{$post->image}")}}" width="120" height=""></td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->category->name}}</td>
                        <td><a class="btn btn-secondary btn-sm" href="{{route('posts.show',$post->slug)}}">View</a></td>
                        <td>
                            @if(!$post->trashed())
                                <a href="{{route('posts.edit',$post->slug)}}" class="btn btn-info btn-sm">Edit</a>
                            @else
                                <form action="{{route('posts.restore',$post->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info btn-sm">Restore</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <form action="{{route('posts.destroy',$post->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    {{$post->trashed() ? 'Delete' : 'Trash'}}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center text-capitalize">no posts available</h3>
        @endif
    </div>
</div>
@endsection
