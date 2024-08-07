<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller

{
    public function __construct()
    {
		$this->middleware('auth:admin');		
    }
    /**

     * Show the Admin Dashboard Page.

     *

     * @return \Illuminate\Http\Response

     */

	public function admin_dashboard(Request $request){
        $data = array(
			'title' => 'RH Divine Center',
			'page' => 'dashboard',
			'subpage' => ''
		);

        // $data["usersctn"] = DB::table('users')->where('c_id', $id)->count();
        $data["usersctn"] = DB::table('users')->count();
        // $data["job_statusctn"] = DB::table('job_status')->where('job_status', '1')->count();
        // $data["notictn"] = DB::table('notifications')->count();

        $data['template'] = 'admin.sidebar';

		return view("admin.adminHome",compact('data'));

	}


    public function admin_profile(){
        $data = array(
            'title' => 'Profile',
            'page' => 'dashboard',
            'subpage' => ''
        );
        $adminId =  Session::get('adminId');
        $data['adminData'] =  DB::table('admins')->where('id',$adminId)->get()[0];
        $data['template'] = 'admin.sidebar';
        return view("admin.profile",compact('data'));
    }

    public function admin_update_profile(Request $request,$adminId){
        $this->validate(request(),[

			'name'          => 'required|min:4|max:100',
			'email'         => 'required|email',
            'phone'         => 'required|min:10|max:10',
			
		]);	
        $adminData = array(
			'name'         => $request['name'],
			'email'        => $request['email'],
			'phone'        => $request['phone'],
            'updated_at'   => date('Y-m-d H:i:s'),
      );

      Admin::where('id', $adminId)->update($adminData);
         $type ="success";
         $msg = 'Admin profile updated successfully. ';
		 Session::flash($type,$msg);
		 return redirect('admin-profile');		
    }

    public function admin_change_password(){
        $data = array(
			'title' => 'Change Password',
			'page' => 'dashboard',
			'subpage' => ''
		);
      
        $data['template'] = 'admin.sidebar';
		return view("admin.change-password",compact('data'));
    }

    public function admin_update_password(Request $request){
        $this->validate(request(),[
			'c_password'          => 'required',
            'n_password'         => 'required|confirmed|min:6|max:8|required_with:n_password_confirmation|same:n_password_confirmation',
            'n_password_confirmation' => 'min:6|max:8',
		]);	
      $adminId =  Session::get('adminId');
      $data =  DB::table('admins')->where('id',$adminId)->get()[0];
      
      if(!Hash::check($request['c_password'],$data->password)){
        $type ="error";
        $msg = 'Current password not match. ';
        Session::flash($type,$msg);
        return redirect('admin-change-password');
      }
      $password = Hash::make($request['n_password']);
      $adminData = array(
			'password'     =>$password,
            'updated_at'   => date('Y-m-d H:i:s'),
      );
  
      Admin::where('id', $adminId)->update($adminData);
         $type ="success";
         $msg = 'Change password updated successfully. ';
		 Session::flash($type,$msg);
		 return redirect('admin-change-password');
    }

	public function adminlogout(Request $request)
    { 
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->intended('/admin');

    }	
}

