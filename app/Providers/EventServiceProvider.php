<?php

namespace App\Providers;

use App\Events\PrepareListEvent;
use App\Events\UpdateBroadcastListEvent;
use App\Listeners\CallForBroadcasting;
use App\Listeners\CountRowsAfter;
use App\Listeners\CountRowsBefore;
use App\Listeners\DeleteDuplicates;
use App\Listeners\DeleteFileListener;
use App\Listeners\ListToDbListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UpdateBroadcastListEvent::class => [
            ListToDbListener::class,
            DeleteFileListener::class,
        ],
        PrepareListEvent::class => [
            CountRowsBefore::class,
            DeleteDuplicates::class,
            CallForBroadcasting::class,
            CountRowsAfter::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
