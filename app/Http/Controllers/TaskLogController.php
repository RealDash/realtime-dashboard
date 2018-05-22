<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TaskLog;
use App\Http\Resources\TaskLog\TaskLogResource;
use App\Http\Resources\TaskLog\TaskLogResourceCollection;

class TaskLogController extends Controller
{
    public function getLog(Request $request, $user_id){
        $log = TaskLog::where('carried_out_by', $user_id)->orderBy('created_at', 'desc')->get();
        // ->orderBy('created_at', 'desc')
        return new TaskLogResourceCollection($log->load('task','user'));
    }
}
