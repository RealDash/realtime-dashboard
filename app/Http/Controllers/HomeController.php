<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->take(9);
        $user_col_1 = [];
        $user_col_2 = [];
        $user_col_3 = [];
        $user_col_4 = [];

        for($i = 0; $i < count($users); $i++){
            if($i < 5){
                $user_col_1[] = $users[$i];
            }else{
                if($i < 7){
                    $user_col_2[] = $users[$i];
                }else{
                    if($i < 8){
                        $user_col_3[] = $users[$i];
                    }else{
                        $user_col_4[] = $users[$i];
                    }
                    
                }
            }
        }
        // dd($user_col_1);
        return view('proper', compact('user_col_1', 'user_col_2', 'user_col_3', 'user_col_4'));
    }
}
