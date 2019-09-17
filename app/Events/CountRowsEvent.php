<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class CountRowsEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $before;
    public $after;
    public $userId;
    public $alert;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, array $alert, $before, $after)
    {
        $this->before = $before;
        $this->after = $after;
        $this->userId = $userId;
        $this->alert = $alert;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Count.Broadcast.List.'.$this->userId);
    }

    public function broadcastWith() {
        return [
            'before' => $this->before,
            'after' => $this->after,
            'alertType' => "alert-".$this->alert['type'],
            'message' => $this->alert['message'],
        ];
    }
}
