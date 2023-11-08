<?php

namespace App\Http\Controllers\Admin\User;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Excel;
class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $users = User::where('role' ,'user')->get();
            return DataTables::of($users)
            ->addColumn('avatar', function($users){
                if(is_null($users->avatar)){
                    return '<img src="https://server.appsstaging.com/3346/boat-basin/public/assets/avatar.png" class="direct-chat-img" >';
                }else{
                    return '<img src="'.$users->avatar.'" class="direct-chat-img" >';
                }
            })
            ->addColumn('is_active', function($users){
                if($users->is_active){
                    return '<span class="badge badge-success">Active<span>';
                }else{
                    return '<span class="badge badge-danger">Deactive<span>';
                }
            })
            
            ->addColumn('action', function ($users) {
                $urlAction = url('admin/user/'.$users->id);
                $content = '<a href="' . $urlAction . '" class=" btn-sm btn-primary" title="View Details"><i class="fa fa-eye"></i></a>';
                return $content;
            })
            ->rawColumns(['action','avatar','is_active', 'status'])
            ->addIndexColumn()
            ->make(true);
           
        }
        return view('Admin.User.index');
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function show( $id )
    {
        $user = User::with('license_images')->findorFail($id);
        // return $user->license_images->count();
        return view('Admin.User.user-details', compact('user'));
    }

    public function updateStatus(Request $request, $id)
    {
            $user = User::findOrFail($id);

            if ($user->is_active == 1) {
                $user->is_active = "0";
                $user->save();
                return webcommonSuccessMessage("User Deactive Successfully");
            }
               $user->is_active = "1";
                $user->save();
                return webcommonSuccessMessage("User Active Successfully");
            
        
    }
}
