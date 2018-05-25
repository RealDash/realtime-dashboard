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

class TaskUpdate implements ShouldBroadCast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $task;
    public $activity;
    public $user;
    public $log;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $activity, $task)
    {   
        $this->user = $user->load('log');
        $this->task = $task;
        $this->activity = $activity;
        $this->log = $this->user->latest()->load('task');
        
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [$this->user->user_name];
    }
}
