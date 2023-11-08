<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Notification\NotificationController;
use App\Http\Controllers\Admin\Page\PageController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Web\Admin\ForgotPasswordController;
use App\Http\Controllers\Web\Admin\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', function () {
    return response()->json(["status"=>0,"message"=>"Sorry User is Unauthorize"], 401);
})->name('login');



Route::get('/',[LoginController::class,'loginForm']);
Route::get('/login',[LoginController::class,'loginForm'])->name('loginform');

Route::get('/forgot-password',[ForgotPasswordController::class,'forgotPasswordForm']);
Route::post('admin/login',[LoginController::class,'login'])->name('admin.login');
Route::get('admin/logout',[LoginController::class,'logout']);

Route::group(['middleware' => 'isAdmin'], function (){

    Route::get('admin/dashboard',function()
    {
        return view('Admin.dashboard');        
    });
    Route::any('admin/settings', [AdminController::class,'myaccount']);
    Route::get('dashboard-data', [AdminController::class,'dashboard'])->name('admin.dashboard');

    Route::get('admin/users', [UserController::class,'index'])->name('admin.users');
    Route::get('export', [UserController::class,'export'])->name('admin.users.export');

    Route::get('admin/user/{id}',[UserController::class,'show']);
    Route::get('admin/user/status/{id}', [UserController::class,'updateStatus']);

    Route::get('admin/page/{name}',[PageController::class,'show']);
    Route::post('admin/page/update',[PageController::class,'update'])->name('admin.page.update');

    Route::get('admin/view-notification',[NotificationController::class, 'index'])->name('admin.view.notification');
    Route::get('admin/send-notification',[NotificationController::class, 'view'])->name('admin.send.notification');
    Route::post('admin/save-notification',[NotificationController::class, 'save'])->name('admin.save.notification');
    Route::get('admin/admin-notifications',[NotificationController::class, 'adminNotifications'])->name('admin.admin.notification');
});