<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController as NormalUserController;
use App\Model\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
class UserController extends NormalUserController
{
    public function viewUsers(){
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function changeUserRole(Request $request){

    }

    public function viewUserProfile(){
        return view('admin.users');
    }

    /**
     * Returns json data of a single user or throws 404 if user is not found
     *
     * @param [int] $id
     * @return json
     */
    public function getSingleUserDetails($id){
        $user = User::withTrashed()->find($id);
        $user->load('musicReaction');
        // dd($user);
        if (!is_null($user)){
            return new UserResource($user);
        }else{
            return $this->notFound('User not found', ["User with id of $id does not exists"]);
        }       
}

/**
 * Returns json data of success or user not found
 *
 * @param [int] $id
 * @return json
 */
public function assignRoleToUser(Request $request, $id){
        $user = User::find($id);
        if (!is_null($user)){
            $user->role_id = $request->role_id;
            $role = Role::find($request->role_id);
            return $this->actionSuccess("User has been assigned the role of $role->role_name");
        }else{
            return $this->notFound('User not found', ["User with id of $id does not exists"]);
        }       
}

/**
 * Ban a single User by finding the model using id
 *
 * @param Request $request
 * @param [int] $id
 * @return success or not found json response
 */
public function banSingleUser(Request $request, $id){

    $user= User::find($id);
    if (!is_null($user)){
        if($user->delete()){
            return $this->actionSuccess('User Banned');
        }
    }else{
        return $this->notFound('User not found', ["User with id of $id does not exists"]);
    }
}

/**
 * unban a single User by finding the model using id
 *
 * @param Request $request
 * @param [int] $id
 * @return success or not found json response
 */
public function unBanSingleUser(Request $request, $id){

    $user= User::withTrashed()->find($id);
    if (!is_null($user)){
        if($user->restore()){
            return $this->actionSuccess('User unbanned');
        }
    }else{
        return $this->notFound('User not found', ["User with id of $id does not exists"]);
    }
}

/**
 * Ban all selected Users coming from the form
 *
 * @param Request $request
 * @return success or not found json response
 */
public function banMultipleUser(Request $request){

    $users= User::whereIn('id', $request->user_id);
    if (!is_null($users)){
        if($users->delete()){
            return $this->actionSuccess(count($request->user_id).' Users(s) Banned');
        }
    }else{
        return $this->notFound('No Users Selected', ["No Users Selected"]);
    }
}

/**
 * Unban all selected Users coming from the form
 *
 * @param Request $request
 * @return success or not found json response
 */
public function unBanMultipleUser(Request $request){

    $users= User::whereIn('id', $request->user_id)->withTrashed();
    if (!is_null($users)){
        if($users->restore()){
            return $this->actionSuccess(count($request->user_id).' Users(s) unbanned');
        }
    }else{
        return $this->notFound('No Users Selected', ["No Users Selected"]);
    }
}


/**
 * Deletes a single User by finding the model using id
 *
 * @param Request $request
 * @param [int] $id
 * @return success or not found json response
 */
public function deleteSingleUser(Request $request, $id){

    $user= User::find($id);
    if (!is_null($user)){
        if($user->forceDelete()){
            return back()->with('success', 'User has been deleted');
        }
    }else{
        return back()->with('error', 'User doesnt exist');
    }
}

/**
 * Deletes all selected Users coming from the form
 *
 * @param Request $request
 * @return success or not found json response
 */
public function deleteMultipleUser(Request $request){

    $users= User::whereIn('id', $request->user_id);
    if (!is_null($users)){
        if($users->forceDelete()){
            return $this->actionSuccess(count($request->user_id).' Users(s) deleted');
        }
    }else{
        return $this->notFound('No Users Selected', ["No Users Selected"]);
    }
}

/**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {   
        // dd($this->validator($request->all()));
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return back()->with('success', 'User has been created');
    }

  /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        return User::create([
            'user_name' => $data['username'],
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 1
        ]);

        // $this->guard()->login();
    }

 /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users,user_name',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

}
