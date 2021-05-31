@auth()
   @php( $layout = auth()->user()->isAdmin() ? 'layouts/admin' : 'layouts/app')
@else
    @php( $layout = 'layouts/app' )
@endauth
@extends($layout)

@section('content')

    <!-- Title -->
    <h1 class="mt-4 text-capitalize">{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by
        <a href="{{route('users.profile',$post->user->username)}}">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p>Posted on {{$post->published_at}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{asset('storage/'.$post->image)}}" alt="postImage">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{$post->description}}</p>

    <p>{!! $post->contents !!}</p>

    <hr>

    @auth()
        <form action="{{route('comments.store',$post->slug)}}" method="post">
            @csrf
            <div class="form-group">
                <label for="content">Comment</label>
                <input id="content" type="hidden" name="content">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" >Add Comment</button>
            </div>
        </form>
    @else
        <div class="mb-3">
            <a href="{{route('login')}}" class="btn btn-primary btn-lg">Login To Add a Comment</a>
        </div>
        <hr>
    @endauth

    <!-- Single Comment -->
    @if($post->comments->count() > 0)
        @foreach($post->comments()->simplePaginate(6) as $comment)
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" width="40" src="{{asset('storage/'.$comment->user->avatar)}}" alt="userImage">
                <div class="media-body">
                    <a href="{{route('users.profile',$comment->user->username)}}"><h5 class="mt-0">{{$comment->user->name}}</h5></a>
                    {!! $comment->content !!}
                </div>
            </div>
            <hr>
        @endforeach
        <div class="mt-3 mb-4">
            {{$post->comments()->simplePaginate(6)->links()}}
        </div>
    @else
        <div class="text-center">
            No comments yet.
        </div>
    @endif

@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"/>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection
