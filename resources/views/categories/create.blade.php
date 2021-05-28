@extends(auth() ? ( auth()->user()->isAdmin() ? 'layouts/admin' : 'layouts/app' ) : 'layouts/app' )

@section('content')
    @include('partials/errors')
    <div class="card card-default">
        <div class="card-header">{{isset($category) ? 'Update Category' : 'Create Category'}}</div>
        <div class="card-body">
            <form method="post" action="{{ isset($category) ? route('categories.update',$category->id) : route('categories.store')}}">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{isset($category) ? $category->name : ''}}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">{{isset($category) ? 'Update Category' : 'Add Category'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
