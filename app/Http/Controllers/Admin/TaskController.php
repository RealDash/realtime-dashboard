<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TaskController as NormalTaskController;
use App\Model\Task;
use App\Model\Category;
use Illuminate\Support\Facades\Validator;

class TaskController extends NormalTaskController
{
    public function viewTasks(){
        $tasks = Task::orderby('created_at', 'desc')->get();
        $categories = Category::all();
        return view('admin.tasks', compact('tasks','categories'));
    }

    public function viewSingleTask(Request $request, $task_id){
        $task = Task::find($task_id);
        return view('admin.singletask', compact('task'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validator = $this->validator($request->all());

        if($validator->fails()){

        }


        $task = new Task;
        $date = explode(' -',$request->start_date);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->start_at = $date[0];
        $task->end_at = $date[1];
        $task->category_id = $request->category;
        $task->assigned_to = $request->assigned ?: null;
        if ($task->save()) {
            return redirect('/admin/manage/tasks');
        }

        return back()->with('error', 'Something went wrong, try again.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255|unique:tasks',
            'description' => 'required|text',
            'start_date' => 'required',
            'assigned_to' => 'nullable|integer',
            'category' => 'required|integer'
        ]);
    }

    
}