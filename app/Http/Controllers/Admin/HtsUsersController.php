<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\DB;
use App\Models\HtsUsers;
use App\Models\HtsConGallery;
use App\Models\HtsGallery;

class HtsUsersController extends Controller
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
    

    public function agent_list(Request $request)
    {
        Session::forget('hts_user_id');
        Session::forget('hts_user_type');
        Session::forget('hts_cont_id');
        Session::forget('hts_rate_id');
        Session::forget('hts_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('carrier_tab');
        Session::forget('carrier_con_tab');

        $keyword = "";

        $keyword = $request['keyword'];

        $query = HtsUsers::query();

        $query->join('hts_user_types', 'hts_users.user_type', '=', 'hts_user_types.id')
            ->select(DB::raw('hts_users.*, hts_user_types.name as t_name'))
            ->where('hts_user_types.id','1');


        if (!empty($request->keyword)) 
        {

            $query->where(function ($query) use ($keyword) {
                $query->where('hts_users.name', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.mobile_phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.email', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.website', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.account_number', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.port', 'like', '%' . $keyword . '%');
            });  
        }

        $query->orderBy('hts_users.id','desc');
        // Paginate the results
        $users = $query->paginate(10);

        $data = array(
            'title'             => 'Forwarding Agent List',
            'page'              => 'agent',
            'subpage'           => 'agents',
            'list'              => $users,
            'keyword'           => $keyword
        );

        return view('admin.hts_users', $data);
    }

    public function changeHtsUserStatus(Request $request)
    {

        $id = $request['id'];
        $status = $request['status'];

        $usrData = array(
            'status'            => @$status,
            'updated_at'        => date('Y-m-d H:i:s')
        );

        $usrResponse = DB::table('hts_users')->where('id', $id)->update($usrData);

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

    public function addAgent($user_type)
    {

        if($user_type=="1")
        {
            $title = "Create new Forwarding Agent";
            $page = "agent";
            $subpage = "add_agent";

        } elseif ($user_type=="2") {

            $title = "Create new Provider";
            $page = "provider";
            $subpage = "add_provider";
            
        } elseif ($user_type=="3") {

            $title = "Create new Customer";
            $page = "customer";
            $subpage = "add_customer";

        } elseif ($user_type=="4") {

            $title = "Create new Vendor";
            $page = "vendor";
            $subpage = "add_vendor";

        } elseif ($user_type=="5") {

            $title = "Create new Salesperson";
            $page = "salesperson";
            $subpage = "add_alesperson";

        } elseif ($user_type=="6") {

            $title = "Create new Contact";
            $page = "contacts";
            $subpage = "contacts";

        }

        if(Session::get('hts_user_type')!=$user_type) {
            Session::forget('hts_user_id');
            Session::forget('hts_user_type');
            Session::forget('hts_cont_id');
            Session::forget('hts_rate_id');
            Session::forget('hts_charge_id');
            Session::forget('carrier_edt_tab');
            Session::forget('carrier_tab');
            Session::forget('carrier_con_tab');
        }

        Session::forget('carrier_id');
        Session::forget('carrier_type');
        Session::forget('carrier_cont_id');
        Session::forget('carrier_rate_id');
        Session::forget('carrier_charge_id');
        Session::forget('carrier_edt_tab');
        // Session::forget('carrier_tab');
        Session::forget('employee_tab');
        Session::forget('employee_id');
        Session::forget('hts_participation_id');

        $types = DB::table('identification_types')->where('status', '1')->orderBy('id','desc')->get();
        $divisons = DB::table('divisons')->where('status', '1')->orderBy('id','desc')->get();
        $ports = DB::table('port_lists')->where('status', '1')->orderBy('id','desc')->get();

        $landCodes = DB::table('carrier_codes')->where('carrier_type', '3')->where('status', '1')->orderBy('id','desc')->get();
        $oceanCodes = DB::table('carrier_codes')->where('carrier_type', '2')->where('status', '1')->orderBy('id','desc')->get();
        $airCodes = DB::table('carrier_codes')->where('carrier_type', '1')->where('status', '1')->orderBy('id','desc')->get();

        $flights = DB::table('flights')->where('status', '1')->orderBy('id','desc')->get();

        $countries = DB::table('countries')->orderBy('name','asc')->get();

        $transportation = DB::table('transportation')->where('status', '1')->orderBy('description','asc')->get();
        $freight_service_class = DB::table('freight_service_class')->where('status', '1')->orderBy('description','asc')->get();
        $carrier_frequency = DB::table('carrier_frequency')->where('status', '1')->orderBy('name','asc')->get();
        $carrier_commodity = DB::table('carrier_commodity')->where('status', '1')->orderBy('name','asc')->get();
        $charge_list = DB::table('charge_list')->where('status', '1')->orderBy('description','asc')->get();

        $htsUsersArray = [];
        $contactArray = [];
        $rateArray = [];
        $chargeArray = [];
        $carrier_contacts = [];
        $carrier_rates = [];
        $carrier_charges = [];
        $states = [];
        $constates = [];
        $billingstates = [];
        $conbillingstates = [];
        $conConstates = [];
        $other_address = [];
        $con_other_address = [];
        $gallery = [];
        $contact_gallery = [];
        $contact_notes = [];
        $cr_notes = [];
        $participations_charges = [];
        $awb_numbers = [];
        $pmt_master_terms = [];


        if (Session::has('hts_user_id')) {

            $hts_user_id = Session::get('hts_user_id');

                // do some thing if the key is exist
            $htsUsersArray = DB::table('hts_users')->where('id', $hts_user_id)->first();

            if(!empty($htsUsersArray->country)) {
                $states = DB::table('states')->where('country_id', @$htsUsersArray->country)->orderBy('name','asc')->get();
            }

            if(!empty($htsUsersArray->billing_country)) {
                $billingstates = DB::table('states')->where('country_id', @$htsUsersArray->billing_country)->orderBy('name','asc')->get();
            }

            $other_address = DB::table('hts_other_address')->where('user_id', @$hts_user_id)->orderBy('id','desc')->get();
            $cr_notes = DB::table('hts_notes')->where('user_id', $hts_user_id)->orderBy('id','desc')->get();
            $gallery = DB::table('hts_galleries')->where('user_id', $hts_user_id)->orderBy('id','desc')->get();

            $carrier_contacts = DB::table('hts_contacts')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $carrier_rates = DB::table('hts_rate_ground')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $carrier_charges = DB::table('hts_charges')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $participations_charges = DB::table('hts_participation_list')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $awb_numbers = DB::table('hts_air_waybills')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $pmt_master_terms = DB::table('pmt_terms')->orderBy('id', 'desc')->get();
        } 

        // Carrier contact module
        if (Session::has('hts_cont_id')) {

            $hts_cont_id = Session::get('hts_cont_id');

            // do some thing if the key is exist
            $contactArray = DB::table('hts_contacts')->where('id', $hts_cont_id)->first();
            $carrier_contacts = DB::table('hts_contacts')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $contact_gallery = DB::table('hts_con_galleries')->where('hts_cont_id', $hts_cont_id)->orderBy('id','desc')->get();
            $contact_notes = DB::table('hts_con_notes')->where('hts_cont_id', $hts_cont_id)->orderBy('id','desc')->get();

            if(!empty($contactArray->country)) {
                $constates = DB::table('states')->where('country_id', @$contactArray->country)->orderBy('name','asc')->get();
            }

            if(!empty($contactArray->billing_country)) {
                $conbillingstates = DB::table('states')->where('country_id', @$contactArray->billing_country)->orderBy('name','asc')->get();
            }

            if(!empty($contactArray->other_country)) {
                $conConstates = DB::table('states')->where('country_id', @$contactArray->other_country)->orderBy('name','asc')->get();
            }

            $isConStatusCompleted = DB::table('hts_contacts')->where('id', $hts_cont_id)->where('status', '2')->count();

            if($isConStatusCompleted>0) {
                // Session::put('carrier_cont_id_notes', $hts_cont_id);
                Session::forget('hts_cont_id');

                $contactArray = [];
            }
        }    

        // Carrier rate module
        if (Session::has('hts_rate_id')) {

            $hts_rate_id = Session::get('hts_rate_id');
            // do some thing if the key is exist
            $rateArray = DB::table('hts_rate_ground')->where('id', $hts_rate_id)->first();
            $carrier_rates = DB::table('hts_rate_ground')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();

            $isRateStatusCompleted = DB::table('hts_rate_ground')->where('id', $hts_rate_id)->where('completed_status', '2')->count();

            if($isRateStatusCompleted>0) {
                // Session::put('carrier_cont_id_notes', $hts_cont_id);
                Session::forget('hts_rate_id');

                $rateArray = [];
            }
                
        } 

        // Carrier charge module
        if (Session::has('hts_charge_id')) {

            $hts_charge_id = Session::get('hts_charge_id');

            // do some thing if the key is exist
            $chargeArray = DB::table('hts_charges')->where('id', $hts_charge_id)->first();
            $carrier_charges = DB::table('hts_charges')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();

            $isChargeStatusCompleted = DB::table('hts_charges')->where('id', $hts_charge_id)->where('completed_status', '2')->count();

            if($isChargeStatusCompleted>0) {
                // Session::put('carrier_cont_id_notes', $hts_cont_id);
                Session::forget('hts_charge_id');

                $chargeArray = [];
            }
                
        } 

        if(!empty($hts_user_id)) {
            $notInArray = [$hts_user_id];
            $all_users = DB::table('hts_users')->where('user_type', $user_type)->whereNotIn('id', $notInArray)->orderBy('id','desc')->get();

            if(!empty($hts_cont_id)) {
                $notInArrayCon = [$hts_cont_id];
                $all_carriers_contact = DB::table('hts_contacts')->where('user_id', $hts_user_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_contact = DB::table('hts_contacts')->where('user_id', $hts_user_id)->orderBy('id','asc')->get();
            }

            if(!empty($hts_rate_id)) {
                $notInArrayCon = [$hts_rate_id];
                $all_carriers_rate = DB::table('hts_rate_ground')->where('user_id', $hts_user_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_rate = DB::table('hts_rate_ground')->where('user_id', $hts_user_id)->orderBy('id','asc')->get();
            }
            
        } else {
            $all_users = DB::table('hts_users')->where('user_type', $user_type)->orderBy('id','desc')->get();
            $all_carriers_contact = [];
            $all_carriers_rate = [];
        }
        

        $participations = DB::table('hts_participations')->where('status', '1')->orderBy('id','asc')->get();

        $data = array(
            'title'                     => $title,
            'page'                      => $page,
            'subpage'                   => $subpage,
            'types'                     => $types,
            'divisons'                  => $divisons,
            'landCodes'                 => $landCodes,
            'oceanCodes'                => $oceanCodes,
            'airCodes'                  => $airCodes,
            'flights'                   => $flights,
            'userData'                  => $htsUsersArray,
            'userType'                  => $user_type,
            'contactData'               => $contactArray,
            'rateData'                  => $rateArray,
            'chargeData'                => $chargeArray,
            'carrier_contacts'          => $carrier_contacts,
            'carrier_rates'             => $carrier_rates,
            'carrier_charges'           => $carrier_charges,
            'countries'                 => $countries,
            'states'                    => $states,
            'constates'                 => $constates,
            'billingstates'             => $billingstates,
            'conbillingstates'          => $conbillingstates,
            'conConstates'              => $conConstates,
            'ports'                     => $ports,
            'other_address'             => $other_address,
            'gallery'                   => $gallery,
            'contact_gallery'           => $contact_gallery,
            'contact_notes'             => $contact_notes,
            'all_users'                 => $all_users,
            'cr_notes'                  => $cr_notes,
            'all_carriers_contact'      => $all_carriers_contact,
            'all_carriers_rate'         => $all_carriers_rate,
            'transportation'            => $transportation,
            'charge_list'               => $charge_list,
            'freight_service_class'     => $freight_service_class,
            'carrier_frequency'         => $carrier_frequency,
            'carrier_commodity'         => $carrier_commodity,
            'participations'            => $participations,
            'participations_charges'    => $participations_charges,
            'awb_numbers'               => $awb_numbers,
            'pmt_master_terms'          => $pmt_master_terms,
        );
            
        return view('admin.add-hts-user', compact('data'));
    }

    public function editAgent($hts_user_id)
    {

        $htsUserData = DB::table('hts_users')->find($hts_user_id);
        $hts_user_type = @$htsUserData->user_type;

        Session::forget('hts_user_id');
        Session::forget('hts_user_type');
        Session::forget('hts_cont_id');
        Session::forget('hts_rate_id');
        Session::forget('hts_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('carrier_tab');
        Session::forget('carrier_con_tab');

        Session::forget('carrier_id');
        Session::forget('carrier_type');
        Session::forget('carrier_cont_id');
        Session::forget('carrier_rate_id');
        Session::forget('carrier_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('employee_tab');
        Session::forget('employee_id');
        Session::forget('hts_participation_id');

        Session::put('hts_user_id', $hts_user_id);
        Session::put('hts_user_type', $hts_user_type);
        Session::put('carrier_tab', 'general');


        if($hts_user_type=='1')
        {
            return redirect('add-agent/'.$hts_user_type);
        } elseif($hts_user_type=='2')
        {
            return redirect('add-provider/'.$hts_user_type);
        } elseif($hts_user_type=='3')
        {
            return redirect('add-customer/'.$hts_user_type);
        } elseif($hts_user_type=='4')
        {
            return redirect('add-vendor/'.$hts_user_type);
        } elseif($hts_user_type=='5')
        {
            return redirect('add-salesperson/'.$hts_user_type);
        } elseif($hts_user_type=='6')
        {
            return redirect('add-contact/'.$hts_user_type);
        }
    }

    public function viewAgent($hts_user_id)
    {

        $htsUserData = DB::table('hts_users')->find($hts_user_id);
        $hts_user_type = @$htsUserData->user_type;

        Session::forget('hts_user_id');
        Session::forget('hts_user_type');
        Session::forget('hts_cont_id');
        Session::forget('hts_rate_id');
        Session::forget('hts_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('carrier_tab');
        Session::forget('carrier_con_tab');

        Session::forget('carrier_id');
        Session::forget('carrier_type');
        Session::forget('carrier_cont_id');
        Session::forget('carrier_rate_id');
        Session::forget('carrier_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('employee_tab');
        Session::forget('employee_id');
        Session::forget('hts_participation_id');

        Session::put('hts_user_id', $hts_user_id);
        Session::put('hts_user_type', $hts_user_type);
        Session::put('carrier_tab', 'general');


        return redirect('view-details/'.$hts_user_type);
    }

    public function viewDetails($user_type)
    {

        if($user_type=="1")
        {
            $title = "Details of Forwarding Agent";
            $page = "agent";
            $subpage = "add_agent";

        } elseif ($user_type=="2") {

            $title = "Details of Provider";
            $page = "provider";
            $subpage = "add_provider";
            
        } elseif ($user_type=="3") {

            $title = "Details of Customer";
            $page = "customer";
            $subpage = "add_customer";

        } elseif ($user_type=="4") {

            $title = "Details of Vendor";
            $page = "vendor";
            $subpage = "add_vendor";

        } elseif ($user_type=="5") {

            $title = "Details of Salesperson";
            $page = "salesperson";
            $subpage = "add_alesperson";

        } elseif ($user_type=="6") {

            $title = "Details of Contact";
            $page = "contacts";
            $subpage = "contacts";

        }

        if(Session::get('hts_user_type')!=$user_type) {
            Session::forget('hts_user_id');
            Session::forget('hts_user_type');
            Session::forget('hts_cont_id');
            Session::forget('hts_rate_id');
            Session::forget('hts_charge_id');
            Session::forget('carrier_edt_tab');
            Session::forget('carrier_tab');
            Session::forget('carrier_con_tab');
        }

        Session::forget('carrier_id');
        Session::forget('carrier_type');
        Session::forget('carrier_cont_id');
        Session::forget('carrier_rate_id');
        Session::forget('carrier_charge_id');
        Session::forget('carrier_edt_tab');
        // Session::forget('carrier_tab');
        Session::forget('employee_tab');
        Session::forget('employee_id');
        Session::forget('hts_participation_id');

        $types = DB::table('identification_types')->where('status', '1')->orderBy('id','desc')->get();
        $divisons = DB::table('divisons')->where('status', '1')->orderBy('id','desc')->get();
        $ports = DB::table('port_lists')->where('status', '1')->orderBy('id','desc')->get();

        $landCodes = DB::table('carrier_codes')->where('carrier_type', '3')->where('status', '1')->orderBy('id','desc')->get();
        $oceanCodes = DB::table('carrier_codes')->where('carrier_type', '2')->where('status', '1')->orderBy('id','desc')->get();
        $airCodes = DB::table('carrier_codes')->where('carrier_type', '1')->where('status', '1')->orderBy('id','desc')->get();

        $flights = DB::table('flights')->where('status', '1')->orderBy('id','desc')->get();

        $countries = DB::table('countries')->orderBy('name','asc')->get();

        $transportation = DB::table('transportation')->where('status', '1')->orderBy('description','asc')->get();
        $freight_service_class = DB::table('freight_service_class')->where('status', '1')->orderBy('description','asc')->get();
        $carrier_frequency = DB::table('carrier_frequency')->where('status', '1')->orderBy('name','asc')->get();
        $carrier_commodity = DB::table('carrier_commodity')->where('status', '1')->orderBy('name','asc')->get();
        $charge_list = DB::table('charge_list')->where('status', '1')->orderBy('description','asc')->get();

        $htsUsersArray = [];
        $contactArray = [];
        $rateArray = [];
        $chargeArray = [];
        $carrier_contacts = [];
        $carrier_rates = [];
        $carrier_charges = [];
        $states = [];
        $constates = [];
        $billingstates = [];
        $conbillingstates = [];
        $conConstates = [];
        $other_address = [];
        $con_other_address = [];
        $gallery = [];
        $contact_gallery = [];
        $contact_notes = [];
        $cr_notes = [];
        $participations_charges = [];
        $awb_numbers = [];
        $pmt_master_terms = [];


        if (Session::has('hts_user_id')) {

            $hts_user_id = Session::get('hts_user_id');

                // do some thing if the key is exist
            $htsUsersArray = DB::table('hts_users')->where('id', $hts_user_id)->first();

            if(!empty($htsUsersArray->country)) {
                $states = DB::table('states')->where('country_id', @$htsUsersArray->country)->orderBy('name','asc')->get();
            }

            if(!empty($htsUsersArray->billing_country)) {
                $billingstates = DB::table('states')->where('country_id', @$htsUsersArray->billing_country)->orderBy('name','asc')->get();
            }

            $other_address = DB::table('hts_other_address')->where('user_id', @$hts_user_id)->orderBy('id','desc')->get();
            $cr_notes = DB::table('hts_notes')->where('user_id', $hts_user_id)->orderBy('id','desc')->get();
            $gallery = DB::table('hts_galleries')->where('user_id', $hts_user_id)->orderBy('id','desc')->get();

            $carrier_contacts = DB::table('hts_contacts')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $carrier_rates = DB::table('hts_rate_ground')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $carrier_charges = DB::table('hts_charges')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $participations_charges = DB::table('hts_participation_list')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $awb_numbers = DB::table('hts_air_waybills')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $pmt_master_terms = DB::table('pmt_terms')->orderBy('id', 'desc')->get();
        } 

        // Carrier contact module
        if (Session::has('hts_cont_id')) {

            $hts_cont_id = Session::get('hts_cont_id');

            // do some thing if the key is exist
            $contactArray = DB::table('hts_contacts')->where('id', $hts_cont_id)->first();
            $carrier_contacts = DB::table('hts_contacts')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $contact_gallery = DB::table('hts_con_galleries')->where('hts_cont_id', $hts_cont_id)->orderBy('id','desc')->get();
            $contact_notes = DB::table('hts_con_notes')->where('hts_cont_id', $hts_cont_id)->orderBy('id','desc')->get();

            if(!empty($contactArray->country)) {
                $constates = DB::table('states')->where('country_id', @$contactArray->country)->orderBy('name','asc')->get();
            }

            if(!empty($contactArray->billing_country)) {
                $conbillingstates = DB::table('states')->where('country_id', @$contactArray->billing_country)->orderBy('name','asc')->get();
            }

            if(!empty($contactArray->other_country)) {
                $conConstates = DB::table('states')->where('country_id', @$contactArray->other_country)->orderBy('name','asc')->get();
            }

            $isConStatusCompleted = DB::table('hts_contacts')->where('id', $hts_cont_id)->where('status', '2')->count();

            if($isConStatusCompleted>0) {
                // Session::put('carrier_cont_id_notes', $hts_cont_id);
                Session::forget('hts_cont_id');

                $contactArray = [];
            }
        }    

        // Carrier rate module
        if (Session::has('hts_rate_id')) {

            $hts_rate_id = Session::get('hts_rate_id');
            // do some thing if the key is exist
            $rateArray = DB::table('hts_rate_ground')->where('id', $hts_rate_id)->first();
            $carrier_rates = DB::table('hts_rate_ground')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();

            $isRateStatusCompleted = DB::table('hts_rate_ground')->where('id', $hts_rate_id)->where('completed_status', '2')->count();

            if($isRateStatusCompleted>0) {
                // Session::put('carrier_cont_id_notes', $hts_cont_id);
                Session::forget('hts_rate_id');

                $rateArray = [];
            }
                
        } 

        // Carrier charge module
        if (Session::has('hts_charge_id')) {

            $hts_charge_id = Session::get('hts_charge_id');

            // do some thing if the key is exist
            $chargeArray = DB::table('hts_charges')->where('id', $hts_charge_id)->first();
            $carrier_charges = DB::table('hts_charges')->where('user_id', $hts_user_id)->orderBy('id', 'desc')->get();

            $isChargeStatusCompleted = DB::table('hts_charges')->where('id', $hts_charge_id)->where('completed_status', '2')->count();

            if($isChargeStatusCompleted>0) {
                // Session::put('carrier_cont_id_notes', $hts_cont_id);
                Session::forget('hts_charge_id');

                $chargeArray = [];
            }
                
        } 

        if(!empty($hts_user_id)) {
            $notInArray = [$hts_user_id];
            $all_users = DB::table('hts_users')->where('user_type', $user_type)->whereNotIn('id', $notInArray)->orderBy('id','desc')->get();

            if(!empty($hts_cont_id)) {
                $notInArrayCon = [$hts_cont_id];
                $all_carriers_contact = DB::table('hts_contacts')->where('user_id', $hts_user_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_contact = DB::table('hts_contacts')->where('user_id', $hts_user_id)->orderBy('id','asc')->get();
            }

            if(!empty($hts_rate_id)) {
                $notInArrayCon = [$hts_rate_id];
                $all_carriers_rate = DB::table('hts_rate_ground')->where('user_id', $hts_user_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_rate = DB::table('hts_rate_ground')->where('user_id', $hts_user_id)->orderBy('id','asc')->get();
            }
            
        } else {
            $all_users = DB::table('hts_users')->where('user_type', $user_type)->orderBy('id','desc')->get();
            $all_carriers_contact = [];
            $all_carriers_rate = [];
        }
        

        $participations = DB::table('hts_participations')->where('status', '1')->orderBy('id','asc')->get();

        $data = array(
            'title'                     => $title,
            'page'                      => $page,
            'subpage'                   => $subpage,
            'types'                     => $types,
            'divisons'                  => $divisons,
            'landCodes'                 => $landCodes,
            'oceanCodes'                => $oceanCodes,
            'airCodes'                  => $airCodes,
            'flights'                   => $flights,
            'userData'                  => $htsUsersArray,
            'userType'                  => $user_type,
            'contactData'               => $contactArray,
            'rateData'                  => $rateArray,
            'chargeData'                => $chargeArray,
            'carrier_contacts'          => $carrier_contacts,
            'carrier_rates'             => $carrier_rates,
            'carrier_charges'           => $carrier_charges,
            'countries'                 => $countries,
            'states'                    => $states,
            'constates'                 => $constates,
            'billingstates'             => $billingstates,
            'conbillingstates'          => $conbillingstates,
            'conConstates'              => $conConstates,
            'ports'                     => $ports,
            'other_address'             => $other_address,
            'gallery'                   => $gallery,
            'contact_gallery'           => $contact_gallery,
            'contact_notes'             => $contact_notes,
            'all_users'                 => $all_users,
            'cr_notes'                  => $cr_notes,
            'all_carriers_contact'      => $all_carriers_contact,
            'all_carriers_rate'         => $all_carriers_rate,
            'transportation'            => $transportation,
            'charge_list'               => $charge_list,
            'freight_service_class'     => $freight_service_class,
            'carrier_frequency'         => $carrier_frequency,
            'carrier_commodity'         => $carrier_commodity,
            'participations'            => $participations,
            'participations_charges'    => $participations_charges,
            'awb_numbers'               => $awb_numbers,
            'pmt_master_terms'          => $pmt_master_terms,
        );
            
        return view('admin.view-hts-user', compact('data'));
    }

    public function viewCarrier($hts_user_id)
    {

        $carrierData = DB::table('hts_users')->where('id', $hts_user_id)->first();
        $hts_user_type = @$carrierData->carrier_type;

        
        $carrier = DB::table('carriers_types')->find($hts_user_type);

        $types = DB::table('identification_types')->where('status', '1')->orderBy('id','desc')->get();
        $divisons = DB::table('divisons')->where('status', '1')->orderBy('id','desc')->get();
        $ports = DB::table('port_lists')->where('status', '1')->orderBy('id','desc')->get();

        $landCodes = DB::table('carrier_codes')->where('carrier_type', '3')->where('status', '1')->orderBy('id','desc')->get();
        $oceanCodes = DB::table('carrier_codes')->where('carrier_type', '2')->where('status', '1')->orderBy('id','desc')->get();
        $airCodes = DB::table('carrier_codes')->where('carrier_type', '1')->where('status', '1')->orderBy('id','desc')->get();

        $flights = DB::table('flights')->where('status', '1')->orderBy('id','desc')->get();

        $countries = DB::table('countries')->orderBy('name','asc')->get();

        $transportation = DB::table('transportation')->where('status', '1')->orderBy('description','asc')->get();
        $freight_service_class = DB::table('freight_service_class')->where('status', '1')->orderBy('description','asc')->get();
        $carrier_frequency = DB::table('carrier_frequency')->where('status', '1')->orderBy('name','asc')->get();
        $carrier_commodity = DB::table('carrier_commodity')->where('status', '1')->orderBy('name','asc')->get();
        $charge_list = DB::table('charge_list')->where('status', '1')->orderBy('description','asc')->get();

        $carrierArray = [];
        $contactArray = [];
        $rateArray = [];
        $chargeArray = [];
        $carrier_contacts = [];
        $carrier_rates = [];
        $carrier_charges = [];
        $states = [];
        $constates = [];
        $billingstates = [];
        $conbillingstates = [];
        $conConstates = [];
        $other_address = [];
        $con_other_address = [];
        $gallery = [];
        $contact_gallery = [];
        $contact_notes = [];
        $cr_notes = [];


            // do some thing if the key is exist
            $carrierArray = DB::table('hts_users')->where('id', $hts_user_id)->first();

            if(!empty($carrierArray->country)) {
                $states = DB::table('states')->where('country_id', @$carrierArray->country)->orderBy('name','asc')->get();
            }

            if(!empty($carrierArray->billing_country)) {
                $billingstates = DB::table('states')->where('country_id', @$carrierArray->billing_country)->orderBy('name','asc')->get();
            }

            $other_address = DB::table('carrier_other_address')->where('carrier_id', @$hts_user_id)->orderBy('id','desc')->get();
            $cr_notes = DB::table('carriers_notes')->where('carrier_id', $hts_user_id)->orderBy('id','desc')->get();
            $gallery = DB::table('carriers_galleries')->where('carrier_id', $hts_user_id)->orderBy('id','desc')->get();
                

        if(!empty($hts_user_id)) {
            $carrier_contacts = DB::table('carrier_contacts')->where('carrier_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $carrier_rates = DB::table('carrier_rate_ground')->where('carrier_id', $hts_user_id)->orderBy('id', 'desc')->get();
            $carrier_charges = DB::table('carrier_charges')->where('carrier_id', $hts_user_id)->orderBy('id', 'desc')->get();
        }

        if(!empty($hts_user_id)) {
            $notInArray = [$hts_user_id];
            $all_carriers = DB::table('hts_users')->whereNotIn('id', $notInArray)->orderBy('id','desc')->get();

            if(!empty($carrier_cont_id)) {
                $notInArrayCon = [$carrier_cont_id];
                $all_carriers_contact = DB::table('carrier_contacts')->where('carrier_id', $hts_user_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_contact = DB::table('carrier_contacts')->where('carrier_id', $hts_user_id)->orderBy('id','asc')->get();
            }

            if(!empty($carrier_rate_id)) {
                $notInArrayCon = [$carrier_rate_id];
                $all_carriers_rate = DB::table('carrier_rate_ground')->where('carrier_id', $hts_user_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_rate = DB::table('carrier_rate_ground')->where('carrier_id', $hts_user_id)->orderBy('id','asc')->get();
            }
            
        } else {
            $all_carriers = DB::table('hts_users')->orderBy('id','desc')->get();
            $all_carriers_contact = [];
            $all_carriers_rate = [];
        }
        

        $data = array(
            'title'                     => $carrier->name.' Carrier',
            'page'                      => 'carrier',
            'subpage'                   => 'aircarrier',
            'carrier_type'              => $hts_user_type,
            'types'                     => $types,
            'divisons'                  => $divisons,
            'landCodes'                 => $landCodes,
            'oceanCodes'                => $oceanCodes,
            'airCodes'                  => $airCodes,
            'flights'                   => $flights,
            'carrierData'               => $carrierArray,
            'contactData'               => $contactArray,
            'rateData'                  => $rateArray,
            'chargeData'                => $chargeArray,
            'carrier_contacts'          => $carrier_contacts,
            'carrier_rates'             => $carrier_rates,
            'carrier_charges'           => $carrier_charges,
            'countries'                 => $countries,
            'states'                    => $states,
            'constates'                 => $constates,
            'billingstates'             => $billingstates,
            'conbillingstates'          => $conbillingstates,
            'conConstates'              => $conConstates,
            'ports'                     => $ports,
            'other_address'             => $other_address,
            'gallery'                   => $gallery,
            'contact_gallery'           => $contact_gallery,
            'contact_notes'             => $contact_notes,
            'all_carriers'              => $all_carriers,
            'cr_notes'                  => $cr_notes,
            'all_carriers_contact'      => $all_carriers_contact,
            'all_carriers_rate'         => $all_carriers_rate,
            'transportation'            => $transportation,
            'charge_list'               => $charge_list,
            'freight_service_class'     => $freight_service_class,
            'carrier_frequency'         => $carrier_frequency,
            'carrier_commodity'         => $carrier_commodity,
            'carrier_id'                => $hts_user_id,
        );
            
        return view('admin.view-carrier', compact('data'));
    }
    
    public function gethtsimages(Request $request)
    {
        $hts_cont_id = Session::get('hts_cont_id');
        $hts_user_id = Session::get('hts_user_id');

        $listing_gallery = DB::table('hts_con_galleries')->where('hts_cont_id', $hts_cont_id)->orderBy('id','desc')->get();


        $data = array(
            'listing_gallery' => $listing_gallery,
        );

        return view('admin.ajax-hts-gallery-list', compact('data'));
    }

    public function gethtsgallerytimages(Request $request)
    {
        $hts_user_type = Session::get('hts_user_type');
        $hts_user_id = Session::get('hts_user_id');

        $listing_gallery = DB::table('hts_galleries')->where('user_id', $hts_user_id)->orderBy('id','desc')->get();


        $data = array(
            'listing_gallery' => $listing_gallery,
        );

        return view('admin.ajax-hts-main-gallery-list', compact('data'));
    }

    public function getimagesEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_cont_id = Session::get('carrier_cont_id');

        $listing_gallery = DB::table('carriers_con_galleries')->where('hts_cont_id', $carrier_cont_id)->orderBy('id','desc')->get();


        $data = array(
            'listing_gallery' => $listing_gallery,
        );

        return view('admin.ajax-gallery-edt-list', compact('data'));
    }

    public function getcarrierimages(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');

        $listing_gallery = DB::table('carriers_galleries')->where('carrier_id', $hts_user_id)->orderBy('id','desc')->get();


        $data = array(
            'listing_gallery' => $listing_gallery,
        );

        return view('admin.ajax-carrier-gallery-list', compact('data'));
    }

    public function getcarrierimagesedt(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        $listing_gallery = DB::table('carriers_galleries')->where('carrier_id', $hts_user_id)->orderBy('id','desc')->get();


        $data = array(
            'listing_gallery' => $listing_gallery,
        );

        return view('admin.ajax-carrier-gallery-list-edt', compact('data'));
    }
  
    public function dropzoneHtsStore(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_cont_id = Session::get('hts_cont_id');
        $hts_user_type = Session::get('hts_user_type');

        $path = public_path('uploads/files');

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $imageName);

        $imageUpload = new HtsConGallery();
        $imageUpload->user_id = $hts_user_id;
        $imageUpload->hts_cont_id = $hts_cont_id;
        $imageUpload->filename = $imageName;
        $imageUpload->created_at = date("Y-m-d H:i:s");
        $imageUpload->save();

        return response()->json([
            'original_name' => $imageName,
        ]);
    }

    public function dropzoneStoreEdt(Request $request)
    {
        $hts_cont_id = Session::get('hts_cont_id');
        $hts_user_id = $request->carrier_id;

        $path = public_path('uploads/files');

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $imageName);

        $imageUpload = new CarriersConGallery();
        $imageUpload->carrier_id = $hts_user_id;
        $imageUpload->hts_cont_id = $hts_cont_id;
        $imageUpload->filename = $imageName;
        $imageUpload->created_at = date("Y-m-d H:i:s");
        $imageUpload->save();

        return response()->json([
            'original_name' => $imageName,
        ]);
    }

    public function dropzoneStoreForHtsGallery(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $path = public_path('uploads/files');

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $imageName);

        $imageUpload = new HtsGallery();
        $imageUpload->user_id = $hts_user_id;
        $imageUpload->filename = $imageName;
        $imageUpload->created_at = date("Y-m-d H:i:s");
        $imageUpload->save();

        return response()->json([
            'original_name' => $imageName,
        ]);
    }

    public function dropzoneStoreForCarrierEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        $path = public_path('uploads/files');

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $imageName);

        $imageUpload = new CarriersGallery();
        $imageUpload->carrier_id = $hts_user_id;
        $imageUpload->filename = $imageName;
        $imageUpload->created_at = date("Y-m-d H:i:s");
        $imageUpload->save();

        return response()->json([
            'original_name' => $imageName,
        ]);
    }
    
    public function createHtsNotes(Request $request)
    {
        $hts_cont_id = Session::get('hts_cont_id');

        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $conStatus = $request->conStatus;

        $carrier_auto_id = DB::table('hts_con_notes')->insertGetId([
            'user_id'                    => $hts_user_id,
            'hts_cont_id'                => $hts_cont_id,
            'notes'                      => $request->edit_note,
            'craeted_by'                 => 'Admin',
            'created_at'                 => date('Y-m-d h:i:s')
        ]);

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cnotes');

        if($conStatus=="1") {
            $dataArray = [
                'status'                 => 2,
            ];
    
            $affected = DB::table('hts_contacts')
                    ->where('id', $hts_cont_id)
                    ->update($dataArray);

            Session::forget('carrier_con_tab');
        }

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function createNotesEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_cont_id = Session::get('carrier_cont_id');

        $conStatus = $request->conStatus;

        $carrier_auto_id = DB::table('carriers_con_notes')->insertGetId([
            'carrier_id'                 => $hts_user_id,
            'hts_cont_id'         => $carrier_cont_id,
            'notes'                      => $request->edit_note,
            'craeted_by'                 => 'Admin',
            'created_at'                 => date('Y-m-d h:i:s')
        ]);

        Session::put('carrier_edt_tab', 'contactsce');
        Session::put('carrier_con_tab', 'cnotes');

        if($conStatus=="1") {
            $dataArray = [
                'status'                 => 2,
            ];
    
            $affected = DB::table('carrier_contacts')
                    ->where('id', $carrier_cont_id)
                    ->update($dataArray);

            Session::forget('carrier_con_tab');
        }

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function createHtsRateNotes(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_rate_id = Session::get('hts_rate_id');
        $hts_user_type = Session::get('hts_user_type');

        $conStatus = $request->completed_status;

        $dataArrayUpt = [
            'rate_notes'                          => $request->rate_notes,
            'updated_at'                          => date('Y-m-d h:i:s')
        ];

        if($conStatus=="1") {

            $dataArrayUpt['completed_status'] = 2;

            Session::forget('carrier_rate_tab');
        } else {
            Session::put('carrier_rate_tab', 'rnotes');
        }

        $affected = DB::table('hts_rate_ground')
                ->where('id', $hts_rate_id)
                ->update($dataArrayUpt);

        Session::put('carrier_tab', 'rates');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function createRateNotesEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_rate_id = Session::get('carrier_rate_id');

        $conStatus = $request->completed_status;

        $dataArrayUpt = [
            'rate_notes'                          => $request->rate_notes,
            'updated_at'                          => date('Y-m-d h:i:s')
        ];

        if($conStatus=="1") {

            $dataArrayUpt['completed_status'] = 2;

            Session::forget('carrier_rate_tab');
        } else {
            Session::put('carrier_rate_tab', 'rnotes');
        }

        $affected = DB::table('carrier_rate_ground')
                ->where('id', $carrier_rate_id)
                ->update($dataArrayUpt);

        Session::put('carrier_edt_tab', 'ratesce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function filter_data_exist(Request $request)
	{
		if (array_key_exists('type_name', $_POST)) {

			$type_name = $request['type_name'];

            if (DB::table('property_types')->where('type_name', '=', $type_name)->where('type_name', '!=', '')->exists()) {
                // user found
                echo json_encode(FALSE);
             } else {
                echo json_encode(TRUE);
             }
		}
	}

    public function is_amenity_exist(Request $request)
	{
		if (array_key_exists('amenity_name', $_POST)) {

			$amenity_name = $request['amenity_name'];

            if (DB::table('amenities')->where('amenity_name', '=', $amenity_name)->where('amenity_name', '!=', '')->exists()) {
                // user found
                echo json_encode(FALSE);
             } else {
                echo json_encode(TRUE);
             }
		}
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

    public function createHtsUser(Request $request)
    {
        if (Session::has('hts_user_id')) {
            // do some thing if the key is exist
            $hts_user_id = Session::get('hts_user_id');
            $hts_user_type = Session::get('hts_user_type');

            $dataArray = [
                'name'                              => $request->name,
                'entity_id'                         => $request->entity_id,
                'phone'                             => $request->phone,
                'phone_1'                           => $request->phone_1,
                'mobile_phone'                      => $request->mobile_phone,
                'fax'                               => $request->fax,
                'email'                             => $request->email,
                'website'                           => $request->website,
                'account_number'                    => $request->account_number,
                'contact_first_name'                => $request->contact_first_name,
                'contact_last_name'                 => $request->contact_last_name,
                'identification_number'             => $request->identification_number,
                'identification_other'              => $request->identification_other,
                'division'                          => $request->division,
                'network_id'                        => $request->network_id,
                'network_status'                    => $request->network_status,
                'updated_at'                        => date('Y-m-d h:i:s')
            ];
    
            $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        } else {
            
            $hts_user_type = $request->user_type;

            $usersId = $this->generate_otp(6);

            $isExist = DB::table('hts_users')->where('user_id', $usersId)
                ->exists();
            
            if ($isExist) {

                $hts_user_id = $this->generate_otp(6);
            } else {
                $hts_user_id = $usersId;
            }

            $carrier_auto_id = DB::table('hts_users')->insertGetId([
                'user_id'                           => $hts_user_id,
                'user_type'                         => $request->user_type,
                'name'                              => $request->name,
                'entity_id'                         => $request->entity_id,
                'phone'                             => $request->phone,
                'phone_1'                           => $request->phone_1,
                'mobile_phone'                      => $request->mobile_phone,
                'fax'                               => $request->fax,
                'email'                             => $request->email,
                'website'                           => $request->website,
                'account_number'                    => $request->account_number,
                'contact_first_name'                => $request->contact_first_name,
                'contact_last_name'                 => $request->contact_last_name,
                'identification_number'             => $request->identification_number,
                'identification_other'              => $request->identification_other,
                'division'                          => $request->division,
                'network_id'                        => $request->network_id,
                'network_status'                    => $request->network_status,
                'created_at'                        => date('Y-m-d h:i:s')
            ]);

            Session::put('hts_user_id', $carrier_auto_id);
            Session::put('hts_user_type', $hts_user_type);
        }

        Session::put('carrier_tab', 'general');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        if($hts_user_type=='1')
        {
            return redirect('add-agent/'.$hts_user_type);
        } elseif($hts_user_type=='2')
        {
            return redirect('add-provider/'.$hts_user_type);
        } elseif($hts_user_type=='3')
        {
            return redirect('add-customer/'.$hts_user_type);
        } elseif($hts_user_type=='4')
        {
            return redirect('add-vendor/'.$hts_user_type);
        } elseif($hts_user_type=='5')
        {
            return redirect('add-salesperson/'.$hts_user_type);
        } elseif($hts_user_type=='6')
        {
            return redirect('add-contact/'.$hts_user_type);
        }
        
    }

    public function updateCarrierData(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $hts_user_type = $request->carrier_type;

        $dataArray = [
            'name'                              => $request->name,
            'entity_id'                         => $request->entity_id,
            'phone'                             => $request->phone,
            'phone_1'                           => $request->phone_1,
            'mobile_phone'                      => $request->mobile_phone,
            'fax'                               => $request->fax,
            'email'                             => $request->email,
            'website'                           => $request->website,
            'account_number'                    => $request->account_number,
            'contact_first_name'                => $request->contact_first_name,
            'contact_last_name'                 => $request->contact_last_name,
            'identification_number'             => $request->identification_number,
            'identification_other'              => $request->identification_other,
            'division'                          => $request->division,
            'network_id'                        => $request->network_id,
            'network_status'                    => $request->network_status,
            'updated_at'                        => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
            ->where('id', $hts_user_id)
            ->update($dataArray);

        

        Session::put('carrier_edt_tab', 'generalce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }
    
    public function createHtsContact(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_cont_id = Session::get('hts_cont_id');
        $hts_user_type = Session::get('hts_user_type');

        if (Session::has('hts_cont_id')) {

            $dataArray = [
                'name'                              => $request->name,
                'entity_id'                         => $request->entity_id,
                'phone'                             => $request->phone,
                'phone_1'                           => $request->phone_1,
                'mobile_phone'                      => $request->mobile_phone,
                'fax'                               => $request->fax,
                'email'                             => $request->email,
                'website'                           => $request->website,
                'account_number'                    => $request->account_number,
                'contact_first_name'                => $request->contact_first_name,
                'contact_last_name'                 => $request->contact_last_name,
                'identification_number'             => $request->identification_number,
                'identification_other'              => $request->identification_other,
                'division'                          => $request->division,
                'parent'                            => $request->con_parent,
                'updated_at'                        => date('Y-m-d h:i:s')
            ];
    
            $affected = DB::table('hts_contacts')
                ->where('id', $hts_cont_id)
                ->update($dataArray);

        } else {


            $carrier_auto_id = DB::table('hts_contacts')->insertGetId([
                'user_id'                           => $hts_user_id,
                'name'                              => $request->name,
                'entity_id'                         => $request->entity_id,
                'phone'                             => $request->phone,
                'phone_1'                           => $request->phone_1,
                'mobile_phone'                      => $request->mobile_phone,
                'fax'                               => $request->fax,
                'email'                             => $request->email,
                'website'                           => $request->website,
                'account_number'                    => $request->account_number,
                'contact_first_name'                => $request->contact_first_name,
                'contact_last_name'                 => $request->contact_last_name,
                'identification_number'             => $request->identification_number,
                'identification_other'              => $request->identification_other,
                'division'                          => $request->division,
                'parent'                            => $request->con_parent,
                'created_at'                        => date('Y-m-d h:i:s')
            ]);

            Session::put('hts_cont_id', $carrier_auto_id);
        }

        // Session::forget('carrier_tab');
        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cgeneral');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function createCarrierContactEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_cont_id = Session::get('carrier_cont_id');

        if (Session::has('carrier_cont_id')) {

            $dataArray = [
                'name'                              => $request->name,
                'entity_id'                         => $request->entity_id,
                'phone'                             => $request->phone,
                'phone_1'                           => $request->phone_1,
                'mobile_phone'                      => $request->mobile_phone,
                'fax'                               => $request->fax,
                'email'                             => $request->email,
                'website'                           => $request->website,
                'account_number'                    => $request->account_number,
                'contact_first_name'                => $request->contact_first_name,
                'contact_last_name'                 => $request->contact_last_name,
                'identification_number'             => $request->identification_number,
                'identification_other'              => $request->identification_other,
                'division'                          => $request->division,
                'parent'                            => $request->con_parent,
                'updated_at'                        => date('Y-m-d h:i:s')
            ];
    
            $affected = DB::table('carrier_contacts')
                ->where('id', $carrier_cont_id)
                ->update($dataArray);

        } else {


            $carrier_auto_id = DB::table('carrier_contacts')->insertGetId([
                'carrier_id'                        => $hts_user_id,
                'name'                              => $request->name,
                'entity_id'                         => $request->entity_id,
                'phone'                             => $request->phone,
                'phone_1'                           => $request->phone_1,
                'mobile_phone'                      => $request->mobile_phone,
                'fax'                               => $request->fax,
                'email'                             => $request->email,
                'website'                           => $request->website,
                'account_number'                    => $request->account_number,
                'contact_first_name'                => $request->contact_first_name,
                'contact_last_name'                 => $request->contact_last_name,
                'identification_number'             => $request->identification_number,
                'identification_other'              => $request->identification_other,
                'division'                          => $request->division,
                'parent'                            => $request->con_parent,
                'created_at'                        => date('Y-m-d h:i:s')
            ]);

            Session::put('carrier_cont_id', $carrier_auto_id);
        }

        // Session::forget('carrier_tab');
        Session::put('carrier_edt_tab', 'contactsce');
        Session::put('carrier_con_tab', 'cgeneral');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function createHtsRateGround(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_rate_id = Session::get('hts_rate_id');
        $hts_user_type = Session::get('hts_user_type');

        if (Session::has('hts_rate_id')) {

            $dataArray = [
                'transportation'                                => $request->transportation,
                'auto_charge'                                   => $request->auto_charge,
                'freight_service_class'                         => $request->freight_service_class,
                'carrier'                                       => $request->carrier,
                'currency'                                      => $request->currency,
                'carrier_frequency'                             => $request->carrier_frequency,
                'transit_time'                                  => $request->transit_time,
                'origin_apply_to_country'                       => $request->origin_apply_to_country,
                'port_of_landing'                               => $request->port_of_landing,
                'port_of_landing_country'                       => $request->port_of_landing_country,
                'destination_apply_to_country'                  => $request->destination_apply_to_country,
                'port_of_unlanding'                             => $request->port_of_unlanding,
                'port_of_unlanding_country'                     => $request->port_of_unlanding_country,
                'apply_by'                                      => $request->apply_by,
                'apply_by_measurement'                          => $request->apply_by_measurement,
                'use_gross_weight'                              => $request->use_gross_weight,
                'carrier_commodity'                             => $request->carrier_commodity,
                'hazadours'                                     => $request->hazadours,
                'minimum'                                       => $request->minimum,
                'rate_per'                                      => $request->rate_per,
                'maximum'                                       => $request->maximum,
                'rate_val'                                      => $request->rate_val,
                'more_than'                                     => $request->more_than,
                'rateP'                                         => $request->rateP,
                'updated_at'                                    => date('Y-m-d h:i:s')
            ];
    
            $affected = DB::table('hts_rate_ground')
                ->where('id', $hts_rate_id)
                ->update($dataArray);

        } else {


            $carrier_auto_id = DB::table('hts_rate_ground')->insertGetId([
                'user_id'                                       => $hts_user_id,
                'transportation'                                => $request->transportation,
                'auto_charge'                                   => $request->auto_charge,
                'freight_service_class'                         => $request->freight_service_class,
                'carrier'                                       => $request->carrier,
                'currency'                                      => $request->currency,
                'carrier_frequency'                             => $request->carrier_frequency,
                'transit_time'                                  => $request->transit_time,
                'origin_apply_to_country'                       => $request->origin_apply_to_country,
                'port_of_landing'                               => $request->port_of_landing,
                'port_of_landing_country'                       => $request->port_of_landing_country,
                'destination_apply_to_country'                  => $request->destination_apply_to_country,
                'port_of_unlanding'                             => $request->port_of_unlanding,
                'port_of_unlanding_country'                     => $request->port_of_unlanding_country,
                'apply_by'                                      => $request->apply_by,
                'apply_by_measurement'                          => $request->apply_by_measurement,
                'use_gross_weight'                              => $request->use_gross_weight,
                'carrier_commodity'                             => $request->carrier_commodity,
                'hazadours'                                     => $request->hazadours,
                'minimum'                                       => $request->minimum,
                'rate_per'                                      => $request->rate_per,
                'maximum'                                       => $request->maximum,
                'rate_val'                                      => $request->rate_val,
                'more_than'                                     => $request->more_than,
                'rateP'                                         => $request->rateP,
                'status'                                        => 1,
                'created_at'                                    => date('Y-m-d h:i:s')
            ]);

            Session::put('hts_rate_id', $carrier_auto_id);
        }

        // Session::forget('carrier_tab');
        Session::put('carrier_tab', 'rates');
        Session::put('carrier_rate_tab', 'rgeneral');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function createCarrierRateGroundEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_rate_id = Session::get('carrier_rate_id');

        if (Session::has('carrier_rate_id')) {

            $dataArray = [
                'transportation'                                => $request->transportation,
                'auto_charge'                                   => $request->auto_charge,
                'freight_service_class'                         => $request->freight_service_class,
                'carrier'                                       => $request->carrier,
                'currency'                                      => $request->currency,
                'carrier_frequency'                             => $request->carrier_frequency,
                'transit_time'                                  => $request->transit_time,
                'origin_apply_to_country'                       => $request->origin_apply_to_country,
                'port_of_landing'                               => $request->port_of_landing,
                'port_of_landing_country'                       => $request->port_of_landing_country,
                'destination_apply_to_country'                  => $request->destination_apply_to_country,
                'port_of_unlanding'                             => $request->port_of_unlanding,
                'port_of_unlanding_country'                     => $request->port_of_unlanding_country,
                'apply_by'                                      => $request->apply_by,
                'apply_by_measurement'                          => $request->apply_by_measurement,
                'use_gross_weight'                              => $request->use_gross_weight,
                'carrier_commodity'                             => $request->carrier_commodity,
                'hazadours'                                     => $request->hazadours,
                'minimum'                                       => $request->minimum,
                'rate_per'                                      => $request->rate_per,
                'maximum'                                       => $request->maximum,
                'rate_val'                                      => $request->rate_val,
                'more_than'                                     => $request->more_than,
                'rateP'                                         => $request->rateP,
                'updated_at'                                    => date('Y-m-d h:i:s')
            ];
    
            $affected = DB::table('carrier_rate_ground')
                ->where('id', $carrier_rate_id)
                ->update($dataArray);

        } else {


            $carrier_auto_id = DB::table('carrier_rate_ground')->insertGetId([
                'carrier_id'                                    => $hts_user_id,
                'transportation'                                => $request->transportation,
                'auto_charge'                                   => $request->auto_charge,
                'freight_service_class'                         => $request->freight_service_class,
                'carrier'                                       => $request->carrier,
                'currency'                                      => $request->currency,
                'carrier_frequency'                             => $request->carrier_frequency,
                'transit_time'                                  => $request->transit_time,
                'origin_apply_to_country'                       => $request->origin_apply_to_country,
                'port_of_landing'                               => $request->port_of_landing,
                'port_of_landing_country'                       => $request->port_of_landing_country,
                'destination_apply_to_country'                  => $request->destination_apply_to_country,
                'port_of_unlanding'                             => $request->port_of_unlanding,
                'port_of_unlanding_country'                     => $request->port_of_unlanding_country,
                'apply_by'                                      => $request->apply_by,
                'apply_by_measurement'                          => $request->apply_by_measurement,
                'use_gross_weight'                              => $request->use_gross_weight,
                'carrier_commodity'                             => $request->carrier_commodity,
                'hazadours'                                     => $request->hazadours,
                'minimum'                                       => $request->minimum,
                'rate_per'                                      => $request->rate_per,
                'maximum'                                       => $request->maximum,
                'rate_val'                                      => $request->rate_val,
                'more_than'                                     => $request->more_than,
                'rateP'                                         => $request->rateP,
                'status'                                        => 1,
                'created_at'                                    => date('Y-m-d h:i:s')
            ]);

            Session::put('carrier_rate_id', $carrier_auto_id);
        }

        // Session::forget('carrier_tab');
        Session::put('carrier_edt_tab', 'ratesce');
        Session::put('carrier_rate_tab', 'rgeneral');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function createHtsCustomCharge(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_charge_id = Session::get('hts_charge_id');
        $hts_user_type = Session::get('hts_user_type');

        if (Session::has('hts_charge_id')) {

            $dataArray = [
                'charge_id'                                     => @$request->charge_id,
                'price'                                         => @$request->charge_price,
                'vendor'                                        => @$request->vendor,
                'show_in_documents'                             => @$request->show_in_documents,
                'other_charge'                                  => @$request->other_charge,
                'updated_at'                                    => date('Y-m-d h:i:s')
            ];
    
            $affected = DB::table('hts_charges')
                ->where('id', $hts_charge_id)
                ->update($dataArray);

        } else {


            $carrier_auto_id = DB::table('hts_charges')->insertGetId([
                'user_id'                                    => @$hts_user_id,
                'charge_id'                                     => @$request->charge_id,
                'price'                                         => @$request->charge_price,
                'vendor'                                        => @$request->vendor,
                'show_in_documents'                             => @$request->show_in_documents,
                'other_charge'                                  => @$request->other_charge,
                'status'                                        => 1,
                'created_at'                                    => date('Y-m-d h:i:s')
            ]);

            Session::put('hts_charge_id', $carrier_auto_id);
        }

        // Session::forget('carrier_tab');
        Session::put('carrier_tab', 'charges');
        Session::put('carrier_charge_tab', 'chgeneral');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function createCustomCarrierChargeEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_charge_id = Session::get('carrier_charge_id');

        if (Session::has('carrier_charge_id')) {

            $dataArray = [
                'charge_id'                                     => @$request->charge_id,
                'price'                                         => @$request->charge_price,
                'vendor'                                        => @$request->vendor,
                'show_in_documents'                             => @$request->show_in_documents,
                'other_charge'                                  => @$request->other_charge,
                'updated_at'                                    => date('Y-m-d h:i:s')
            ];
    
            $affected = DB::table('carrier_charges')
                ->where('id', $carrier_charge_id)
                ->update($dataArray);

        } else {


            $carrier_auto_id = DB::table('carrier_charges')->insertGetId([
                'carrier_id'                                    => @$hts_user_id,
                'charge_id'                                     => @$request->charge_id,
                'price'                                         => @$request->charge_price,
                'vendor'                                        => @$request->vendor,
                'show_in_documents'                             => @$request->show_in_documents,
                'other_charge'                                  => @$request->other_charge,
                'status'                                        => 1,
                'created_at'                                    => date('Y-m-d h:i:s')
            ]);

            Session::put('carrier_charge_id', $carrier_auto_id);
        }

        // Session::forget('carrier_tab');
        Session::put('carrier_edt_tab', 'chargesce');
        Session::put('carrier_charge_tab', 'chgeneral');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function createHtsCustomChargeAutoCreation(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_charge_id = Session::get('hts_charge_id');
        $hts_user_type = Session::get('hts_user_type');

        $auto_creation = @$request->auto_creation;
        $conStatus = @$request->completed_status;

        if(!empty($auto_creation)) {
            DB::table('hts_auto_creation')->where('charge_id', $hts_charge_id)->delete();

            foreach ($auto_creation as $key => $item) {
                DB::table('hts_auto_creation')->insertGetId([
                    'user_id'                                      => @$hts_user_id,
                    'charge_id'                                    => @$hts_charge_id,
                    'auto_creation'                                => @$item,
                    'created_at'                                   => date('Y-m-d h:i:s')
                ]);
            }
        }

        $dataArray = [
            'route_assigned'                                => @$request->route_assigned,
            'updated_at'                                    => date('Y-m-d h:i:s')
        ];

        if($conStatus=="1") {

            $dataArray['completed_status'] = 2;

            Session::forget('carrier_charge_tab');
        } else {
            Session::put('carrier_charge_tab', 'chgeneral');

            Session::put('carrier_tab', 'charges');
            Session::put('carrier_charge_tab', 'chinfo');
        }

        $affected = DB::table('hts_charges')
            ->where('id', $hts_charge_id)
            ->update($dataArray);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function createCustomChargeAutoCreationEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_charge_id = Session::get('carrier_charge_id');

        $auto_creation = @$request->auto_creation;
        $conStatus = @$request->completed_status;

        if(!empty($auto_creation)) {
            DB::table('carrier_auto_creation')->where('charge_id', $carrier_charge_id)->delete();

            foreach ($auto_creation as $key => $item) {
                DB::table('carrier_auto_creation')->insertGetId([
                    'carrier_id'                                   => @$hts_user_id,
                    'charge_id'                                    => @$carrier_charge_id,
                    'auto_creation'                                => @$item,
                    'created_at'                                   => date('Y-m-d h:i:s')
                ]);
            }
        }

        $dataArray = [
            'route_assigned'                                => @$request->route_assigned,
            'updated_at'                                    => date('Y-m-d h:i:s')
        ];

        if($conStatus=="1") {

            $dataArray['completed_status'] = 2;

            Session::forget('carrier_charge_tab');
        } else {
            Session::put('carrier_charge_tab', 'chgeneral');

            Session::put('carrier_edt_tab', 'chargesce');
            Session::put('carrier_charge_tab', 'chinfo');
        }

        $affected = DB::table('carrier_charges')
            ->where('id', $carrier_charge_id)
            ->update($dataArray);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }
    
    public function updateHtsUserAddress(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'street_number'                => $request->street_number,
            'city'                         => $request->city,
            'country'                      => $request->country,
            'state'                        => $request->state,
            'zip_code'                     => $request->zip_code,
            'port'                         => $request->port,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'address');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateHtsUserAgent(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'ita_code'                => $request->ita_code,
            'fmc_code'                => $request->fmc_code,
            'scac_code'               => $request->scac_code,
            'tsa_number'              => $request->tsa_number,
            'updated_at'              => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'agent');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updatePmtData(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'pmt_master_terms'                          => @$request->pmt_master_terms,
            'pmt_common_type_payment'                   => @$request->pmt_common_type_payment,
            'pmt_incoterms'                             => @$request->pmt_incoterms,
            'pmt_currency'                              => @$request->pmt_currency,
            'pmt_credit_limit'                          => @$request->pmt_credit_limit,
            'is_tax_exempt'                             => @$request->is_tax_exempt,
            'pmt_invoice_periodically'                  => @$request->pmt_invoice_periodically,
            'is_known_shipper'                          => @$request->is_known_shipper,
            'pmt_expiration'                            => date("Y-m-d", strtotime($request->pmt_expiration)),
            'updated_at'                                => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'pmttems');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updatePersonalData(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'country_of_citizenship'                     => $request->country_of_citizenship,
            'date_of_birth'                              => date("Y-m-d", strtotime($request->date_of_birth)),
            'updated_at'                                 => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'personalInfoC');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateMoreInfoData(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'password_pin'                               => $request->password_pin,
            'mailing_address'                            => $request->mailing_address,
            'authorized_person'                          => $request->authorized_person,
            'date_of_birth'                              => date("Y-m-d", strtotime($request->date_of_birth)),
            'updated_at'                                 => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'moreinfo');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateCarrierPmtTerms(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'pmt_terms'                => $request->pmt_terms,
            'updated_at'               => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'pmttems');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateCarrierPmtTermsEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        $dataArray = [
            'pmt_terms'                => $request->pmt_terms,
            'updated_at'               => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'pmttemsce');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function updateCarrierMoreInfo(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'more_info'                     => $request->more_info,
            'updated_at'                    => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'moreinfo');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateCarrierMoreInfoEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        $dataArray = [
            'more_info'                     => $request->more_info,
            'updated_at'                    => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'moreinfoce');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function updateCarrierEdtAddress(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        $dataArray = [
            'street_number'                => $request->street_number,
            'city'                         => $request->city,
            'country'                      => $request->country,
            'state'                        => $request->state,
            'zip_code'                     => $request->zip_code,
            'port'                         => $request->port,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'addressce');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function addHtsNote(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $carrier_auto_id = DB::table('hts_notes')->insertGetId([
            'user_id'                 => $hts_user_id,
            'notes'                      => $request->carrier_notes,
            'craeted_by'                 => 'Admin',
            'created_at'                 => date('Y-m-d h:i:s')
        ]);

        Session::put('carrier_tab', 'notes');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function addCarrierNoteEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        $carrier_auto_id = DB::table('carriers_notes')->insertGetId([
            'carrier_id'                 => $hts_user_id,
            'notes'                      => $request->carrier_notes,
            'craeted_by'                 => 'Admin',
            'created_at'                 => date('Y-m-d h:i:s')
        ]);

        Session::put('carrier_edt_tab', 'notesce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }
    
    public function updateHtsParentEntity(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'parent_entity'                => $request->parent_entity,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'relatedentities');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateParentEntityEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        $dataArray = [
            'parent_entity'                => $request->parent_entity,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'relatedentitiesce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function updateLandCarrierCode(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'land_carrier_code'            => $request->land_carrier_code,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'land');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateLandCarrierCodeEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        $dataArray = [
            'land_carrier_code'            => $request->land_carrier_code,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'landce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }
    
    public function updateOceanCarrierCode(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'fmc_number'                => $request->fmc_number,
            'scac_number'               => $request->scac_number,
            'updated_at'                => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'land');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateOceanCarrierCodeEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        $dataArray = [
            'fmc_number'                => $request->fmc_number,
            'scac_number'               => $request->scac_number,
            'updated_at'                => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'landce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function updateAirCarrierCode(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        if(!empty($request->passengers_only_airline)) {
            $passengers_only_airline = $request->passengers_only_airline;
        } else {
            $passengers_only_airline = '0';
        }

        $dataArray = [
            'IATA_account_number'                   => $request->IATA_account_number,
            'airline_code'                          => $request->airline_code,
            'airline_prefix'                        => $request->airline_prefix,
            'air_way_bill_numbers'                  => $request->air_way_bill_numbers,
            'passengers_only_airline'               => $passengers_only_airline,
            'updated_at'                            => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'land');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateAirCarrierCodeEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        if(!empty($request->passengers_only_airline)) {
            $passengers_only_airline = $request->passengers_only_airline;
        } else {
            $passengers_only_airline = '0';
        }

        $dataArray = [
            'IATA_account_number'                   => $request->IATA_account_number,
            'airline_code'                          => $request->airline_code,
            'airline_prefix'                        => $request->airline_prefix,
            'air_way_bill_numbers'                  => $request->air_way_bill_numbers,
            'passengers_only_airline'               => $passengers_only_airline,
            'updated_at'                            => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'landce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function updateConHtsAddress(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_cont_id = Session::get('hts_cont_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'street_number'                => $request->street_number,
            'city'                         => $request->city,
            'country'                      => $request->country,
            'state'                        => $request->state,
            'zip_code'                     => $request->zip_code,
            'port'                         => $request->port,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_contacts')
                ->where('id', $hts_cont_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'caddress');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateConCarrierAddressEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_cont_id = Session::get('carrier_cont_id');

        $dataArray = [
            'street_number'                => $request->street_number,
            'city'                         => $request->city,
            'country'                      => $request->country,
            'state'                        => $request->state,
            'zip_code'                     => $request->zip_code,
            'port'                         => $request->port,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carrier_contacts')
                ->where('id', $carrier_cont_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'contactsce');
        Session::put('carrier_con_tab', 'caddress');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }
    
    public function updateHtsBillingAddress(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'billing_street_number'                => $request->billing_street_number,
            'billing_city'                         => $request->billing_city,
            'billing_country'                      => $request->billing_country,
            'billing_state'                        => $request->billing_state,
            'billing_zip_code'                     => $request->billing_zip_code,
            'billing_port'                         => $request->billing_port,
            'updated_at'                           => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'billing');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateCarrierBillingAddressEdt(Request $request)
    {

        $hts_user_id = $request->carrier_id;

        $dataArray = [
            'billing_street_number'                => $request->billing_street_number,
            'billing_city'                         => $request->billing_city,
            'billing_country'                      => $request->billing_country,
            'billing_state'                        => $request->billing_state,
            'billing_zip_code'                     => $request->billing_zip_code,
            'billing_port'                         => $request->billing_port,
            'updated_at'                           => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_users')
                ->where('id', $hts_user_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'billingce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function updateHtsConBillingAddress(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_cont_id = Session::get('hts_cont_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'billing_street_number'                => $request->billing_street_number,
            'billing_city'                         => $request->billing_city,
            'billing_country'                      => $request->billing_country,
            'billing_state'                        => $request->billing_state,
            'billing_zip_code'                     => $request->billing_zip_code,
            'billing_port'                         => $request->billing_port,
            'updated_at'                           => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_contacts')
                ->where('id', $hts_cont_id)
                ->update($dataArray);


        $msg = 'Record saved successfully.';

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cbaddress');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateCarrierConBillingAddressEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_cont_id = Session::get('carrier_cont_id');

        $dataArray = [
            'billing_street_number'                => $request->billing_street_number,
            'billing_city'                         => $request->billing_city,
            'billing_country'                      => $request->billing_country,
            'billing_state'                        => $request->billing_state,
            'billing_zip_code'                     => $request->billing_zip_code,
            'billing_port'                         => $request->billing_port,
            'updated_at'                           => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carrier_contacts')
                ->where('id', $carrier_cont_id)
                ->update($dataArray);


        $msg = 'Record saved successfully.';

        Session::put('carrier_edt_tab', 'contactsce');
        Session::put('carrier_con_tab', 'cbaddress');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function updateHtsOtherAddress(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'user_id'                            => $hts_user_id,
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

        $affected = DB::table('hts_other_address')
                ->insert($dataArray);

        Session::put('carrier_tab', 'otheraddresses');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateCarrierOtherAddressEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        $dataArray = [
            'carrier_id'                         => $hts_user_id,
            'other_description'                  => $request->other_description,
            'other_contact_name'                 => $request->other_contact_name,
            'other_street_number'                => $request->other_street_number,
            'other_city'                         => $request->other_city,
            'other_country'                      => $request->other_country,
            'other_state'                        => $request->other_state,
            'other_zip_code'                     => $request->other_zip_code,
            'other_port'                         => $request->other_port,
            'created_at'                           => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carrier_other_address')
                ->insert($dataArray);

        Session::put('carrier_edt_tab', 'otheraddressesce');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function updateHtsContOtherAddress(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_cont_id = Session::get('hts_cont_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'other_address'                     => $request->other_address,
            'other_description'                 => $request->other_description,
            'other_contact'                     => $request->other_contact,
            'other_phone'                       => $request->other_phone,
            'other_fax'                         => $request->other_fax,
            'other_email'                       => $request->other_email,
            'other_street_number'               => $request->other_street_number,
            'other_city'                        => $request->other_city,
            'other_country'                     => $request->other_country_2,
            'other_state'                       => $request->other_state_2,
            'other_zipcode'                     => $request->other_zipcode,
            'other_port'                        => $request->other_port,
            'updated_at'                        => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_contacts')
                ->where('id', $hts_cont_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'coaddress');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateCarrierContOtherAddressEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_cont_id = Session::get('carrier_cont_id');

        $dataArray = [
            'other_address'                     => $request->other_address,
            'other_description'                 => $request->other_description,
            'other_contact'                     => $request->other_contact,
            'other_phone'                       => $request->other_phone,
            'other_fax'                         => $request->other_fax,
            'other_email'                       => $request->other_email,
            'other_street_number'               => $request->other_street_number,
            'other_city'                        => $request->other_city,
            'other_country'                     => $request->other_country_2,
            'other_state'                       => $request->other_state_2,
            'other_zipcode'                     => $request->other_zipcode,
            'other_port'                        => $request->other_port,
            'updated_at'                        => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carrier_contacts')
                ->where('id', $carrier_cont_id)
                ->update($dataArray);

                Session::put('carrier_edt_tab', 'contactsce');
        Session::put('carrier_con_tab', 'coaddress');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }
    
    public function updateHtsContDateOfBirth(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_cont_id = Session::get('hts_cont_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'country_of_citizenship'                     => $request->country_of_citizenship,
            'date_of_birth'                              => date("Y-m-d", strtotime($request->date_of_birth)),
            'updated_at'                                 => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_contacts')
                ->where('id', $hts_cont_id)
                ->update($dataArray);


        $msg = 'Record saved successfully.';

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cpinfo');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateCarrierContDateOfBirthEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_cont_id = Session::get('carrier_cont_id');

        $dataArray = [
            'country_of_citizenship'                     => $request->country_of_citizenship,
            'date_of_birth'                              => date("Y-m-d", strtotime($request->date_of_birth)),
            'updated_at'                                 => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carrier_contacts')
                ->where('id', $carrier_cont_id)
                ->update($dataArray);


        $msg = 'Record saved successfully.';

        Session::put('carrier_edt_tab', 'contactsce');
        Session::put('carrier_con_tab', 'cpinfo');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function updateHtsRateContract(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_rate_id = Session::get('hts_rate_id');
        $hts_user_type = Session::get('hts_user_type');

        $dataArray = [
            'effect_date'                                   => date("Y-m-d", strtotime($request->effect_date)),
            'expiratin_date'                                => date("Y-m-d", strtotime($request->expiratin_date)),
            'contract_number'                               => $request->contract_number,
            'amendment_number'                              => $request->amendment_number,
            'updated_at'                                    => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_rate_ground')
                ->where('id', $hts_rate_id)
                ->update($dataArray);


        $msg = 'Record saved successfully.';

        Session::put('carrier_tab', 'rates');
        Session::put('carrier_rate_tab', 'rpinfo');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function updateCarrierRateContractEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_rate_id = Session::get('carrier_rate_id');

        $dataArray = [
            'effect_date'                                   => date("Y-m-d", strtotime($request->effect_date)),
            'expiratin_date'                                => date("Y-m-d", strtotime($request->expiratin_date)),
            'contract_number'                               => $request->contract_number,
            'amendment_number'                              => $request->amendment_number,
            'updated_at'                                    => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carrier_rate_ground')
                ->where('id', $carrier_rate_id)
                ->update($dataArray);


        $msg = 'Record saved successfully.';

        Session::put('carrier_edt_tab', 'ratesce');
        Session::put('carrier_rate_tab', 'rpinfo');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function saveHtsOtherAddress(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

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

        $affected = DB::table('hts_other_address')
                ->where('id', $other_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'otheraddresses');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function saveCarrierOtherAddressEdt(Request $request)
    {

        $other_id = $request->other_id;

        $carrier = DB::table('carrier_other_address')->where('id', $other_id)->first();
        $hts_user_id = @$carrier->carrier_id;

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

        $affected = DB::table('carrier_other_address')
                ->where('id', $other_id)
                ->update($dataArray);

                Session::put('carrier_edt_tab', 'otheraddressesce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }
    
    public function saveHtsConNote(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $note_id = $request->note_id;

        $dataArray = [
            'notes'                  => $request->conn_note_edt,
            'updated_by'             => 'Admin',
            'updated_at'             => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_con_notes')
                ->where('id', $note_id)
                ->update($dataArray);


        $msg = 'Record saved successfully.';

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cinternalnotes');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function saveCarrierConNoteEdit(Request $request)
    {
        $hts_user_id = $request->carrier_id;
        $carrier_cont_id = Session::get('carrier_cont_id');

        $note_id = $request->note_id;

        $dataArray = [
            'notes'                  => $request->conn_note_edt,
            'updated_by'             => 'Admin',
            'updated_at'             => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers_con_notes')
                ->where('id', $note_id)
                ->update($dataArray);


        $msg = 'Record saved successfully.';

        Session::put('carrier_edt_tab', 'contactsce');
        Session::put('carrier_con_tab', 'cinternalnotes');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function saveHtsNote(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $note_id = $request->note_id;

        $dataArray = [
            'notes'                  => $request->note_edt,
            'updated_by'             => 'Admin',
            'updated_at'             => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('hts_notes')
                ->where('id', $note_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'internalnotes');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function saveCarrierNoteEdt(Request $request)
    {
        $hts_user_id = $request->carrier_id;

        $note_id = $request->note_id;

        $dataArray = [
            'notes'                  => $request->note_edt,
            'updated_by'             => 'Admin',
            'updated_at'             => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers_notes')
                ->where('id', $note_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'internalnotesce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function getState(Request $request)
    {
        $country_id = $request['country_id'];
        $states = DB::table('states')->where('country_id', $country_id)->orderBy('name','asc')->get();

        $result = "";
		$result .= '<option value="">Select state...</option>';

		if (!empty($states)) {
			foreach ($states as $key => $value) {
				if ($key=='0') {
					$selected = "selected";
				}

				$result .= '<option value="' . $value->id . '">' . $value->name . '</option>';
			}

			echo $result;
		}
    }

    public function getHtsRates(Request $request)
    {
        $ratwhere = $request['hts_rate_method'];
        $transportation = DB::table('transportation')->where('method', $ratwhere)->where('status', '1')->orderBy('description','asc')->get();

        $result = "";
		$result .= '<option value="">Select...</option>';
        $result .= '<optgroup label="Description / Method / Code">';

		if (!empty($transportation)) {
			foreach ($transportation as $key => $value) {
				if ($key=='0') {
					$selected = "selected";
				}

				$result .= '<option value="' . $value->id . '">' . @$value->description." / ".@$value->method." / ".@$value->code . '</option>';
			}

			echo $result;
		}

        $result .= '</optgroup>';
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

    public function getRateVal(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $carrier_rate_id = Session::get('carrier_rate_id');

        if (Session::has('carrier_rate_id')) {

        } else {

        }

        $rate_val = $request['rate_val'];
        $cities = DB::table('carriers_rate_lists')->where('state_id', $state_county)->orderBy('name','asc')->get();

        $result = "";
		$result .= '<option value="">Select city...</option>';

    }

    public function deleteHtsUser(Request $request, $id, $route)
    {
        $listing_gallery = DB::table('hts_galleries')->where('user_id', $id)->get();

        if(!empty($listing_gallery)) {
            foreach ($listing_gallery as $key => $value) {
                $filename =  $value->filename;

                $path = public_path().'/uploads/files/'.$filename;

                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        $listing_gallery2 = DB::table('hts_con_galleries')->where('user_id', $id)->get();

        if(!empty($listing_gallery2)) {
            foreach ($listing_gallery2 as $key => $value2) {
                $filename2 =  $value2->filename;
                $path2 = public_path().'/uploads/files/'.$filename2;

                if (file_exists($path2)) {
                    unlink($path2);
                }
            }
        }

        
        $delete = DB::table('hts_users')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' User has been not deleted ';
        } else {
            DB::table('hts_galleries')->where('user_id', $id)->delete();
            DB::table('hts_con_galleries')->where('user_id', $id)->delete();
            DB::table('hts_con_notes')->where('user_id', $id)->delete();
            DB::table('hts_notes')->where('user_id', $id)->delete();
            DB::table('hts_rate_lists')->where('user_id', $id)->delete();
            DB::table('hts_charges')->where('user_id', $id)->delete();
            DB::table('hts_contacts')->where('user_id', $id)->delete();
            DB::table('hts_other_address')->where('user_id', $id)->delete();
            DB::table('hts_rate_ground')->where('user_id', $id)->delete();
            DB::table('hts_auto_creation')->where('user_id', $id)->delete();

            $type = "success";
            $msg = ' User deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        if($route)
        {
            return redirect($route);
        }else{
            return redirect('agents');
        }
    }

    public function deleteHtsOtherAddress(Request $request, $id)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $delete = DB::table('hts_other_address')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' Other Address has been not deleted ';
        } else {
            $type = "success";
            $msg = ' Other Address deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        Session::put('carrier_tab', 'otheraddresses');

        return redirect('add-agent/'.$hts_user_type);
    }

    public function deleteOtherAddressEdt(Request $request, $id)
    {
        $carrier = DB::table('carrier_other_address')->where('id', $id)->first();
        $hts_user_id = @$carrier->carrier_id;

        $delete = DB::table('carrier_other_address')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' Other Address has been not deleted ';
        } else {
            $type = "success";
            $msg = ' Other Address deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        Session::put('carrier_edt_tab', 'otheraddressesce');

        return redirect('editCarrier/'.$hts_user_id);
    }
    
    public function deleteHtsConNote(Request $request, $id)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $delete = DB::table('hts_con_notes')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Note has been not deleted ';
        } else {
            $type = "success";
            $msg = 'Note deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cinternalnotes');

        return redirect('add-agent/'.$hts_user_type);
    }

    public function deleteConNoteEdt(Request $request, $id)
    {
        $carriers = DB::table('carriers_con_notes')->where('id', $id)->first();
        $hts_user_id = $carriers->carrier_id;

        $delete = DB::table('carriers_con_notes')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Note has been not deleted ';
        } else {
            $type = "success";
            $msg = 'Note deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        Session::put('carrier_edt_tab', 'contactsce');
        Session::put('carrier_con_tab', 'cinternalnotes');

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function deleteHtsNote(Request $request, $id)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $delete = DB::table('hts_notes')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Note has been not deleted ';
        } else {
            $type = "success";
            $msg = 'Note deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        Session::put('carrier_tab', 'internalnotes');

        return redirect('add-agent/'.$hts_user_type);
    }

    public function deleteNoteEdt(Request $request, $id)
    {
        $carrier = DB::table('carriers_notes')->where('id', $id)->first();

        $hts_user_id = @$carrier->carrier_id;

        $delete = DB::table('carriers_notes')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Note has been not deleted ';
        } else {
            $type = "success";
            $msg = 'Note deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        Session::put('carrier_edt_tab', 'internalnotesce');

        return redirect('editCarrier/'.$hts_user_id);
    }
    
    public function deleteHtsConTabData(Request $request, $id)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $delete = DB::table('hts_contacts')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Contact record has been not deleted ';
        } else {

            $listings = DB::table('hts_con_galleries')->where('hts_cont_id', $id)->get();

            if(!empty($listings)) {
                foreach ($listings as $key => $listing_gallery) {
                    # code...
                    $filename =  $listing_gallery->filename;
                    $path=public_path().'/uploads/files/'.$filename;

                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
        
            DB::table('hts_con_notes')->where('hts_cont_id', $id)->delete();
            DB::table('hts_con_galleries')->where('hts_cont_id', $id)->delete();

            $type = "success";
            $msg = 'Contact all record deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function deleteConTabDataEdt(Request $request, $id)
    {
        $carriers = DB::table('carrier_contacts')->where('id', $id)->first();
        $hts_user_id = $carriers->carrier_id;

        $delete = DB::table('carrier_contacts')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Contact record has been not deleted ';
        } else {

            $listings = DB::table('carriers_con_galleries')->where('hts_cont_id', $id)->get();

            if(!empty($listings)) {
                foreach ($listings as $key => $listing_gallery) {
                    # code...
                    $filename =  $listing_gallery->filename;
                    $path=public_path().'/uploads/files/'.$filename;

                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
        
            DB::table('carriers_con_notes')->where('hts_cont_id', $id)->delete();
            DB::table('carriers_con_galleries')->where('hts_cont_id', $id)->delete();

            $type = "success";
            $msg = 'Contact all record deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function deleteHtsRateGroundTabData(Request $request, $id)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $delete = DB::table('hts_rate_ground')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Rate ground record has been not deleted ';
        } else {

            $type = "success";
            $msg = 'Rate ground all record deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function deleteRateGroundTabDataEdt(Request $request, $id)
    {
        $carrier = DB::table('carrier_rate_ground')->where('id', $id)->first();
        $hts_user_id = @$carrier->carrier_id;

        $delete = DB::table('carrier_rate_ground')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Rate ground record has been not deleted ';
        } else {

            $type = "success";
            $msg = 'Rate ground all record deleted successfully. ';
        }

        Session::put('carrier_edt_tab', 'ratesce');
    
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$hts_user_id);
    }

    public function deleteHtsChargeTabData(Request $request, $id)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $delete = DB::table('hts_charges')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Custom Charge record has been not deleted ';
        } else {

            DB::table('hts_auto_creation')->where('charge_id', $id)->delete();

            $type = "success";
            $msg = 'Custom Charge all record deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function deleteChargeTabDataEdt(Request $request, $id)
    {
        $carrier = DB::table('carrier_charges')->where('id', $id)->first();
        $hts_user_id = @$carrier->carrier_id;

        $delete = DB::table('carrier_charges')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Custom Charge record has been not deleted ';
        } else {

            DB::table('carrier_auto_creation')->where('charge_id', $id)->delete();

            $type = "success";
            $msg = 'Custom Charge all record deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        Session::put('carrier_edt_tab', 'chargesce');

        return redirect('editCarrier/'.$hts_user_id);
    }
    
    public function deleteHtsGalleryImage($id)
    {
        $listing_gallery = DB::table('hts_con_galleries')->where('id', $id)->first();
        $filename =  $listing_gallery->filename;
        $hts_user_type = Session::get('hts_user_type');
        $path=public_path().'/uploads/files/'.$filename;

        if (file_exists($path)) {
            unlink($path);
        }

        $delete = DB::table('hts_con_galleries')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'File has been not deleted. ';
        } else {
            $type = "success";
            $msg = ' File deleted successfully. ';
        }

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cattachment');
    
        Session::flash($type, $msg);
        return redirect('add-agent/'.$hts_user_type);
    }

    public function deleteHtsMainGalleryImage($id)
    {
        $listing_gallery = DB::table('hts_galleries')->where('id', $id)->first();
        $filename =  $listing_gallery->filename;
        $hts_user_type = Session::get('hts_user_type');
        $path=public_path().'/uploads/files/'.$filename;

        if (file_exists($path)) {
            unlink($path);
        }

        $delete = DB::table('hts_galleries')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'File has been not deleted. ';
        } else {
            $type = "success";
            $msg = ' File deleted successfully. ';
        }

        Session::put('carrier_tab', 'attachments');
    
        Session::flash($type, $msg);
        return redirect('add-agent/'.$hts_user_type);
    }

    public function deleteGalleryImageEdt($id)
    {
        $listing_gallery = DB::table('carriers_con_galleries')->where('id', $id)->first();
        $filename =  $listing_gallery->filename;
        $hts_user_id = $listing_gallery->carrier_id;
        $path=public_path().'/uploads/files/'.$filename;

        if (file_exists($path)) {
            unlink($path);
        }

        $delete = DB::table('carriers_con_galleries')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'File has been not deleted. ';
        } else {
            $type = "success";
            $msg = ' File deleted successfully. ';
        }

        Session::put('carrier_edt_tab', 'contactsce');
        Session::put('carrier_con_tab', 'cattachment');
    
        Session::flash($type, $msg);
        
        return redirect('editCarrier/'.$hts_user_id);
    }

    public function deleteCarrierGalleryImage($id)
    {
        $listing_gallery = DB::table('carriers_galleries')->where('id', $id)->first();
        $filename =  $listing_gallery->filename;
        $hts_user_type = Session::get('hts_user_type');
        $path=public_path().'/uploads/files/'.$filename;

        if (file_exists($path)) {
            unlink($path);
        }

        $delete = DB::table('carriers_galleries')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'File has been not deleted. ';
        } else {
            $type = "success";
            $msg = ' File deleted successfully. ';
        }

        Session::put('carrier_tab', 'attachments');
    
        Session::flash($type, $msg);
        return redirect('add-agent/'.$hts_user_type);
    }

    public function deleteCarrierGalleryImageEdt($id)
    {
        $listing_gallery = DB::table('carriers_galleries')->where('id', $id)->first();
        $filename =  $listing_gallery->filename;
        $hts_user_id =  $listing_gallery->carrier_id;
   
        $path=public_path().'/uploads/files/'.$filename;

        if (file_exists($path)) {
            unlink($path);
        }

        $delete = DB::table('carriers_galleries')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'File has been not deleted. ';
        } else {
            $type = "success";
            $msg = ' File deleted successfully. ';
        }

        Session::put('carrier_edt_tab', 'attachmentsce');
    
        Session::flash($type, $msg);
        
        return redirect('editCarrier/'.$hts_user_id);
    }


    public function provider_list(Request $request)
    {      
        Session::forget('hts_user_id');
        Session::forget('hts_user_type');
        Session::forget('hts_cont_id');
        Session::forget('hts_rate_id');
        Session::forget('hts_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('carrier_tab');
        Session::forget('carrier_con_tab');

        $keyword = "";

        $keyword = $request['keyword'];

        $query = HtsUsers::query();

        $query->join('hts_user_types', 'hts_users.user_type', '=', 'hts_user_types.id')
            ->select(DB::raw('hts_users.*, hts_user_types.name as t_name'))
            ->where('hts_user_types.id','2');


        if (!empty($request->keyword)) {

            $query->where(function ($query) use ($keyword) {
                $query->where('hts_users.name', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.mobile_phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.email', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.website', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.account_number', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.port', 'like', '%' . $keyword . '%');
            });         
              
        }

        $query->orderBy('hts_users.id','desc');
        $users = $query->paginate(10);

        $data = array(
            'title'             => 'Warehouse Providers List',
            'page'              => 'provider',
            'subpage'           => 'providers',
            'list'              => $users,
            'keyword'           => $keyword
        );

        return view('admin.providers', $data);
    }
   
    public function addprovider($user_type)
    {       
        $data = array(
            'title'                     => 'Create new Provider',
            'page'                      => 'provider',
            'subpage'                   => 'add_provider',            
        );
            
        return view('admin.add_provider', compact('data'));
    }

    public function customer_list(Request $request)
    {      
        Session::forget('hts_user_id');
        Session::forget('hts_user_type');
        Session::forget('hts_cont_id');
        Session::forget('hts_rate_id');
        Session::forget('hts_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('carrier_tab');
        Session::forget('carrier_con_tab');

        $keyword = "";

        $keyword = $request['keyword'];

        $query = HtsUsers::query();

        $query->join('hts_user_types', 'hts_users.user_type', '=', 'hts_user_types.id')
            ->select(DB::raw('hts_users.*, hts_user_types.name as t_name'))
            ->where('hts_user_types.id','3');


        if (!empty($request->keyword)) {

            $query->where(function ($query) use ($keyword) {
                $query->where('hts_users.name', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.mobile_phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.email', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.website', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.account_number', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.port', 'like', '%' . $keyword . '%');
            });         
              
        }

        $query->orderBy('hts_users.id','desc');
        $users = $query->paginate(10);

        $data = array(
            'title'             => 'Customers List',
            'page'              => 'customer',
            'subpage'           => 'customers',
            'list'              => $users,
            'keyword'           => $keyword
        );

        return view('admin.customers', $data);
    }
   

    public function vendor_list(Request $request)
    {     
        Session::forget('hts_user_id');
        Session::forget('hts_user_type');
        Session::forget('hts_cont_id');
        Session::forget('hts_rate_id');
        Session::forget('hts_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('carrier_tab');
        Session::forget('carrier_con_tab'); 

        $keyword = "";

        $keyword = $request['keyword'];

        $query = HtsUsers::query();

        $query->join('hts_user_types', 'hts_users.user_type', '=', 'hts_user_types.id')
            ->select(DB::raw('hts_users.*, hts_user_types.name as t_name'))
            ->where('hts_user_types.id','4');


        if (!empty($request->keyword)) {

            $query->where(function ($query) use ($keyword) {
                $query->where('hts_users.name', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.mobile_phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.email', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.website', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.account_number', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.port', 'like', '%' . $keyword . '%');
            });         
              
        }

        $query->orderBy('hts_users.id','desc');
        $users = $query->paginate(10);

        $data = array(
            'title'             => 'Vendor List',
            'page'              => 'vendor',
            'subpage'           => 'vendors',
            'list'              => $users,
            'keyword'           => $keyword
        );

        return view('admin.vendors', $data);
    }
    

    public function sales_list(Request $request)
    {      
        Session::forget('hts_user_id');
        Session::forget('hts_user_type');
        Session::forget('hts_cont_id');
        Session::forget('hts_rate_id');
        Session::forget('hts_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('carrier_tab');
        Session::forget('carrier_con_tab');

        $keyword = "";

        $keyword = $request['keyword'];

        $query = HtsUsers::query();

        $query->join('hts_user_types', 'hts_users.user_type', '=', 'hts_user_types.id')
            ->select(DB::raw('hts_users.*, hts_user_types.name as t_name'))
            ->where('hts_user_types.id','5');


        if (!empty($request->keyword)) {

            $query->where(function ($query) use ($keyword) {
                $query->where('hts_users.name', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.mobile_phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.email', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.website', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.account_number', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.port', 'like', '%' . $keyword . '%');
            });         
              
        }

        $query->orderBy('hts_users.id','desc');
        $users = $query->paginate(10);

        $data = array(
            'title'             => 'Sales Person List',
            'page'              => 'salesperson',
            'subpage'           => 'salespersons',
            'list'              => $users,
            'keyword'           => $keyword
        );

        return view('admin.salesperson', $data);
    }

    public function contact_list(Request $request)
    {      
        Session::forget('hts_user_id');
        Session::forget('hts_user_type');
        Session::forget('hts_cont_id');
        Session::forget('hts_rate_id');
        Session::forget('hts_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('carrier_tab');
        Session::forget('carrier_con_tab');

        $keyword = "";

        $keyword = $request['keyword'];

        $query = HtsUsers::query();

        $query->join('hts_user_types', 'hts_users.user_type', '=', 'hts_user_types.id')
            ->select(DB::raw('hts_users.*, hts_user_types.name as t_name'))
            ->where('hts_user_types.id','6');


        if (!empty($request->keyword)) {

            $query->where(function ($query) use ($keyword) {
                $query->where('hts_users.name', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.entity_id', 'like', '%'. $keyword . '%')
                ->orWhere('hts_users.phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.mobile_phone', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.email', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.website', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.account_number', 'like', '%' . $keyword . '%')
                ->orWhere('hts_users.port', 'like', '%' . $keyword . '%');
            });         
              
        }

        $query->orderBy('hts_users.id','desc');
        $users = $query->paginate(10);

        $data = array(
            'title'             => 'Contacts List',
            'page'              => 'contacts',
            'subpage'           => 'contacts',
            'list'              => $users,
            'keyword'           => $keyword
        );

        return view('admin.contacts', $data);
    }

    public function createParticipation(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_participation_id = Session::get('hts_participation_id');
        $hts_user_type = Session::get('hts_user_type');

        if ($request->has('air_import')) {
            $air_import ="1";
        } else {
            $air_import ="";
        }
        if ($request->has('ocean_import')) {
            $ocean_import ="1";
        } else {
            $ocean_import ="";
        }
        if ($request->has('ground_import')) {
            $ground_import ="1";
        } else {
            $ground_import ="";
        }


        if ($request->has('air_export')) {
            $air_export ="1";
        } else {
            $air_export ="";
        }
        if ($request->has('ocean_export')) {
            $ocean_export ="1";
        } else {
            $ocean_export ="";
        }
        if ($request->has('ground_export')) {
            $ground_export ="1";
        } else {
            $ground_export ="";
        }        
        

        // if (Session::has('hts_participation_id')) {

        //     $dataArray = [
        //         'participation_type'                       => @$request->participation_type,
        //         'participation_charge_id'                  => @$request->participation_charge_id,
        //         'type'                                     => @$request->type,
        //         'price'                                    => @$request->price,
        //         'air_import'                               => @$request->air_import,
        //         'ocean_import'                             => @$request->ocean_import,
        //         'ground_import'                            => @$request->ground_import,
        //         'ocean_export'                             => @$request->ocean_export,
        //         'air_export'                               => @$request->air_export,
        //         'ground_export'                            => @$request->ground_export,
        //     ];
    
        //     $affected = DB::table('hts_participation_list')
        //         ->where('id', $hts_participation_id)
        //         ->update($dataArray);

        // } else {


            $auto_id = DB::table('hts_participation_list')->insertGetId([
                'user_id'                                      => @$hts_user_id,
                'participation_type'                           => @$request->participation_type,
                'participation_charge_id'                      => @$request->participation_charge_id,
                'type'                                         => @$request->type,
                'price'                                        => @$request->price,
                'air_import'                                   => @$air_import,
                'ocean_import'                                 => @$ocean_import,
                'ground_import'                                => @$ground_import,
                'air_export'                                   => @$air_export,
                'ocean_export'                                 => @$ocean_export,
                'ground_export'                                => @$ground_export,
                'status'                                       => 1,
                'created_at'                                   => date('Y-m-d h:i:s')
            ]);

            Session::put('hts_participation_id', $auto_id);
        //}

        // Session::forget('carrier_tab');
        Session::put('carrier_tab', 'participation');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function generateAWBNumbers($start, $end)
    {
        // Generate a random 7-digit number
        $randomNumber = mt_rand($start, $end);

        return str_pad($randomNumber, 7, '0', STR_PAD_LEFT);
    }

    public function createAwbNumber(Request $request)
    {
        $hts_user_id = Session::get('hts_user_id');
        $hts_user_type = Session::get('hts_user_type');

        $start = $request->start_awb_number;
        $end = $request->end_awb_number;

        if ($start >= $end) {

            Session::put('carrier_tab', 'airbaybills');

            $msg = 'The start value must be less than the end value.';

            $type = "error";
            Session::flash($type, $msg);

            return redirect('add-agent/'.$hts_user_type);
        }

        $awb_number = $this->generateAWBNumbers($start, $end);

        $isExistAwbNumber = DB::table('hts_air_waybills')->where('awb_number', $awb_number)->count();

        if($isExistAwbNumber>0) {
            $awb_number = $this->generateAWBNumbers($start, $end);
        }

        $auto_id = DB::table('hts_air_waybills')->insertGetId([
            'user_id'                                       => @$hts_user_id,
            'awb_number'                                    => @$awb_number,
            'status'                                        => 1,
            'created_at'                                    => date('Y-m-d h:i:s')
        ]);

        Session::put('carrier_tab', 'airbaybills');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function deleteParticipationDetails(Request $request, $id)
    {
        
        $hts_user_type = Session::get('hts_user_type');

        $delete = DB::table('hts_participation_list')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Participation has been not deleted ';
        } else {
            Session::forget('hts_participation_id');
            $type = "success";
            $msg = 'Participation has deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }

    public function deleteAwbDetails(Request $request, $id)
    {
        
        $hts_user_type = Session::get('hts_user_type');

        $delete = DB::table('hts_air_waybills')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Awb Number has been not deleted ';
        } else {
            Session::forget('hts_participation_id');
            $type = "success";
            $msg = 'Awb Number has deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        return redirect('add-agent/'.$hts_user_type);
    }


}
