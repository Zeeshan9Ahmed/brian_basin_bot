<?php

namespace App\Providers;

use App\Events\AcceptFriendRequestEvent;
use App\Events\SendFriendRequestEvent;
use App\Events\SendNotificationToAdminEvent;
use App\Events\SendNotificationToUsersEvent;
use App\Listeners\AcceptFriendRequestListener;
use App\Listeners\SendFriendRequestListener;
use App\Listeners\SendNotificationToAdminListener;
use App\Listeners\SendNotificationToUsersListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendNotificationToAdminEvent::class => [
            SendNotificationToAdminListener::class
        ],
        SendNotificationToUsersEvent::class => [
            SendNotificationToUsersListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
