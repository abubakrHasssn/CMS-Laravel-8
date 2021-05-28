@extends(auth() ? ( auth()->user()->isAdmin() ? 'layouts/admin' : 'layouts/app' ) : 'layouts/app' )

@section('content')
    @include('partials/errors')
    <div class="card card-default">
        <div class="card-header">{{isset($tag) ? 'Update Tag' : 'Create Tag'}}</div>
        <div class="card-body">
            <form method="post" action="{{ isset($tag) ? route('tags.update',$tag->id) : route('tags.store')}}">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{isset($tag) ? $tag->name : ''}}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">{{isset($tag) ? 'Update Tag' : 'Add Tag'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
