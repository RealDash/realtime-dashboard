<?php

namespace App\Http\Controllers\Admin;

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
    
    public function viewEvents(){
        $events = Event::orderby('created_at', 'desc')->get();
        return view('admin.events', compact('events'));
    }

    public function getEvents(){
        $now = Carbon::now();
        $events = Event::where('start_at', '>=', $now)
                        ->where('end_at', '<=', $now)
                        ->orderby('created_at', 'desc')->get();
        return new TaskLogResourceCollection($events);
    }

    public function viewSingleEvent(Request $request, $event_id){
        $event = Event::find($event_id);
        return view('admin.singleevent', compact('event'));
    }


    public function deleteEvent(Request $request, $event_id){
        $event = Event::find($event_id);
        if(is_null($event)){
            abort(404);
        }
        $event->delete();
        return back()->with('success', 'Event has been deleted');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createEvent(Request $request)
    {

        $this->validator($request->all())->validate();

        $event = new Event;
        $date = explode(' - ',$request->date);
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_at = $this->formatDate($date[0]);
        $event->end_at = $this->formatDate($date[1]);

        if ($event->save()) {
            return back()->with('success', 'Event Created Succefully');
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required',
        ]);
    }

}
