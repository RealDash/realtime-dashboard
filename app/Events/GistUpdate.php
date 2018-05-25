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

class GistUpdate implements ShouldBroadCast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $gists;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($gists)
    {
        $this->gists = $gists;
        $this->gists->load('user');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['gist-update'];
    }
}
