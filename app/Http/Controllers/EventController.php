<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Events\EventUpdate;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Model\Event;
use App\Http\Resources\TaskLog\TaskLogResource;
use App\Http\Resources\TaskLog\TaskLogResourceCollection;
use Carbon\Carbon;

class EventController extends Controller
{
    
    public function getEvents(){
        $now = date('Y-m-d');
        $events = Event::where('start_at', '<=', $now)
                        ->where('end_at', '>=', $now)->get();
        return new TaskLogResourceCollection($events);
    }


}
