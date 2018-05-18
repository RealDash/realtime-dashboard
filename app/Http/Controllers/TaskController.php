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
        return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->descrip;
        $task->start_at = $request->start_date;
        $task->end_at = $request->end_date;
        $task->category_id = $request->category;
        $task->assigned_to = $request->assigned ?: null;

        if ($task->save()) {
            return redirect('/tasks');
        }

        return back()->with('error', 'Something went wrong, try again.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'title' => 'required|string|max:255|unique:tasks',
            'descrip' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'assigned_to' => 'nullable|integer',
            'category' => 'required|integer'
        ]);
    }
}
