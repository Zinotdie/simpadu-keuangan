<?php

namespace App\Listeners;

use App\Events\PembayaranSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPembayaranNotification
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
    public function handle(PembayaranSuccess $event): void
    {
        //
    }
}
