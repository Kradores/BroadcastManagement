<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListToDbListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if($event->action == 'new') {
            DB::table('ListaToBroadcast')->truncate();
        }

        $query = "LOAD DATA LOCAL INFILE '$event->path' INTO TABLE ListaToBroadcast FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES (@col1) SET msisdn=@col1;";
        DB::getPdo()->exec($query);
    }

    public function failed()
    {
        
    }
}
