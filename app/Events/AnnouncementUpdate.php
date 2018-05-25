<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;

class AnnouncementUpdate implements ShouldBroadCast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $announcements;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($announcements)
    {
        $this->announcements = $announcements;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['announcement-update'];
    }
}
