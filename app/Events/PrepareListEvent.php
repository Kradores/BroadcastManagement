<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PrepareListEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $msisdn;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($msisdn, $userId)
    {
        $this->msisdn = $msisdn;
        $this->userId = $userId;
    }
}
