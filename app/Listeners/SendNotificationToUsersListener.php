<?php

namespace App\Listeners;

use App\Events\SendNotificationToUsersEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationToUsersListener
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
     * @param  \App\Events\SendNotificationToUsersEvent  $event
     * @return void
     */
    public function handle(SendNotificationToUsersEvent $event)
    {
        //
    }
}
