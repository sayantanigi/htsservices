@extends('layouts.admin-dashboard')
@section('title', $data['title'])

@section('content')

@php
    if($data['title']=="Air Carrier") {
        $tabCode = "Airline";
    } else if($data['title']=="Ocean Carrier") {
        $tabCode = "Ocean";
    } else if($data['title']=="Land Carrier") {
        $tabCode = "Land";
    }
@endphp

    <div class="tab-main-box">
        <div class="main-content tab-box" id="tab-1" style="display:block;">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">{{ $data['title'] }}
                                    {{-- <a href="{{ route('properties') }}" style="margin-left:10px;" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New</a> --}}
                                </h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item active">{{ $data['title'] }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">

                            @if (\Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show font-size-12">
                                    {{ \Session::get('error') }}<button type="button" class="btn-close"
                                        data-bs-dismiss="alert" aria-label="Close"></button></div>
                                {{ \Session::forget('error') }}
                            @endif

                            @if (\Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show font-size-12">
                                    {{ \Session::get('success') }}<button type="button" class="btn-close"
                                        data-bs-dismiss="alert" aria-label="Close"></button></div>
                                {{ \Session::forget('success') }}
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-cus" role="tablist" id="myAccordionEdt">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#generalce" id="generalce_nav" role="tab"
                                        aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">General</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#addressce" id="addressce_nav" role="tab" aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Address</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#billingce" id="billingce_nav" role="tab" aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Billing Address</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#otheraddressesce" id="otheraddressesce_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Other Addresses</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#relatedentitiesce" id="relatedentitiesce_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Related Entities</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#contactsce" id="contactsce_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Contacts</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#landce" id="landce_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">{{ $tabCode }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#ratesce" id="ratesce_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Rates</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#chargesce" id="chargesce_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Charges</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#pmttemsce" id="pmttemsce_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Pmt Tems</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#attachmentsce" id="attachmentsce_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Attachments</span>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#notesce" id="notesce_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Notes</span>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#internalnotesce" id="internalnotesce_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Internal Notes</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        data-bs-toggle="tab" href="#moreinfoce" id="moreinfoce_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">More Info</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">

                                <div class="tab-pane active" id="generalce" role="tabpanel">
                                    <form action="javascript:void(0)" class="custom-validation" method="post"
                                        id="formValidated">
                                        @csrf
                                        <input type="hidden" name="carrier_id" value="{{ @$data['carrier_id'] }}">
                                        <input type="hidden" name="carrier_type" value="{{ @$data['carrier_type'] }}">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Name<code>*</code></label>
                                                    <input disabled type="text" class="form-control" name="name"
                                                        value="{{ @$data['carrierData']->name }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Entity ID</label>
                                                    <input disabled type="text" class="form-control" name="entity_id"
                                                        value="{{ @$data['carrierData']->entity_id }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Phone </label>
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <input disabled type="text" class="form-control" name="phone"
                                                                value="{{ @$data['carrierData']->phone }}">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input disabled type="number" class="form-control" name="phone_1"
                                                                value="{{ @$data['carrierData']->phone_1 }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Mobile Phone</label>
                                                    <input disabled type="text" class="form-control" name="mobile_phone"
                                                        value="{{ @$data['carrierData']->mobile_phone }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Fax </label>
                                                    <input disabled type="text" class="form-control" name="fax"
                                                        value="{{ @$data['carrierData']->fax }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Email<code>*</code></label>
                                                    <input disabled type="email" class="form-control" name="email"
                                                        value="{{ @$data['carrierData']->email }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Website </label>
                                                    <input disabled type="text" class="form-control" name="website"
                                                        value="{{ @$data['carrierData']->website }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Account Number </label>
                                                    <input disabled type="text" class="form-control" name="account_number"
                                                        value="{{ @$data['carrierData']->account_number }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Contact First Name </label>
                                                    <input disabled type="text" class="form-control" name="contact_first_name"
                                                        value="{{ @$data['carrierData']->contact_first_name }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Contact Last Name </label>
                                                    <input disabled type="text" class="form-control" name="contact_last_name"
                                                        value="{{ @$data['carrierData']->contact_last_name }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Indentification Number </label>
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <input disabled type="text" class="form-control"
                                                                name="identification_number"
                                                                value="{{ @$data['carrierData']->identification_number }}">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="mb-3">
                                                                <select disabled class="form-select select2"
                                                                    name="identification_other"
                                                                    aria-label="Default select example">
                                                                    <option value="" selected="">Select other
                                                                    </option>
                                                                    @if (!$data['types']->isEmpty())
                                                                        @foreach ($data['types'] as $key => $item)
                                                                            <option value="{{ @$item->name }}"
                                                                                {{ @$item->name == @$data['carrierData']->identification_other ? 'selected' : '' }}>
                                                                                {{ @$item->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">

                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <label>Divison </label>
                                                            <select disabled class="form-select select2" name="division"
                                                                aria-label="Default select example">
                                                                <option value="" selected="">Select...</option>
                                                                @if (!$data['divisons']->isEmpty())
                                                                    @foreach ($data['divisons'] as $key => $item_2)
                                                                        <option value="{{ @$item_2->name }}"
                                                                            {{ @$item_2->name == @$data['carrierData']->division ? 'selected' : '' }}>
                                                                            {{ @$item_2->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Network ID </label>
                                                            <input disabled type="text" class="form-control" name="network_id"
                                                                value="{{ @$data['carrierData']->network_id }}">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>&nbsp; </label>
                                                            <div class="mb-3">
                                                                <div class="form-check-inline mb-3">
                                                                    <input disabled class="form-check-input" type="radio"
                                                                        name="network_status" id="formRadios1"
                                                                        value="1"
                                                                        {{ '1' == @$data['carrierData']->network_status ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="formRadios1">
                                                                        Active
                                                                    </label>
                                                                </div>
                                                                <div class="form-check-inline">
                                                                    <input disabled class="form-check-input" type="radio"
                                                                        name="network_status" id="formRadios2"
                                                                        value="0"
                                                                        {{ '0' == @$data['carrierData']->network_status ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="formRadios2">
                                                                        Inactive
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                                <div class="tab-pane " id="addressce" role="tabpanel">
                                    <form action="javascript:void(0);" class="custom-validation"
                                        method="post" id="formValidatedAddress">
                                        @csrf
                                        <input type="hidden" name="carrier_id" value="{{ @$data['carrier_id'] }}">
                                        <div class="form-group mb-3">
                                            <label>Street & Number<code>*</code></label>
                                            <div>
                                                <textarea disabled required="" name="street_number" class="form-control" rows="5">{{ @$data['carrierData']->street_number }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>City<code>*</code></label>
                                            <input disabled type="text" class="form-control" name="city" required=""
                                                placeholder="Type City" value="{{ @$data['carrierData']->city }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Country<code>*</code></label>
                                            <select disabled class="form-select select2" aria-label="Default select example"
                                                name="country" id="country_id">
                                                <option value="" selected="">Select Country...</option>
                                                @if (!$data['countries']->isEmpty())
                                                    @foreach ($data['countries'] as $key => $item_val)
                                                        <option value="{{ @$item_val->id }}"
                                                            {{ @$item_val->id == @$data['carrierData']->country ? 'selected' : '' }}>
                                                            {{ @$item_val->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>State<code>*</code></label>
                                            <select disabled class="form-select select2" aria-label="Default select example"
                                                name="state" id="state_html">
                                                <option value="" selected="">Select State...</option>
                                                @if (!empty($data['states']))
                                                    @foreach ($data['states'] as $key => $item_val_2)
                                                        <option value="{{ @$item_val_2->id }}"
                                                            {{ @$item_val_2->id == @$data['carrierData']->state ? 'selected' : '' }}>
                                                            {{ @$item_val_2->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Zip Code<code>*</code></label>
                                            <input disabled type="text" class="form-control" name="zip_code" required=""
                                                placeholder="Type Zip Code"
                                                value="{{ @$data['carrierData']->zip_code }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Port</label>
                                            <select disabled class="form-select select2" name="port"
                                                aria-label="Default select example">
                                                <option value="" selected="">Select Port...</option>
                                                @if (!$data['ports']->isEmpty())
                                                    @foreach ($data['ports'] as $key => $item_val_1)
                                                        <option value="{{ @$item_val_1->name }}"
                                                            {{ @$item_val_1->name == @$data['carrierData']->port ? 'selected' : '' }}>
                                                            {{ @$item_val_1->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="billingce" role="tabpanel">
                                    <form action="javascript:void(0);" class="custom-validation"
                                        method="post" id="formValidatedBillingAddress">
                                        @csrf
                                        <input type="hidden" name="carrier_id" value="{{ @$data['carrier_id'] }}">
                                        <div class="form-group mb-3">
                                            <label>Street & Number<code>*</code></label>
                                            <div>
                                                <textarea disabled required="" name="billing_street_number" class="form-control" rows="5">{{ @$data['carrierData']->billing_street_number }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>City<code>*</code></label>
                                            <input disabled type="text" class="form-control" name="billing_city"
                                                required="" placeholder="Type City"
                                                value="{{ @$data['carrierData']->billing_city }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Country<code>*</code></label>
                                            <select disabled class="form-select select2" aria-label="Default select example"
                                                name="billing_country" id="billing_country_id">
                                                <option value="" selected="">Select Country...</option>
                                                @if (!$data['countries']->isEmpty())
                                                    @foreach ($data['countries'] as $key => $item_val)
                                                        <option value="{{ @$item_val->id }}"
                                                            {{ @$item_val->id == @$data['carrierData']->billing_country ? 'selected' : '' }}>
                                                            {{ @$item_val->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>State<code>*</code></label>
                                            <select disabled class="form-select select2" aria-label="Default select example"
                                                name="billing_state" id="billing_state_html">
                                                <option value="" selected="">Select State...</option>
                                                @if (!empty($data['billingstates']))
                                                    @foreach ($data['billingstates'] as $key => $item_val_2)
                                                        <option value="{{ @$item_val_2->id }}"
                                                            {{ @$item_val_2->id == @$data['carrierData']->billing_state ? 'selected' : '' }}>
                                                            {{ @$item_val_2->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Zip Code<code>*</code></label>
                                            <input disabled type="text" class="form-control" name="billing_zip_code"
                                                required="" placeholder="Type Zip Code"
                                                value="{{ @$data['carrierData']->billing_zip_code }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Port</label>
                                            <select disabled class="form-select select2" name="billing_port"
                                                aria-label="Default select example">
                                                <option value="" selected="">Select Port...</option>
                                                @if (!$data['ports']->isEmpty())
                                                    @foreach ($data['ports'] as $key => $item_val_1)
                                                        <option value="{{ @$item_val_1->name }}"
                                                            {{ @$item_val_1->name == @$data['carrierData']->billing_port ? 'selected' : '' }}>
                                                            {{ @$item_val_1->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                    </form>
                                </div>

                                <div class="tab-pane " id="otheraddressesce" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-3">Other address lists
                                                
                                            </h4>
                                        </div>

                                        <div class="table-responsive fixhei">

                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th width="30">#</th>
                                                        <th width="250">Description</th>
                                                        <th>Contact Name</th>
                                                        <th>Country</th>
                                                        <th>Port</th>
                                                        <th>City</th>
                                                        <th>State</th>
                                                        <th>Street & Number</th>
                                                        <th width="100">Zip Code</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($data['other_address']))
                                                        @foreach ($data['other_address'] as $key => $row)
                                                            @php
                                                                $state = DB::table('states')
                                                                    ->where('id', $row->other_state)
                                                                    ->select('name')
                                                                    ->first();
                                                                $country = DB::table('countries')
                                                                    ->where('id', $row->other_country)
                                                                    ->select('name')
                                                                    ->first();
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    @if (@$row->other_description)
                                                                        {{ $row->other_description }}
                                                                    @else
                                                                        &#8212;
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (@$row->other_contact_name)
                                                                        {{ $row->other_contact_name }}
                                                                    @else
                                                                        &#8212;
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (@$country->name)
                                                                        {{ $country->name }}
                                                                    @else
                                                                        &#8212;
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (@$row->other_port)
                                                                        {{ $row->other_port }}
                                                                    @else
                                                                        &#8212;
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (@$row->other_city)
                                                                        {{ $row->other_city }}
                                                                    @else
                                                                        &#8212;
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (@$state->name)
                                                                        {{ $state->name }}
                                                                    @else
                                                                        &#8212;
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (@$row->other_street_number)
                                                                        {{ $row->other_street_number }}
                                                                    @else
                                                                        &#8212;
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (@$row->other_zip_code)
                                                                        {{ $row->other_zip_code }}
                                                                    @else
                                                                        &#8212;
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="relatedentitiesce" role="tabpanel">
                                    @php
                                        if(!empty(@$data['carrierData']->parent_entity)) {
                                            $carriers_single = DB::table('carriers')->where('id', @$data['carrierData']->parent_entity)->select('id','name','entity_id','parent_entity','carrier_type')->first();

                                            $carriers_types_v = DB::table('carriers_types')->where('id', $carriers_single->carrier_type)->select('name')->first();

                                            $carrieryTitle = @$carriers_single->name." - ".@$carriers_single->entity_id." - ".@$carriers_types_v->name." Carrier";
                                        } else {
                                            $carrieryTitle = "";
                                        }
                                        
            
                                    @endphp
                                    <div class="mb-3">
                                        <label>Parent Entity</label>
                                        <input type="text" disabled class="form-control" required="" value="{{ @$carrieryTitle }}">
                                    </div>
                                </div>

                                <div class="tab-pane " id="contactsce" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="table-responsive fixhei">
    
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-3">Contact lists
                                                    </h4>
                                                </div>
        
                                                <div class="table-responsive fixhei">
        
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th width="30">#</th>
                                                                <th width="250">Description</th>
                                                                <th>Contact Name</th>
                                                                <th>Country</th>
                                                                <th>Port</th>
                                                                <th>City</th>
                                                                <th>State</th>
                                                                <th>Street & Number</th>
                                                                <th width="100">Zip Code</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (!empty($data['carrier_contacts']))
                                                                @foreach ($data['carrier_contacts'] as $key => $row)
                                                                    @php
                                                                        if(!empty($row->state)) {
                                                                            $state = DB::table('states')
                                                                            ->where('id', $row->state)
                                                                            ->select('name')
                                                                            ->first();
                                                                        }
                                                                        
                                                                        if(!empty($row->country)) {
                                                                            $country = DB::table('countries')
                                                                            ->where('id', $row->country)
                                                                            ->select('name')
                                                                            ->first();
                                                                        }
                                                                        
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>
                                                                            @if (@$row->other_description)
                                                                                {{ @$row->other_description }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row->contact_first_name)
                                                                                {{ @$row->contact_first_name. " ".@$row->contact_last_name }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$country->name)
                                                                                {{ $country->name }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row->port)
                                                                                {{ $row->port }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row->city)
                                                                                {{ @$row->city }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$state->name)
                                                                                {{ $state->name }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row->street_number)
                                                                                {{ $row->street_number }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row->zip_code)
                                                                                {{ $row->zip_code }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                    </tr>
    
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
        
                                                </div>
                                            </div>
                                        
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane " id="landce" role="tabpanel">

                                    @php
                                        if(!empty(@$data['carrierData']->land_carrier_code)) {
                                            $carriers_land_code = DB::table('carrier_codes')->where('id', @$data['carrierData']->land_carrier_code)->select('id','carrier_code')->first();

                                            $landCarrierCode = @$carriers_land_code->carrier_code;
                                        } else {
                                            $landCarrierCode = "";
                                        }

                                        if(!empty(@$data['carrierData']->scac_number)) {
                                            $carriers_oc_code = DB::table('carrier_codes')->where('id', @$data['carrierData']->scac_number)->select('id','carrier_code')->first();

                                            $oceanCarrierCode = @$carriers_oc_code->carrier_code;
                                        } else {
                                            $oceanCarrierCode = "";
                                        }
                                        
            
                                    @endphp

                                    @if ($data['title']=="Air Carrier")
                                        <form action="javascript:void(0);" class="custom-validation" method="post" id="formValidatedirline">
                                            @csrf
                                            <input type="hidden" name="carrier_id" value="{{ @$data['carrier_id'] }}">
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">IATA Account Number</label>
                                                <div class="col-sm-5">
                                                    <input disabled class="form-control" name="IATA_account_number" type="text" placeholder="" value="{{ @$data['carrierData']->IATA_account_number }}" id="IATA_account_number">
                                                </div>

                                            </div>

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Airline Code</label>
                                                <div class="col-sm-5">
                                                    <input disabled class="form-control" name="airline_code" type="text" value="{{ @$data['carrierData']->airline_code }}" placeholder="" id="airline_code">
                                                </div>

                                                <div class="col-sm-3">
                                                    <button type="button" disabled class="btn btn-primary waves-effect waves-light">
                                                        ...
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Airline Prefix</label>
                                                <div class="col-sm-5">
                                                    <input disabled class="form-control" name="airline_prefix" type="text" placeholder="" value="{{ @$data['carrierData']->airline_prefix }}" id="airline_prefix">
                                                </div>

                                                <div class="col-sm-3">
                                                    <button type="button" disabled class="btn btn-primary waves-effect waves-light">
                                                        Flights...
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Air Way Bill Numbers</label>
                                                <div class="col-sm-5">
                                                    <textarea disabled class="form-control" name="air_way_bill_numbers" rows="5">{{ @$data['carrierData']->air_way_bill_numbers }}</textarea>
                                                </div>

                                            </div>

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label"><input disabled type="checkbox" name="passengers_only_airline" {{ @$data['carrierData']->passengers_only_airline == '1' ? 'checked' : '' }} value="1" id="passengers_only_airline"> This is a passengers only Airline</label>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">&nbsp;</label>
                                                <div class="col-sm-5">
                                                    &nbsp;
                                                </div>
                                            </div>
                                        </form>

                                    @elseif ($data['title']=="Ocean Carrier")
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">FMC Number</label>
                                            <div class="col-sm-5">
                                                <input disabled class="form-control" type="text" name="fmc_number_src" placeholder="" value="{{ @$data['carrierData']->fmc_number }}" id="fmc_number_src">
                                            </div>

                                        </div>

                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">SCAC Number</label>
                                            <div class="col-sm-5">
                                                <input disabled class="form-control" type="text" placeholder="" id="example-text-input" value="{{ @$oceanCarrierCode }}">
                                            </div>

                                            <div class="col-sm-3">
                                                
                                            </div>
                                        </div>

                                    @elseif ($data['title']=="Land Carrier")
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">SCAC Number</label>
                                            <div class="col-sm-5">
                                                <input disabled class="form-control" type="text" placeholder="" value="{{ @$landCarrierCode }}" id="example-text-input">
                                            </div>

                                            <div class="col-sm-3">
                                               
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <div class="tab-pane " id="ratesce" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="table-responsive fixhei">
                                
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-3">Rate lists
                                                       
                                                    </h4>
                                                </div>
                                
                                                <div class="table-responsive fixhei">
                                
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th width="30">#</th>
                                                                <th>Transportation</th>
                                                                <th>Freight Service</th>
                                                                <th>Carrier</th>
                                                                <th>Currency</th>
                                                                <th>Creaton Date</th>
                                                                <th>Transit Time</th>
                                                                <th>Port of landing</th>
                                                                <th>Port of unlanding</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (!empty($data['carrier_rates']))
                                                                @foreach ($data['carrier_rates'] as $key => $row_val)
                                                                    @php
                                                                        if(!empty($row_val->transportation)) {
                                                                            $transportationData = DB::table('transportation')
                                                                            ->where('id', $row_val->transportation)
                                                                            ->first();
                                                                        }

                                                                        
                                                                        if(!empty($row_val->freight_service_class)) {
                                                                            $freight_service_classData = DB::table('freight_service_class')
                                                                            ->where('id', $row_val->freight_service_class)
                                                                            ->first();
                                                                        }
                                                                        
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>
                                                                            @if ($row_val->transportation)
                                                                                {{ $transportationData->description."/".$transportationData->method."/".$transportationData->code }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row_val->freight_service_class)
                                                                                {{ $freight_service_classData->description."/".$freight_service_classData->code."/".$freight_service_classData->account_name }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row_val->carrier)
                                                                                {{ $row_val->carrier }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row_val->currency)
                                                                                {{ $row_val->currency }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row_val->created_at)
                                                                                {{ date("d M, Y, H:i", strtotime(@$row_val->created_at)) }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row_val->transit_time)
                                                                                {{ $row_val->transit_time }} days
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row_val->port_of_landing)
                                                                                {{ $row_val->port_of_landing." / ".$row_val->port_of_landing_country }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if (@$row_val->port_of_unlanding)
                                                                                {{ $row_val->port_of_unlanding." / ".$row_val->port_of_unlanding_country }}
                                                                            @else
                                                                                &#8212;
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                
                                                </div>
                                            </div>
                                        
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane " id="chargesce" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-3">Charge lists
                                                   
                                                </h4>
                                            </div>
                                        
                                            <div class="table-responsive fixhei">
                                        
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th width="30">#</th>
                                                            <th>Charge</th>
                                                            <th>Price</th>
                                                            <th>Autometic Creation</th>
                                                            <th>Currency</th>
                                                            <th>Creaton Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($data['carrier_charges']))
                                                            @foreach ($data['carrier_charges'] as $key => $row_val)
                                                                @php
                                                                    $chargeList = DB::table('charge_list')->where('id', @$row_val->charge_id)->first();
                                                                @endphp

                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>
                                                                        @if (@$row_val->charge_id)W
                                                                            {{ @$chargeList->description }}
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (@$row_val->price)
                                                                            {{ number_format($row_val->price,2) }}
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (@$row_val->carrier)
                                                                            {{ $row_val->carrier }}
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        USD
                                                                    </td>
                                                                    <td>
                                                                        @if (@$row_val->created_at)
                                                                            {{ date("d M, Y, H:i", strtotime(@$row_val->created_at)) }}
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    
                                                                </tr>
                                        
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                        
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="pmttemsce" role="tabpanel">
                                    <div class="rates_main">
                                        <form action="javascript:void(0);" class="custom-validation"
                                            method="post" id="formValidatedAddress">
                                            @csrf
                                            <input type="hidden" name="carrier_id" value="{{ @$data['carrier_id'] }}">
                                            <div class="form-group mb-3">
                                                <div>
                                                    <textarea disabled style="border:0; color: #8ca3bd!important;" name="pmt_terms" placeholder="Enter the Pmt Terms" class="form-control" rows="3">{{ @$data['carrierData']->pmt_terms }}</textarea>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="tab-pane " id="attachmentsce" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                        
                                                        <h4 class="card-title mb-3">Drop your file and attachment here.</h4>
                        
                                                        <div class="text-center mt-4">
                                                            <div class="card">
                                                                <div class="card-body wizard-card">
                                                                    <h4 class="card-title mb-4">Files</h4>
                                                                    <div id="conHTMLForCarrier">
                                                                        <table id="dataTable222" class="table dt-responsive nowrap w-100">
                                                                            <thead>
                                                                               <tr>
                                                                                  <th width="70">#</th>
                                                                                  <th width="400">File</th>
                                                                               </tr>
                                                                            </thead>
                                                          
                                                          
                                                                            <tbody>
                                                                               @if(!empty($data['gallery']))
                                                                                  @foreach($data['gallery'] as $key=>$row)
                                                                                 
                                                                                     <tr>
                                                                                        <td>{{ $key+1 }}</td>
                                                                                        <td>
                                                                                           @if(@$row->filename && file_exists( 'public/uploads/files/'.@$row->filename))
                                                                                                @php
                                                                                                    $ext = pathinfo(asset('/uploads/files/'.@$row->filename), PATHINFO_EXTENSION);
                                                                                                @endphp

                                                                                                @if ($ext=="jpeg" || $ext=="jpg" || $ext=="png" || $ext=="gif")
                                                                                                    <img id="output_image" src="{{ asset('/uploads/files/'.@$row->filename) }}" alt="image">
                                                                                                @else
                                                                                                    <a href="{{ asset('/uploads/files/'.@$row->filename) }}" target="__blank">{{ @$row->filename }}</a>
                                                                                                @endif
                                                                                           @else
                                                                                              <img id="output_image" src="{{ asset('/images/small.jpg') }}" alt="Header Avatar">
                                                                                           @endif
                                                                                        </td>
                                                                                     </tr>
                                                                                  @endforeach
                                                                               @endif
                                                                            </tbody>
                                                                         </table>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="tab-pane " id="notesce" role="tabpanel">
                                    <div class="rates_main">
                                        <form action="javascript:void(0);" class="custom-validation" method="post" id="formValidatedNotes">
                                        @csrf
                                        <input type="hidden" name="carrier_id" value="{{ @$data['carrier_id'] }}">
                                            <div class="row row-border-bottom mt-3 mb-3">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                        <label>Write Note Here</label>
                                                        <div>
                                                            <textarea disabled required="" class="form-control" name="carrier_notes" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> --}}

                                <div class="tab-pane " id="internalnotesce" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        
                                                        <th scope="col">Created On</th>
                                                        <th width="300" scope="">Notes</th>
                                                        <th scope="col">Craeted By</th>
                                                        <th scope="col">Last Modified</th>
                                                        <th scope="col">Last Modified By</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($data['cr_notes']))
                                                          @foreach($data['cr_notes'] as $key=>$row)
                                                                <tr>
                                                                    
                                                                    <td>
                                                                        @if (@$row->created_at)
                                                                            {{ date("jS M, Y", strtotime($row->created_at)) }}
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td style="white-space: inherit;">
                                                                        @if (@$row->notes)
                                                                              {{ $row->notes }}
                                                                        @else
                                                                              &#8212;
                                                                        @endif
                                                                     </td>
                                                                     <td>
                                                                        @if (@$row->craeted_by)
                                                                              {{ $row->craeted_by }}
                                                                        @else
                                                                              &#8212;
                                                                        @endif
                                                                     </td>
                                                                    <td>
                                                                        @if (@$row->updated_at)
                                                                              {{ date("jS M, Y", strtotime($row->updated_at)) }}
                                                                        @else
                                                                              &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (@$row->updated_by)
                                                                              {{ $row->updated_by }}
                                                                        @else
                                                                              &#8212;
                                                                        @endif
                                                                     </td>

                                                                    
                                                                </tr>
                                                    
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="moreinfoce" role="tabpanel">
                                    <div class="rates_main">
                                        <form action="{{ route('updateCarrierMoreInfoEdt') }}" class="custom-validation"
                                            method="post" id="formValidatedAddress">
                                            @csrf
                                            <input type="hidden" name="carrier_id" value="{{ @$data['carrier_id'] }}">
                                            <div class="form-group mb-3">
                                                <div>
                                                    <textarea disabled style="border:0; color: #8ca3bd!important;" name="more_info" placeholder="More info" class="form-control" rows="3">{{ @$data['carrierData']->more_info }}</textarea>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #output_image {
            height: 67px;
            width: 67px;
            padding: 2px;
            border: 1px solid #f15a24;
        }

        .select2-container {
            display: block;
        }

        .twitter-bs-wizard .twitter-bs-wizard-pager-link li.finish {
            float: right;
        }

        .property-type iframe {
            width: 100%;
            height: 580px;
        }

        .clear-btn {
            border: 1px solid #f00;
            background: #ff0000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .map-btn {
            border: 1px solid #000;
            background: #000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            margin-left: 10px;
        }

        .address-btn {
            border: 1px solid #000;
            background: #000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            margin-left: 10px;
        }

        .listing-btn {
            border: 1px solid #000;
            background: #000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            margin-left: 10px;
        }

        .nav-tabs-cus>li>a {
            color: #445990;
            font-weight: bold;
            font-size: 12px;
        }
        .form-control:disabled, .form-control[readonly] {
            border: 0px;
        }

        .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
            border: 0px;
        }
    </style>

@endsection
