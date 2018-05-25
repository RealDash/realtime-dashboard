<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Announcement;

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
        $announcement->subject = $request->subject;
        $announcement->message = $request->message_body;
        $announcement->user_id = \Auth::id();

        if ($announcement->save()) {
            return back()->with('success', 'Message has been Announced!');
        }

        return back()->with('error', 'Announcement failed to Announce!');
    }

    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'subject' => 'required|string|max:100',
            'message_body' => 'required|string'
        ]);
    }
}
