<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UpdateBroadcastListEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $action;
    public $path;
    public $folder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($action, $path, $folder)
    {
        $this->action = $action;
        $this->path = $path;
        $this->folder = $folder;
    }
}
