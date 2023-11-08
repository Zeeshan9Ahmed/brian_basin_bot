<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Services\Notifications\PushNotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $notifications = Notification::with('sender')->latest()->get();
            // $users = User::where('role' ,'user')->get();
            return DataTables::of($notifications)
            ->addColumn('avatar', function($notifications){
                if(is_null($notifications->sender->avatar)){
                    return '<img src="'.getDummyImageUrl().'" class="direct-chat-img" >';
                }else{
                    return '<img src="'.$notifications->sender->avatar.'" class="direct-chat-img" >';
                }
            })
            ->addColumn('users', function($notifications){
                return $notifications->sender->first_name;
            })
            ->editColumn('created_at', function($data){ 
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y'); 
            return $formatedDate; 
            })
            ->rawColumns(['action','avatar','users', 'status'])
            ->addIndexColumn()
            ->make(true);
           
        }
        return view('Admin.notifications.index');
    }

    public function view()
    {
        return view('Admin.notifications.send-notification');
    }

    public function save(Request $request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'to_user_id' => auth()->id(),
            'from_user_id' => auth()->id(),
            'redirection_id' => 0,
            'notification_is_read' => '0',
            'notification_type' => 'ADMIN'
        ];
        
        $send_notification = Notification::create($data);
        if ( $send_notification )
        {
            $this->sendNotificationToAllUsers($data);
            $redirect = url("admin/admin-notifications");
            return webcommonSuccessMessage("Notification Sent Successfully", false, $redirect);
        }
        
        return webcommonErrorMessage("Something Went Wrong , Please Try Again");
    }


    protected function sendNotificationToAllUsers($data)
    {
        $user_tokens = User::where(['role' => 'user', 'push_notification' => '1'])->get()->pluck('device_token')->toArray();
        $send_push = app(PushNotificationService::class)->execute($data,[$user_tokens]);
        
    }

    public function adminNotifications(Request $request)
    {
        
        if($request->ajax()){
            $notifications = Notification::where('notification_type', 'ADMIN')->latest()->get();
            // $users = User::where('role' ,'user')->get();
            return DataTables::of($notifications)
            ->editColumn('created_at', function($data){ 
                $formatedDate =  $data->created_at->diffForHumans(); 
            return $formatedDate; 
            })
            ->rawColumns([])
            ->addIndexColumn()
            ->make(true);
           
        }
        return view('Admin.notifications.admin-notifications');
    }
}
