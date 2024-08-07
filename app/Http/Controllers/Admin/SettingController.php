<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Settings;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function profile()
    {
        $adminId = Session::get('adminId');
        // $userData =  DB::table('users')->where('id',$id)->get()[0];
        $adminData =  DB::table('admins')->where('id',$adminId)->get()[0];
        // $user = User::find($id);

        $data = array(
            'title' => 'Admin Profile',
            'userData' => $adminData
        );

        return view('admin.ad-profile', compact('data'));
    }


    public function update_profile(Request $request)
    {
        $adminId = Session::get('adminId');

        $this->validate(request(), [
            'email'    => 'required|email|unique:admins,email,'.$adminId,
        ]);

        $fileName = "";

        $userData = array(
            'name'         => $request['fname'],
            'email'         => $request['email'],
            'phone'         => @$request['phone'],
            'updated_at'    => date('Y-m-d H:i:s')
        );

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/users');
            $image->move($destinationPath, $fileName);

            $userData['profile_image'] = @$fileName;
        }

        if ($request['oldProfileImage'] && $request->hasFile('image')) {

            if ($request['oldProfileImage'] && file_exists(public_path() . "/uploads/users/" . @$request['oldProfileImage'])) {
                $filePath = public_path() . "/uploads/users/" . @$request['oldProfileImage'];
                unlink(@$filePath);
            }
        }

        Admin::where('id', $adminId)->update($userData);

        $type = "success";
        $msg = 'Admin profile updated successfully!';
        Session::flash($type, $msg);

        return redirect('ad-profile');
    }


    public function update_password(Request $request)
    {
        $this->validate(request(), [
            'c_password'          => 'required',
            'password'            => 'required|min:6',
            'confirm_password'    => 'min:6',
        ]);

        $adminId = Session::get('adminId');
        $data =  DB::table('admins')->where('id', $adminId)->get()[0];

        if (!Hash::check($request['c_password'], $data->password)) {
            $type = "error";
            $msg = 'Current password not matched!';
            Session::flash($type, $msg);

            return redirect('ad-profile');
        }

        $password = Hash::make($request['password']);
        $userData = array(
            'password'     => $password,
            'updated_at'   => date('Y-m-d H:i:s'),
        );

        Admin::where('id', $adminId)->update($userData);
        $type = "success";
        $msg = 'Password updated successfully.';
        Session::flash($type, $msg);
        
        return redirect('ad-profile');
    }

    public function site_settings(Request $request){
        $data = array(
			'title' => 'Site Settings',
			'page' => 'settings',
			'subpage' => 'site_settings'
		);

        $data['setting'] = Settings::where('settingId',1)->get()[0];
        $data['template'] = 'admin.sidebar';
        
		return view("admin.site-settings",compact('data'));

	}

    public function save(Request $request){

        $this->validate(request(),[

			'address'           => 'required|min:4|max:400',
			'email'             => 'required|email',
            'phone'             => 'required',
            'website_name'      => 'required',
            'website'           => 'required'

		]);
        
        $settingsData = array(
			    'address'           => $request['address'],
				'address_map'       => $request['address_map'],
				'email'             => $request['email'],
                'support_email'     => $request['support_email'],
				'phone'             => $request['phone'],
				'website_name'      => $request['website_name'],
				'website'           =>$request['website'],
				'facebook'          => $request['facebook'],
				'twitter'           => $request['twitter'],
				'instagram'         => $request['instagram'],
				'youtube'           => $request['youtube'],
                'pinterest'         => $request['pinterest'],
        );


         Settings::where('settingId',1)->update($settingsData);
         $type ="success";
         $msg = 'Settings updated successfully. ';
		 Session::flash($type,$msg);
		 return redirect('settings/site_settings');
    }

    public function logo(){
        $data = array(
			'title' => 'Logo Settings',
			'page' => 'settings',
			'subpage' => 'logo_settings'
		);

        $data['setting'] = Settings::where('settingId',1)->get()[0];
        $data['template'] = 'admin.sidebar';
		return view("admin.logo-settings",compact('data'));
    }


    public  function logosave(Request $request)
    {
        $this->validate(request(),[

			'title'          => 'required|min:4|max:100',
            'logo'         => 'max:10000000000|image|mimes:jpeg,png,jpg,gif',
            'favicon'         => 'max:10000000000|image|mimes:jpeg,png,jpg,gif',
            'footer_logo'         => 'max:10000000000|image|mimes:jpeg,png,jpg,gif',
		]);

        ini_set('max_execution_time', 0);

        ini_set('memory_limit', '-1');

        // FOR IMAGE

        if ($request->hasFile('logo')) {
            //UNLINK
            $path = public_path() . "/uploads/logo/" . $request['oldLogo'];
            @unlink($path);
            $files1 = $request->file('logo');
            $filename1 = md5($files1->getClientOriginalName() . rand() . time()) . '.' . $files1->extension();
            $destinationPath = public_path('/uploads/logo');
            $thumb_img = Image::make($files1->getRealPath())->resize(500, 400, function ($constraint) {
               $constraint->aspectRatio();
            });
            $thumb_img->save($destinationPath . '/' . $filename1, 80);
         } else {
            $filename1 = $request['oldLogo'];
         }


        if($request->hasFile('favicon')) {
            //UNLINK
            $path = public_path() . "/uploads/logo/" . $request['oldFavicon'];
            @unlink($path);
            $files1 = $request->file('favicon');
            $filename2 = md5($files1->getClientOriginalName() . rand() . time()) . '.' . $files1->extension();
            $destinationPath = public_path('/uploads/logo');
            $thumb_img = Image::make($files1->getRealPath())->resize(500, 400, function ($constraint) {
               $constraint->aspectRatio();
            });
            $thumb_img->save($destinationPath . '/' . $filename2, 80);
        } else {
            $filename2 = $request['oldFavicon'];
        }


        if($request->hasFile('footer_logo')) {
            //UNLINK
            $path = public_path() . "/uploads/logo/" . $request['oldfooterLogo'];
            @unlink($path);
            $files1 = $request->file('footer_logo');
            $filename3 = md5($files1->getClientOriginalName() . rand() . time()) . '.' . $files1->extension();
            $destinationPath = public_path('/uploads/logo');
            $thumb_img = Image::make($files1->getRealPath())->resize(500, 400, function ($constraint) {
               $constraint->aspectRatio();
            });
            $thumb_img->save($destinationPath . '/' . $filename3, 80);
        } else {
            $filename3 = $request['oldfooterLogo'];
        }

        $settingsData = array(
            'title' => $request['title'],
            'logo' => $filename1,
            'favicon' => $filename2,
            'footer_logo' => $filename3,
        );

        Settings::where('settingId',1)->update($settingsData);
        $type ="success";
        $msg = 'Settings updated successfully. ';
        Session::flash($type,$msg);
        return redirect('settings/logo');
    }
}
