<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Announcement;
use App\Http\Resources\TaskLog\TaskLogResource;
use App\Http\Resources\TaskLog\TaskLogResourceCollection;

class AnnouncementController extends Controller
{
    public function apiGetAnnouncements()
    {
        $announcements = Announcement::orderBy('updated_at', 'desc')->get();
        
        return new TaskLogResourceCollection($announcements);
    }
}
