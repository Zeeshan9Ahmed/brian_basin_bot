<?php

use App\Http\Controllers\Api\User\Auth\LoginController;
use App\Http\Controllers\Api\User\Auth\PasswordController;
use App\Http\Controllers\Api\User\Auth\SignUpController;
use App\Http\Controllers\Api\User\Core\IndexController;
use App\Http\Controllers\Api\User\OTP\VerificationController;
use App\Http\Controllers\Api\User\Profile\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/login', function () {
    return response()->json(["status"=>0,"message"=>"Sorry User is Unauthorize"], 401);
})->name('login');

Route::post('signup', [SignUpController::class, 'signUp']);
Route::post('signup/resend-otp', [SignUpController::class, 'resendSignUpOtp']);

Route::post('otp-verify', [VerificationController::class, 'otpVerify']);

Route::post('login', [LoginController::class, 'login']);
Route::post('forgot-password', [PasswordController::class, 'forgotPassword']);
Route::post('reset/forgot-password', [PasswordController::class, 'resetForgotPassword']);
Route::get('content', [IndexController::class, 'content']);


Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::post('change-password', [ProfileController::class , 'changePassword']);
    Route::post('update-profile', [ProfileController::class , 'completeProfile']);
    Route::get('profile', [ProfileController::class , 'profile']);
    Route::post('logout', [LoginController::class , 'logout']);

    Route::post('allow-permission', [IndexController::class, 'allowPermission']);
    Route::post('update-location', [IndexController::class, 'updateLocation']);
    Route::post('delete-license-image', [IndexController::class, 'deleteLicenseImage']);
    Route::post('send-sos-notification', [IndexController::class, 'sendSosNotification']);

});