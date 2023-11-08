<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\LoginRequest;
use App\Http\Resources\LoggedInUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        
        if ( Auth::attempt(['email' => $request->email, 'password' => $request->password]) )
        {
            $user = Auth::user();

            if ( $user->email_verified_at == null)
            {
                return commonErrorMessage("Account not verified Please Verify your account", 400);
            }
            
            $user->device_type = $request->device_type;
            $user->device_token = $request->device_token;
            $user->save();
            // $user->tokens()->delete();
            // $token =$user->createToken('authToken')->plainTextToken;
            $url = 'test';
            return apiSuccessMessage("User login Successfully", new LoggedInUser($user, $url), '$token');
        }

        return commonErrorMessage("Invalid Credientials", 400);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        $user->device_type = null;
        $user->device_token = null;
        $user->save();
        
        return commonSuccessMessage('Logged Out');

    }
}
