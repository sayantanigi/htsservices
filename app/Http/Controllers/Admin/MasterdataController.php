<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\DB;
use App\Models\listingGallery;

class MasterdataController extends Controller
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
    

     public function identificationTypes()
    {
        $types = DB::table('identification_types')->orderBy('name','asc')->get();

        $data = array(
            'title' => 'Identification Type List',
            'page' => 'lists',
            'subpage' => 'types',
            'list' => $types
        );

        return view('admin.identification-types', compact('data'));
    }

    public function divisons()
    {
        $list = DB::table('divisons')->orderBy('name','asc')->get();

        $data = array(
            'title' => 'Divison List',
            'page' => 'lists',
            'subpage' => 'divisons',
            'list' => $list
        );

        return view('admin.divisons', compact('data'));
    }

    public function ports()
    {
        $list = DB::table('port_lists')
            ->leftJoin('countries', 'port_lists.country_id', '=', 'countries.id')
            ->select(DB::raw('port_lists.*, countries.name as country_name'))
            ->orderBy('port_lists.country_id','asc')->get();

        $countries = DB::table('countries')->orderBy('name','asc')->get();

        $data = array(
            'title' => 'Port List',
            'page' => 'ports',
            'subpage' => 'ports',
            'list' => $list,
            'countries' => $countries
        );

        return view('admin.ports', compact('data'));
    }

    public function frequency()
    {
        $list = DB::table('carrier_frequency')->orderBy('name','asc')->get();

        $data = array(
            'title' => 'Frequency List',
            'page' => 'lists',
            'subpage' => 'frequency',
            'list' => $list
        );

        return view('admin.frequency', compact('data'));
    }

    public function commodity()
    {
        $list = DB::table('carrier_commodity')->orderBy('name','asc')->get();

        $data = array(
            'title' => 'Commodity List',
            'page' => 'lists',
            'subpage' => 'commodity',
            'list' => $list
        );

        return view('admin.commodity', compact('data'));
    }

    public function carrierCodes()
    {
        // $list = DB::table('carrier_codes')->orderBy('carrier_code','asc')->get();
        $list = DB::table('carrier_codes')->join('carriers_types', 'carriers_types.id', '=', 'carrier_codes.carrier_type')
             ->select('carrier_codes.*', 'carriers_types.name as typename')
             ->orderBy('carrier_codes.id', 'desc')
             ->get();

        $data = array(
            'title' => 'Carrier Code List',
            'page' => 'lists',
            'subpage' => 'codes',
            'list' => $list
        );

        return view('admin.carrier-codes', compact('data'));
    }

    public function transportation()
    {
        $list = DB::table('transportation')->orderBy('id','desc')->get();

        $data = array(
            'title' => 'Transportation List',
            'page' => 'lists',
            'subpage' => 'transportation',
            'list' => $list
        );

        return view('admin.transportation', compact('data'));
    }

    public function pmtTerms()
    {
        $list = DB::table('pmt_terms')->orderBy('id','desc')->get();

        $data = array(
            'title' => 'Payment Terms List',
            'page' => 'lists',
            'subpage' => 'pmtTerms',
            'list' => $list
        );

        return view('admin.pmt_terms', compact('data'));
    }

    public function freight_service_class()
    {
        $list = DB::table('freight_service_class')->orderBy('id','desc')->get();

        $data = array(
            'title' => 'Freight Service Class List',
            'page' => 'lists',
            'subpage' => 'service_class',
            'list' => $list
        );

        return view('admin.freight_service_class', compact('data'));
    }

    public function customCharge()
    {
        $list = DB::table('charge_list')->orderBy('id','desc')->get();

        $data = array(
            'title' => 'Custom Charge List',
            'page' => 'lists',
            'subpage' => 'charge',
            'list' => $list
        );

        return view('admin.custom-charge', compact('data'));
    }

    public function flights()
    {
        // $list = DB::table('carrier_codes')->orderBy('carrier_code','asc')->get();
        $list = DB::table('flights')->select('flights.*')
             ->orderBy('id', 'desc')
             ->get();

        $data = array(
            'title' => 'Flight List',
            'page' => 'lists',
            'subpage' => 'flight',
            'list' => $list
        );

        return view('admin.flights', compact('data'));
    }


    public function filter_data_exist(Request $request)
	{
		if (array_key_exists('type_name', $_POST)) {

			$type_name = $request['type_name'];

            if (DB::table('identification_types')->where('name', '=', $type_name)->where('name', '!=', '')->exists()) {
                // user found
                echo json_encode(FALSE);
             } else {
                echo json_encode(TRUE);
             }
		}
	}

    public function createType(Request $request)
    {

        $usrData = array(
            'name'     => $request['type_name'],
            'status'        => 1,
            'created_at'    => date('Y-m-d h:i:s')
        );

        DB::table('identification_types')->insert($usrData);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('identification-types');
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
    

    public function createDivison(Request $request)
    {

        $usrData = array(
            'name'     => $request['divison_name'],
            'status'        => 1,
            'created_at'    => date('Y-m-d h:i:s')
        );

        DB::table('divisons')->insert($usrData);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('divisons');
    }
    
    public function createPort(Request $request)
    {
        $transportation_method = "";

        if(!empty($request->transportation_method)) {
            $transportation_method = implode(",", @$request->transportation_method);
        }

        if(!empty($request->used_by_company)) {
            $used_by_company = @$request->used_by_company;
        } else {
            $used_by_company = 0;
        }

        $usrData = array(
            'country_id'                => $request['port_country'],
            'port_id'                   => $request['port_id'],
            'name'                      => $request['port_name'],
            'subdivision'               => $request['subdivision'],
            'remarks'                   => $request['remarks'],
            'transportation_method'     => @$transportation_method,
            'used_by_company'           => @$used_by_company,
            'notes'                     => $request['notes'],
            'status'                    => 1,
            'created_at'                => date('Y-m-d h:i:s')
        );

        DB::table('port_lists')->insert($usrData);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('ports');
    }
    
    public function createFrequency(Request $request)
    {

        $usrData = array(
            'name'     => $request['port_name'],
            'status'        => 1,
            'created_at'    => date('Y-m-d h:i:s')
        );

        DB::table('carrier_frequency')->insert($usrData);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('frequency');
    }

    public function createCommodity(Request $request)
    {

        $usrData = array(
            'name'     => $request['port_name'],
            'status'        => 1,
            'created_at'    => date('Y-m-d h:i:s')
        );

        DB::table('carrier_commodity')->insert($usrData);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('commodity');
    }
    
    public function createCarrierCode(Request $request)
    {

        $usrData = array(
            'carrier_type'              => $request->carrier_type,
            'carrier_code'              => $request->carrier_code,
            'carrier_description'       => $request->carrier_description,
            'status'                    => 1,
            'created_at'                => date('Y-m-d h:i:s')
        );

        DB::table('carrier_codes')->insert($usrData);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('carrier-codes');
    }
    
    public function createTransportation(Request $request)
    {

        $usrData = array(
            'code'                      => $request->carrier_code,
            'method'                    => $request->carrier_method,
            'description'               => $request->carrier_description,
            'status'                    => 1,
            'created_at'                => date('Y-m-d h:i:s')
        );

        DB::table('transportation')->insert($usrData);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('transportation');
    }

    public function createPmtTerms(Request $request)
    {

        $usrData = array(
            'due_days'                  => $request->due_days,
            'discount_pe'               => $request->discount_pe,
            'discount_days'             => $request->discount_days,
            'description'               => $request->description,
            'status'                    => $request->status,
            'created_at'                => date('Y-m-d h:i:s')
        );

        DB::table('pmt_terms')->insert($usrData);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('pmt-terms');
    }

    public function createFreightServiceClass(Request $request)
    {

        $usrData = array(
            'code'                      => $request->carrier_code,
            'account_name'              => $request->account_name,
            'description'               => $request->carrier_description,
            'status'                    => 1,
            'created_at'                => date('Y-m-d h:i:s')
        );

        DB::table('freight_service_class')->insert($usrData);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('freight-service-class');
    }

    public function createCustomCharge(Request $request)
    {

        $usrData = array(
            'code'                      => $request->carrier_code,
            'account_name'              => $request->account_name,
            'description'               => $request->carrier_description,
            'status'                    => 1,
            'created_at'                => date('Y-m-d h:i:s')
        );

        DB::table('charge_list')->insert($usrData);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('custom-charge');
    }

    public function createFlight(Request $request)
    {

        $usrData = array(
            'fight_number'              => $request->carrier_code,
            'passenger'                 => $request->carrier_description,
            'status'                    => 1,
            'created_at'                => date('Y-m-d h:i:s')
        );

        DB::table('flights')->insert($usrData);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('flights');
    }

    public function updateIdentification(Request $request)
    {

        $usrData = array(
            'name'     => $request['type_name_edt']
        );

        
        DB::table('identification_types')->where('id', $request['type_id'])->update($usrData);

        $msg = 'Record update successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('identification-types');
    }
    
    public function updateDivison(Request $request)
    {

        $usrData = array(
            'name'     => $request['type_name_edt']
        );

        
        DB::table('divisons')->where('id', $request['divison_id'])->update($usrData);

        $msg = 'Record update successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('divisons');
    }
    
    public function updatePort(Request $request)
    {
        if(!empty($request->transportation_method_edt)) {
            $transportation_method = implode(",", @$request->transportation_method_edt);
        }

        if(!empty($request->used_by_company_edt)) {
            $used_by_company = @$request->used_by_company_edt;
        } else {
            $used_by_company = 0;
        }


        $usrData = array(
            'country_id'                => $request['port_country_edt'],
            'port_id'                   => $request['port_id_edt'],
            'name'                      => $request['port_name_edt'],
            'subdivision'               => $request['subdivision_edt'],
            'remarks'                   => $request['remarks_edt'],
            'transportation_method'     => @$transportation_method,
            'used_by_company'           => @$used_by_company,
            'notes'                     => $request['notes_edt'],
        );

        
        DB::table('port_lists')->where('id', $request['port_id'])->update($usrData);

        $msg = 'Record update successfully.';
        $type = "success";
        Session::flash($type, $msg);

        return redirect('ports');
    }
    
    public function updateFrequency(Request $request)
    {

        $usrData = array(
            'name'     => $request['type_name_edt']
        );

        
        DB::table('carrier_frequency')->where('id', $request['port_id'])->update($usrData);

        $msg = 'Record update successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('frequency');
    }

    public function updateCommodity(Request $request)
    {

        $usrData = array(
            'name'     => $request['type_name_edt']
        );

        
        DB::table('carrier_commodity')->where('id', $request['port_id'])->update($usrData);

        $msg = 'Record update successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('commodity');
    }
    
    public function updateCarrierCode(Request $request)
    {

        $usrData = array(
            'carrier_type'              => $request['carrier_type_edt'],
            'carrier_code'              => $request['carrier_code_edt'],
            'carrier_description'       => $request['carrier_description_edt']
        );

        
        DB::table('carrier_codes')->where('id', $request['code_id'])->update($usrData);

        $msg = 'Record update successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('carrier-codes');
    }
    
    public function updateTransportation(Request $request)
    {

        $usrData = array(
            'code'              => $request['carrier_code_edt'],
            'method'              => $request['carrier_method_edt'],
            'description'       => $request['carrier_description_edt']
        );

        
        DB::table('transportation')->where('id', $request['code_id'])->update($usrData);

        $msg = 'Record update successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('transportation');
    }

    public function updatePmtTerms(Request $request)
    {

        $usrData = array(
            'due_days'                  => $request->due_days_edt,
            'discount_pe'               => $request->discount_pe_edt,
            'discount_days'             => $request->discount_days_edt,
            'description'               => $request->description_edt,
            'status'                    => $request->status,
        );

        
        DB::table('pmt_terms')->where('id', $request['code_id'])->update($usrData);

        $msg = 'Record update successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('pmt-terms');
    }

    public function updateFreightServiceClass(Request $request)
    {

        $usrData = array(
            'code'              => $request['carrier_code_edt'],
            'account_name'      => $request['carrier_account_name_edt'],
            'description'       => $request['carrier_description_edt']
        );

        
        DB::table('freight_service_class')->where('id', $request['code_id'])->update($usrData);

        $msg = 'Record update successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('freight-service-class');
    }

    public function updateCustomCharge(Request $request)
    {

        $usrData = array(
            'code'              => $request['carrier_code_edt'],
            'account_name'      => $request['carrier_account_name_edt'],
            'description'       => $request['carrier_description_edt']
        );

        
        DB::table('charge_list')->where('id', $request['code_id'])->update($usrData);

        $msg = 'Record update successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('custom-charge');
    }

    public function updateFlight(Request $request)
    {

        $usrData = array(
            'fight_number'              => $request['carrier_code_edt'],
            'passenger'                 => $request['carrier_description_edt']
        );

        
        DB::table('flights')->where('id', $request['code_id'])->update($usrData);

        $msg = 'Record update successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('flights');
    }
    
    public function updateIdentiTypeStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = DB::table('identification_types')->where('id', $id)->update($usrData);

        if ($status == 1) {
            $msg = 'Type has been activated successfully!';
        } else {
            $msg = 'Type has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }

    public function changeDivisonStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = DB::table('divisons')->where('id', $id)->update($usrData);

        if ($status == 1) {
            $msg = 'Divison has been activated successfully!';
        } else {
            $msg = 'Divison has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }
    
    public function changePortStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = DB::table('port_lists')->where('id', $id)->update($usrData);

        if ($status == 1) {
            $msg = 'Port has been activated successfully!';
        } else {
            $msg = 'Port has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }
    
    public function changeFrequencyStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = DB::table('carrier_frequency')->where('id', $id)->update($usrData);

        if ($status == 1) {
            $msg = 'Carrier frequency has been activated successfully!';
        } else {
            $msg = 'Carrier frequency has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }

    public function changeCommodityStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = DB::table('carrier_commodity')->where('id', $id)->update($usrData);

        if ($status == 1) {
            $msg = 'Commodity has been activated successfully!';
        } else {
            $msg = 'Commodity has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }
    
    public function changeCodeStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = DB::table('carrier_codes')->where('id', $id)->update($usrData);

        if ($status == 1) {
            $msg = 'Carrier Code has been activated successfully!';
        } else {
            $msg = 'Carrier Code has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }
    
    public function changeTransportationStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = DB::table('transportation')->where('id', $id)->update($usrData);

        if ($status == 1) {
            $msg = 'Transportation has been activated successfully!';
        } else {
            $msg = 'Transportation has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }

    public function changeFreightServiceClass(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = DB::table('freight_service_class')->where('id', $id)->update($usrData);

        if ($status == 1) {
            $msg = 'Freight Service Class has been activated successfully!';
        } else {
            $msg = 'Freight Service Class has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }

    public function changeChargeStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = DB::table('charge_list')->where('id', $id)->update($usrData);

        if ($status == 1) {
            $msg = 'Charge has been activated successfully!';
        } else {
            $msg = 'Charge has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }

    public function changeFlightStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = DB::table('flights')->where('id', $id)->update($usrData);

        if ($status == 1) {
            $msg = 'Flight has been activated successfully!';
        } else {
            $msg = 'Flight has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }

    public function deleteIdentificationType(Request $request, $id)
    {
        $delete = DB::table('identification_types')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' Type has been not deleted ';
        } else {
            $type = "success";
            $msg = ' Type deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('identification-types');
    }
    
    public function deleteDivison(Request $request, $id)
    {
        $delete = DB::table('divisons')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' Divison has been not deleted ';
        } else {
            $type = "success";
            $msg = ' Divison deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('divisons');
    }
    
    public function deletePort(Request $request, $id)
    {
        $delete = DB::table('port_lists')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' Port has been not deleted ';
        } else {
            $type = "success";
            $msg = ' Port deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('ports');
    }
    
    public function deleteFrequency(Request $request, $id)
    {
        $delete = DB::table('carrier_frequency')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' Frequency has been not deleted ';
        } else {
            $type = "success";
            $msg = ' Frequency deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('frequency');
    }

    public function deleteCommodity(Request $request, $id)
    {
        $delete = DB::table('carrier_commodity')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' Commodity has been not deleted ';
        } else {
            $type = "success";
            $msg = ' Commodity deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('commodity');
    }
    
    public function deleteCode(Request $request, $id)
    {
        $delete = DB::table('carrier_codes')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Carrier code has been not deleted ';
        } else {
            $type = "success";
            $msg = 'Carrier code deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('carrier-codes');
    }
    
    public function deleteTransportation(Request $request, $id)
    {
        $delete = DB::table('transportation')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Transportation has been not deleted ';
        } else {
            $type = "success";
            $msg = 'Transportation deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('transportation');
    }

    public function deletePmtTerms(Request $request, $id)
    {
        $delete = DB::table('pmt_terms')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Terms has been not deleted ';
        } else {
            $type = "success";
            $msg = 'Terms deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('pmt-terms');
    }

    public function deleteFreightServiceClass(Request $request, $id)
    {
        $delete = DB::table('freight_service_class')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'freight service class has been not deleted ';
        } else {
            $type = "success";
            $msg = 'freight service class deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('freight-service-class');
    }

    public function deleteCustomCharge(Request $request, $id)
    {
        $delete = DB::table('charge_list')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Charge has been not deleted ';
        } else {
            $type = "success";
            $msg = 'Charge deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('custom-charge');
    }

    public function deleteFlight(Request $request, $id)
    {
        $delete = DB::table('flights')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Flight has been not deleted ';
        } else {
            $type = "success";
            $msg = 'Flight deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('flights');
    }

    public function getCity(Request $request)
    {
        $state_county = $request['state_county'];
        $cities = DB::table('cities')->where('state_id', $state_county)->orderBy('name','asc')->get();

        $result = "";
		$result .= '<option value="">Select city...</option>';

		if (!empty($cities)) {
			foreach ($cities as $key => $value) {
				if ($key=='0') {
					$selected = "selected";
				}

				$result .= '<option value="' . $value->id . '">' . $value->name . '</option>';
			}

			echo $result;
		}
    }

    public function participationList()
    {
        $list = DB::table('hts_participations')->orderBy('id','desc')->get();

        $data = array(
            'title' => 'Participation List',
            'page' => 'lists',
            'subpage' => 'participation',
            'list' => $list
        );

        return view('admin.participation', compact('data'));
    }

    public function createParticipation(Request $request)
    {
        $usrData = array(
            'code'                      => $request->carrier_code,
            'account_name'              => $request->account_name,
            'description'               => $request->carrier_description,
            'status'                    => 1,
            'created_at'                => date('Y-m-d h:i:s')
        );

        DB::table('hts_participations')->insert($usrData);

        $msg = 'Record has saved successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('participation');
    }

    public function updateParticipation(Request $request)
    {

        $usrData = array(
            'code'              => $request['carrier_code_edt'],
            'account_name'      => $request['carrier_account_name_edt'],
            'description'       => $request['carrier_description_edt']
        );

        
        DB::table('hts_participations')->where('id', $request['code_id'])->update($usrData);

        $msg = 'Record has updated successfully.';

        $type = "success";
        Session::flash($type, $msg);
        return redirect('participation');
    }


    public function changeParticipationStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
        );

        $usrResponse = DB::table('hts_participations')->where('id', $id)->update($usrData);

        if ($status == 1) 
        {
            $msg = 'Participation Status has been activated successfully!';
        } else {
            $msg = 'Participation Status has been deactivated successfully!';
        }

        if ($usrResponse) {
            echo '["'.$msg.'", "success", "#A5DC86"]';
        } else {
            echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
        }
        
    }

    public function deleteParticipation(Request $request, $id)
    {
        $delete = DB::table('hts_participations')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Participation has been not deleted ';
        } else {
            $type = "success";
            $msg = 'Participation has deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('participation');
    }

}
