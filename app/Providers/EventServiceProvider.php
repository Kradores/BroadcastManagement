<?php

namespace App\Providers;

use App\Events\UpdateBroadcastListEvent;
use App\Events\UploadEvent;
use App\Listeners\DeleteFileListener;
use App\Listeners\ListToDbListener;
use App\Listeners\UploadListener;
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
