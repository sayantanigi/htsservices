<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Facades\DB;
use App\Models\Carriers;
use App\Models\CarriersConGallery;
use App\Models\CarriersGallery;

class CarrierController extends Controller
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
    

    public function carrier_list(Request $request)
    {
        Session::forget('carrier_id');
        Session::forget('carrier_type');
        Session::forget('carrier_cont_id');
        Session::forget('carrier_rate_id');
        Session::forget('carrier_charge_id');
        Session::forget('carrier_edt_tab');
        Session::forget('carrier_tab');

        $carrier_type = "";
        $keyword = "";

        $carrier_type = $request['carrier_type'];
        $keyword = $request['keyword'];

        $query = Carriers::query();

        $query->join('carriers_types', 'carriers.carrier_type', '=', 'carriers_types.id')
            ->select(DB::raw('carriers.*, carriers_types.name as t_name'));

        if (!empty($request->carrier_type)) {

            if($request->carrier_type=="all") {
                $ids = [1, 2, 3]; // An array of IDs you want to match
                $query->whereIn('carriers.carrier_type', $ids);
            } else {
                $query->where('carriers.carrier_type', $request->carrier_type);
            }
            
        }

        if (!empty($request->keyword)) {
            $query->where('carriers.name', 'like', '%' . $keyword . '%')
              ->orWhere('carriers.entity_id', 'like', '%'. $keyword . '%')
              ->orWhere('carriers.phone', 'like', '%' . $keyword . '%')
              ->orWhere('carriers.mobile_phone', 'like', '%' . $keyword . '%')
              ->orWhere('carriers.email', 'like', '%' . $keyword . '%')
              ->orWhere('carriers.website', 'like', '%' . $keyword . '%')
              ->orWhere('carriers.account_number', 'like', '%' . $keyword . '%')
              ->orWhere('carriers.port', 'like', '%' . $keyword . '%');
        }

        $query->orderBy('carriers.id','desc');
        // Paginate the results
        $carriers = $query->paginate(10);

        // $carriers = DB::table('carriers')->latest()->paginate(50);

        $data = array(
            'title'             => 'Carriers',
            'page'              => 'carrier',
            'subpage'           => 'carriers',
            'list'              => $carriers,
            'carrier_type'      => $carrier_type,
            'keyword'           => $keyword
        );

        return view('admin.carriers', $data);
    }

    public function addCarrier($id)
    {
        if (Session::has('employee_id')) {
            Session::forget('employee_id');
        }

        if (Session::has('employee_tab')) {
            Session::forget('employee_tab');
        }
        
        $carrier = DB::table('carriers_types')->find($id);

        $types = DB::table('identification_types')->where('status', '1')->orderBy('id','desc')->get();
        $divisons = DB::table('divisons')->where('status', '1')->orderBy('id','desc')->get();
        $ports = DB::table('port_lists')->where('status', '1')->orderBy('id','desc')->get();

        $landCodes = DB::table('carrier_codes')->where('carrier_type', '3')->where('status', '1')->orderBy('id','desc')->get();
        $oceanCodes = DB::table('carrier_codes')->where('carrier_type', '2')->where('status', '1')->orderBy('id','desc')->get();
        $airCodes = DB::table('carrier_codes')->where('carrier_type', '1')->where('status', '1')->orderBy('id','desc')->get();

        $flights = DB::table('flights')->where('status', '1')->orderBy('id','desc')->get();

        $countries = DB::table('countries')->orderBy('name','asc')->get();

        if($id=="1") {
            $ratwhere = "Air";
        } else if($id=="2") {
            $ratwhere = "Ocean";
        } else if($id=="3") {
            $ratwhere = "Ground";
        }

        $transportation = DB::table('transportation')->where('method', $ratwhere)->where('status', '1')->orderBy('description','asc')->get();
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

        
        if (empty(Session::get('carrier_tab'))) {
            Session::put('carrier_tab', 'general');
        }

        if (Session::has('carrier_id')) {

            $carrier_id = Session::get('carrier_id');
            $carrier_type = Session::get('carrier_type');

            if($carrier_type==$id) {
                // do some thing if the key is exist
                $carrierArray = DB::table('carriers')->where('id', $carrier_id)->first();

                if(!empty($carrierArray->country)) {
                    $states = DB::table('states')->where('country_id', @$carrierArray->country)->orderBy('name','asc')->get();
                }

                if(!empty($carrierArray->billing_country)) {
                    $billingstates = DB::table('states')->where('country_id', @$carrierArray->billing_country)->orderBy('name','asc')->get();
                }

                $other_address = DB::table('carrier_other_address')->where('carrier_id', @$carrier_id)->orderBy('id','desc')->get();
                $cr_notes = DB::table('carriers_notes')->where('carrier_id', $carrier_id)->orderBy('id','desc')->get();
                $gallery = DB::table('carriers_galleries')->where('carrier_id', $carrier_id)->orderBy('id','desc')->get();
                
            } else {
                Session::forget('carrier_id');
                Session::forget('carrier_type');
                Session::forget('carrier_cont_id');
                Session::put('carrier_tab', 'general');
                Session::forget('carrier_con_tab');
                Session::forget('carrier_charge_id');

                $carrierArray = [];
                $contactArray = [];
                $carrier_contacts = [];
            }
        } 

        // Carrier contact module
        if (Session::has('carrier_cont_id')) {

            $carrier_cont_id = Session::get('carrier_cont_id');
            $carrier_type = Session::get('carrier_type');

            if($carrier_type==$id) {
                // do some thing if the key is exist
                $contactArray = DB::table('carrier_contacts')->where('id', $carrier_cont_id)->first();
                $carrier_contacts = DB::table('carrier_contacts')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();
                $contact_gallery = DB::table('carriers_con_galleries')->where('carrier_contact_id', $carrier_cont_id)->orderBy('id','desc')->get();
                $contact_notes = DB::table('carriers_con_notes')->where('carrier_contact_id', $carrier_cont_id)->orderBy('id','desc')->get();

                if(!empty($contactArray->country)) {
                    $constates = DB::table('states')->where('country_id', @$contactArray->country)->orderBy('name','asc')->get();
                }

                if(!empty($contactArray->billing_country)) {
                    $conbillingstates = DB::table('states')->where('country_id', @$contactArray->billing_country)->orderBy('name','asc')->get();
                }

                if(!empty($contactArray->other_country)) {
                    $conConstates = DB::table('states')->where('country_id', @$contactArray->other_country)->orderBy('name','asc')->get();
                }

                $isConStatusCompleted = DB::table('carrier_contacts')->where('id', $carrier_cont_id)->where('status', '2')->count();

                if($isConStatusCompleted>0) {
                    // Session::put('carrier_cont_id_notes', $carrier_cont_id);
                    Session::forget('carrier_cont_id');

                    $contactArray = [];
                }
                
            } else {
                Session::forget('carrier_cont_id');

                $contactArray = [];
                $carrier_contacts = [];
            }
        } else {
            $carrier_id = Session::get('carrier_id');

            if(!empty($carrier_id)) {
                $carrier_contacts = DB::table('carrier_contacts')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();
            }
        }

        // Carrier rate module
        if (Session::has('carrier_rate_id')) {

            $carrier_rate_id = Session::get('carrier_rate_id');
            $carrier_type = Session::get('carrier_type');

            if($carrier_type==$id) {
                // do some thing if the key is exist
                $rateArray = DB::table('carrier_rate_ground')->where('id', $carrier_rate_id)->first();
                $carrier_rates = DB::table('carrier_rate_ground')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();

                $isRateStatusCompleted = DB::table('carrier_rate_ground')->where('id', $carrier_rate_id)->where('completed_status', '2')->count();

                if($isRateStatusCompleted>0) {
                    // Session::put('carrier_cont_id_notes', $carrier_cont_id);
                    Session::forget('carrier_rate_id');

                    $rateArray = [];
                }
                
            } else {
                Session::forget('carrier_rate_id');

                $rateArray = [];
                $carrier_rates = [];
            }
        } else {
            $carrier_id = Session::get('carrier_id');

            if(!empty($carrier_id)) {
                $carrier_rates = DB::table('carrier_rate_ground')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();
            }
        }

        // Carrier charge module
        if (Session::has('carrier_charge_id')) {

            $carrier_charge_id = Session::get('carrier_charge_id');
            $carrier_type = Session::get('carrier_type');

            if($carrier_type==$id) {
                // do some thing if the key is exist
                $chargeArray = DB::table('carrier_charges')->where('id', $carrier_charge_id)->first();
                $carrier_charges = DB::table('carrier_charges')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();

                $isChargeStatusCompleted = DB::table('carrier_charges')->where('id', $carrier_charge_id)->where('completed_status', '2')->count();

                if($isChargeStatusCompleted>0) {
                    // Session::put('carrier_cont_id_notes', $carrier_cont_id);
                    Session::forget('carrier_charge_id');

                    $chargeArray = [];
                }
                
            } else {
                Session::forget('carrier_charge_id');

                $chargeArray = [];
                $carrier_charges = [];
            }
        } else {
            $carrier_id = Session::get('carrier_id');

            if(!empty($carrier_id)) {
                $carrier_charges = DB::table('carrier_charges')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();
            }
        }

        if(!empty($carrier_id)) {
            $notInArray = [$carrier_id];
            $all_carriers = DB::table('carriers')->whereNotIn('id', $notInArray)->orderBy('id','desc')->get();

            if(!empty($carrier_cont_id)) {
                $notInArrayCon = [$carrier_cont_id];
                $all_carriers_contact = DB::table('carrier_contacts')->where('carrier_id', $carrier_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_contact = DB::table('carrier_contacts')->where('carrier_id', $carrier_id)->orderBy('id','asc')->get();
            }

            if(!empty($carrier_rate_id)) {
                $notInArrayCon = [$carrier_rate_id];
                $all_carriers_rate = DB::table('carrier_rate_ground')->where('carrier_id', $carrier_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_rate = DB::table('carrier_rate_ground')->where('carrier_id', $carrier_id)->orderBy('id','asc')->get();
            }
            
        } else {
            $all_carriers = DB::table('carriers')->orderBy('id','desc')->get();
            $all_carriers_contact = [];
            $all_carriers_rate = [];
        }
        

        $data = array(
            'title'                     => $carrier->name.' Carrier',
            'page'                      => 'carrier',
            'subpage'                   => 'aircarrier',
            'carrier_type'              => $id,
            'types'                     => $types,
            'divisons'                  => $divisons,
            'landCodes'                 => $landCodes,
            'oceanCodes'                => $oceanCodes,
            'airCodes'                  => $airCodes,
            'flights'                   => $flights,
            'carrierData'               => $carrierArray,
            'contactData'               => $contactArray,
            'rateData'                  => $rateArray,
            'chargeData'                  => $chargeArray,
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
        );
            
        return view('admin.add-carrier', compact('data'));
    }

    public function editCarrier($carrier_id)
    {

        if (Session::has('employee_id')) {
            Session::forget('employee_id');
        }

        if (Session::has('employee_tab')) {
            Session::forget('employee_tab');
        }

        $carrierData = DB::table('carriers')->where('id', $carrier_id)->first();
        $carrier_type = @$carrierData->carrier_type;


        if($carrier_type=="1") {
            $ratwhere = "Air";
        } else if($carrier_type=="2") {
            $ratwhere = "Ocean";
        } else if($carrier_type=="3") {
            $ratwhere = "Ground";
        }
        
        $carrier = DB::table('carriers_types')->find($carrier_type);

        $types = DB::table('identification_types')->where('status', '1')->orderBy('id','desc')->get();
        $divisons = DB::table('divisons')->where('status', '1')->orderBy('id','desc')->get();
        $ports = DB::table('port_lists')->where('status', '1')->orderBy('id','desc')->get();

        $landCodes = DB::table('carrier_codes')->where('carrier_type', '3')->where('status', '1')->orderBy('id','desc')->get();
        $oceanCodes = DB::table('carrier_codes')->where('carrier_type', '2')->where('status', '1')->orderBy('id','desc')->get();
        $airCodes = DB::table('carrier_codes')->where('carrier_type', '1')->where('status', '1')->orderBy('id','desc')->get();

        $flights = DB::table('flights')->where('status', '1')->orderBy('id','desc')->get();

        $countries = DB::table('countries')->orderBy('name','asc')->get();

        $transportation = DB::table('transportation')->where('method', $ratwhere)->where('status', '1')->orderBy('description','asc')->get();
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

        
        if (empty(Session::get('carrier_tab'))) {
            Session::put('carrier_tab', 'general');
        }

            // do some thing if the key is exist
            $carrierArray = DB::table('carriers')->where('id', $carrier_id)->first();

            if(!empty($carrierArray->country)) {
                $states = DB::table('states')->where('country_id', @$carrierArray->country)->orderBy('name','asc')->get();
            }

            if(!empty($carrierArray->billing_country)) {
                $billingstates = DB::table('states')->where('country_id', @$carrierArray->billing_country)->orderBy('name','asc')->get();
            }

            $other_address = DB::table('carrier_other_address')->where('carrier_id', @$carrier_id)->orderBy('id','desc')->get();
            $cr_notes = DB::table('carriers_notes')->where('carrier_id', $carrier_id)->orderBy('id','desc')->get();
            $gallery = DB::table('carriers_galleries')->where('carrier_id', $carrier_id)->orderBy('id','desc')->get();
                

        if(!empty($carrier_id)) {
            $carrier_contacts = DB::table('carrier_contacts')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();
            $carrier_rates = DB::table('carrier_rate_ground')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();
            $carrier_charges = DB::table('carrier_charges')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();
        }

        if(!empty($carrier_id)) {
            $notInArray = [$carrier_id];
            $all_carriers = DB::table('carriers')->whereNotIn('id', $notInArray)->orderBy('id','desc')->get();

            if(!empty($carrier_cont_id)) {
                $notInArrayCon = [$carrier_cont_id];
                $all_carriers_contact = DB::table('carrier_contacts')->where('carrier_id', $carrier_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_contact = DB::table('carrier_contacts')->where('carrier_id', $carrier_id)->orderBy('id','asc')->get();
            }

            if(!empty($carrier_rate_id)) {
                $notInArrayCon = [$carrier_rate_id];
                $all_carriers_rate = DB::table('carrier_rate_ground')->where('carrier_id', $carrier_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_rate = DB::table('carrier_rate_ground')->where('carrier_id', $carrier_id)->orderBy('id','asc')->get();
            }
            
        } else {
            $all_carriers = DB::table('carriers')->orderBy('id','desc')->get();
            $all_carriers_contact = [];
            $all_carriers_rate = [];
        }

        // Carrier contact module
        if (Session::has('carrier_cont_id')) {

            $carrier_cont_id = Session::get('carrier_cont_id');

            $contactArray = [];

            // do some thing if the key is exist
            $contactArray = DB::table('carrier_contacts')->where('id', $carrier_cont_id)->first();
            $contact_gallery = DB::table('carriers_con_galleries')->where('carrier_contact_id', $carrier_cont_id)->orderBy('id','desc')->get();
            $contact_notes = DB::table('carriers_con_notes')->where('carrier_contact_id', $carrier_cont_id)->orderBy('id','desc')->get();

            if(!empty($contactArray->country)) {
                $constates = DB::table('states')->where('country_id', @$contactArray->country)->orderBy('name','asc')->get();
            }

            if(!empty($contactArray->billing_country)) {
                $conbillingstates = DB::table('states')->where('country_id', @$contactArray->billing_country)->orderBy('name','asc')->get();
            }

            if(!empty($contactArray->other_country)) {
                $conConstates = DB::table('states')->where('country_id', @$contactArray->other_country)->orderBy('name','asc')->get();
            }

            $isConStatusCompleted = DB::table('carrier_contacts')->where('id', $carrier_cont_id)->where('status', '2')->count();

            if($isConStatusCompleted>0) {
                // Session::put('carrier_cont_id_notes', $carrier_cont_id);
                Session::forget('carrier_cont_id');

                $contactArray = [];
            }
        }

        // Carrier rate module
        if (Session::has('carrier_rate_id')) {

            $carrier_rate_id = Session::get('carrier_rate_id');

            // do some thing if the key is exist
            $rateArray = DB::table('carrier_rate_ground')->where('id', $carrier_rate_id)->first();
            $isRateStatusCompleted = DB::table('carrier_rate_ground')->where('id', $carrier_rate_id)->where('completed_status', '2')->count();

            if($isRateStatusCompleted>0) {
                // Session::put('carrier_cont_id_notes', $carrier_cont_id);
                Session::forget('carrier_rate_id');

                $rateArray = [];
            }
        } 

        // Carrier charge module
        if (Session::has('carrier_charge_id')) {

            $carrier_charge_id = Session::get('carrier_charge_id');

            // do some thing if the key is exist
            $chargeArray = DB::table('carrier_charges')->where('id', $carrier_charge_id)->first();
            $isChargeStatusCompleted = DB::table('carrier_charges')->where('id', $carrier_charge_id)->where('completed_status', '2')->count();

            if($isChargeStatusCompleted>0) {
                // Session::put('carrier_cont_id_notes', $carrier_cont_id);
                Session::forget('carrier_charge_id');

                $chargeArray = [];
            }
                
        } 
        

        $data = array(
            'title'                     => $carrier->name.' Carrier',
            'page'                      => 'carrier',
            'subpage'                   => 'aircarrier',
            'carrier_type'              => $carrier_type,
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
            'carrier_id'                => $carrier_id,
        );
            
        return view('admin.edit-carrier', compact('data'));
    }

    public function viewCarrier($carrier_id)
    {

        $carrierData = DB::table('carriers')->where('id', $carrier_id)->first();
        $carrier_type = @$carrierData->carrier_type;

        
        $carrier = DB::table('carriers_types')->find($carrier_type);

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
            $carrierArray = DB::table('carriers')->where('id', $carrier_id)->first();

            if(!empty($carrierArray->country)) {
                $states = DB::table('states')->where('country_id', @$carrierArray->country)->orderBy('name','asc')->get();
            }

            if(!empty($carrierArray->billing_country)) {
                $billingstates = DB::table('states')->where('country_id', @$carrierArray->billing_country)->orderBy('name','asc')->get();
            }

            $other_address = DB::table('carrier_other_address')->where('carrier_id', @$carrier_id)->orderBy('id','desc')->get();
            $cr_notes = DB::table('carriers_notes')->where('carrier_id', $carrier_id)->orderBy('id','desc')->get();
            $gallery = DB::table('carriers_galleries')->where('carrier_id', $carrier_id)->orderBy('id','desc')->get();
                

        if(!empty($carrier_id)) {
            $carrier_contacts = DB::table('carrier_contacts')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();
            $carrier_rates = DB::table('carrier_rate_ground')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();
            $carrier_charges = DB::table('carrier_charges')->where('carrier_id', $carrier_id)->orderBy('id', 'desc')->get();
        }

        if(!empty($carrier_id)) {
            $notInArray = [$carrier_id];
            $all_carriers = DB::table('carriers')->whereNotIn('id', $notInArray)->orderBy('id','desc')->get();

            if(!empty($carrier_cont_id)) {
                $notInArrayCon = [$carrier_cont_id];
                $all_carriers_contact = DB::table('carrier_contacts')->where('carrier_id', $carrier_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_contact = DB::table('carrier_contacts')->where('carrier_id', $carrier_id)->orderBy('id','asc')->get();
            }

            if(!empty($carrier_rate_id)) {
                $notInArrayCon = [$carrier_rate_id];
                $all_carriers_rate = DB::table('carrier_rate_ground')->where('carrier_id', $carrier_id)->whereNotIn('id', $notInArrayCon)->orderBy('id','asc')->get();
            } else {
                $all_carriers_rate = DB::table('carrier_rate_ground')->where('carrier_id', $carrier_id)->orderBy('id','asc')->get();
            }
            
        } else {
            $all_carriers = DB::table('carriers')->orderBy('id','desc')->get();
            $all_carriers_contact = [];
            $all_carriers_rate = [];
        }
        

        $data = array(
            'title'                     => $carrier->name.' Carrier',
            'page'                      => 'carrier',
            'subpage'                   => 'aircarrier',
            'carrier_type'              => $carrier_type,
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
            'carrier_id'                => $carrier_id,
        );
            
        return view('admin.view-carrier', compact('data'));
    }
    
    public function getimages(Request $request)
    {
        $carrier_cont_id = Session::get('carrier_cont_id');
        $carrier_id = Session::get('carrier_id');

        $listing_gallery = DB::table('carriers_con_galleries')->where('carrier_contact_id', $carrier_cont_id)->orderBy('id','desc')->get();


        $data = array(
            'listing_gallery' => $listing_gallery,
        );

        return view('admin.ajax-gallery-list', compact('data'));
    }

    public function getimagesEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
        $carrier_cont_id = Session::get('carrier_cont_id');

        $listing_gallery = DB::table('carriers_con_galleries')->where('carrier_contact_id', $carrier_cont_id)->orderBy('id','desc')->get();


        $data = array(
            'listing_gallery' => $listing_gallery,
        );

        return view('admin.ajax-gallery-edt-list', compact('data'));
    }

    public function getcarrierimages(Request $request)
    {
        $carrier_id = Session::get('carrier_id');

        $listing_gallery = DB::table('carriers_galleries')->where('carrier_id', $carrier_id)->orderBy('id','desc')->get();


        $data = array(
            'listing_gallery' => $listing_gallery,
        );

        return view('admin.ajax-carrier-gallery-list', compact('data'));
    }

    public function getcarrierimagesedt(Request $request)
    {
        $carrier_id = $request->carrier_id;

        $listing_gallery = DB::table('carriers_galleries')->where('carrier_id', $carrier_id)->orderBy('id','desc')->get();


        $data = array(
            'listing_gallery' => $listing_gallery,
        );

        return view('admin.ajax-carrier-gallery-list-edt', compact('data'));
    }
  
    public function dropzoneStore(Request $request)
    {
        if (Session::has('carrier_cont_id')) {

            $carrier_cont_id = Session::get('carrier_cont_id');
            $carrier_id = Session::get('carrier_id');
            $carrier_type = Session::get('carrier_type');
        } 

        $path = public_path('uploads/files');

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $imageName);

        $imageUpload = new CarriersConGallery();
        $imageUpload->carrier_id = $carrier_id;
        $imageUpload->carrier_contact_id = $carrier_cont_id;
        $imageUpload->filename = $imageName;
        $imageUpload->created_at = date("Y-m-d H:i:s");
        $imageUpload->save();

        return response()->json([
            'original_name' => $imageName,
        ]);
    }

    public function dropzoneStoreEdt(Request $request)
    {
        $carrier_cont_id = Session::get('carrier_cont_id');
        $carrier_id = $request->carrier_id;

        $path = public_path('uploads/files');

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $imageName);

        $imageUpload = new CarriersConGallery();
        $imageUpload->carrier_id = $carrier_id;
        $imageUpload->carrier_contact_id = $carrier_cont_id;
        $imageUpload->filename = $imageName;
        $imageUpload->created_at = date("Y-m-d H:i:s");
        $imageUpload->save();

        return response()->json([
            'original_name' => $imageName,
        ]);
    }

    public function dropzoneStoreForCarrier(Request $request)
    {
        if (Session::has('carrier_id')) {

            $carrier_id = Session::get('carrier_id');
            $carrier_type = Session::get('carrier_type');
        } 

        $path = public_path('uploads/files');

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $imageName);

        $imageUpload = new CarriersGallery();
        $imageUpload->carrier_id = $carrier_id;
        $imageUpload->filename = $imageName;
        $imageUpload->created_at = date("Y-m-d H:i:s");
        $imageUpload->save();

        return response()->json([
            'original_name' => $imageName,
        ]);
    }

    public function dropzoneStoreForCarrierEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;

        $path = public_path('uploads/files');

        !file_exists($path) && mkdir($path, 0777, true);

        $file = $request->file('file');
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $imageName);

        $imageUpload = new CarriersGallery();
        $imageUpload->carrier_id = $carrier_id;
        $imageUpload->filename = $imageName;
        $imageUpload->created_at = date("Y-m-d H:i:s");
        $imageUpload->save();

        return response()->json([
            'original_name' => $imageName,
        ]);
    }
    
    public function createNotes(Request $request)
    {
        if (Session::has('carrier_cont_id')) {

            $carrier_cont_id = Session::get('carrier_cont_id');
        } 

        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $conStatus = $request->conStatus;

        $carrier_auto_id = DB::table('carriers_con_notes')->insertGetId([
            'carrier_id'                 => $carrier_id,
            'carrier_contact_id'         => $carrier_cont_id,
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
    
            $affected = DB::table('carrier_contacts')
                    ->where('id', $carrier_cont_id)
                    ->update($dataArray);

            Session::forget('carrier_con_tab');
        }

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function createNotesEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
        $carrier_cont_id = Session::get('carrier_cont_id');

        $conStatus = $request->conStatus;

        $carrier_auto_id = DB::table('carriers_con_notes')->insertGetId([
            'carrier_id'                 => $carrier_id,
            'carrier_contact_id'         => $carrier_cont_id,
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

        return redirect('editCarrier/'.$carrier_id);
    }

    public function createRateNotes(Request $request)
    {
        if (Session::has('carrier_rate_id')) {

            $carrier_rate_id = Session::get('carrier_rate_id');
        } 

        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

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

        Session::put('carrier_tab', 'rates');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function createRateNotesEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
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

        return redirect('editCarrier/'.$carrier_id);
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

    public function createCarrier(Request $request)
    {
        if (Session::has('carrier_id')) {
            // do some thing if the key is exist
            $carrier_id = Session::get('carrier_id');

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
    
            $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        } else {

            $carrier = $this->generate_otp(6);

            $isExist = DB::table('carriers')->where('carrier_id', $carrier)
                ->exists();
            
            if ($isExist) {

                $carrier_id = $this->generate_otp(6);
            } else {
                $carrier_id = $carrier;
            }

            $carrier_auto_id = DB::table('carriers')->insertGetId([
                'carrier_id'                        => $carrier_id,
                'carrier_type'                      => $request->carrier_type,
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

            Session::put('carrier_id', $carrier_auto_id);
            Session::put('carrier_type', $request->carrier_type);
        }

        Session::put('carrier_tab', 'general');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$request->carrier_type);
    }

    public function updateCarrierData(Request $request)
    {
        $carrier_id = $request->carrier_id;
        $carrier_type = $request->carrier_type;

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

        $affected = DB::table('carriers')
            ->where('id', $carrier_id)
            ->update($dataArray);

        

        Session::put('carrier_edt_tab', 'generalce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$carrier_id);
    }
    
    public function createCarrierContact(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_cont_id = Session::get('carrier_cont_id');
        $carrier_type = Session::get('carrier_type');

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
                'carrier_id'                        => $carrier_id,
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
        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cgeneral');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function createCarrierContactEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
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
                'carrier_id'                        => $carrier_id,
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

        return redirect('editCarrier/'.$carrier_id);
    }

    public function createCarrierRateGround(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_rate_id = Session::get('carrier_rate_id');
        $carrier_type = Session::get('carrier_type');

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
                'carrier_id'                                    => $carrier_id,
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
        Session::put('carrier_tab', 'rates');
        Session::put('carrier_rate_tab', 'rgeneral');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function createCarrierRateGroundEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
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
                'carrier_id'                                    => $carrier_id,
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

        return redirect('editCarrier/'.$carrier_id);
    }

    public function createCarrierCustomCharge(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_charge_id = Session::get('carrier_charge_id');
        $carrier_type = Session::get('carrier_type');

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
                'carrier_id'                                    => @$carrier_id,
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
        Session::put('carrier_tab', 'charges');
        Session::put('carrier_charge_tab', 'chgeneral');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function createCustomCarrierChargeEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
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
                'carrier_id'                                    => @$carrier_id,
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

        return redirect('editCarrier/'.$carrier_id);
    }

    public function createCustomChargeAutoCreation(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_charge_id = Session::get('carrier_charge_id');
        $carrier_type = Session::get('carrier_type');

        $auto_creation = @$request->auto_creation;
        $conStatus = @$request->completed_status;

        if(!empty($auto_creation)) {
            DB::table('carrier_auto_creation')->where('charge_id', $carrier_charge_id)->delete();

            foreach ($auto_creation as $key => $item) {
                DB::table('carrier_auto_creation')->insertGetId([
                    'carrier_id'                                   => @$carrier_id,
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

            Session::put('carrier_tab', 'charges');
            Session::put('carrier_charge_tab', 'chinfo');
        }

        $affected = DB::table('carrier_charges')
            ->where('id', $carrier_charge_id)
            ->update($dataArray);

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function createCustomChargeAutoCreationEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
        $carrier_charge_id = Session::get('carrier_charge_id');

        $auto_creation = @$request->auto_creation;
        $conStatus = @$request->completed_status;

        if(!empty($auto_creation)) {
            DB::table('carrier_auto_creation')->where('charge_id', $carrier_charge_id)->delete();

            foreach ($auto_creation as $key => $item) {
                DB::table('carrier_auto_creation')->insertGetId([
                    'carrier_id'                                   => @$carrier_id,
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

        return redirect('editCarrier/'.$carrier_id);
    }
    
    public function updateCarrierAddress(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $dataArray = [
            'street_number'                => $request->street_number,
            'city'                         => $request->city,
            'country'                      => $request->country,
            'state'                        => $request->state,
            'zip_code'                     => $request->zip_code,
            'port'                         => $request->port,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'address');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateCarrierPmtTerms(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $dataArray = [
            'pmt_terms'                => $request->pmt_terms,
            'updated_at'               => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'pmttems');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateCarrierPmtTermsEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;

        $dataArray = [
            'pmt_terms'                => $request->pmt_terms,
            'updated_at'               => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'pmttemsce');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$carrier_id);
    }

    public function updateCarrierMoreInfo(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $dataArray = [
            'more_info'                     => $request->more_info,
            'updated_at'                    => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'moreinfo');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateCarrierMoreInfoEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;

        $dataArray = [
            'more_info'                     => $request->more_info,
            'updated_at'                    => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'moreinfoce');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$carrier_id);
    }

    public function updateCarrierEdtAddress(Request $request)
    {
        $carrier_id = $request->carrier_id;

        $dataArray = [
            'street_number'                => $request->street_number,
            'city'                         => $request->city,
            'country'                      => $request->country,
            'state'                        => $request->state,
            'zip_code'                     => $request->zip_code,
            'port'                         => $request->port,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'addressce');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$carrier_id);
    }

    public function addCarrierNote(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $carrier_auto_id = DB::table('carriers_notes')->insertGetId([
            'carrier_id'                 => $carrier_id,
            'notes'                      => $request->carrier_notes,
            'craeted_by'                 => 'Admin',
            'created_at'                 => date('Y-m-d h:i:s')
        ]);

        Session::put('carrier_tab', 'notes');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function addCarrierNoteEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;

        $carrier_auto_id = DB::table('carriers_notes')->insertGetId([
            'carrier_id'                 => $carrier_id,
            'notes'                      => $request->carrier_notes,
            'craeted_by'                 => 'Admin',
            'created_at'                 => date('Y-m-d h:i:s')
        ]);

        Session::put('carrier_edt_tab', 'notesce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$carrier_id);
    }
    
    public function updateParentEntity(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $dataArray = [
            'parent_entity'                => $request->parent_entity,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'relatedentities');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateParentEntityEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;

        $dataArray = [
            'parent_entity'                => $request->parent_entity,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'relatedentitiesce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$carrier_id);
    }

    public function updateLandCarrierCode(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $dataArray = [
            'land_carrier_code'            => $request->land_carrier_code,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'land');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateLandCarrierCodeEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;

        $dataArray = [
            'land_carrier_code'            => $request->land_carrier_code,
            'updated_at'                   => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'landce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$carrier_id);
    }
    
    public function updateOceanCarrierCode(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $dataArray = [
            'fmc_number'                => $request->fmc_number,
            'scac_number'               => $request->scac_number,
            'updated_at'                => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'land');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateOceanCarrierCodeEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;

        $dataArray = [
            'fmc_number'                => $request->fmc_number,
            'scac_number'               => $request->scac_number,
            'updated_at'                => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'landce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$carrier_id);
    }

    public function updateAirCarrierCode(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

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

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'land');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateAirCarrierCodeEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;

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

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'landce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$carrier_id);
    }

    public function updateConCarrierAddress(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_cont_id = Session::get('carrier_cont_id');
        $carrier_type = Session::get('carrier_type');

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

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'caddress');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateConCarrierAddressEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
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

        return redirect('editCarrier/'.$carrier_id);
    }
    
    public function updateCarrierBillingAddress(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $dataArray = [
            'billing_street_number'                => $request->billing_street_number,
            'billing_city'                         => $request->billing_city,
            'billing_country'                      => $request->billing_country,
            'billing_state'                        => $request->billing_state,
            'billing_zip_code'                     => $request->billing_zip_code,
            'billing_port'                         => $request->billing_port,
            'updated_at'                           => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'billing');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateCarrierBillingAddressEdt(Request $request)
    {

        $carrier_id = $request->carrier_id;

        $dataArray = [
            'billing_street_number'                => $request->billing_street_number,
            'billing_city'                         => $request->billing_city,
            'billing_country'                      => $request->billing_country,
            'billing_state'                        => $request->billing_state,
            'billing_zip_code'                     => $request->billing_zip_code,
            'billing_port'                         => $request->billing_port,
            'updated_at'                           => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers')
                ->where('id', $carrier_id)
                ->update($dataArray);

        Session::put('carrier_edt_tab', 'billingce');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$carrier_id);
    }

    public function updateCarrierConBillingAddress(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_cont_id = Session::get('carrier_cont_id');
        $carrier_type = Session::get('carrier_type');

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

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cbaddress');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateCarrierConBillingAddressEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
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

        return redirect('editCarrier/'.$carrier_id);
    }

    public function updateCarrierOtherAddress(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $dataArray = [
            'carrier_id'                         => $carrier_id,
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

        Session::put('carrier_tab', 'otheraddresses');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateCarrierOtherAddressEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;

        $dataArray = [
            'carrier_id'                         => $carrier_id,
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

        return redirect('editCarrier/'.$carrier_id);
    }

    public function updateCarrierContOtherAddress(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_cont_id = Session::get('carrier_cont_id');
        $carrier_type = Session::get('carrier_type');

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

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'coaddress');


        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateCarrierContOtherAddressEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
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

        return redirect('editCarrier/'.$carrier_id);
    }
    
    public function updateCarrierContDateOfBirth(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_cont_id = Session::get('carrier_cont_id');
        $carrier_type = Session::get('carrier_type');

        $dataArray = [
            'country_of_citizenship'                     => $request->country_of_citizenship,
            'date_of_birth'                              => date("Y-m-d", strtotime($request->date_of_birth)),
            'updated_at'                                 => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carrier_contacts')
                ->where('id', $carrier_cont_id)
                ->update($dataArray);


        $msg = 'Record saved successfully.';

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cpinfo');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateCarrierContDateOfBirthEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
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

        return redirect('editCarrier/'.$carrier_id);
    }

    public function updateCarrierRateContract(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_rate_id = Session::get('carrier_rate_id');
        $carrier_type = Session::get('carrier_type');

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

        Session::put('carrier_tab', 'rates');
        Session::put('carrier_rate_tab', 'rpinfo');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function updateCarrierRateContractEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;
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

        return redirect('editCarrier/'.$carrier_id);
    }

    public function saveCarrierOtherAddress(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

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

        $affected = DB::table('carrier_other_address')
                ->where('id', $other_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'otheraddresses');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function saveCarrierOtherAddressEdt(Request $request)
    {

        $other_id = $request->other_id;

        $carrier = DB::table('carrier_other_address')->where('id', $other_id)->first();
        $carrier_id = @$carrier->carrier_id;

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

        return redirect('editCarrier/'.$carrier_id);
    }
    
    public function saveCarrierConNote(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

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

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cinternalnotes');

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function saveCarrierConNoteEdit(Request $request)
    {
        $carrier_id = $request->carrier_id;
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

        return redirect('editCarrier/'.$carrier_id);
    }

    public function saveCarrierNote(Request $request)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $note_id = $request->note_id;

        $dataArray = [
            'notes'                  => $request->note_edt,
            'updated_by'             => 'Admin',
            'updated_at'             => date('Y-m-d h:i:s')
        ];

        $affected = DB::table('carriers_notes')
                ->where('id', $note_id)
                ->update($dataArray);

        Session::put('carrier_tab', 'internalnotes');

        $msg = 'Record saved successfully.';

        $type = "success";
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function saveCarrierNoteEdt(Request $request)
    {
        $carrier_id = $request->carrier_id;

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

        return redirect('editCarrier/'.$carrier_id);
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
        $carrier_id = Session::get('carrier_id');
        $carrier_rate_id = Session::get('carrier_rate_id');

        if (Session::has('carrier_rate_id')) {

        } else {

        }

        $rate_val = $request['rate_val'];
        $cities = DB::table('carriers_rate_lists')->where('state_id', $state_county)->orderBy('name','asc')->get();

        $result = "";
		$result .= '<option value="">Select city...</option>';

    }

    public function deleteCarrier(Request $request, $id)
    {
        $listing_gallery = DB::table('carriers_galleries')->where('carrier_id', $id)->get();

        if(!empty($listing_gallery)) {
            foreach ($listing_gallery as $key => $value) {
                $filename =  $value->filename;

                $path = public_path().'/uploads/files/'.$filename;

                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        $listing_gallery2 = DB::table('carriers_con_galleries')->where('carrier_id', $id)->get();

        if(!empty($listing_gallery2)) {
            foreach ($listing_gallery2 as $key => $value2) {
                $filename2 =  $value2->filename;
                $path2 = public_path().'/uploads/files/'.$filename2;

                if (file_exists($path2)) {
                    unlink($path2);
                }
            }
        }

        
        $delete = DB::table('carriers')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' Carrier has been not deleted ';
        } else {
            DB::table('carriers_galleries')->where('carrier_id', $id)->delete();
            DB::table('carriers_con_galleries')->where('carrier_id', $id)->delete();
            DB::table('carriers_con_notes')->where('carrier_id', $id)->delete();
            DB::table('carriers_notes')->where('carrier_id', $id)->delete();
            DB::table('carriers_rate_lists')->where('carrier_id', $id)->delete();
            DB::table('carrier_charges')->where('carrier_id', $id)->delete();
            DB::table('carrier_contacts')->where('carrier_id', $id)->delete();
            DB::table('carrier_other_address')->where('carrier_id', $id)->delete();
            DB::table('carrier_rate_ground')->where('carrier_id', $id)->delete();
            DB::table('carrier_auto_creation')->where('carrier_id', $id)->delete();

            $type = "success";
            $msg = ' Carrier deleted successfully. ';
        }
    
        Session::flash($type, $msg);
        return redirect('carriers');
    }

    public function deleteOtherAddress(Request $request, $id)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $delete = DB::table('carrier_other_address')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = ' Other Address has been not deleted ';
        } else {
            $type = "success";
            $msg = ' Other Address deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        Session::put('carrier_tab', 'otheraddresses');

        return redirect('add-carrier/'.$carrier_type);
    }

    public function deleteOtherAddressEdt(Request $request, $id)
    {
        $carrier = DB::table('carrier_other_address')->where('id', $id)->first();
        $carrier_id = @$carrier->carrier_id;

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

        return redirect('editCarrier/'.$carrier_id);
    }
    
    public function deleteConNote(Request $request, $id)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $delete = DB::table('carriers_con_notes')->where('id', $id)->delete();

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

        return redirect('add-carrier/'.$carrier_type);
    }

    public function deleteConNoteEdt(Request $request, $id)
    {
        $carriers = DB::table('carriers_con_notes')->where('id', $id)->first();
        $carrier_id = $carriers->carrier_id;

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

        return redirect('editCarrier/'.$carrier_id);
    }

    public function deleteNote(Request $request, $id)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $delete = DB::table('carriers_notes')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Note has been not deleted ';
        } else {
            $type = "success";
            $msg = 'Note deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        Session::put('carrier_tab', 'internalnotes');

        return redirect('add-carrier/'.$carrier_type);
    }

    public function deleteNoteEdt(Request $request, $id)
    {
        $carrier = DB::table('carriers_notes')->where('id', $id)->first();

        $carrier_id = @$carrier->carrier_id;

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

        return redirect('editCarrier/'.$carrier_id);
    }
    
    public function deleteConTabData(Request $request, $id)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $delete = DB::table('carrier_contacts')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Contact record has been not deleted ';
        } else {

            $listings = DB::table('carriers_con_galleries')->where('carrier_contact_id', $id)->get();

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
        
            DB::table('carriers_con_notes')->where('carrier_contact_id', $id)->delete();
            DB::table('carriers_con_galleries')->where('carrier_contact_id', $id)->delete();

            $type = "success";
            $msg = 'Contact all record deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function deleteConTabDataEdt(Request $request, $id)
    {
        $carriers = DB::table('carrier_contacts')->where('id', $id)->first();
        $carrier_id = $carriers->carrier_id;

        $delete = DB::table('carrier_contacts')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Contact record has been not deleted ';
        } else {

            $listings = DB::table('carriers_con_galleries')->where('carrier_contact_id', $id)->get();

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
        
            DB::table('carriers_con_notes')->where('carrier_contact_id', $id)->delete();
            DB::table('carriers_con_galleries')->where('carrier_contact_id', $id)->delete();

            $type = "success";
            $msg = 'Contact all record deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        return redirect('editCarrier/'.$carrier_id);
    }

    public function deleteRateGroundTabData(Request $request, $id)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

        $delete = DB::table('carrier_rate_ground')->where('id', $id)->delete();

        if (!$delete) {
            $type = "error";
            $msg = 'Rate ground record has been not deleted ';
        } else {

            $type = "success";
            $msg = 'Rate ground all record deleted successfully. ';
        }
    
        Session::flash($type, $msg);

        return redirect('add-carrier/'.$carrier_type);
    }

    public function deleteRateGroundTabDataEdt(Request $request, $id)
    {
        $carrier = DB::table('carrier_rate_ground')->where('id', $id)->first();
        $carrier_id = @$carrier->carrier_id;

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

        return redirect('editCarrier/'.$carrier_id);
    }

    public function deleteChargeTabData(Request $request, $id)
    {
        $carrier_id = Session::get('carrier_id');
        $carrier_type = Session::get('carrier_type');

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

        return redirect('add-carrier/'.$carrier_type);
    }

    public function deleteChargeTabDataEdt(Request $request, $id)
    {
        $carrier = DB::table('carrier_charges')->where('id', $id)->first();
        $carrier_id = @$carrier->carrier_id;

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

        return redirect('editCarrier/'.$carrier_id);
    }
    
    public function deleteGalleryImage($id)
    {
        $listing_gallery = DB::table('carriers_con_galleries')->where('id', $id)->first();
        $filename =  $listing_gallery->filename;
        $carrier_type = Session::get('carrier_type');
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

        Session::put('carrier_tab', 'contacts');
        Session::put('carrier_con_tab', 'cattachment');
    
        Session::flash($type, $msg);
        return redirect('add-carrier/'.$carrier_type);
    }

    public function deleteGalleryImageEdt($id)
    {
        $listing_gallery = DB::table('carriers_con_galleries')->where('id', $id)->first();
        $filename =  $listing_gallery->filename;
        $carrier_id = $listing_gallery->carrier_id;
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
        
        return redirect('editCarrier/'.$carrier_id);
    }

    public function deleteCarrierGalleryImage($id)
    {
        $listing_gallery = DB::table('carriers_galleries')->where('id', $id)->first();
        $filename =  $listing_gallery->filename;
        $carrier_type = Session::get('carrier_type');
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
        return redirect('add-carrier/'.$carrier_type);
    }

    public function deleteCarrierGalleryImageEdt($id)
    {
        $listing_gallery = DB::table('carriers_galleries')->where('id', $id)->first();
        $filename =  $listing_gallery->filename;
        $carrier_id =  $listing_gallery->carrier_id;
   
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
        
        return redirect('editCarrier/'.$carrier_id);
    }
}
