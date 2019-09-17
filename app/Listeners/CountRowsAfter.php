<?php

namespace App\Listeners;

use App\Events\CountRowsEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CountRowsAfter implements ShouldQueue
{
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
        $rows = DB::connection()->table("ListaToBroadcast")->count('id');
        event(new CountRowsEvent($event->userId, ['type' => 'success', 'message' => 'Broadcast List Successfully Prepared '], 0, $rows));
    }
}
