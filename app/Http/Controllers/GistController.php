<?php

namespace App\Http\Controllers;

use App\Model\Gists;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TaskLog\TaskLogResource;
use App\Http\Resources\TaskLog\TaskLogResourceCollection;

class GistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gists = Gists::orderBy('created_at', 'desc')->get();
        return view('user.gist', compact('gists'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiGetGists()
    {
        $gists = Gists::orderBy('created_at', 'desc')->get();
        $gists->load('user');
        return new TaskLogResourceCollection($gists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'gist' => 'required|string|max:65',         
        ]);

        $gist = new Gists;
        $gist->gist = $request->gist;
        $gist->user_id = Auth::user()->id; 
        if ($gist->save()) {
            $user = Auth::user();
            $this->broadcastCurrentGist($gist);
            return back()->with('success', 'Gist Created Succefully');
        }

        return back()->with('error', 'Something went wrong, try again.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $gist_id)
    {
         $gist = Gists::find($gist_id);
        return view('user.singlegist', compact('gist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
