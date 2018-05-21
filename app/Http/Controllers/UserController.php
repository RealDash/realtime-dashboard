<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Task;
use Auth;

class UserController extends ApiController
{

    public function __contruct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        $task = Auth::user()->tasks();
        $pending = $task->where('status',config('data')['Pending'])->count();
        $completed = $task->where('status',config('data')['Completed'])->count();
        $verified = $task->where('status',config('data')['Verified'])->count();
        $progress = $task->where('status',config('data')['Progress'])->count();
        return view('user.index', compact('pending', 'completed', 'verified', 'progress'));
    }

    public function myTasks(){
        return view('user.tasks');
    }

    public function profile(){
        return view('user.profile');
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
}
