<?php

namespace App\Http\Controllers;

use App\Model\Gists;
use App\Model\Task;
use Auth;
use Illuminate\Http\Request;

class UserController extends ApiController
{

    public function __contruct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        $task = Auth::user()->tasks()->get();
        $pending = $task->where('status',config('data')['Pending'])->count();
        $completed = $task->where('status',config('data')['Completed'])->count();
        $verified = $task->where('status',config('data')['Verified'])->count();
        $progress = $task->where('status',config('data')['Progress'])->count();
        // dd($task);
        return view('user.index', compact('pending', 'completed', 'verified', 'progress'));
    }

    public function myTasks(){
        return view('user.tasks');
    }

    public function profile(){
        return view('user.profile');
    }

    public function gists(){
        $gists = Auth::user()->gists()->orderBy('created_at', 'desc')->get();
     return view('user.gist', compact('gists'));
 }

 protected function changeAvatar(Request $request){
        // dd($request);
    if($request->has('avatar')){
        $image = $request->file('avatar'); 
        $filename = "/images/avatars/".time().".".$image->getClientOriginalExtension();
        $path = public_path('/images/avatars/');
        $image->move($path,$filename);
        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();
    }

}

public function updateSocials(Request $request){
    $this->validatorSocials($request->all())->validate();
    $user = Auth::user();
    if(is_null($user)){
        abort(404);
    }
    $user->facebook = $request->facebook;
    $user->twitter = $request->twitter;
    $user->linkedin = $request->linkedin;
    $user->google = $request->google;
    $user->save();
    return back()->with('success', 'You have updated your social handles');
   
}

public function changePassword(Request $request){
    $data = $request->all();


    $user = Auth::user();
    if($request->newpassword != $request->confirmpassword){

        return back()->with('error', 'Passwords do not match');
    }
    if(!Hash::check($request->oldpassword, $user->password)){

        return back()->with('error', 'Wrong Password');
    }else{
        $user->password = bcrypt($request->newpassword);
        $user->save();
        return back()->with('success', 'Password change Successful');
    }

    return view('user.changepassword');
    
}
 /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorSocials(array $data)
    {
        return Validator::make($data, [
            'facebook' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'twitter' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'linkedin' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ]);
    }
}
