@extends(auth() ? ( auth()->user()->isAdmin() ? 'layouts/admin' : 'layouts/app' ) : 'layouts/app' )

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('users.create')}}" class="btn btn-primary">Add New User</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            USERS
        </div>
        <div class="card-body">
            @if($users->count() > 0)
                <table class="table">
                    <thead>
                    <th>Image</th>
                    <th>User Name</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <td></td>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><img class="img-thumbnail" src="{{asset('storage/'.$user->avatar)}}" width="60" height="60"></td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                {{$user->role()}}
                            </td>
                            <td>
                                <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary btn-sm">edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center text-capitalize">No Users.</h3>
            @endif
        </div>
    </div>
@endsection
