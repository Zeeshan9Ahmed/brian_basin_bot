<?php

namespace App\Http\Controllers\Api\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\ChangePasswordRequest;
use App\Http\Requests\Api\User\Profile\UpdateProfileRequest;
use App\Http\Resources\LoggedInUser;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class ProfileController extends Controller
{

    public function profile()
    {
        $user = User::with('license_images')->whereId(auth()->id())->first();
        return apiSuccessMessage("Profile Data", new LoggedInUser($user));
    }
    public function completeProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        if($request->hasFile('license_images')){
            foreach ( $request->file('license_images') as $license_image )
            {
                $imageName = time().'.'.$license_image->getClientOriginalExtension();
                $license_image->move(public_path('/uploadedimages'), $imageName);
                $image = asset('uploadedimages')."/".$imageName;
                $arr = [
                    'user_id' => auth()->id(),
                    'license_image' => $image
                ];
                Photo::create($arr);
            }
        }

        if($request->hasFile('avatar')){
            $imageName = time().'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('/uploadedimages'), $imageName);
            $avatar = asset('uploadedimages')."/".$imageName;
            $user->avatar = $avatar;
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->emergency_number = $request->contact;
        $user->country_code = $request->country_code;
        $user->profile_completed = 1;
        // $user->is_active = 1;
        
        if ( $user->save() )
        {
            return commonSuccessMessage("Profile Updated Successfully");
        }

        return commonErrorMessage("Something went wrong" , 400);
        
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->old_password , $user->password))
        {
            return commonErrorMessage("InCorrect Old password , please try again",400);
        }

        if (Hash::check($request->new_password , $user->password))
        {
            return commonErrorMessage("New Password can not be match to Old Password",400);
        } 
        
        $user->password = bcrypt($request->new_password);
        $user->save();
        if( $user )
        {
            return commonSuccessMessage("Password Updated Successfully");
        }
            return commonErrorMessage("Something went wrong while updating old password", 400);
         
    
    }
}
