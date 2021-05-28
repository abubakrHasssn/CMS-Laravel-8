@extends(auth() ? ( auth()->user()->isAdmin() ? 'layouts/admin' : 'layouts/app' ) : 'layouts/app' )

@section('content')
    @include('partials/errors')
    <div class="container">
        <div class="card">
            <div class="card-header">{{isset($user) ? 'Update User Info' :'Create User'}}</div>
            <div class="card-body">
                <form action="{{isset($user) ? route('users.update',$user->id) :route('users.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="{{isset($user) ? $user->username :''}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{isset($user) ? $user->email :''}}">
                    </div>
                    @if(!isset($user))
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" class="form-control" name="password" id="password" >
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Re-password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" >
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{isset($user) ? $user->name :''}}">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role" >
                            @foreach($roles as $role)
                                <option value="{{$role->name}}"
                                        @if(isset($user) && $role->name === $user->role())
                                           selected
                                        @endif
                                >{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" id="about" class="form-control" rows="5" cols="5">{{isset($user) ? $user->about :''}}</textarea>
                    </div>
                    @if(isset($user))
                    <div class="form-group">
                        <label for="avatar">User Avatar</label>
                        <div>
                            <img src="{{asset('storage/'.$user->avatar)}}" alt="avatar" class="img-fluid mb-1" width="120" height="120">
                        </div>
                        <input type="file" name="avatar" id="avatar" class="form-control">
                    </div>
                    @endif
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{isset($user) ? 'Update User' :'Create user'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
