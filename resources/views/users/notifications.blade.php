@extends(auth() ? ( auth()->user()->isAdmin() ? 'layouts/admin' : 'layouts/app' ) : 'layouts/app' )
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h3>Notifications</h3>
        </div>
        <div class="card-body">
            @if(auth()->user()->notifications->count() > 0)
                @foreach(auth()->user()->notifications()->simplepaginate(10) as $notification)
                    <a class="dropdown-item d-flex align-items-center" href="{{route('posts.show',$notification->data['post_slug'])}}">
                        <div class="notification">
                            <div class="small text-gray-500">{{$notification->created_at->toFormattedDateString()}}</div>
                            <span class="font-weight-bold text-primary">{{$notification->data['name']}}</span>
                            <span class="small text-gray-500">commented in your Post</span>
                            <span class="font-weight-bold text-primary">{{$notification->data['post_title']}}</span>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="text-center">
                    <h2>No New Notifications.</h2>
                </div>
            @endif
        </div>
    </div>
    <div class="mb-4">
        {{auth()->user()->notifications()->simplepaginate(10)->links()}}
    </div>
@endsection
