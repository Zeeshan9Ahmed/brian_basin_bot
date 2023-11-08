<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class LoggedInUser extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name??"",
            'last_name' => $this->last_name??"",
            'avatar' => $this->avatar??"",
            'email' => $this->email??"",
            'profile_completed' => $this->profile_completed,
            'device_type' => $this->device_type??"",
            'device_token' => $this->device_token??"",
            'emergency_number' => $this->emergency_number??"",
            'lat' => $this->lat??"",
            'lang' => $this->lang??"",
            'is_verified'=>$this->email_verified_at?1:0,
            'is_allowed_location' => $this->is_allowed_location?1:0,
            'is_allowed_push_notification' => $this->is_allowed_push_notification?1:0,
            'is_allowed_light_bird' => $this->is_allowed_light_bird?1:0,
            'is_allowed_flashy_bird' => $this->is_allowed_flashy_bird?1:0,
            'is_allowed_nav_bird' => $this->is_allowed_nav_bird?1:0,
            'is_allowed_loud_bird' => $this->is_allowed_loud_bird?1:0,
            // 'url' => $this->url,
            'is_subscribed' => isSubscribed(),
            'license_images' => LicenseImageResource::collection($this->whenLoaded('license_images')),

        ];
    }
}
