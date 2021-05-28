<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
    *@return Response
     */
    public function index(){
        return view('users.index')->with('users',User::all());
    }

    /**
     * @return View
     */
    public function create(){
        return view('users.adduser',[
            'roles' => Role::all()
        ]);
    }

    /**
     * @param CreateUserRequest $request
     * @return RedirectResponse
     */
    public function store(CreateUserRequest $request){
            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'name' => $request->name,
                'role_name' => $request->role
            ]);
            session()->flash('success','User Created Successfully.');
            return redirect()->back();
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user){
        return view('users.AddUser')->with('user',$user)->with('roles',Role::all());
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->only(['username','name','email','role','about']);
        $data['role_name'] = $request->role;
        if ($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar')->store('avatars');
            $data['avatar'] = $avatar;
        }
        $user->update($data);
        session()->flash('success','user info updated successfully.');
        return redirect(route('users.index'));
    }

    public function profile($username)
    {
        $user = User::where('username',$username)->get()->first();
        if ($user){
            return view('users.profile')->with('user',$user);
        }else{
            return abort(404) ;
        }

    }

    public function updateProfile(UpdateUserRequest $request){
        $data = $request->only(['name','about','email']);
        auth()->user()->update($data);
        session()->flash('success','Profile Updated Successfully.');
        return redirect()->back();
    }

    public function makeAdmin(User $user){
        $user->role = 'admin';
        $user->save();
        session()->flash('success','user has been Admin successfully.');
        return redirect()->back();
    }
}
