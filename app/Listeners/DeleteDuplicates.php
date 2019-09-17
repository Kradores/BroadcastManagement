<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteDuplicates implements ShouldQueue
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
        $delete = "DELETE FROM ListaToBroadcast WHERE id IN 
                    (
                        SELECT id FROM 
                        (
                            SELECT t1.id id FROM ListaToBroadcast t1
                            INNER JOIN
                            (
                                SELECT MAX(id) id, msisdn FROM ListaToBroadcast GROUP BY msisdn
                            ) t0
                            ON 
                            t1.id <> t0.id AND t1.msisdn = t0.msisdn
                        ) t10
                    );";
        DB::connection()->select(DB::raw($delete));
    }
}
