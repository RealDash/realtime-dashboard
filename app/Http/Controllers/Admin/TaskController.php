<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TaskController as NormalTaskController;
use App\Model\Task;
use App\Model\Category;
use App\Events\TaskUpdate;
use Auth;
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

        $this->validator($request->all())->validate();

        $task = new Task;
        $date = explode(' - ',$request->start_date);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->number_required_in_task = $request->number_required_in_task;
        $task->start_at = $this->formatDate($date[0]);
        $task->end_at = $this->formatDate($date[1]);
        $task->category_id = $request->category;
        $task->assigned_to = $request->assigned ?: null;
        if ($task->save()) {
            $user = Auth::user();
            $this->log($task->id, $user->id, config('mine.activities.created_task'));
            $this->broadcastEvent($user,config('mine.activities.created_task'),$task);
            return back()->with('success', 'Task Created Succefully');
        }

        return back()->with('error', 'Something went wrong, try again.');
    }

    public function formatDate($date){
        $temp = explode('/', $date);
        return $temp[2].'-'.$temp[0].'-'.$temp[1];
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255|unique:tasks',
            'description' => 'required|string',
            'start_date' => 'required',
            'assigned_to' => 'nullable|integer',
            'category' => 'required|integer',
            'number_required_in_task' => 'required|integer'
        ]);
    }

    
}
