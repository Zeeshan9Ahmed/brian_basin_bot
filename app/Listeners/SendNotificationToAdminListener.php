<?php

namespace App\Listeners;

use App\Events\SendNotificationToAdminEvent;
use App\Models\User;
use App\Services\Notifications\CreateDBNotification;
use App\Services\Notifications\PushNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationToAdminListener
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
     * @param  \App\Events\SendNotificationToAdminEvent  $event
     * @return void
     */
    public function handle(SendNotificationToAdminEvent $event)
    {
        $admin = User::where('role','admin')->get()->pluck(['device_token'])->toArray();
        
        $data = [
            'to_user_id'        =>  0,
            'from_user_id'      =>  $event->user->id,
            'notification_type' =>  'SOS',
            'title'             =>  "SOS Alert from " .$event->user->first_name ." " .$event->user->last_name,
            'redirection_id'    =>   0,
            'description'       => 'SOS DESCRIPTION',
        ];
        
        $save_notification = app(CreateDBNotification::class)->execute($data);
        return $send_push = app(PushNotificationService::class)->execute($data,$admin);

    }
}
