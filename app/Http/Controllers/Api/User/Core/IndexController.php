<?php

namespace App\Http\Controllers\Api\User\Core;

use App\Events\SendNotificationToAdminEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CoreModule\AllowPermissionRequest;
use App\Http\Requests\Api\User\CoreModule\ContentRequest;
use App\Http\Requests\Api\User\CoreModule\DeleteImageRequest;
use App\Http\Requests\Api\User\CoreModule\UpdateLocationRequest;
use App\Mail\SendSoSMailToAdmin;
use App\Models\Content;
use App\Models\Photo;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class IndexController extends Controller
{
    public function deleteLicenseImage(DeleteImageRequest $request)
    {
        
        
        $license_image = Photo::find($request->image_id);
        
        
        if ( !$license_image )
        {
            return commonErrorMessage("No Image Found", 404);
        }
        
        if( $license_image->user_id != auth()->id() )
        {
            return commonErrorMessage("Can not delete Image ", 400);
        }
        $imageName =  last(explode('public/',$license_image->license_image));
        if(File::exists(public_path($imageName)))
        {
            File::delete(public_path($imageName));
        }
        if ( $license_image->delete() )
        {
            return commonSuccessMessage("Image Deleted Succesfully");
        }

        return commonErrorMessage("Something Went Wrong, Please try again", 400);

    }

    public function sendSosNotification()
    {
        $user = Auth::user();
        if ( $user->is_allowed_location == 0 )
        {
            return commonErrorMessage("Please Allow your location" , 400 );
        }
        
        $message = "Boat Basin Lightening  \nName: " . auth()->user()->first_name . " " .auth()->user()->last_name . "\nEmergency Contact Number: " .auth()->user()->country_code. auth()->user()->emergency_number 
        . "\nLocation: https://maps.google.com/?q=" . auth()->user()->lat. "," . auth()->user()->lang ;
        // return $message;
        return Mail::to('test@gmail.com')->send(new SendSoSMailToAdmin($message));
        return $this->sendMessage($message , '+923000267244');
        return env('TWILIO_SID');
        event( new SendNotificationToAdminEvent($user));
        return commonSuccessMessage("Notification Send Successfully");
    }

    private function sendMessage($message, $recipients)
    {
        $account_sid = env('TWILIO_SID');;
        $auth_token = env("TWILIO_AUTH_TOKEN");
        $twilio_number = env("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, 
                ['from' => $twilio_number, 'body' => $message] );
    }


    public function content(ContentRequest $request)
    {
        $content = Content::where('slug', $request->slug)->first();
        if ( !$content )
        {
            return commonErrorMessage("No Content Found", 404);
        }

        return apiSuccessMessage("Content", $content);
    }

    public function allowPermission(AllowPermissionRequest $request)
    {
        $type = $request->type;        
        if ( $type == 'receivePushNotification' )
        {
            return $this->changeNotificationStatus();
        }
        
        if ( $type == 'location' )
        {
            return $this->changeLocationStatus();
        }

        if ( $type == 'lightBirdMainLed' )
        {
            return $this->changeLighBirdStatus();
        }

        if ( $type == 'flashyBirdFlasher' )
        {
            return $this->changeFlashyBirdStatus();
        }

        if ( $type == 'navBirdNavLight' )
        {
            return $this->changeNavBirdStatus();
        }

        if ( $type == 'loudBirdHorn' )
        {
            return $this->changeLoudBirdStatus();
        }
    }

    public function updateLocation(UpdateLocationRequest $request)
    {
        auth()->user()->lat = $request->lat;
        auth()->user()->lang = $request->lang;
        auth()->user()->save();
        
        return commonSuccessMessage("Location Updated Successfully");
    }

    protected function changeNotificationStatus()
    {
        if ( auth()->user()->is_allowed_push_notification ) 
        {
            auth()->user()->is_allowed_push_notification = 0;
            auth()->user()->save();
            return commonSuccessMessage("Notifications permission turned off successfully");
        }
            auth()->user()->is_allowed_push_notification = 1;
            auth()->user()->save();
            return commonSuccessMessage("Notifications permission turned on successfully");
    }

    protected function changeLocationStatus()
    {
        
        if ( auth()->user()->is_allowed_location ) 
        {
            auth()->user()->is_allowed_location = 0;
            auth()->user()->save();
            return commonSuccessMessage("Location permission turned off successfully");
        }
            auth()->user()->is_allowed_location = 1;
            auth()->user()->save();
            return commonSuccessMessage("Location permission turned on successfully");
    }

    protected function changeLighBirdStatus()
    {
        
        if ( auth()->user()->is_allowed_light_bird ) 
        {
            auth()->user()->is_allowed_light_bird = 0;
            auth()->user()->save();
            return commonSuccessMessage("Light Bird permission turned off successfully");
        }
            auth()->user()->is_allowed_light_bird = 1;
            auth()->user()->save();
            return commonSuccessMessage("Light Bird permission turned on successfully");
    }

    protected function changeFlashyBirdStatus()
    {
        
        if ( auth()->user()->is_allowed_flashy_bird ) 
        {
            auth()->user()->is_allowed_flashy_bird = 0;
            auth()->user()->save();
            return commonSuccessMessage("Flashy Bird permission turned off successfully");
        }
            auth()->user()->is_allowed_flashy_bird = 1;
            auth()->user()->save();
            return commonSuccessMessage("Flashy Bird permission turned on successfully");
    }

    protected function changeNavBirdStatus()
    {
        
        if ( auth()->user()->is_allowed_nav_bird ) 
        {
            auth()->user()->is_allowed_nav_bird = 0;
            auth()->user()->save();
            return commonSuccessMessage("Nav Bird permission turned off successfully");
        }
            auth()->user()->is_allowed_nav_bird = 1;
            auth()->user()->save();
            return commonSuccessMessage("Nav Bird permission turned on successfully");
    }

    protected function changeLoudBirdStatus()
    {
        
        if ( auth()->user()->is_allowed_loud_bird ) 
        {
            auth()->user()->is_allowed_loud_bird = 0;
            auth()->user()->save();
            return commonSuccessMessage("Loud Bird permission turned off successfully");
        }
            auth()->user()->is_allowed_loud_bird = 1;
            auth()->user()->save();
            return commonSuccessMessage("Loud Bird permission turned on successfully");
    }
}
