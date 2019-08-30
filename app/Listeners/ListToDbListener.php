<?php

namespace App\Listeners;

use App\BroadcastList;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Translation\Loader\CsvFileLoader;

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

        $list = new BroadcastList();
        $csv = new CsvFileLoader();
        $csv->loadResource($event->path);
        // $query = "LOAD DATA LOCAL INFILE '$event->path' INTO TABLE ListaToBroadcast FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES (@col1) SET msisdn=@col1;";
        // DB::connection()->getPdo()->exec($query);
    }
}
