<?php

namespace App\Listeners;

use App\Events\KeringananStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendKeringananNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(KeringananStatusUpdated $event): void
    {
        //
    }
}
