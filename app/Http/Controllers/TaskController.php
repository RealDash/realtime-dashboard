<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.task');
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($task)
    {
        return view('user.singletask');
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
