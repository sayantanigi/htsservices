<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\EmployeeGallery;

class UserController extends Controller
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


    public function users()
    {
        $users = User::orderBy('id','desc')->get();

        $data = array(
            'title' => 'Employee List',
            'list' => $users
        );

        Session::forget('carrier_id');
        Session::forget('carrier_type');
        Session::forget('carrier_cont_id');
        Session::forget('carrier_rate_id');
        Session::forget('carrier_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('carrier_tab');
        Session::forget('employee_tab');
        Session::forget('employee_id');

        return view('admin.employee', compact('data'));
    }

    public function addEmployee()
    {
        $employee_id = Session::has('employee_id');

        Session::forget('carrier_id');
        Session::forget('carrier_type');
        Session::forget('carrier_cont_id');
        Session::forget('carrier_rate_id');
        Session::forget('carrier_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('carrier_tab');

        $types = DB::table('identification_types')->where('status', '1')->orderBy('id','desc')->get();
        $divisons = DB::table('divisons')->where('status', '1')->orderBy('id','desc')->get();
        $ports = DB::table('port_lists')->where('status', '1')->orderBy('id','desc')->get();
        $countries = DB::table('countries')->orderBy('name','asc')->get();
        $warehouse = DB::table('warehouse')->orderBy('name','asc')->get();

        $userData = [];
        $states = [];
        $billingstates = [];
        $other_address = [];
        $gallery = [];

        if (Session::has('employee_id')) {

            $employee_id = Session::get('employee_id');
            $userData = DB::table('users')->where('id', $employee_id)->first();
            $other_address = DB::table('emplpoyee_other_address')->where('employee_id', @$employee_id)->orderBy('id','desc')->get();
            $gallery = DB::table('employee_galleries')->where('employee_id', $employee_id)->orderBy('id','desc')->get();

            if(!empty($userData->country)) {
                $states = DB::table('states')->where('country_id', @$userData->country)->orderBy('name','asc')->get();
            }

            if(!empty($userData->billing_country)) {
                $billingstates = DB::table('states')->where('country_id', @$userData->billing_country)->orderBy('name','asc')->get();
            }
        }

        if(!empty($employee_id)) {
            $notInArray = [$employee_id];
            $salesperson = DB::table('users')->whereNotIn('id', $notInArray)->orderBy('id','desc')->get();
        } else {
            $salesperson = DB::table('users')->orderBy('id','desc')->get();
        }

        $data = array(
            'title'                     => 'Add New Employee',
            'subpage'                   => 'airemploee',
            'types'                     => $types,
            'divisons'                  => $divisons,
            'ports'                     => $ports,
            'countries'                 => $countries,
            'states'                    => $states,
            'billingstates'             => $billingstates,
            'warehouse'                 => $warehouse,
            'userData'                  => $userData,
            'salesperson'               => $salesperson,
            'other_address'             => $other_address,
            'gallery'                   => $gallery,
        );

        return view('admin.add-employee', compact('data'));
    }


    public function createUserOld(Request $request)
    {

        $this->validate(request(), [
            'fname'    => 'required',
            'lname'     => 'required',
            'email'     => 'required|email|unique:users,email',
            'user_name'     => 'required|unique:users,user_name',
            'password' => 'required|min:6',
        ]);

        $usrData = new User();

        $randomNumber = random_int(1000, 9999);

        $usrData->fname                     = $request['fname'];
        $usrData->lname                     = $request['lname'];
        $usrData->email                     = $request['email'];
        $usrData->password                  = Hash::make($request['password']);
        $usrData->address                   = $request['address'];
        $usrData->phone                     = $request['phone'];
        $usrData->user_type                 = $request['user_type'];
        $usrData->status                    = '1';
        $usrData->email_verified            = '1';
        $usrData->created_at                = date('Y-m-d h:i:s');

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/users');
            $image->move($destinationPath, $fileName);

            $usrData->profile_image  = @$fileName;
        }

        $usrData->save();

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('users');
    }

    public function createUser(Request $request)
    {

        $email = $request->email;
        $user_name = $request->user_name;


        if (Session::has('employee_id')) {
            // do some thing if the key is exist
            $employee_id = Session::get('employee_id');

            $existingUser = User::where('email', $email)
                ->where('id', '!=', $employee_id)
                ->first();

            $existingUserName = User::where('user_name', $user_name)
                ->where('id', '!=', $employee_id)
                ->first();

            if ($existingUser) {
                // The email exists for another user
                Session::put('employee_tab', 'generale');

                $msg = 'Sorry! Email already taken!';

                $type = "error";
                Session::flash($type, $msg);

                return redirect('add-employee');
            }

            if ($existingUserName) {
                // The email exists for another user
                Session::put('employee_tab', 'generale');

                $msg = 'Sorry! Username already taken!';

                $type = "error";
                Session::flash($type, $msg);

                return redirect('add-employee');
            }


            $dataArray = [
                'name'                                    => $request->name,
                'entity_id'                               => $request->entity_id,
                'citizenship'                             => $request->citizenship,
                'date_of_birth'                           => date("Y-m-d", strtotime($request->date_of_birth)),
                'email'                                   => $request->email,
                'password'                                => Hash::make($request['password']),
                'encoded_password'                        => base64_encode($request['password']),
                'user_name'                               => $request->user_name,
                'divison_permission'                      => $request->divison_permission,
                'identification_number'                   => $request->identification_number,
                'indentification_type'                    => $request->indentification_type,
                'divison'                                 => $request->divison,
                'pin_number'                              => $request->pin_number,
                'warehouse'                               => $request->warehouse,
                'is_hts_user'                             => @$request->is_hts_user ? '1' : '0',
                'hts_explorer'                            => @$request->hts_explorer ? '1' : '0',
                'wms_mobile'                              => @$request->wms_mobile ? '1' : '0',
                'flow_wms'                                => @$request->flow_wms ? '1' : '0',
                'final_me'                                => @$request->final_me ? '1' : '0',
                'api'                                     => @$request->api ? '1' : '0',
                'status'                                  => (@$request->usr_status=='0') ? '0' : '1',
                'updated_at'                              => date('Y-m-d h:i:s')
            ];
    
            $affected = DB::table('users')
                ->where('id', $employee_id)
                ->update($dataArray);

        } else {

            $user = User::where('email', $email)->first();
            $username = User::where('user_name', $user_name)->first();

            if ($user) {

                Session::put('employee_tab', 'generale');

                $msg = 'Sorry! Email already taken!';

                $type = "error";
                Session::flash($type, $msg);

                return redirect('add-employee');
            }

            if ($username) {

                Session::put('employee_tab', 'generale');

                $msg = 'Sorry! Username already taken!';

                $type = "error";
                Session::flash($type, $msg);

                return redirect('add-employee');
            }

            $user = $this->generate_otp(6);

            $isExist = DB::table('users')->where('employee_id', $user)
                ->exists();
            
            if ($isExist) {

                $employee_auto_id = $this->generate_otp(6);
            } else {
                $employee_auto_id = $user;
            }

            $emp_auto_id = DB::table('users')->insertGetId([
                'user_type'                               => 1,
                'employee_id'                             => $employee_auto_id,
                'name'                                    => $request->name,
                'entity_id'                               => $request->entity_id,
                'citizenship'                             => $request->citizenship,
                'date_of_birth'                           => date("Y-m-d", strtotime($request->date_of_birth)),
                'email'                                   => $request->email,
                'password'                                => Hash::make($request['password']),
                'encoded_password'                        => base64_encode($request['password']),
                'user_name'                               => $request->user_name,
                'divison_permission'                      => $request->divison_permission,
                'identification_number'                   => $request->identification_number,
                'indentification_type'                    => $request->indentification_type,
                'divison'                                 => $request->divison,
                'pin_number'                              => $request->pin_number,
                'warehouse'                               => $request->warehouse,
                'is_hts_user'                             => @$request->is_hts_user ? '1' : '0',
                'hts_explorer'                            => @$request->hts_explorer ? '1' : '0',
                'wms_mobile'                              => @$request->wms_mobile ? '1' : '0',
                'flow_wms'                                => @$request->flow_wms ? '1' : '0',
                'final_me'                                => @$request->final_me ? '1' : '0',
                'api'                                     => @$request->api ? '1' : '0',
                'status'                                  => (@$request->usr_status=='0') ? '0' : '1',
                'created_at'                              => date('Y-m-d h:i:s')
            ]);

            Session::put('employee_id', $emp_auto_id);
        }

        Session::put('employee_tab', 'generale');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-employee');
    }

    public function updateEmpData(Request $request, $employee_id)
    {

        $email = $request->email;
        $user_name = $request->user_name;


        // do some thing if the key is exist

        $existingUser = User::where('email', $email)
            ->where('id', '!=', $employee_id)
            ->first();

        $existingUserName = User::where('user_name', $user_name)
            ->where('id', '!=', $employee_id)
            ->first();

        if ($existingUser) {
            // The email exists for another user
            Session::put('employee_tab', 'generale');

            $msg = 'Sorry! Email already taken!';

            $type = "error";
            Session::flash($type, $msg);

            return redirect('editEmployee/'.$employee_id);
        }

        if ($existingUserName) {
            // The email exists for another user
            Session::put('employee_tab', 'generale');

            $msg = 'Sorry! Username already taken!';

            $type = "error";
            Session::flash($type, $msg);

            return redirect('editEmployee/'.$employee_id);
        }


        $dataArray = [
            'name'                                    => $request->name,
            'entity_id'                               => $request->entity_id,
            'citizenship'                             => $request->citizenship,
            'date_of_birth'                           => date("Y-m-d", strtotime($request->date_of_birth)),
            'email'                                   => $request->email,
            'user_name'                               => $request->user_name,
            'divison_permission'                      => $request->divison_permission,
            'identification_number'                   => $request->identification_number,
            'indentification_type'                    => $request->indentification_type,
            'divison'                                 => $request->divison,
            'pin_number'                              => $request->pin_number,
            'warehouse'                               => $request->warehouse,
            'is_hts_user'                             => @$request->is_hts_user ? '1' : '0',
            'hts_explorer'                            => @$request->hts_explorer ? '1' : '0',
            'wms_mobile'                              => @$request->wms_mobile ? '1' : '0',
            'flow_wms'                                => @$request->flow_wms ? '1' : '0',
            'final_me'                                => @$request->final_me ? '1' : '0',
            'api'                                     => @$request->api ? '1' : '0',
            'status'                                  => (@$request->usr_status=='0') ? '0' : '1',
            'updated_at'                              => date('Y-m-d h:i:s')
        ];

        if(!empty($request['edit_password'])) {
            $dataArray['password'] = Hash::make($request['edit_password']);
            $dataArray['encoded_password'] = base64_encode($request['edit_password']);
        }

        $affected = DB::table('users')
            ->where('id', $employee_id)
            ->update($dataArray);

        Session::put('employee_tab', 'generale');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editEmployee/'.$employee_id);
    }

    public function updateParentEntityEmp(Request $request)
    {
        $employee_id = Session::get('employee_id');

        $dataArray = [
            'parent_entity'                => $request->parent_entity,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('users')
                ->where('id', $employee_id)
                ->update($dataArray);

        Session::put('employee_tab', 'relatedentitiese');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-employee');
    }

    public function updateParentEntityUsr(Request $request, $employee_id)
    {

        $dataArray = [
            'parent_entity'                => $request->parent_entity,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('users')
                ->where('id', $employee_id)
                ->update($dataArray);

        Session::put('employee_tab', 'relatedentitiese');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editEmployee/'.$employee_id);
    }
    
    public function updateUsrAddress(Request $request)
    {
        $employee_id = Session::get('employee_id');

        if(@$request->same_as_maddress=="1") {
            $billing_street_number = $request->street_number;
            $billing_city = $request->city;
            $billing_country = $request->country;
            $billing_state = $request->state;
            $billing_zip_code = $request->zip_code;
            $billing_port = $request->port;
        } else {
            $billing_street_number = $request->billing_street_number;
            $billing_city = $request->billing_city;
            $billing_country = $request->billing_country;
            $billing_state = $request->billing_state;
            $billing_zip_code = $request->billing_zip_code;
            $billing_port = $request->billing_port;
        }

        $dataArray = [
            'phone'                                => $request->phone,
            'extension'                            => $request->extension,
            'mobile_phone'                         => $request->mobile_phone,
            'fax'                                  => $request->fax,
            'same_as_maddress'                     => $request->same_as_maddress,
            'street_number'                        => $request->street_number,
            'city'                                 => $request->city,
            'country'                              => $request->country,
            'state'                                => $request->state,
            'zip_code'                             => $request->zip_code,
            'port'                                 => $request->port,
            'billing_street_number'                => $billing_street_number,
            'billing_city'                         => $billing_city,
            'billing_country'                      => $billing_country,
            'billing_state'                        => $billing_state,
            'billing_zip_code'                     => $billing_zip_code,
            'billing_port'                         => $billing_port,
            'updated_at'                           => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('users')
                ->where('id', $employee_id)
                ->update($dataArray);

        Session::put('employee_tab', 'addresse');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-employee');
    }

    public function updateUsrAddressEmp(Request $request, $employee_id)
    {

        if(@$request->same_as_maddress=="1") {
            $billing_street_number = $request->street_number;
            $billing_city = $request->city;
            $billing_country = $request->country;
            $billing_state = $request->state;
            $billing_zip_code = $request->zip_code;
            $billing_port = $request->port;
        } else {
            $billing_street_number = $request->billing_street_number;
            $billing_city = $request->billing_city;
            $billing_country = $request->billing_country;
            $billing_state = $request->billing_state;
            $billing_zip_code = $request->billing_zip_code;
            $billing_port = $request->billing_port;
        }

        $dataArray = [
            'phone'                                => $request->phone,
            'extension'                            => $request->extension,
            'mobile_phone'                         => $request->mobile_phone,
            'fax'                                  => $request->fax,
            'same_as_maddress'                     => $request->same_as_maddress,
            'street_number'                        => $request->street_number,
            'city'                                 => $request->city,
            'country'                              => $request->country,
            'state'                                => $request->state,
            'zip_code'                             => $request->zip_code,
            'port'                                 => $request->port,
            'billing_street_number'                => $billing_street_number,
            'billing_city'                         => $billing_city,
            'billing_country'                      => $billing_country,
            'billing_state'                        => $billing_state,
            'billing_zip_code'                     => $billing_zip_code,
            'billing_port'                         => $billing_port,
            'updated_at'                           => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('users')
                ->where('id', $employee_id)
                ->update($dataArray);

        Session::put('employee_tab', 'addresse');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editEmployee/'.$employee_id);
    }

    public function updateUsrOtherAddress(Request $request)
    {
        $employee_id = Session::get('employee_id');

        $dataArray = [
            'employee_id'                        => $employee_id,
            'other_description'                  => $request->other_description,
            'other_contact_name'                 => $request->other_contact_name,
            'other_street_number'                => $request->other_street_number,
            'other_city'                         => $request->other_city,
            'other_country'                      => $request->other_country,
            'other_state'                        => $request->other_state,
            'other_zip_code'                     => $request->other_zip_code,
            'other_port'                         => $request->other_port,
            'created_at'                         => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('emplpoyee_other_address')
                ->insert($dataArray);

        Session::put('employee_tab', 'otheraddressese');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-employee');
    }

    public function updateUsrOtherAddressEmp(Request $request, $employee_id)
    {

        $dataArray = [
            'employee_id'                        => $employee_id,
            'other_description'                  => $request->other_description,
            'other_contact_name'                 => $request->other_contact_name,
            'other_street_number'                => $request->other_street_number,
            'other_city'                         => $request->other_city,
            'other_country'                      => $request->other_country,
            'other_state'                        => $request->other_state,
            'other_zip_code'                     => $request->other_zip_code,
            'other_port'                         => $request->other_port,
            'created_at'                         => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('emplpoyee_other_address')
                ->insert($dataArray);

        Session::put('employee_tab', 'otheraddressese');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editEmployee/'.$employee_id);
    }

    public function saveEmployeeOtherAddress(Request $request)
    {
        $employee_id = Session::get('employee_id');

        $other_id = $request->other_id;

        $dataArray = [
            'other_description'                  => $request->other_description_edt,
            'other_contact_name'                 => $request->other_contact_name_edt,
            'other_street_number'                => $request->other_street_number_edt,
            'other_city'                         => $request->other_city_edt,
            'other_country'                      => $request->other_country_edt,
            'other_state'                        => $request->other_state_edt,
            'other_zip_code'                     => $request->other_zip_code_edt,
            'other_port'                         => $request->other_port_edt,
            'updated_at'                         => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('emplpoyee_other_address')
                ->where('id', $other_id)
                ->update($dataArray);

        Session::put('employee_tab', 'otheraddressese');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-employee');
    }

    public function saveEmployeeOtherAddressEmp(Request $request, $employee_id)
    {

        $other_id = $request->other_id;

        $dataArray = [
            'other_description'                  => $request->other_description_edt,
            'other_contact_name'                 => $request->other_contact_name_edt,
            'other_street_number'                => $request->other_street_number_edt,
            'other_city'                         => $request->other_city_edt,
            'other_country'                      => $request->other_country_edt,
            'other_state'                        => $request->other_state_edt,
            'other_zip_code'                     => $request->other_zip_code_edt,
            'other_port'                         => $request->other_port_edt,
            'updated_at'                         => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('emplpoyee_other_address')
                ->where('id', $other_id)
                ->update($dataArray);

        Session::put('employee_tab', 'otheraddressese');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editEmployee/'.$employee_id);
    }

    public function getemployeeimages(Request $request)
    {
        $employee_id = Session::get('employee_id');

        $listing_gallery = DB::table('employee_galleries')->where('employee_id', $employee_id)->orderBy('id','desc')->get();


        $data = array(
            'listing_gallery' => $listing_gallery,
        );

        return view('admin.ajax-employee-gallery-list', compact('data'));
    }

    public function getemployeeimagesEdt(Request $request, $employee_id)
    {

        $listing_gallery = DB::table('employee_galleries')->where('employee_id', $employee_id)->orderBy('id','desc')->get();


        $data = array(
            'listing_gallery' => $listing_gallery,
        );

        return view('admin.ajax-employee-edt-gallery-list', compact('data'));
    }

    public function dropzoneStoreForEmployee(Request $request)
    {
        $employee_id = Session::get('employee_id');

        $path = public_path('uploads/files');

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $imageName);

        $imageUpload = new EmployeeGallery();
        $imageUpload->employee_id = $employee_id;
        $imageUpload->filename = $imageName;
        $imageUpload->created_at = date("Y-m-d H:i:s");
        $imageUpload->save();

        Session::put('employee_tab', 'attachmentse');

        return response()->json([
            'original_name' => $imageName,
        ]);
    }

    public function dropzoneStoreForEmployeeEdt(Request $request, $employee_id)
    {

        $path = public_path('uploads/files');

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $imageName);

        $imageUpload = new EmployeeGallery();
        $imageUpload->employee_id = $employee_id;
        $imageUpload->filename = $imageName;
        $imageUpload->created_at = date("Y-m-d H:i:s");
        $imageUpload->save();

        Session::put('employee_tab', 'attachmentse');

        return response()->json([
            'original_name' => $imageName,
        ]);
    }

    public function addUsrNote(Request $request)
    {
        $employee_id = Session::get('employee_id');

        $dataArray = [
            'usr_note'               => $request->usr_note,
            'updated_at'             => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('users')
                ->where('id', $employee_id)
                ->update($dataArray);

        Session::put('employee_tab', 'notese');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-employee');
    }

    public function addUsrNoteEdt(Request $request, $employee_id)
    {

        $dataArray = [
            'usr_note'               => $request->usr_note,
            'updated_at'             => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('users')
                ->where('id', $employee_id)
                ->update($dataArray);

        Session::put('employee_tab', 'notese');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editEmployee/'.$employee_id);
    }

    public function deleteEmployeeGalleryImage($id)
    {
        $listing_gallery = DB::table('employee_galleries')->where('id', $id)->first();
        $filename =  $listing_gallery->filename;

        $path=public_path().'/uploads/files/'.$filename;

        if (file_exists($path)) {
            unlink($path);
        }

        $delete = DB::table('employee_galleries')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'File has been not deleted. ';
        } else {
            $type = "success";
            $msg = ' File deleted successfully. ';
        }

        Session::put('employee_tab', 'attachmentse');
    
        Session::flash($type, $msg);
        
        return redirect('add-employee');
    }

    public function deleteEmployeeGalleryImageEdt($id)
    {
        $listing_gallery = DB::table('employee_galleries')->where('id', $id)->first();
        $filename =  $listing_gallery->filename;
        $employee_id = $listing_gallery->employee_id;

        $path=public_path().'/uploads/files/'.$filename;

        if (file_exists($path)) {
            unlink($path);
        }

        $delete = DB::table('employee_galleries')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'File has been not deleted. ';
        } else {
            $type = "success";
            $msg = ' File deleted successfully. ';
        }

        Session::put('employee_tab', 'attachmentse');
    
        Session::flash($type, $msg);
        
        return redirect('editEmployee/'.$employee_id);
    }

    public function deleteUsrOtherAddress(Request $request, $id)
    {
        $employee_id = Session::get('employee_id');

        $delete = DB::table('emplpoyee_other_address')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' Other Address has been not deleted ';
        } else {
            $type = "success";
            $msg = ' Other Address deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        Session::put('employee_tab', 'otheraddressese');

        return redirect('add-employee');
    }

    public function deleteUsrOtherAddressEmp(Request $request, $id)
    {
        
        $usr = DB::table('emplpoyee_other_address')->where('id', $id)->first();
        $employee_id = @$usr->employee_id;

        $delete = DB::table('emplpoyee_other_address')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' Other Address has been not deleted ';
        } else {
            $type = "success";
            $msg = ' Other Address deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        Session::put('employee_tab', 'otheraddressese');

        return redirect('editEmployee/'.$employee_id);
    }

    public function generate_otp($length)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function editEmployee(Request $request, $employee_id)
    {
        $data = array(
            'title' => 'Edit Employee Details',
            'page' => 'users',
            'subpage' => 'userEdit'
        );

        $types = DB::table('identification_types')->where('status', '1')->orderBy('id','desc')->get();
        $divisons = DB::table('divisons')->where('status', '1')->orderBy('id','desc')->get();
        $ports = DB::table('port_lists')->where('status', '1')->orderBy('id','desc')->get();
        $countries = DB::table('countries')->orderBy('name','asc')->get();
        $warehouse = DB::table('warehouse')->orderBy('name','asc')->get();

        $userData = [];
        $states = [];
        $billingstates = [];
        $other_address = [];
        $gallery = [];

        if ($employee_id) {

            $userData = DB::table('users')->where('id', $employee_id)->first();
            $other_address = DB::table('emplpoyee_other_address')->where('employee_id', @$employee_id)->orderBy('id','desc')->get();
            $gallery = DB::table('employee_galleries')->where('employee_id', $employee_id)->orderBy('id','desc')->get();

            if(!empty($userData->country)) {
                $states = DB::table('states')->where('country_id', @$userData->country)->orderBy('name','asc')->get();
            }

            if(!empty($userData->billing_country)) {
                $billingstates = DB::table('states')->where('country_id', @$userData->billing_country)->orderBy('name','asc')->get();
            }
        }

        if(!empty($employee_id)) {
            $notInArray = [$employee_id];
            $salesperson = DB::table('users')->whereNotIn('id', $notInArray)->orderBy('id','desc')->get();
        } else {
            $salesperson = DB::table('users')->orderBy('id','desc')->get();
        }

        $data = array(
            'title'                     => 'Add New Employee',
            'subpage'                   => 'airemploee',
            'employee_id'               => $employee_id,
            'types'                     => $types,
            'divisons'                  => $divisons,
            'ports'                     => $ports,
            'countries'                 => $countries,
            'states'                    => $states,
            'billingstates'             => $billingstates,
            'warehouse'                 => $warehouse,
            'userData'                  => $userData,
            'salesperson'               => $salesperson,
            'other_address'             => $other_address,
            'gallery'                   => $gallery,
        );

        return view('admin.edit-employee', compact('data'));
    }

    public function viewEmployee(Request $request, $employee_id)
    {
        $data = array(
            'title' => 'View Employee Details',
            'page' => 'users',
            'subpage' => 'userEdit'
        );

        $types = DB::table('identification_types')->where('status', '1')->orderBy('id','desc')->get();
        $divisons = DB::table('divisons')->where('status', '1')->orderBy('id','desc')->get();
        $ports = DB::table('port_lists')->where('status', '1')->orderBy('id','desc')->get();
        $countries = DB::table('countries')->orderBy('name','asc')->get();
        $warehouse = DB::table('warehouse')->orderBy('name','asc')->get();

        $userData = [];
        $states = [];
        $billingstates = [];
        $other_address = [];
        $gallery = [];

        if ($employee_id) {

            $userData = DB::table('users')->where('id', $employee_id)->first();
            $other_address = DB::table('emplpoyee_other_address')->where('employee_id', @$employee_id)->orderBy('id','desc')->get();
            $gallery = DB::table('employee_galleries')->where('employee_id', $employee_id)->orderBy('id','desc')->get();

            if(!empty($userData->country)) {
                $states = DB::table('states')->where('country_id', @$userData->country)->orderBy('name','asc')->get();
            }

            if(!empty($userData->billing_country)) {
                $billingstates = DB::table('states')->where('country_id', @$userData->billing_country)->orderBy('name','asc')->get();
            }
        }

        if(!empty($employee_id)) {
            $notInArray = [$employee_id];
            $salesperson = DB::table('users')->whereNotIn('id', $notInArray)->orderBy('id','desc')->get();
        } else {
            $salesperson = DB::table('users')->orderBy('id','desc')->get();
        }

        $data = array(
            'title'                     => 'Add New Employee',
            'subpage'                   => 'airemploee',
            'employee_id'               => $employee_id,
            'types'                     => $types,
            'divisons'                  => $divisons,
            'ports'                     => $ports,
            'countries'                 => $countries,
            'states'                    => $states,
            'billingstates'             => $billingstates,
            'warehouse'                 => $warehouse,
            'userData'                  => $userData,
            'salesperson'               => $salesperson,
            'other_address'             => $other_address,
            'gallery'                   => $gallery,
        );

        return view('admin.view-employee', compact('data'));
    }


    public function updateUser(Request $request, $id)
    {

        $this->validate(request(), [
            'fname'    => 'required',
            'lname'     => 'required',
            'email'     => 'required|email',
        ]);

        $usrData = array();

        $usrData['fname']                     = $request['fname'];
        $usrData['lname']                     = $request['lname'];
        $usrData['email']                     = $request['email'];
        $usrData['user_type']                 = $request['user_type'];

        if($request['edpassword']){
            $usrData['password']= Hash::make($request['edpassword']);
        }
        
        $usrData['address']= $request['address'];
        $usrData['phone']= $request['phone'];

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/users');
            $image->move($destinationPath, $fileName);

            $usrData['profile_image'] = @$fileName;
        }

        if ($request['oldProfileImage'] && $request->hasFile('image')) {

            if ($request['oldProfileImage'] && file_exists(public_path() . "/uploads/users/" . @$request['oldProfileImage'])) {
                $filePath = public_path() . "/uploads/users/" . @$request['oldProfileImage'];
                unlink(@$filePath);
            }
        }
        
        User::where('id', $id)->update($usrData);

        $msg = 'Record update successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('users');
    }

    public function updateUserStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = User::where('id', $id)->update($usrData);

        if ($status == 1) {
            $msg = 'User has been activated successfully!';
        } else {
            $msg = 'User has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }


    public function deleteUser(Request $request, $id)
    {
        $userData = User::find($id);
        $image = @$userData->profile_image;

        if ($image && file_exists(public_path() . "/uploads/users/" . @$image)) {
            $filePath = public_path() . "/uploads/users/" . @$image;
            unlink(@$filePath);
        }

        $listing_gallery = DB::table('employee_galleries')->where('employee_id', $id)->get();

        if(!empty($listing_gallery)) {
            foreach ($listing_gallery as $key => $value) {
                # code...
                $filename2 =  $value->filename;

                $path2=public_path().'/uploads/files/'.$filename2;

                if (file_exists($path2)) {
                    unlink($path2);
                }
            }
        }
        

            $delete = User::where('id', $id)->delete();

            if (!$delete) {
                $type = "error";
                $msg = ' User has been not deleted ';
            } else {
                DB::table('emplpoyee_other_address')->where('employee_id', $id)->delete();
                DB::table('employee_galleries')->where('employee_id', $id)->delete();

                $type = "success";
                $msg = ' User deleted successfully. ';
            }
        
        Session::flash($type, $msg);
        return redirect('employees');
    }

    public function viewUser(Request $request, $id)
    {
        $data = array(
            'title' => 'User Detail',
            'page' => 'users',
            'subpage' => 'userEdit'
        );

        $data["userData"] = User::find($id);

        return view("admin.view-member", compact('data'));
    }

}
