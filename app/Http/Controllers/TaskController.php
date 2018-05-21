<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Task;
use Auth;

class TaskController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // dd(Auth::user()->tasks()->get());
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('user.task', compact('tasks'));
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $task_id)
    {
        $exists = true;//Auth::user()->tasks()->where('task_id', $task_id)->exists();
        
        if($exists){
            $task = Task::find($task_id);
            if(!is_null($task)){
                
                return view('user.singletask',compact('task'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
        

        
    }

    public function pickTask(Request $request){
        $exists = Auth::user()->tasks()->where('task_id', $request->task_id)->exists();
        if($exists){
            return back()->with('error', 'You have alreasy picked task');
        }
        Auth::user()->tasks()->attach($request->task_id);
        return back();
    }

    /**
     * Show the form for viewing pending task
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pending(Request $request)
    {
        return view('user.task');
    }

    /**
     * Show the form for viewing pending task
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function completed(Request $request)
    {
        return view('user.task');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
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
