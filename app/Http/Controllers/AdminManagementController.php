<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class AdminManagementController extends Controller
{
      public function admin(){
          $adminrole=Role::where('delete_status',1)->get();
         $admin=User::where('delete_status',1)->get();
          return view('backend.users.index',compact('adminrole','admin'));
      }
      public function adminajax(){
        return  $admin=User::with('adminRole')->where('delete_status',1)->where('admin_id',Auth::user()->admin_id)->where('admin_role_id','!=',Auth::user()->admin_role_id)->get();
  
      }
      public function adminStore(Request $request){
        //   return $request;
        $this->validate($request,[
              'role_id' => 'required|max:255',
              'name' => 'required|max:255',
              'email' => 'required|email|max:255|unique:Users',
              'password' => 'required|min:6',
          ]);
              $admin=new User();
              $admin->name=$request->name;
              $admin->role_id=$request->role_id;
              $admin->email=$request->email;
              $admin->phone=$request->phone;
              $admin->password=Hash::make($request->password);
              $admin->save();
             Toastr::success('Add  User successful','Success');
             return back();
                  
      }
      public function adminFind(Request $request){
      //        return $request;
          return   $admin=User::findOrFail($request->id);
      }
      public function adminUpdate(Request $request){
          $admin=User::findOrFail($request->id);
            $admin->name=$request->name;
              $admin->role_id=$request->role_id;
              $admin->email=$request->email;
              $admin->phone=$request->phone;
              $admin->password=Hash::make($request->password);
              $admin->status=0;
              $admin->save();
              Toastr::success('Update  User successful','Success');
              return back();
      }
      public function adminDelete($id){
          $admin=User::findOrFail($id);
          if ($admin->delete_status==1){
              $admin->delete_status=0;
              $admin->status=0;
          }else{
              $admin->delete_status=1;
              $admin->status=1;
          }
          $admin->save();
          Toastr::success('Delete  User successful','Success');
          return back();
      }
      public function adminActive($id){
          $admin=User::findOrFail($id);
          if ($admin->status==1){
              $admin->status=0;
          }else{
              $admin->status=1;
          }
          $admin->save();
        //   return response(json_encode(['success' => 'Your data Delete Success full']));
             Toastr::Success('admin User Active Inactive Update Successful','Success');
             return back();
      }
}
