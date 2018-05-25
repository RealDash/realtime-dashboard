<?php

namespace App\Http\Controllers;

use App\Model\Gists;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

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
        'title' => 'required|string',
        'gist' => 'required|string',         
        ]);

        $gist = new Gists;
        $gist->title = $request->title;
        $gist->gist = $request->gist;
        $gist->user_id = Auth::user()->id; 
        if ($gist->save()) {
            $user = Auth::user();
            //$this->log($task->id, $user->id, config('mine.activities.created_task'));
            //$this->broadcastEvent($user,config('mine.activities.created_task'),$task);
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
