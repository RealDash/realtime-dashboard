<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __contruct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        return view('user.index');
    }

    public function myTasks(){
        return view('user.tasks');
    }

    public function profile(){
        return view('user.profile');
    }

    public function changePassword(Request $request){
        $data = $request->all();
        // dd($request);
        $this->validator($data)->validate();
        
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
