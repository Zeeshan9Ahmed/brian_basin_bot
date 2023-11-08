<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminUpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function myaccount(AdminUpdateProfileRequest $request)
    {
        
        if ($request->method() == 'GET') {
            return view('Admin.settings.index');
        } else if ($request->method() == 'POST') {
            $section = $request->update_section;
            switch ($section) {
                case  'update_profile_information':
            // auth()->user()->email = trim($request->input("email"));
            auth()->user()->first_name = trim($request->input("first_name"));
            auth()->user()->last_name = trim($request->input("last_name"));
            if ($request->hasFile("profile_image")) {
                $avatar = uploadImage($request->file('profile_image'));
                auth()->user()->avatar = $avatar;
            }
                auth()->user()->save();
                return webcommonSuccessMessage("Profile Updated Successfully");
                break;
                
                case 'update_password_information':
                    if(password_verify($request->current_password , auth()->user()->password)){
                        auth()->user()->password = bcrypt($request->password);
                        auth()->user()->save();
                        return webcommonSuccessMessage("Password Changed Successfully");
                    }else{
                        return webcommonErrorMessage("Sorry Current password is Incorrect");
                    }
            }
        }
    }

    public function dashboard()
    {
        $dashboard_data = [
            'total_users' => User::where('role','user')->count(),
        ];
        
        return webapiSuccessMessage("Dashboard Data", $dashboard_data);
    }

}
