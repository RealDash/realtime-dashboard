<?php

namespace App\Http\Controllers;
use App\Model\TaskLog;
use App\Events\TaskUpdate;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function log($task_id, $user_id, $action){
        $task_log = new TaskLog;
        $task_log->carried_out_by = $user_id;
        $task_log->task_id = $task_id;
        $task_log->action = $action;
        $task_log->save();
    }

    public function broadcastEvent($user, $activity, $task = null){

        event(new TaskUpdate($user, $activity, $task));
    }
}
