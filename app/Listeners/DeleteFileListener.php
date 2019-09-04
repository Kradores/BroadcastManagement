<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteFileListener implements ShouldQueue
{
    public $delay = 5;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Storage::disk('local')->delete($event->folder.'/'.basename($event->path));
    }
    
}
