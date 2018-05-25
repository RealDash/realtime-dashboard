<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Announcement;
use App\Http\Resources\TaskLog\TaskLogResource;
use App\Http\Resources\TaskLog\TaskLogResourceCollection;

class AnnouncementController extends Controller
{
    //

    public function index()
    {
        $announcements = Announcement::all();

        return view('admin.announcements', compact('announcements'));
    }


    public function store(Request $request)
    {

        $this->validator($request->all())->validate();

        $announcement = new Announcement;
        $announcement->message = $request->message_body;
        $announcement->user_id = \Auth::id();

        if ($announcement->save()) {
            $this->broadCastCurrentAnnouncement($announcement);
            return back()->with('success', 'Message has been Announced!');
        }

        return back()->with('error', 'Announcement failed to Announce!');
    }

    public function show($id)
    {
        return redirect(route('announcements'));
    }

    protected function validator(array $data)
    {
        return \Validator::make($data, [
       
            'message_body' => 'required|string'
        ]);
    }
}
