<?php

namespace App\Http\Controllers;

use App\Http\Requests\Password\passwordChangeRequest;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['admin'])->only(['index','create','store']);
    }

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
                'username' => Str::slug($request->username,'_'),
                'email' => $request->email,
                'password' => $request->password,
                'name' => $request->name,
                'role_name' => $request->role
            ]);
            session()->flash('success', 'User Created Successfully.');
            return redirect()->back();
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user){
        if ($this->isAuthorized($user)) {
            return view('users.AddUser')->with('user', $user)->with('roles', Role::all());
        }else{
            session()->flash('warning','you dont have permission to perform this action.');
            return redirect()->back();
        }
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($this->isValidUserName($request,$user)) {
            if ($this->isValidEmail($request,$user)) {
                if ($this->isAuthorized($user)) {
                    $data = $request->only(['name', 'email', 'role', 'about']);
                    $data['username'] = Str::slug($request->username,'_');
                    $data['role_name'] = $request->role;
                    if ($request->hasFile('avatar')) {
                        $avatar = $request->file('avatar')->store('avatars');
                        $data['avatar'] = $avatar;
                    }
                    $user->update($data);
                    session()->flash('success', 'user info updated successfully.');
                    return redirect()->back();
                } else {
                    session()->flash('warning', 'you dont have permission to perform this action.');
                    return redirect()->back();
                }
            }else{
                session()->flash('warning', 'this Email was registered with another account.');
                return redirect()->back();
            }
        }else{
            session()->flash('warning', 'user name is not available.');
            return redirect()->back();
        }
    }

    /**
     * validate user name
     *
     * @param $request
     * @param $user
     * @return bool
     */
    public function isValidUserName($request,$user){
        $usr = User::where('username',Str::slug($request->username,'_'))->first();
        return  Empty($usr) || $usr->id === $user->id;
    }

    /**
     * validate email
     *
     * @param $request
     * @param $user
     * @return bool
     */
    public function isValidEmail($request,$user){
        $usr = User::where('email',$request->email)->first();
        return  Empty($usr) || $usr->id === $user->id;
    }

    /**
     * display user profile
     *
     * @param $username
     * @return View|void
     */
    public function profile($username)
    {
        $user = User::where('username',$username)->get()->first();
        if ($user){
            return view('users.profile')->with('user',$user);
        }else{
            return abort(404) ;
        }

    }

    /**
     * display user settings / edit profile
     *
     * @return View
     */
    public function Settings(){
        return view('users.AddUser')->with('user',auth()->user())->with('roles',Role::all());
    }

    /**
     * display user notifications
     *
     * @return View
     */
    public function notifications(){
        auth()->user()->unreadNotifications->markAsRead();
        return view('users.notifications',
            [
                'notifications'=>auth()->user()->notifications()->paginate(6)
            ]);
    }

    /**
     * validate user authorization for making changes
     *
     * @param $user
     * @return bool
     */
    public function isAuthorized($user){
        return (auth()->user()->isAdmin() ||auth()->user()->getAuthIdentifier() === $user->id );
    }

    /**
     * change user password
     *
     * @param passwordChangeRequest $request
     * @return RedirectResponse
     */
    public function passwordChange(passwordChangeRequest $request){
        if ($this->oldPasswordValidation($request)){
            auth()->user()->update(['password'=>Hash::make($request->new_password)]);
            session()->flash('success','Password changed successfully.');
            return redirect()->back();
        }else{
            session()->flash('warning','old password is incorrect.');
            return redirect()->back();
        }

    }

    /**
     * validate password
     *
     * @param $request
     * @return bool
     */
    public function oldPasswordValidation($request){
        return Hash::check($request->old_password,auth()->user()->getAuthPassword());
    }

}
