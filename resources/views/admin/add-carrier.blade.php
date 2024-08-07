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
                            <ul class="nav nav-tabs nav-tabs-cus" role="tablist" id="myAccordion">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#general" id="general_nav" role="tab"
                                        aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">General</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#address" id="address_nav" role="tab" aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Address</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#billing" id="billing_nav" role="tab" aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Billing Address</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#otheraddresses" id="otheraddresses_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Other Addresses</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#relatedentities" id="relatedentities_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Related Entities</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#contacts" id="contacts_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Contacts</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#land" id="land_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">{{ $tabCode }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#rates" id="rates_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Rates</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#charges" id="charges_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Charges</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#pmttems" id="pmttems_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Pmt Tems</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#attachments" id="attachments_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Attachments</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#notes" id="notes_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Notes</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#internalnotes" id="internalnotes_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Internal Notes</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('carrier_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#moreinfo" id="moreinfo_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">More Info</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">

                                <div class="tab-pane active" id="general" role="tabpanel">
                                    <form action="{{ route('createCarrier') }}" class="custom-validation" method="post"
                                        id="formValidated">
                                        @csrf
                                        <input type="hidden" name="carrier_type" value="{{ @$data['carrier_type'] }}">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Name<code>*</code></label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ @$data['carrierData']->name }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Entity ID</label>
                                                    <input type="text" class="form-control" name="entity_id"
                                                        value="{{ @$data['carrierData']->entity_id }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Phone </label>
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" name="phone"
                                                                value="{{ @$data['carrierData']->phone }}">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="number" class="form-control" name="phone_1"
                                                                value="{{ @$data['carrierData']->phone_1 }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Mobile Phone</label>
                                                    <input type="text" class="form-control" name="mobile_phone"
                                                        value="{{ @$data['carrierData']->mobile_phone }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Fax </label>
                                                    <input type="text" class="form-control" name="fax"
                                                        value="{{ @$data['carrierData']->fax }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Email<code>*</code></label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ @$data['carrierData']->email }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Website </label>
                                                    <input type="text" class="form-control" name="website"
                                                        value="{{ @$data['carrierData']->website }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Account Number </label>
                                                    <input type="text" class="form-control" name="account_number"
                                                        value="{{ @$data['carrierData']->account_number }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Contact First Name </label>
                                                    <input type="text" class="form-control" name="contact_first_name"
                                                        value="{{ @$data['carrierData']->contact_first_name }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Contact Last Name </label>
                                                    <input type="text" class="form-control" name="contact_last_name"
                                                        value="{{ @$data['carrierData']->contact_last_name }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Indentification Number </label>
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control"
                                                                name="identification_number"
                                                                value="{{ @$data['carrierData']->identification_number }}">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="mb-3">
                                                                <select class="form-select select2"
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
                                                            <select class="form-select select2" name="division"
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
                                                            <input type="text" class="form-control" name="network_id"
                                                                value="{{ @$data['carrierData']->network_id }}">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>&nbsp; </label>
                                                            <div class="mb-3">
                                                                <div class="form-check-inline mb-3">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="network_status" id="formRadios1"
                                                                        value="1"
                                                                        {{ '1' == @$data['carrierData']->network_status ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="formRadios1">
                                                                        Active
                                                                    </label>
                                                                </div>
                                                                <div class="form-check-inline">
                                                                    <input class="form-check-input" type="radio"
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

                                            <div class="col-lg-12">
                                                <div class="form-group mb-0 float-end">
                                                    <div>
                                                        <button type="submit" name="submit" value="generalForm"
                                                            class="btn btn-primary waves-effect waves-light me-1">
                                                            Save
                                                        </button>
                                                        {{-- <button type="reset" class="btn btn-secondary waves-effect">
                                                            Cancel
                                                        </button>
                                                        <button type="reset" class="btn btn-secondary waves-effect">
                                                            Help
                                                        </button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                                <div class="tab-pane " id="address" role="tabpanel">
                                    <form action="{{ route('updateCarrierAddress') }}" class="custom-validation"
                                        method="post" id="formValidatedAddress">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label>Street & Number<code>*</code></label>
                                            <div>
                                                <textarea required="" name="street_number" class="form-control" rows="5">{{ @$data['carrierData']->street_number }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>City<code>*</code></label>
                                            <input type="text" class="form-control" name="city" required=""
                                                placeholder="Type City" value="{{ @$data['carrierData']->city }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Country<code>*</code></label>
                                            <select class="form-select select2" aria-label="Default select example"
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
                                            <select class="form-select select2" aria-label="Default select example"
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
                                            <input type="text" class="form-control" name="zip_code" required=""
                                                placeholder="Type Zip Code"
                                                value="{{ @$data['carrierData']->zip_code }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Port</label>
                                            <select class="form-select select2" name="port"
                                                aria-label="Default select example">
                                                <option value="" selected="">Select Port...</option>
                                                @if (!$data['ports']->isEmpty())
                                                    @foreach ($data['ports'] as $key => $item_val_1)
                                                        <option value="{{ @$item_val_1->name }}"
                                                            {{ @$item_val_1->name == @$data['carrierData']->port ? 'selected' : '' }}>
                                                            {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group mb-0 float-end">
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light me-1" name="submit"
                                                    value="address">
                                                    Save
                                                </button>
                                                {{-- <button type="reset" class="btn btn-secondary waves-effect">
                                                    Cancel
                                                </button>
                                                <button type="reset" class="btn btn-secondary waves-effect">
                                                    Help
                                                </button> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="billing" role="tabpanel">
                                    <form action="{{ route('updateCarrierBillingAddress') }}" class="custom-validation"
                                        method="post" id="formValidatedBillingAddress">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label>Street & Number<code>*</code></label>
                                            <div>
                                                <textarea required="" name="billing_street_number" class="form-control" rows="5">{{ @$data['carrierData']->billing_street_number }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>City<code>*</code></label>
                                            <input type="text" class="form-control" name="billing_city"
                                                required="" placeholder="Type City"
                                                value="{{ @$data['carrierData']->billing_city }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Country<code>*</code></label>
                                            <select class="form-select select2" aria-label="Default select example"
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
                                            <select class="form-select select2" aria-label="Default select example"
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
                                            <input type="text" class="form-control" name="billing_zip_code"
                                                required="" placeholder="Type Zip Code"
                                                value="{{ @$data['carrierData']->billing_zip_code }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Port</label>
                                            <select class="form-select select2" name="billing_port"
                                                aria-label="Default select example">
                                                <option value="" selected="">Select Port...</option>
                                                @if (!$data['ports']->isEmpty())
                                                    @foreach ($data['ports'] as $key => $item_val_1)
                                                        <option value="{{ @$item_val_1->name }}"
                                                            {{ @$item_val_1->name == @$data['carrierData']->billing_port ? 'selected' : '' }}>
                                                            {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group mb-0 float-end">
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light me-1" name="submit"
                                                    value="address">
                                                    Save
                                                </button>
                                                {{-- <button type="reset" class="btn btn-secondary waves-effect">
                                                    Cancel
                                                </button>
                                                <button type="reset" class="btn btn-secondary waves-effect">
                                                    Help
                                                </button> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane " id="otheraddresses" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-3">Other address lists
                                                <button type="button" style="float: right;" data-bs-toggle="modal"
                                                    data-bs-target="#otherserviceadd"
                                                    class="btn btn-primary btn-sm waves-effect waves-light">
                                                    <i class="fas fa-plus"></i> Add
                                                </button>
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
                                                        <th width="100" class="text-center">Actions</th>
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
                                                                <td>
                                                                    <button type="reset"
                                                                        class="btn btn-primary btn-sm btn-xs waves-effect" data-bs-toggle="modal"
                                                                        data-bs-target="#editotherserviceadd-{{ $row->id }}">
                                                                        <i class="fas fa-edit"></i> Edit
                                                                    </button>
                                                                    <button type="reset"
                                                                        class="btn btn-danger btn-sm waves-effect"
                                                                        onclick="deleteOtherAddress({{ $row->id }});">
                                                                        <i class="fas fa-trash"></i> Delete
                                                                    </button>
                                                                </td>
                                                            </tr>

                                                            <div class="modal fade" id="editotherserviceadd-{{ $row->id }}" tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Address</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('saveCarrierOtherAddress') }}" class="custom-validation"
                                                                                method="post" id="formValidatedOtherAddress">
                                                                                @csrf
                                                                                <input type="hidden" name="other_id" value="{{ $row->id }}">
                                                                                <div class="form-group mb-3">
                                                                                    <label>Description<code>*</code></label>
                                                                                    <div>
                                                                                        <textarea required="" name="other_description_edt" class="form-control" rows="5">{{ @$row->other_description }}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group mb-3">
                                                                                    <label>Contact Name<code>*</code></label>
                                                                                    <input type="text" name="other_contact_name_edt" class="form-control" value="{{ @$row->other_contact_name }}" required="">
                                                                                </div>
                                                                                <hr>

                                                                                <div class="form-group mb-3">
                                                                                    <label>Street & Number<code>*</code></label>
                                                                                    <div>
                                                                                        <textarea required="" name="other_street_number_edt" class="form-control" rows="5">{{ @$row->other_street_number }}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group mb-3">
                                                                                    <label>City<code>*</code></label>
                                                                                    <input type="text" class="form-control" name="other_city_edt" required=""
                                                                                        placeholder="Type City" value="{{ @$row->other_city }}">
                                                                                </div>
                                                                                <div class="form-group mb-3">
                                                                                    <label>Country<code>*</code></label>
                                                                                    <select class="form-select select2" name="other_country_edt" id="other_country_id_{{ $row->id }}" onchange="getOtherState('{{ $row->id }}', this);">
                                                                                        <option value="" selected="">Select Country...</option>
                                                                                        @if (!$data['countries']->isEmpty())
                                                                                            @foreach ($data['countries'] as $key => $item_val)
                                                                                                <option value="{{ @$item_val->id }}" {{ @$item_val->id == @$row->other_country ? 'selected' : '' }}>
                                                                                                    {{ @$item_val->name }}</option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                </div>
                                                                                @php
                                                                                    $othetstates = DB::table('states')->where('country_id', @$row->other_country)->orderBy('name','asc')->get();
                                                                                @endphp
                                                                                <div class="form-group mb-3">
                                                                                    <label>State<code>*</code></label>
                                                                                    <select class="form-select select2" name="other_state_edt" id="other_state_html_{{ $row->id }}">
                                                                                        <option value="" selected="">Select State...</option>
                                                                                        @if (!empty($othetstates))
                                                                                            @foreach ($othetstates as $key => $item_val_2)
                                                                                                <option value="{{ @$item_val_2->id }}" {{ @$item_val_2->id == @$row->other_state ? 'selected' : '' }}>
                                                                                                    {{ @$item_val_2->name }}</option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group mb-3">
                                                                                    <label>Zip Code<code>*</code></label>
                                                                                    <input type="text" class="form-control" name="other_zip_code_edt" required=""
                                                                                        placeholder="Type Zip Code" value="{{ @$row->other_zip_code }}">
                                                                                </div>
                                                                                <div class="form-group mb-3">
                                                                                    <label>Port</label>
                                                                                    <select class="form-select select2" name="other_port_edt"
                                                                                        aria-label="Default select example">
                                                                                        <option value="" selected="">Select Port...</option>
                                                                                        @if (!$data['ports']->isEmpty())
                                                                                            @foreach ($data['ports'] as $key => $item_val_1)
                                                                                                <option value="{{ @$item_val_1->name }}" {{ @$item_val_1->name == @$row->other_port ? 'selected' : '' }}>
                                                                                                    {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                </div>

                                                                                <div class="form-group mb-3">
                                                                                    <button type="submit" name="submit" value="otherAddress_edt"
                                                                                        class="btn btn-primary waves-effect waves-light">Save</button>

                                                                                    <button type="button" class="btn btn-light waves-effect"
                                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                                    {{-- <button type="button" class="btn btn-light waves-effect">Help</button> --}}
                                                                                </div>

                                                                            </form>
                                                                        </div>
                                                                        {{-- <div class="modal-footer">
                                                                            <button type="submit" name="submit" value="otherAddress" class="btn btn-primary waves-effect waves-light">Save</button>

                                                                            <button type="button" class="btn btn-light waves-effect"
                                                                                data-bs-dismiss="modal">Cancel</button>

                                                                        </div> --}}
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="relatedentities" role="tabpanel">
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
                                        <input type="text" class="form-control" required="" value="{{ @$carrieryTitle }}" placeholder=""
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    </div>

                                    <div class="modal fade bs-example-modal-lg" id="staticBackdrop"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
     
                                                <div class="modal-body">
                                                    {{-- <div class="table-responsive" style="max-height: 450px; overflow-y: auto;"> --}}
                                                    <div class="table-responsive">
                                                        <div style="max-height: 450px; overflow-y: auto;">
                                                            <form action="{{ route('updateParentEntity') }}" class="custom-validation" method="post"
                                                            id="formValidatedParentEntity">
                                                               @csrf
                                                               <table class="table table-centered table-nowrap table-hover mb-0">
                                                                <thead>
                                                                    
                                                                    <tr>
    
                                                                        <th scope="col">Name</th>
                                                                        <th scope="">Entity ID</th>
                                                                        <th scope="col">Type</th>
                                                                        <th scope="col">Action</th>
    
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(!empty($data['all_carriers']))
                                                                        @foreach($data['all_carriers'] as $key=>$item_val)
                                                
                                                                        @php
                                                                            $carriers_types = DB::table('carriers_types')->where('id', $item_val->carrier_type)->select('name')->first();
                                                
                                                                        @endphp
                                                                         
                                                                            <tr>
    
                                                                                <td>
                                                                                    <h5 class="font-size-16"> 
                                                                                        @if (@$item_val->name)
                                                                                                {{ $item_val->name }}
                                                                                        @else
                                                                                                &#8212;
                                                                                        @endif
                                                                                    </h5>
                                                                                </td>
                                                                                <td>
                                                                                    @if (@$item_val->entity_id)
                                                                                          {{ $item_val->entity_id }}
                                                                                    @else
                                                                                          &#8212;
                                                                                    @endif
                                                                                 </td>
                                                                                <td>
                                                                                    @if (@$item_val->carrier_type)
                                                                                          {{ $carriers_types->name }} Carrier
                                                                                    @else
                                                                                          &#8212;
                                                                                    @endif
                                                                                 </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input class="table-radio" type="radio" {{ @$item_val->id == @$data['carrierData']->parent_entity ? 'checked' : '' }} name="parent_entity" required id="parent_entity_{{ @$item_val->id }}" value="{{ @$item_val->id }}">
                                                                                    </div>
                                                                                    
                                                                                </td>
    
                                                                            </tr>
                                                                        
                                                                        @endforeach
                                                                    @endif 
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light waves-effect"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" name="submit" value="Parententity"
                                                                    class="btn btn-primary waves-effect waves-light">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-light waves-effect"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" value="Parententity"
                                                        class="btn btn-primary waves-effect waves-light">Save</button>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="contacts" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="table-responsive fixhei">
    
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-3">Contact lists
                                                        <button type="button" style="float: right;" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl"
                                                            class="btn btn-primary btn-sm waves-effect waves-light">
                                                            <i class="fas fa-plus"></i> 
                                                            @if (empty(Session::has('carrier_cont_id')))
                                                                Add New
                                                            @else
                                                                Edit
                                                            @endif
                                                            
                                                        </button>
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
                                                                <th width="135" class="text-center">Actions</th>
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
                                                                        <td>
                                                                            <button type="reset"
                                                                                class="btn btn-danger btn-sm waves-effect"
                                                                                onclick="deleteConTabData({{ $row->id }});">
                                                                                <i class="fas fa-trash"></i> Delete
                                                                            </button>
                                                                        </td>
                                                                    </tr>
    
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
        
                                                </div>
                                            </div>
                                        
                                        </div>

                                        <div class="modal fade bs-example-modal-xl" id="myModal" role="dialog" aria-labelledby="addcontactdetails" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addcontactdetails">Contacts
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="conModalCls" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <ul class="nav nav-tabs nav-tabs-cus" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-bs-toggle="tab" href="#cgeneral" id="cgeneral_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                            <span class="d-none d-sm-block">General
                                                                            </span>    
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('carrier_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#caddress" id="caddress_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                            <span class="d-none d-sm-block">Address
                                                                            </span>    
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('carrier_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#cbaddress" id="cbaddress_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Billing Address
                                                                            </span>    
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('carrier_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#coaddress" id="coaddress_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Other Address
                                                                            </span>    
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('carrier_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#cpinfo" id="cpinfo_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Personal Info
                                                                            </span>    
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('carrier_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#cattachment" id="cattachment_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Attachments
                                                                            </span>    
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('carrier_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#cnotes" id="cnotes_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Notes

                                                                            </span>    
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('carrier_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#cinternalnotes" id="cinternalnotes_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Internal Notes
                                                                            </span>    
                                                                        </a>
                                                                    </li>
                                                                </ul>

                                                                <div class="tab-content p-3 text-muted">
                                                                    <div class="tab-pane active" id="cgeneral" role="tabpanel">
                                                                        <form action="{{ route('createCarrierContact') }}" class="custom-validation" method="post"
                                                                            id="formValidatedContact">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>First Name<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="contact_first_name"
                                                                                            value="{{ @$data['contactData']->contact_first_name }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Last Name<code>*</code> </label>
                                                                                        <input type="text" class="form-control" name="contact_last_name"
                                                                                            value="{{ @$data['contactData']->contact_last_name }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Name<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="name"
                                                                                            value="{{ @$data['contactData']->name }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Parent </label>
                                                                                        <select class="form-select select2" aria-label="Default select example"
                                                                                            name="con_parent" id="con_parent">
                                                                                            <option value="" selected="">Select...</option>
                                                                                            @if (!empty($data['all_carriers_contact']))
                                                                                                @foreach ($data['all_carriers_contact'] as $key => $item_val)
                                                                                                    <option value="{{ @$item_val->id }}"
                                                                                                        {{ @$item_val->id == @$data['contactData']->parent ? 'selected' : '' }}>
                                                                                                        {{ @$item_val->name." - ".@$item_val->entity_id }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Divison </label>
                                                                                        <select class="form-select select2" name="division"
                                                                                            aria-label="Default select example">
                                                                                            <option value="" selected="">Select...</option>
                                                                                            @if (!$data['divisons']->isEmpty())
                                                                                                @foreach ($data['divisons'] as $key => $item_2)
                                                                                                    <option value="{{ @$item_2->name }}"
                                                                                                        {{ @$item_2->name == @$data['contactData']->division ? 'selected' : '' }}>
                                                                                                        {{ @$item_2->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Entity ID<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="entity_id"
                                                                                            value="{{ @$data['contactData']->entity_id }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Phone </label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-9">
                                                                                                <input type="text" class="form-control" name="phone"
                                                                                                    value="{{ @$data['contactData']->phone }}">
                                                                                            </div>
                                                                                            <div class="col-sm-3">
                                                                                                <input type="text" class="form-control" name="phone_1"
                                                                                                    value="{{ @$data['contactData']->phone_1 }}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Mobile Phone</label>
                                                                                        <input type="text" class="form-control" name="mobile_phone"
                                                                                            value="{{ @$data['contactData']->mobile_phone }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Fax </label>
                                                                                        <input type="text" class="form-control" name="fax"
                                                                                            value="{{ @$data['contactData']->fax }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Email<code>*</code></label>
                                                                                        <input type="email" class="form-control" name="email"
                                                                                            value="{{ @$data['contactData']->email }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Website </label>
                                                                                        <input type="text" class="form-control" name="website"
                                                                                            value="{{ @$data['contactData']->website }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Account Number<code>*</code> </label>
                                                                                        <input type="text" class="form-control" name="account_number"
                                                                                            value="{{ @$data['contactData']->account_number }}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Indentification Number<code>*</code> </label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-9">
                                                                                                <input type="text" class="form-control"
                                                                                                    name="identification_number"
                                                                                                    value="{{ @$data['contactData']->identification_number }}">
                                                                                            </div>
                                                                                            <div class="col-sm-3">
                                                                                                <div class="mb-3">
                                                                                                    <select class="form-select select2"
                                                                                                        name="identification_other"
                                                                                                        aria-label="Default select example">
                                                                                                        <option value="" selected="">Select other
                                                                                                        </option>
                                                                                                        @if (!$data['types']->isEmpty())
                                                                                                            @foreach ($data['types'] as $key => $item)
                                                                                                                <option value="{{ @$item->name }}"
                                                                                                                    {{ @$item->name == @$data['contactData']->identification_other ? 'selected' : '' }}>
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
                                                                                    <div class="form-group mb-0 float-end">
                                                                                        <div>
                                                                                            <button type="submit" name="submit" value="generalContactForm"
                                                                                                class="btn btn-primary waves-effect waves-light me-1">
                                                                                                Save
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                        
                                                                    </div>
                                                                    <div class="tab-pane" id="caddress" role="tabpanel">
                                                                        <form action="{{ route('updateConCarrierAddress') }}" class="custom-validation"
                                                                            method="post" id="formValidatedAddress2ndTab">
                                                                            @csrf
                                                                            <div class="form-group mb-3">
                                                                                <label>Street & Number<code>*</code></label>
                                                                                <div>
                                                                                    <textarea required="" name="street_number" class="form-control" rows="5">{{ @$data['contactData']->street_number }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>City<code>*</code></label>
                                                                                <input type="text" class="form-control" name="city" required=""
                                                                                    placeholder="Type City" value="{{ @$data['contactData']->city }}">
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Country<code>*</code></label>
                                                                                <select class="form-select select2" aria-label="Default select example"
                                                                                    name="country" id="cont_country_id">
                                                                                    <option value="" selected="">Select Country...</option>
                                                                                    @if (!$data['countries']->isEmpty())
                                                                                        @foreach ($data['countries'] as $key => $item_val)
                                                                                            <option value="{{ @$item_val->id }}"
                                                                                                {{ @$item_val->id == @$data['contactData']->country ? 'selected' : '' }}>
                                                                                                {{ @$item_val->name }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>State<code>*</code></label>
                                                                                <select class="form-select select2" aria-label="Default select example"
                                                                                    name="state" id="cont_state_html">
                                                                                    <option value="" selected="">Select State...</option>
                                                                                    @if (!empty($data['constates']))
                                                                                        @foreach ($data['constates'] as $key => $item_val_2)
                                                                                            <option value="{{ @$item_val_2->id }}"
                                                                                                {{ @$item_val_2->id == @$data['contactData']->state ? 'selected' : '' }}>
                                                                                                {{ @$item_val_2->name }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Zip Code<code>*</code></label>
                                                                                <input type="text" class="form-control" name="zip_code" required=""
                                                                                    placeholder="Type Zip Code"
                                                                                    value="{{ @$data['contactData']->zip_code }}">
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Port</label>
                                                                                <select class="form-select select2" name="port"
                                                                                    aria-label="Default select example">
                                                                                    <option value="" selected="">Select Port...</option>
                                                                                    @if (!$data['ports']->isEmpty())
                                                                                        @foreach ($data['ports'] as $key => $item_val_1)
                                                                                            <option value="{{ @$item_val_1->name }}"
                                                                                                {{ @$item_val_1->name == @$data['contactData']->port ? 'selected' : '' }}>
                                                                                                {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group mb-0 float-end">
                                                                                <div>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary waves-effect waves-light me-1" name="submit"
                                                                                        value="address">
                                                                                        Save
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="tab-pane " id="cbaddress" role="tabpanel">
                                                                        <form action="{{ route('updateCarrierConBillingAddress') }}" class="custom-validation"
                                                                            method="post" id="formValidatedBillingAddress2ndTab">
                                                                            @csrf
                                                                            <div class="form-group mb-3">
                                                                                <label>Street & Number<code>*</code></label>
                                                                                <div>
                                                                                    <textarea required="" name="billing_street_number" class="form-control" rows="5">{{ @$data['contactData']->billing_street_number }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>City<code>*</code></label>
                                                                                <input type="text" class="form-control" name="billing_city"
                                                                                    required="" placeholder="Type City"
                                                                                    value="{{ @$data['contactData']->billing_city }}">
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Country<code>*</code></label>
                                                                                <select class="form-select select2" aria-label="Default select example"
                                                                                    name="billing_country" id="con_billing_country_id">
                                                                                    <option value="" selected="">Select Country...</option>
                                                                                    @if (!$data['countries']->isEmpty())
                                                                                        @foreach ($data['countries'] as $key => $item_val)
                                                                                            <option value="{{ @$item_val->id }}"
                                                                                                {{ @$item_val->id == @$data['contactData']->billing_country ? 'selected' : '' }}>
                                                                                                {{ @$item_val->name }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>State<code>*</code></label>
                                                                                <select class="form-select select2" aria-label="Default select example"
                                                                                    name="billing_state" id="con_billing_state_html">
                                                                                    <option value="" selected="">Select State...</option>
                                                                                    @if (!empty($data['conbillingstates']))
                                                                                        @foreach ($data['conbillingstates'] as $key => $item_val_2)
                                                                                            <option value="{{ @$item_val_2->id }}"
                                                                                                {{ @$item_val_2->id == @$data['contactData']->billing_state ? 'selected' : '' }}>
                                                                                                {{ @$item_val_2->name }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Zip Code<code>*</code></label>
                                                                                <input type="text" class="form-control" name="billing_zip_code"
                                                                                    required="" placeholder="Type Zip Code"
                                                                                    value="{{ @$data['contactData']->billing_zip_code }}">
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Port</label>
                                                                                <select class="form-select select2" name="billing_port"
                                                                                    aria-label="Default select example">
                                                                                    <option value="" selected="">Select Port...</option>
                                                                                    @if (!$data['ports']->isEmpty())
                                                                                        @foreach ($data['ports'] as $key => $item_val_1)
                                                                                            <option value="{{ @$item_val_1->name }}"
                                                                                                {{ @$item_val_1->name == @$data['contactData']->billing_port ? 'selected' : '' }}>
                                                                                                {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group mb-0 float-end">
                                                                                <div>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary waves-effect waves-light me-1" name="submit"
                                                                                        value="address">
                                                                                        Save
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="tab-pane " id="coaddress" role="tabpanel">
                                                                        <form action="{{ route('updateCarrierContOtherAddress') }}" class="custom-validation"
                                                                            method="post" id="formValidatedBillingAddress2ndTab_2">
                                                                            @csrf
                                                                            <div class="mb-3 form-group">
                                                                                <label>Address</label>
                                                                                <div>
                                                                                    <textarea required="" name="other_address" class="form-control" rows="5">{{ @$data['contactData']->other_address }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Description
                                                                                </label>
                                                                                <div>
                                                                                    <textarea required="" name="other_description" class="form-control" rows="5">{{ @$data['contactData']->other_description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Contact</label>
                                                                                        <input type="text" class="form-control" name="other_contact" value="{{ @$data['contactData']->other_contact }}" required="" placeholder="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Phone</label>
                                                                                        <input type="text" class="form-control" required="" name="other_phone" value="{{ @$data['contactData']->other_phone }}" placeholder="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Fax</label>
                                                                                        <input type="text" class="form-control" required="" name="other_fax" value="{{ @$data['contactData']->other_fax }}" placeholder="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Email</label>
                                                                                        <input type="text" class="form-control" required="" name="other_email" value="{{ @$data['contactData']->other_email }}" placeholder="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group mb-3">
                                                                                <label>Street & Number<code>*</code></label>
                                                                                <div>
                                                                                    <textarea required="" name="other_street_number" class="form-control" rows="5">{{ @$data['contactData']->other_street_number }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>City<code>*</code></label>
                                                                                <input type="text" class="form-control" name="other_city"
                                                                                    required="" placeholder="Type City"
                                                                                    value="{{ @$data['contactData']->other_city }}">
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Country<code>*</code></label>
                                                                                <select class="form-select select2" aria-label="Default select example"
                                                                                    name="other_country_2" id="other_country_id_2">
                                                                                    <option value="" selected="">Select Country...</option>
                                                                                    @if (!$data['countries']->isEmpty())
                                                                                        @foreach ($data['countries'] as $key => $item_val)
                                                                                            <option value="{{ @$item_val->id }}"
                                                                                                {{ @$item_val->id == @$data['contactData']->other_country ? 'selected' : '' }}>
                                                                                                {{ @$item_val->name }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>State<code>*</code></label>
                                                                                <select class="form-select select2" aria-label="Default select example"
                                                                                    name="other_state_2" id="other_state_html_2">
                                                                                    <option value="" selected="">Select State...</option>
                                                                                    @if (!empty($data['conConstates']))
                                                                                        @foreach ($data['conConstates'] as $key => $item_val_2)
                                                                                            <option value="{{ @$item_val_2->id }}"
                                                                                                {{ @$item_val_2->id == @$data['contactData']->other_state ? 'selected' : '' }}>
                                                                                                {{ @$item_val_2->name }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Zip Code<code>*</code></label>
                                                                                <input type="text" class="form-control" name="other_zipcode"
                                                                                    required="" placeholder="Type Zip Code"
                                                                                    value="{{ @$data['contactData']->other_zipcode }}">
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Port</label>
                                                                                <select class="form-select select2" name="other_port"
                                                                                    aria-label="Default select example">
                                                                                    <option value="" selected="">Select Port...</option>
                                                                                    @if (!$data['ports']->isEmpty())
                                                                                        @foreach ($data['ports'] as $key => $item_val_1)
                                                                                            <option value="{{ @$item_val_1->name }}"
                                                                                                {{ @$item_val_1->name == @$data['contactData']->other_port ? 'selected' : '' }}>
                                                                                                {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            <div class="mb-0 float-end">
                                                                                <div>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary waves-effect waves-light me-1" name="submit"
                                                                                        value="address">
                                                                                        Save
                                                                                    </button>
                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                    <div class="tab-pane " id="cpinfo" role="tabpanel">
                                                                        <form action="{{ route('updateCarrierContDateOfBirth') }}" class="custom-validation"
                                                                            method="post" id="formValidatedBillingAddress2ndTab_3">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Country of Citizenship
                                                                                        </label>
                                                                                        <select class="form-select select2" aria-label="Default select example"
                                                                                            name="country_of_citizenship" id="country_of_citizenship">
                                                                                            <option value="" selected="">Select Country...</option>
                                                                                            @if (!$data['countries']->isEmpty())
                                                                                                @foreach ($data['countries'] as $key => $item_val)
                                                                                                    <option value="{{ @$item_val->id }}"
                                                                                                        {{ @$item_val->id == @$data['contactData']->country_of_citizenship ? 'selected' : '' }}>
                                                                                                        {{ @$item_val->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Date Of Birth
                                                                                        </label>
                                                                                        <input type="date" class="form-control" name="date_of_birth" required="" placeholder="" value="{{ @$data['contactData']->date_of_birth }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-0 float-end">
                                                                                <div>
                                                                                    <button type="submit" name="submit" value="saveDOB" class="btn btn-primary waves-effect waves-light me-1">
                                                                                        Save
                                                                                    </button>
                                                                                    {{-- <button type="reset" class="btn btn-secondary waves-effect">
                                                                                        Cancel
                                                                                    </button>
                                                                                    <button type="reset" class="btn btn-secondary waves-effect">
                                                                                        Help
                                                                                    </button> --}}
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="tab-pane " id="cattachment" role="tabpanel">
                                                                        <div>
                                                                            <form action="{{ route('upload-images') }}" class="form-horizontal form dropzone" method="post" id="formValidatedConCarrierGallery">
                                                                                @csrf
                                                                                <div class="fallback">
                                                                                    <input name="file" type="file" multiple="multiple">
                                                                                </div>
                                                                                <div class="dz-message needsclick">
                                                                                    <div class="mb-3">
                                                                                        <i class="display-4 text-muted ri-upload-cloud-2-line"></i>
                                                                                    </div>
                                                                                    
                                                                                    <h4>Drop files here or click to upload.</h4>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                        
                                                                        {{-- <div class="text-center mt-4">
                                                                            <button type="button" class="btn btn-primary waves-effect waves-light">Send Files</button>
                                                                        </div> --}}

                                                                        <div class="card">
                                                                            <div class="card-body wizard-card">
                                                                                <h4 class="card-title mb-4">Files</h4>
                                                                                <div id="conHTML">
                                                                                    <table id="dataTable222" class="table dt-responsive nowrap w-100">
                                                                                        <thead>
                                                                                           <tr>
                                                                                              <th width="70">#</th>
                                                                                              <th>File</th>
                                                                                              <th>Actions</th>
                                                                                           </tr>
                                                                                        </thead>
                                                                      
                                                                      
                                                                                        <tbody>
                                                                                           @if(!empty($data['contact_gallery']))
                                                                                              @foreach($data['contact_gallery'] as $key=>$row)
                                                                                             
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
                                                                                                    <td>
                                                                                                       <button class="btn btn-xs btn-danger" onclick="deleteListingImage({{@$row->id}})"><i class="fas fa-trash-alt"></i></button>
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
                                                                    <div class="tab-pane " id="cnotes" role="tabpanel">
                                                                        <div class="rates_main">
                                                                            <form action="{{ route('create-notes') }}" class="form-horizontal form" method="post" id="formValidatedBillingAddress2ndTab_4">
                                                                                @csrf
                                                                                <div class="row row-border-bottom mt-3 mb-3">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="mb-3 form-group">
                                                                                            <label>Write Note Here</label>
                                                                                            <div>
                                                                                                <textarea name="edit_note" class="form-control" rows="5"></textarea>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="mb-3 form-group">
                                                                                            <label>Is Contact Tabs Completed</label>
                                                                                            <div class="form-group">
                                                                                                <div class="form-check form-check-inline">
                                                                                                    <input class="form-check-input" type="radio" name="conStatus" id="inlineRadio1" value="1">
                                                                                                <label class="form-check-label" for="inlineRadio1">Completed</label>
                                                                                                </div>
                                                                                                <div class="form-check form-check-inline">
                                                                                                    <input class="form-check-input" type="radio" name="conStatus" id="inlineRadio2" value="0" checked>
                                                                                                <label class="form-check-label" for="inlineRadio2">Not Completed</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <div>
                                                                                                <button type="submit" name="submit" value="" class="btn btn-primary waves-effect waves-light me-1">
                                                                                                    Submit
                                                                                                </button>
                                                                                                {{-- <button type="reset" class="btn btn-secondary waves-effect">
                                                                                                    Cancel
                                                                                                </button> --}}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane " id="cinternalnotes" role="tabpanel">
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
                                                                                            <th scope="col" width="200">Action</th>
                                                                                            
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @if(!empty($data['contact_notes']))
                                                                                              @foreach($data['contact_notes'] as $key=>$row)
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
                                    
                                                                                                        
                                                                                                        <td>
                                                                                                            <button type="button" class="btn btn-primary btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#editConNote-{{ $row->id }}">
                                                                                                                <i class="fas fa-edit"></i> Edit
                                                                                                            </button>
                                                                                                            <button type="button" class="btn btn-danger btn-sm waves-effect"
                                                                                                                onclick="deleteConNote({{ $row->id }});">
                                                                                                                <i class="fas fa-trash"></i> Delete
                                                                                                            </button>
                                                                                                        </td>
                                                                                                        
                                                                                                    </tr>
                                                                                        
                                                                                                    <div class="modal fade" id="editConNote-{{ $row->id }}" tabindex="-1" role="dialog"
                                                                                                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                                                                            <div class="modal-content">
                                                                                                                <div class="modal-header">
                                                                                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Note</h5>
                                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                                                        aria-label="Close"></button>
                                                                                                                </div>
                                                                                                                <div class="modal-body">
                                                                                                                    <form action="{{ route('saveCarrierConNote') }}" class="custom-validation"
                                                                                                                        method="post" id="formValidatedOtherAddress">
                                                                                                                        @csrf
                                                                                                                        <input type="hidden" name="note_id" value="{{ $row->id }}">
                                                                                                                        <div class="form-group mb-3">
                                                                                                                            <label>Note<code>*</code></label>
                                                                                                                            <div>
                                                                                                                                <textarea required="" name="conn_note_edt" class="form-control" rows="5">{{ @$row->notes }}</textarea>
                                                                                                                            </div>
                                                                                                                        </div>
                                        
                                                                                                                        <div class="form-group mb-3">
                                                                                                                            <button type="submit" name="submit" value="conNoteEdt"
                                                                                                                                class="btn btn-primary waves-effect waves-light">Save</button>
                                        
                                                                                                                            <button type="button" class="btn btn-light waves-effect"
                                                                                                                                data-bs-dismiss="modal">Cancel</button>
                                                                                                                        </div>
                                        
                                                                                                                    </form>
                                                                                                                </div>
                                                                                                            </div><!-- /.modal-content -->
                                                                                                        </div><!-- /.modal-dialog -->
                                                                                                    </div>
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
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="land" role="tabpanel">

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
                                        <form action="{{ route('updateAirCarrierCode') }}" class="custom-validation" method="post" id="formValidatedirline">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">IATA Account Number</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control" name="IATA_account_number" type="text" placeholder="" value="{{ @$data['carrierData']->IATA_account_number }}" id="IATA_account_number">
                                                </div>

                                            </div>

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Airline Code</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control" name="airline_code" type="text" value="{{ @$data['carrierData']->airline_code }}" placeholder="" id="airline_code">
                                                </div>

                                                <div class="col-sm-3">
                                                    <button type="button" onclick="airlineCodeModalOpen();" class="btn btn-primary waves-effect waves-light">
                                                        ...
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Airline Prefix</label>
                                                <div class="col-sm-5">
                                                    <input class="form-control" name="airline_prefix" type="text" placeholder="" value="{{ @$data['carrierData']->airline_prefix }}" id="airline_prefix">
                                                </div>

                                                <div class="col-sm-3">
                                                    <button type="button" onclick="airlinePrefixModalOpen();" class="btn btn-primary waves-effect waves-light">
                                                        Flights...
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Air Way Bill Numbers</label>
                                                <div class="col-sm-5">
                                                    <textarea class="form-control" name="air_way_bill_numbers" rows="5">{{ @$data['carrierData']->air_way_bill_numbers }}</textarea>
                                                </div>

                                            </div>

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label"><input type="checkbox" name="passengers_only_airline" {{ @$data['carrierData']->passengers_only_airline == '1' ? 'checked' : '' }} value="1" id="passengers_only_airline"> This is a passengers only Airline</label>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">&nbsp;</label>
                                                <div class="col-sm-5">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    @elseif ($data['title']=="Ocean Carrier")
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">FMC Number</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text" name="fmc_number_src" placeholder="" value="{{ @$data['carrierData']->fmc_number }}" id="fmc_number_src">
                                            </div>

                                        </div>

                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">SCAC Number</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text" placeholder="" id="example-text-input" value="{{ @$oceanCarrierCode }}">
                                            </div>

                                            <div class="col-sm-3">
                                                <button type="button" onclick="oceanModalOpen();" class="btn btn-primary waves-effect waves-light">
                                                    Add
                                                </button>
                                            </div>
                                        </div>

                                    @elseif ($data['title']=="Land Carrier")
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">SCAC Number</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text" placeholder="" value="{{ @$landCarrierCode }}" id="example-text-input">
                                            </div>

                                            <div class="col-sm-3">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#addLandCode" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addSCAC">
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="modal fade bs-example-modal-lg" id="addLandCode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Select Land & Carriers</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <form action="{{ route('updateLandCarrierCode') }}" class="custom-validation" method="post" id="formValidatedParentEntity">
                                                            @csrf
                                                            <div style="max-height: 350px; overflow-y: auto;">
                                                                <table class="table table-centered table-nowrap table-hover mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            
                                                                            <th scope="col">Code</th>
                                                                            <th scope="" >Description</th>
                                                                            <th scope="col">Action</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if(!empty($data['landCodes']))
                                                                            @foreach($data['landCodes'] as $key=>$item_val)
                                                                                <tr>
                                                                                    <td>
                                                                                        @if (@$item_val->carrier_code)
                                                                                                {{ $item_val->carrier_code }}
                                                                                        @else
                                                                                                &#8212;
                                                                                        @endif
                                                                                    </td>
                                                                                    <td style="white-space: inherit;">
                                                                                        @if (@$item_val->carrier_description)
                                                                                                {{ $item_val->carrier_description }}
                                                                                        @else
                                                                                                &#8212;
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="form-group">
                                                                                            <input class="table-radio" type="radio" {{ @$item_val->id == @$data['carrierData']->land_carrier_code ? 'checked' : '' }} name="land_carrier_code" required id="land_carrier_code_{{ @$item_val->id }}" value="{{ @$item_val->id }}">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="submit" value="landcarrierCodeVal" class="btn btn-primary waves-effect waves-light">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" value="landcarrierCodeVal" class="btn btn-primary waves-effect waves-light">Save</button>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade bs-example-modal-lg" id="addOceanCode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Select Ocean & Carriers</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <form action="{{ route('updateOceanCarrierCode') }}" class="custom-validation" method="post" id="formValidatedParentEntity">
                                                            @csrf

                                                            <input type="hidden" name="fmc_number" id="fmc_number">

                                                            <div style="max-height: 350px; overflow-y: auto;">
                                                                <table class="table table-centered table-nowrap table-hover mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            
                                                                            <th scope="col">Code</th>
                                                                            <th scope="" >Description</th>
                                                                            <th scope="col">Action</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if(!empty($data['oceanCodes']))
                                                                            @foreach($data['oceanCodes'] as $key=>$item_val)
                                                                                <tr>
                                                                                    <td>
                                                                                        @if (@$item_val->carrier_code)
                                                                                                {{ $item_val->carrier_code }}
                                                                                        @else
                                                                                                &#8212;
                                                                                        @endif
                                                                                    </td>
                                                                                    <td style="white-space: inherit;">
                                                                                        @if (@$item_val->carrier_description)
                                                                                                {{ $item_val->carrier_description }}
                                                                                        @else
                                                                                                &#8212;
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="form-group">
                                                                                            <input class="table-radio" type="radio" {{ @$item_val->id == @$data['carrierData']->scac_number ? 'checked' : '' }} name="scac_number" required id="scac_number_{{ @$item_val->id }}" value="{{ @$item_val->id }}">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="submit" value="landcarrierCodeVal" class="btn btn-primary waves-effect waves-light">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade bs-example-modal-lg" id="airlineCodeMD" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Select Airline Code</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">

                                                            <div style="max-height: 350px; overflow-y: auto;">
                                                                <table class="table table-centered table-nowrap table-hover mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            
                                                                            <th scope="col">Code</th>
                                                                            <th scope="" >Description</th>
                                                                            <th scope="col">Action</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if(!empty($data['airCodes']))
                                                                            @foreach($data['airCodes'] as $key=>$item_val)
                                                                                <tr>
                                                                                    <td>
                                                                                        @if (@$item_val->carrier_code)
                                                                                                {{ $item_val->carrier_code }}
                                                                                        @else
                                                                                                &#8212;
                                                                                        @endif
                                                                                    </td>
                                                                                    <td style="white-space: inherit;">
                                                                                        @if (@$item_val->carrier_description)
                                                                                                {{ $item_val->carrier_description }}
                                                                                        @else
                                                                                                &#8212;
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="form-group">
                                                                                            <input class="table-radio clsGender" type="radio" {{ @$item_val->carrier_code == @$data['carrierData']->airline_code ? 'checked' : '' }} name="airline_code_pm" required id="airline_code_{{ @$item_val->carrier_code }}" value="{{ @$item_val->carrier_code }}">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Add</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade bs-example-modal-lg" id="airlineCodeFL" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Select Airline Prefix</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">

                                                            <div style="max-height: 350px; overflow-y: auto;">
                                                                <table class="table table-centered table-nowrap table-hover mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            
                                                                            <th scope="col">Number</th>
                                                                            <th scope="" >Passenger Flight</th>
                                                                            <th scope="col">Action</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if(!empty($data['flights']))
                                                                            @foreach($data['flights'] as $key=>$item_val)
                                                                                <tr>
                                                                                    <td>
                                                                                        @if (@$item_val->fight_number)
                                                                                                {{ $item_val->fight_number }}
                                                                                        @else
                                                                                                &#8212;
                                                                                        @endif
                                                                                    </td>
                                                                                    <td style="white-space: inherit;">
                                                                                        @if (@$item_val->passenger)
                                                                                                {{ $item_val->passenger }}
                                                                                        @else
                                                                                                &#8212;
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="form-group">
                                                                                            <input class="table-radio clsGenderFL" type="radio" {{ @$item_val->fight_number == @$data['carrierData']->airline_prefix ? 'checked' : '' }} name="airline_prefix_pm" required id="airline_code_{{ @$item_val->fight_number }}" value="{{ @$item_val->fight_number }}">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Add</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade bs-example-modal-lg" id="addSCAC" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Select Land & Carriers</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-centered table-nowrap table-hover mb-0">
                                                            <thead>
                                                                <tr>
                                                                    
                                                                    <th scope="col">Code</th>
                                                                    <th scope="" >Description</th>
                                                                    <th scope="col">Action</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    
                                                                    <td>
                                                                    IB0001234
                                                                    </td>
                                                                    <td>
                                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <a href="javascript:void(0);" class="me-3 text-primary" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" aria-label="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                                        <a href="javascript:void(0);" class="text-danger" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="mdi mdi-trash-can font-size-18"></i></a>
                                                                    </td>
                                                                    
                                                                </tr>
                                                                
                                                                
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary waves-effect waves-light">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane " id="rates" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="table-responsive fixhei">
                                
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-3">Rate lists
                                                        <button type="button" style="float: right;" data-bs-toggle="modal" data-bs-target=".bs-rate-modal-xl"
                                                            class="btn btn-primary btn-sm waves-effect waves-light">
                                                            <i class="fas fa-plus"></i> 
                                                            @if (empty(Session::has('carrier_rate_id')))
                                                                Add New
                                                            @else
                                                                Edit
                                                            @endif
                                                            
                                                        </button>
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
                                                                <th width="135" class="text-center">Actions</th>
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
                                                                        <td>
                                                                            <button type="reset"
                                                                                class="btn btn-danger btn-sm waves-effect"
                                                                                onclick="deleteRateGroundTabData({{ $row_val->id }});">
                                                                                <i class="fas fa-trash"></i> Delete
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                
                                                </div>
                                            </div>
                                        
                                        </div>
                                
                                        <div class="modal fade bs-rate-modal-xl" id="myModalRate" role="dialog" aria-labelledby="addcontactdetails" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addcontactdetails">Carrier Rate-Ground
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="conModalClsRate" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <ul class="nav nav-tabs nav-tabs-cus" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-bs-toggle="tab" href="#rgeneral" id="rgeneral_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                            <span class="d-none d-sm-block">General
                                                                            </span>    
                                                                        </a>
                                                                    </li>
                                                                    
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('carrier_rate_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#rpinfo" id="rpinfo_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Contract
                                                                            </span>    
                                                                        </a>
                                                                    </li>
                                          
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('carrier_rate_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#rnotes" id="rnotes_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Notes
                                
                                                                            </span>    
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                
                                                                <div class="tab-content p-3 text-muted">
                                
                                                                    <div class="tab-pane active" id="rgeneral" role="tabpanel">
                                                                        <form action="{{ route('createCarrierRateGround') }}" class="custom-validation" method="post"
                                                                            id="formValidatedRateGround">
                                                                            @csrf
                                                                            <div class="row row-border-bottom mt-3 mb-3">
                                                                                <div class="col-lg-4">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label class="form-label">Mode of Transportation</label>
                                                                                        <select class="form-control select2" name="transportation">
                                                                                            <option value="">Select</option>
                                                                                            <optgroup label="Description / Method / Code">
                                                                                                @if (!$data['transportation']->isEmpty())
                                                                                                    @foreach ($data['transportation'] as $key => $item_val_t)
                                                                                                        <option value="{{ @$item_val_t->id }}"
                                                                                                            {{ @$item_val_t->id == @$data['rateData']->transportation ? 'selected' : '' }}>
                                                                                                            {{ @$item_val_t->description." / ".@$item_val_t->method." / ".@$item_val_t->code }}</option>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </optgroup>
                                                                                            
                                                                                        </select>
                                                            
                                                                                    </div>
                                                                                    <div class="form-check mb-3 form-group">
                                                                                        <input class="form-check-input" type="checkbox" name="auto_charge" {{ '1' == @$data['rateData']->auto_charge ? 'checked' : '' }} value="1" id="invalidCheck">
                                                                                        <label class="form-check-label" for="invalidCheck">
                                                                                            Automatically create charge with this rate
                                                                                        </label>
                                                                                        <div class="invalid-feedback">
                                                                                            You must agree before submitting.
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label class="form-label">Freight Service Class</label>
                                                                                        <select class="form-control select2" name="freight_service_class">
                                                                                            <option value="">Select</option>
                                                                                            <optgroup label="Description / Code / Account Name">
                                                                                                @if (!$data['freight_service_class']->isEmpty())
                                                                                                    @foreach ($data['freight_service_class'] as $key => $item_val_t2)
                                                                                                        <option value="{{ @$item_val_t2->id }}"
                                                                                                            {{ @$item_val_t2->id == @$data['rateData']->freight_service_class ? 'selected' : '' }}>
                                                                                                            {{ @$item_val_t2->description." / ".@$item_val_t2->code." / ".@$item_val_t2->account_name }}</option>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </optgroup>
                                                                                            
                                                                                        </select>
                                                            
                                                                                    </div>
                                                                                    
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Carriers</label>
                                                                                        <select class="form-select select2" name="carrier" aria-label="Default select example">
                                                                                            <option value="">Select Carriers</option>
                                                                                            <option value="{{ @$data['carrierData']->id  }}" selected>{{ @$data['carrierData']->name." ".$data['title']  }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-2">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Currency</label>
                                                                                            <select id="currencyList" name="currency" class="form-select select2">
                                                                                                <option value="USD" {{ 'USD' == @$data['rateData']->currency ? 'selected' : '' }}>USD United States Dollar</option>
                                                                                                <option value="EUR" {{ 'EUR' == @$data['rateData']->currency ? 'selected' : '' }}>EUR Euro</option>
                                                                                                <option value="JPY" {{ 'JPY' == @$data['rateData']->currency ? 'selected' : '' }}>JPY Japanese Yen</option>
                                                                                                <option value="GBP" {{ 'GBP' == @$data['rateData']->currency ? 'selected' : '' }}>GBP British Pound</option>
                                                                                                <option disabled>──────────</option>
                                                                                                <option value="AED" {{ 'AED' == @$data['rateData']->currency ? 'selected' : '' }}>AED United Arab Emirates dirham</option>
                                                                                                <option value="AFN" {{ 'AFN' == @$data['rateData']->currency ? 'selected' : '' }}>AFN Afghan afghani</option>
                                                                                                <option value="ALL" {{ 'ALL' == @$data['rateData']->currency ? 'selected' : '' }}>ALL Albanian lek</option>
                                                                                                <option value="AMD" {{ 'AMD' == @$data['rateData']->currency ? 'selected' : '' }}>AMD Armenian dram</option>
                                                                                                <option value="ANG" {{ 'ANG' == @$data['rateData']->currency ? 'selected' : '' }}>ANG Netherlands Antillean guilder</option>
                                                                                                <option value="AOA" {{ 'AOA' == @$data['rateData']->currency ? 'selected' : '' }}>AOA Angolan kwanza</option>
                                                                                                <option value="ARS" {{ 'ARS' == @$data['rateData']->currency ? 'selected' : '' }}>ARS Argentine peso</option>
                                                                                                <option value="AUD" {{ 'AUD' == @$data['rateData']->currency ? 'selected' : '' }}>AUD Australian dollar</option>
                                                                                                <option value="AWG" {{ 'AWG' == @$data['rateData']->currency ? 'selected' : '' }}>AWG Aruban florin</option>
                                                                                                <option value="AZN" {{ 'AZN' == @$data['rateData']->currency ? 'selected' : '' }}>AZN Azerbaijani manat</option>
                                                                                                <option value="BAM" {{ 'BAM' == @$data['rateData']->currency ? 'selected' : '' }}>BAM Bosnia and Herzegovina convertible mark</option>
                                                                                                <option value="BBD" {{ 'BBD' == @$data['rateData']->currency ? 'selected' : '' }}>BBD Barbadian dollar</option>
                                                                                                <option value="BDT" {{ 'BDT' == @$data['rateData']->currency ? 'selected' : '' }}>BDT Bangladeshi taka</option>
                                                                                                <option value="BGN" {{ 'BGN' == @$data['rateData']->currency ? 'selected' : '' }}>BGN Bulgarian lev</option>
                                                                                                <option value="BHD" {{ 'BHD' == @$data['rateData']->currency ? 'selected' : '' }}>BHD Bahraini dinar</option>
                                                                                                <option value="BIF" {{ 'BIF' == @$data['rateData']->currency ? 'selected' : '' }}>BIF Burundian franc</option>
                                                                                                <option value="BMD" {{ 'BMD' == @$data['rateData']->currency ? 'selected' : '' }}>BMD Bermudian dollar</option>
                                                                                                <option value="BND" {{ 'BND' == @$data['rateData']->currency ? 'selected' : '' }}>BND Brunei dollar</option>
                                                                                                <option value="BOB" {{ 'BOB' == @$data['rateData']->currency ? 'selected' : '' }}>BOB Bolivian boliviano</option>
                                                                                                <option value="BRL" {{ 'BRL' == @$data['rateData']->currency ? 'selected' : '' }}>BRL Brazilian real</option>
                                                                                                <option value="BSD" {{ 'BSD' == @$data['rateData']->currency ? 'selected' : '' }}>BSD Bahamian dollar</option>
                                                                                                <option value="BTN" {{ 'BTN' == @$data['rateData']->currency ? 'selected' : '' }}>BTN Bhutanese ngultrum</option>
                                                                                                <option value="BWP" {{ 'BWP' == @$data['rateData']->currency ? 'selected' : '' }}>BWP Botswana pula</option>
                                                                                                <option value="BYN" {{ 'BYN' == @$data['rateData']->currency ? 'selected' : '' }}>BYN Belarusian ruble</option>
                                                                                                <option value="BZD" {{ 'BZD' == @$data['rateData']->currency ? 'selected' : '' }}>BZD Belize dollar</option>
                                                                                                <option value="CAD" {{ 'CAD' == @$data['rateData']->currency ? 'selected' : '' }}>CAD Canadian dollar</option>
                                                                                                <option value="CDF" {{ 'CDF' == @$data['rateData']->currency ? 'selected' : '' }}>CDF Congolese franc</option>
                                                                                                <option value="CHF" {{ 'CHF' == @$data['rateData']->currency ? 'selected' : '' }}>CHF Swiss franc</option>
                                                                                                <option value="CLP" {{ 'CLP' == @$data['rateData']->currency ? 'selected' : '' }}>CLP Chilean peso</option>
                                                                                                <option value="CNY" {{ 'CNY' == @$data['rateData']->currency ? 'selected' : '' }}>CNY Chinese yuan</option>
                                                                                                <option value="COP" {{ 'COP' == @$data['rateData']->currency ? 'selected' : '' }}>COP Colombian peso</option>
                                                                                                <option value="CRC" {{ 'CRC' == @$data['rateData']->currency ? 'selected' : '' }}>CRC Costa Rican colón</option>
                                                                                                <option value="CUC" {{ 'CUC' == @$data['rateData']->currency ? 'selected' : '' }}>CUC Cuban convertible peso</option>
                                                                                                <option value="CUP" {{ 'CUP' == @$data['rateData']->currency ? 'selected' : '' }}>CUP Cuban peso</option>
                                                                                                <option value="CVE" {{ 'CVE' == @$data['rateData']->currency ? 'selected' : '' }}>CVE Cape Verdean escudo</option>
                                                                                                <option value="CZK" {{ 'CZK' == @$data['rateData']->currency ? 'selected' : '' }}>CZK Czech koruna</option>
                                                                                                <option value="DJF" {{ 'DJF' == @$data['rateData']->currency ? 'selected' : '' }}>DJF Djiboutian franc</option>
                                                                                                <option value="DKK" {{ 'DKK' == @$data['rateData']->currency ? 'selected' : '' }}>DKK Danish krone</option>
                                                                                                <option value="DOP" {{ 'DOP' == @$data['rateData']->currency ? 'selected' : '' }}>DOP Dominican peso</option>
                                                                                                <option value="DZD" {{ 'DZD' == @$data['rateData']->currency ? 'selected' : '' }}>DZD Algerian dinar</option>
                                                                                                <option value="EGP" {{ 'EGP' == @$data['rateData']->currency ? 'selected' : '' }}>EGP Egyptian pound</option>
                                                                                                <option value="ERN" {{ 'ERN' == @$data['rateData']->currency ? 'selected' : '' }}>ERN Eritrean nakfa</option>
                                                                                                <option value="ETB" {{ 'ETB' == @$data['rateData']->currency ? 'selected' : '' }}>ETB Ethiopian birr</option>
                                                                                                <option value="EUR" {{ 'EUR' == @$data['rateData']->currency ? 'selected' : '' }}>EUR EURO</option>
                                                                                                <option value="FJD" {{ 'FJD' == @$data['rateData']->currency ? 'selected' : '' }}>FJD Fijian dollar</option>
                                                                                                <option value="FKP" {{ 'FKP' == @$data['rateData']->currency ? 'selected' : '' }}>FKP Falkland Islands pound</option>
                                                                                                <option value="GBP" {{ 'GBP' == @$data['rateData']->currency ? 'selected' : '' }}>GBP British pound</option>
                                                                                                <option value="GEL" {{ 'GEL' == @$data['rateData']->currency ? 'selected' : '' }}>GEL Georgian lari</option>
                                                                                                <option value="GGP" {{ 'GGP' == @$data['rateData']->currency ? 'selected' : '' }}>GGP Guernsey pound</option>
                                                                                                <option value="GHS" {{ 'GHS' == @$data['rateData']->currency ? 'selected' : '' }}>GHS Ghanaian cedi</option>
                                                                                                <option value="GIP" {{ 'GIP' == @$data['rateData']->currency ? 'selected' : '' }}>GIP Gibraltar pound</option>
                                                                                                <option value="GMD" {{ 'GMD' == @$data['rateData']->currency ? 'selected' : '' }}>GMD Gambian dalasi</option>
                                                                                                <option value="GNF" {{ 'GNF' == @$data['rateData']->currency ? 'selected' : '' }}>GNF Guinean franc</option>
                                                                                                <option value="GTQ" {{ 'GTQ' == @$data['rateData']->currency ? 'selected' : '' }}>GTQ Guatemalan quetzal</option>
                                                                                                <option value="GYD" {{ 'GYD' == @$data['rateData']->currency ? 'selected' : '' }}>GYD Guyanese dollar</option>
                                                                                                <option value="HKD" {{ 'HKD' == @$data['rateData']->currency ? 'selected' : '' }}>HKD Hong Kong dollar</option>
                                                                                                <option value="HNL" {{ 'HNL' == @$data['rateData']->currency ? 'selected' : '' }}>HNL Honduran lempira</option>
                                                                                                <option value="HRK" {{ 'HRK' == @$data['rateData']->currency ? 'selected' : '' }}>HRK Croatian kuna</option>
                                                                                                <option value="HTG" {{ 'HTG' == @$data['rateData']->currency ? 'selected' : '' }}>HTG Haitian gourde</option>
                                                                                                <option value="HUF" {{ 'HUF' == @$data['rateData']->currency ? 'selected' : '' }}>HUF Hungarian forint</option>
                                                                                                <option value="IDR" {{ 'IDR' == @$data['rateData']->currency ? 'selected' : '' }}>IDR Indonesian rupiah</option>
                                                                                                <option value="ILS" {{ 'ILS' == @$data['rateData']->currency ? 'selected' : '' }}>ILS Israeli new shekel</option>
                                                                                                <option value="IMP" {{ 'IMP' == @$data['rateData']->currency ? 'selected' : '' }}>IMP Manx pound</option>
                                                                                                <option value="INR" {{ 'INR' == @$data['rateData']->currency ? 'selected' : '' }}>INR Indian rupee</option>
                                                                                                <option value="IQD" {{ 'IQD' == @$data['rateData']->currency ? 'selected' : '' }}>IQD Iraqi dinar</option>
                                                                                                <option value="IRR" {{ 'IRR' == @$data['rateData']->currency ? 'selected' : '' }}>IRR Iranian rial</option>
                                                                                                <option value="ISK" {{ 'ISK' == @$data['rateData']->currency ? 'selected' : '' }}>ISK Icelandic króna</option>
                                                                                                <option value="JEP" {{ 'JEP' == @$data['rateData']->currency ? 'selected' : '' }}>JEP Jersey pound</option>
                                                                                                <option value="JMD" {{ 'JMD' == @$data['rateData']->currency ? 'selected' : '' }}>JMD Jamaican dollar</option>
                                                                                                <option value="JOD" {{ 'JOD' == @$data['rateData']->currency ? 'selected' : '' }}>JOD Jordanian dinar</option>
                                                                                                <option value="JPY" {{ 'JPY' == @$data['rateData']->currency ? 'selected' : '' }}>JPY Japanese yen</option>
                                                                                                <option value="KES" {{ 'KES' == @$data['rateData']->currency ? 'selected' : '' }}>KES Kenyan shilling</option>
                                                                                                <option value="KGS" {{ 'KGS' == @$data['rateData']->currency ? 'selected' : '' }}>KGS Kyrgyzstani som</option>
                                                                                                <option value="KHR" {{ 'KHR' == @$data['rateData']->currency ? 'selected' : '' }}>KHR Cambodian riel</option>
                                                                                                <option value="KID" {{ 'KID' == @$data['rateData']->currency ? 'selected' : '' }}>KID Kiribati dollar</option>
                                                                                                <option value="KMF" {{ 'KMF' == @$data['rateData']->currency ? 'selected' : '' }}>KMF Comorian franc</option>
                                                                                                <option value="KPW" {{ 'KPW' == @$data['rateData']->currency ? 'selected' : '' }}>KPW North Korean won</option>
                                                                                                <option value="KRW" {{ 'KRW' == @$data['rateData']->currency ? 'selected' : '' }}>KRW South Korean won</option>
                                                                                                <option value="KWD" {{ 'KWD' == @$data['rateData']->currency ? 'selected' : '' }}>KWD Kuwaiti dinar</option>
                                                                                                <option value="KYD" {{ 'KYD' == @$data['rateData']->currency ? 'selected' : '' }}>KYD Cayman Islands dollar</option>
                                                                                                <option value="KZT" {{ 'KZT' == @$data['rateData']->currency ? 'selected' : '' }}>KZT Kazakhstani tenge</option>
                                                                                                <option value="LAK" {{ 'LAK' == @$data['rateData']->currency ? 'selected' : '' }}>LAK Lao kip</option>
                                                                                                <option value="LBP" {{ 'LBP' == @$data['rateData']->currency ? 'selected' : '' }}>LBP Lebanese pound</option>
                                                                                                <option value="LKR" {{ 'LKR' == @$data['rateData']->currency ? 'selected' : '' }}>LKR Sri Lankan rupee</option>
                                                                                                <option value="LRD" {{ 'LRD' == @$data['rateData']->currency ? 'selected' : '' }}>LRD Liberian dollar</option>
                                                                                                <option value="LSL" {{ 'LSL' == @$data['rateData']->currency ? 'selected' : '' }}>LSL Lesotho loti</option>
                                                                                                <option value="LYD" {{ 'LYD' == @$data['rateData']->currency ? 'selected' : '' }}>LYD Libyan dinar</option>
                                                                                                <option value="MAD" {{ 'MAD' == @$data['rateData']->currency ? 'selected' : '' }}>MAD Moroccan dirham</option>
                                                                                                <option value="MDL" {{ 'MDL' == @$data['rateData']->currency ? 'selected' : '' }}>MDL Moldovan leu</option>
                                                                                                <option value="MGA" {{ 'MGA' == @$data['rateData']->currency ? 'selected' : '' }}>MGA Malagasy ariary</option>
                                                                                                <option value="MKD" {{ 'MKD' == @$data['rateData']->currency ? 'selected' : '' }}>MKD Macedonian denar</option>
                                                                                                <option value="MMK" {{ 'MMK' == @$data['rateData']->currency ? 'selected' : '' }}>MMK Burmese kyat</option>
                                                                                                <option value="MNT" {{ 'MNT' == @$data['rateData']->currency ? 'selected' : '' }}>MNT Mongolian tögrög</option>
                                                                                                <option value="MOP" {{ 'MOP' == @$data['rateData']->currency ? 'selected' : '' }}>MOP Macanese pataca</option>
                                                                                                <option value="MRU" {{ 'MRU' == @$data['rateData']->currency ? 'selected' : '' }}>MRU Mauritanian ouguiya</option>
                                                                                                <option value="MUR" {{ 'MUR' == @$data['rateData']->currency ? 'selected' : '' }}>MUR Mauritian rupee</option>
                                                                                                <option value="MVR" {{ 'MVR' == @$data['rateData']->currency ? 'selected' : '' }}>MVR Maldivian rufiyaa</option>
                                                                                                <option value="MWK" {{ 'MWK' == @$data['rateData']->currency ? 'selected' : '' }}>MWK Malawian kwacha</option>
                                                                                                <option value="MXN" {{ 'MXN' == @$data['rateData']->currency ? 'selected' : '' }}>MXN Mexican peso</option>
                                                                                                <option value="MYR" {{ 'MYR' == @$data['rateData']->currency ? 'selected' : '' }}>MYR Malaysian ringgit</option>
                                                                                                <option value="MZN" {{ 'MZN' == @$data['rateData']->currency ? 'selected' : '' }}>MZN Mozambican metical</option>
                                                                                                <option value="NAD" {{ 'NAD' == @$data['rateData']->currency ? 'selected' : '' }}>NAD Namibian dollar</option>
                                                                                                <option value="NGN" {{ 'NGN' == @$data['rateData']->currency ? 'selected' : '' }}>NGN Nigerian naira</option>
                                                                                                <option value="NIO" {{ 'NIO' == @$data['rateData']->currency ? 'selected' : '' }}>NIO Nicaraguan córdoba</option>
                                                                                                <option value="NOK" {{ 'NOK' == @$data['rateData']->currency ? 'selected' : '' }}>NOK Norwegian krone</option>
                                                                                                <option value="NPR" {{ 'NPR' == @$data['rateData']->currency ? 'selected' : '' }}>NPR Nepalese rupee</option>
                                                                                                <option value="NZD" {{ 'NZD' == @$data['rateData']->currency ? 'selected' : '' }}>NZD New Zealand dollar</option>
                                                                                                <option value="OMR" {{ 'OMR' == @$data['rateData']->currency ? 'selected' : '' }}>OMR Omani rial</option>
                                                                                                <option value="PAB" {{ 'PAB' == @$data['rateData']->currency ? 'selected' : '' }}>PAB Panamanian balboa</option>
                                                                                                <option value="PEN" {{ 'PEN' == @$data['rateData']->currency ? 'selected' : '' }}>PEN Peruvian sol</option>
                                                                                                <option value="PGK" {{ 'PGK' == @$data['rateData']->currency ? 'selected' : '' }}>PGK Papua New Guinean kina</option>
                                                                                                <option value="PHP" {{ 'PHP' == @$data['rateData']->currency ? 'selected' : '' }}>PHP Philippine peso</option>
                                                                                                <option value="PKR" {{ 'PKR' == @$data['rateData']->currency ? 'selected' : '' }}>PKR Pakistani rupee</option>
                                                                                                <option value="PLN" {{ 'PLN' == @$data['rateData']->currency ? 'selected' : '' }}>PLN Polish złoty</option>
                                                                                                <option value="PRB" {{ 'PRB' == @$data['rateData']->currency ? 'selected' : '' }}>PRB Transnistrian ruble</option>
                                                                                                <option value="PYG" {{ 'PYG' == @$data['rateData']->currency ? 'selected' : '' }}>PYG Paraguayan guaraní</option>
                                                                                                <option value="QAR" {{ 'QAR' == @$data['rateData']->currency ? 'selected' : '' }}>QAR Qatari riyal</option>
                                                                                                <option value="RON" {{ 'RON' == @$data['rateData']->currency ? 'selected' : '' }}>RON Romanian leu</option>
                                                                                                <option value="RSD" {{ 'RSD' == @$data['rateData']->currency ? 'selected' : '' }}>RSD Serbian dinar</option>
                                                                                                <option value="RUB" {{ 'RUB' == @$data['rateData']->currency ? 'selected' : '' }}>RUB Russian ruble</option>
                                                                                                <option value="RWF" {{ 'RWF' == @$data['rateData']->currency ? 'selected' : '' }}>RWF Rwandan franc</option>
                                                                                                <option value="SAR" {{ 'SAR' == @$data['rateData']->currency ? 'selected' : '' }}>SAR Saudi riyal</option>
                                                                                                <option value="SEK" {{ 'SEK' == @$data['rateData']->currency ? 'selected' : '' }}>SEK Swedish krona</option>
                                                                                                <option value="SGD" {{ 'SGD' == @$data['rateData']->currency ? 'selected' : '' }}>SGD Singapore dollar</option>
                                                                                                <option value="SHP" {{ 'SHP' == @$data['rateData']->currency ? 'selected' : '' }}>SHP Saint Helena pound</option>
                                                                                                <option value="SLL" {{ 'SLL' == @$data['rateData']->currency ? 'selected' : '' }}>SLL Sierra Leonean leone</option>
                                                                                                <option value="SLS" {{ 'SLS' == @$data['rateData']->currency ? 'selected' : '' }}>SLS Somaliland shilling</option>
                                                                                                <option value="SOS" {{ 'SOS' == @$data['rateData']->currency ? 'selected' : '' }}>SOS Somali shilling</option>
                                                                                                <option value="SRD" {{ 'SRD' == @$data['rateData']->currency ? 'selected' : '' }}>SRD Surinamese dollar</option>
                                                                                                <option value="SSP" {{ 'SSP' == @$data['rateData']->currency ? 'selected' : '' }}>SSP South Sudanese pound</option>
                                                                                                <option value="STN" {{ 'STN' == @$data['rateData']->currency ? 'selected' : '' }}>STN São Tomé and Príncipe dobra</option>
                                                                                                <option value="SYP" {{ 'SYP' == @$data['rateData']->currency ? 'selected' : '' }}>SYP Syrian pound</option>
                                                                                                <option value="SZL" {{ 'SZL' == @$data['rateData']->currency ? 'selected' : '' }}>SZL Swazi lilangeni</option>
                                                                                                <option value="THB" {{ 'THB' == @$data['rateData']->currency ? 'selected' : '' }}>THB Thai baht</option>
                                                                                                <option value="TJS" {{ 'TJS' == @$data['rateData']->currency ? 'selected' : '' }}>TJS Tajikistani somoni</option>
                                                                                                <option value="TMT" {{ 'TMT' == @$data['rateData']->currency ? 'selected' : '' }}>TMT Turkmenistan manat</option>
                                                                                                <option value="TND" {{ 'TND' == @$data['rateData']->currency ? 'selected' : '' }}>TND Tunisian dinar</option>
                                                                                                <option value="TOP" {{ 'TOP' == @$data['rateData']->currency ? 'selected' : '' }}>TOP Tongan paʻanga</option>
                                                                                                <option value="TRY" {{ 'TRY' == @$data['rateData']->currency ? 'selected' : '' }}>TRY Turkish lira</option>
                                                                                                <option value="TTD" {{ 'TTD' == @$data['rateData']->currency ? 'selected' : '' }}>TTD Trinidad and Tobago dollar</option>
                                                                                                <option value="TVD" {{ 'TVD' == @$data['rateData']->currency ? 'selected' : '' }}>TVD Tuvaluan dollar</option>
                                                                                                <option value="TWD" {{ 'TWD' == @$data['rateData']->currency ? 'selected' : '' }}>TWD New Taiwan dollar</option>
                                                                                                <option value="TZS" {{ 'TZS' == @$data['rateData']->currency ? 'selected' : '' }}>TZS Tanzanian shilling</option>
                                                                                                <option value="UAH" {{ 'UAH' == @$data['rateData']->currency ? 'selected' : '' }}>UAH Ukrainian hryvnia</option>
                                                                                                <option value="UGX" {{ 'UGX' == @$data['rateData']->currency ? 'selected' : '' }}>UGX Ugandan shilling</option>
                                                                                                <option value="USD" {{ 'USD' == @$data['rateData']->currency ? 'selected' : '' }}>USD United States dollar</option>
                                                                                                <option value="UYU" {{ 'UYU' == @$data['rateData']->currency ? 'selected' : '' }}>UYU Uruguayan peso</option>
                                                                                                <option value="UZS" {{ 'UZS' == @$data['rateData']->currency ? 'selected' : '' }}>UZS Uzbekistani soʻm</option>
                                                                                                <option value="VES" {{ 'VES' == @$data['rateData']->currency ? 'selected' : '' }}>VES Venezuelan bolívar soberano</option>
                                                                                                <option value="VND" {{ 'VND' == @$data['rateData']->currency ? 'selected' : '' }}>VND Vietnamese đồng</option>
                                                                                                <option value="VUV" {{ 'VUV' == @$data['rateData']->currency ? 'selected' : '' }}>VUV Vanuatu vatu</option>
                                                                                                <option value="WST" {{ 'WST' == @$data['rateData']->currency ? 'selected' : '' }}>WST Samoan tālā</option>
                                                                                                <option value="XAF" {{ 'XAF' == @$data['rateData']->currency ? 'selected' : '' }}>XAF Central African CFA franc</option>
                                                                                                <option value="XCD" {{ 'XCD' == @$data['rateData']->currency ? 'selected' : '' }}>XCD Eastern Caribbean dollar</option>
                                                                                                <option value="XOF" {{ 'XOF' == @$data['rateData']->currency ? 'selected' : '' }}>XOF West African CFA franc</option>
                                                                                                <option value="XPF" {{ 'XPF' == @$data['rateData']->currency ? 'selected' : '' }}>XPF CFP franc</option>
                                                                                                <option value="ZAR" {{ 'ZAR' == @$data['rateData']->currency ? 'selected' : '' }}>ZAR South African rand</option>
                                                                                                <option value="ZMW" {{ 'ZMW' == @$data['rateData']->currency ? 'selected' : '' }}>ZMW Zambian kwacha</option>
                                                                                                <option value="ZWB" {{ 'ZWB' == @$data['rateData']->currency ? 'selected' : '' }}>ZWB Zimbabwean bonds</option>
                                                                                            </select>
                                                            
                                                                                    </div>
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Frequency</label>
                                                                                        <select class="form-select select2" name="carrier_frequency" aria-label="Default select example">
                                                                                            <option selected="">Select</option>
                                                                                                @if (!$data['carrier_frequency']->isEmpty())
                                                                                                    @foreach ($data['carrier_frequency'] as $key => $item_val_t3)
                                                                                                        <option value="{{ @$item_val_t3->name }}"
                                                                                                            {{ @$item_val_t3->name == @$data['rateData']->carrier_frequency ? 'selected' : '' }}>
                                                                                                            {{ @$item_val_t3->name }}</option>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                        </select>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label for="validationCustom05" class="form-label">Transit Time(Days)</label>
                                                                                        <input type="text" class="form-control" id="validationCustom05" name="transit_time" placeholder="0" value="{{ @$data['rateData']->transit_time }}">
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                            
                                                                            <div class="row row-border-bottom mt-4 mb-3">
                                                                                <div class="col-lg-6 form-group">
                                                                                    <label class="form-check-label" style="margin-right: 37px;" for="invalidCheck1">
                                                                                        <b>Origin:</b>
                                                                                    </label>
                                                                                    <div class="form-check mb-3 ml-3" style="display: inline-block;">
                                                                                        
                                                                                        <input class="form-check-input" name="origin_apply_to_country" type="checkbox" {{ '1' == @$data['rateData']->origin_apply_to_country ? 'checked' : '' }} value="1" id="invalidCheck15">
                                                                                        <label class="form-check-label" for="invalidCheck15">
                                                                                            Apply to country
                                                                                        </label>
                                                                                        
                                                                                    </div>
                                                            
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Port of landing</label>
                                                                                        <select class="form-select select2" name="port_of_landing" aria-label="Default select example">
                                                                                            <option value="" selected="">Select Port...</option>
                                                                                            @if (!$data['ports']->isEmpty())
                                                                                                @foreach ($data['ports'] as $key => $item_val_1)
                                                                                                    <option value="{{ @$item_val_1->name }}"
                                                                                                        {{ @$item_val_1->name == @$data['rateData']->port_of_landing ? 'selected' : '' }}>
                                                                                                        {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                            </select>
                                                            
                                                                                    </div>
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Country</label>
                                                                                        <select class="form-select select2" name="port_of_landing_country" aria-label="Default select example">
                                                                                            <option value="" selected="">Select Country</option>
                                                                                            @if (!$data['countries']->isEmpty())
                                                                                                @foreach ($data['countries'] as $key => $item_val)
                                                                                                    <option value="{{ @$item_val->name }}"
                                                                                                        {{ @$item_val->name == @$data['rateData']->port_of_landing_country ? 'selected' : '' }}>
                                                                                                        {{ @$item_val->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                            </select>
                                                            
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 form-group">
                                                                                    <label class="form-check-label" style="margin-right: 37px;" for="invalidCheck1">
                                                                                        <b>Destination:</b>
                                                                                    </label>
                                                                                    <div class="form-check mb-3" style="display: inline-block;">
                                                                                        <input class="form-check-input" type="checkbox" name="destination_apply_to_country" {{ '1' == @$data['rateData']->destination_apply_to_country ? 'checked' : '' }} value="1" id="invalidCheck2">
                                                                                        <label class="form-check-label" for="invalidCheck2">
                                                                                            Apply to country
                                                                                        </label>
                                                                                        
                                                                                    </div>
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Port of unlanding</label>
                                                                                        <select class="form-select select2" name="port_of_unlanding" aria-label="Default select example">
                                                                                            <option value="">Select Port...</option>
                                                                                            @if (!$data['ports']->isEmpty())
                                                                                                @foreach ($data['ports'] as $key => $item_val_1)
                                                                                                    <option value="{{ @$item_val_1->name }}"
                                                                                                        {{ @$item_val_1->name == @$data['rateData']->port_of_unlanding ? 'selected' : '' }}>
                                                                                                        {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                            </select>
                                                            
                                                                                    </div>
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Country</label>
                                                                                        <select class="form-select select2" name="port_of_unlanding_country" aria-label="Default select example">
                                                                                            <option value="" selected="">Select Country</option>
                                                                                            @if (!$data['countries']->isEmpty())
                                                                                                @foreach ($data['countries'] as $key => $item_val)
                                                                                                    <option value="{{ @$item_val->name }}"
                                                                                                        {{ @$item_val->name == @$data['rateData']->port_of_unlanding_country ? 'selected' : '' }}>
                                                                                                        {{ @$item_val->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                            </select>
                                                            
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                            
                                                                            <div class="row row-border-bottom mt-4 mb-3">
                                                                                <div class="col-lg-8">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-6">
                                                                                            <div class="mb-3 form-group">
                                                                                                <label>Apply By</label>
                                                                                                <div class="mb-3 form-group">
                                                                                                    <select class="form-select mb-3 select2" name="apply_by" aria-label="Default select example">
                                                                                                        <option selected="">Select Here</option>
                                                                                                        <option value="Weight" {{ 'Weight' == @$data['rateData']->apply_by ? 'selected' : '' }}>Weight</option>
                                                                                                        <option value="Pieces" {{ 'Pieces' == @$data['rateData']->apply_by ? 'selected' : '' }}>Pieces</option>
                                                                                                        <option value="Volume" {{ 'Volume' == @$data['rateData']->apply_by ? 'selected' : '' }}>Volume</option>
                                                                                                        <option value="Container" {{ 'Container' == @$data['rateData']->apply_by ? 'selected' : '' }}>Container</option>
                                                                                                        <option value="Calculated Amount" {{ 'Calculated Amount' == @$data['rateData']->apply_by ? 'selected' : '' }}>Calculated Amount</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <div class="mb-3 form-group">
                                                                                                <label>&nbsp;</label>
                                                                                                <select class="form-select select2" name="apply_by_measurement" aria-label="Default select example">
                                                                                                    <option value="">Select Here</option>
                                                                                                    <option value="Kilogram(kg)" {{ 'Kilogram(kg)' == @$data['rateData']->apply_by_measurement ? 'selected' : '' }}>Kilogram(kg)</option>
                                                                                                    <option value="Gram(g)" {{ 'Gram(g)' == @$data['rateData']->apply_by_measurement ? 'selected' : '' }}>Gram(g)</option>
                                                                                                    <option value="Ton(t)" {{ 'Ton(t)' == @$data['rateData']->apply_by_measurement ? 'selected' : '' }}>Ton(t)</option>
                                                                                                    <option value="Pound(lb)" {{ 'Pound(lb)' == @$data['rateData']->apply_by_measurement ? 'selected' : '' }}>Pound(lb)</option>
                                                                                                    <option value="Ounce(oz)" {{ 'Ounce(oz)' == @$data['rateData']->apply_by_measurement ? 'selected' : '' }}>Ounce(oz)</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                    <div class="form-check mb-3 form-group">
                                                                                        <input class="form-check-input" type="checkbox" name="use_gross_weight" {{ '1' == @$data['rateData']->use_gross_weight ? 'checked' : '' }} value="1" id="invalidCheck78">
                                                                                        <label class="form-check-label" for="invalidCheck78">
                                                                                            Use gross weight instead of chargable weight.
                                                                                        </label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-4">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Description/Commodity</label>
                                                                                        <select class="form-select mb-3 select2" name="carrier_commodity" aria-label="Default select example">
                                                                                            <option selected="">Select...</option>
                                                                                                @if (!$data['carrier_commodity']->isEmpty())
                                                                                                    @foreach ($data['carrier_commodity'] as $key => $item_val_t4)
                                                                                                        <option value="{{ @$item_val_t4->name }}"
                                                                                                            {{ @$item_val_t4->name == @$data['rateData']->carrier_commodity ? 'selected' : '' }}>
                                                                                                            {{ @$item_val_t4->name }}</option>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-check mb-3 form-group">
                                                                                        <input class="form-check-input" type="checkbox" name="hazadours" {{ '1' == @$data['rateData']->hazadours ? 'checked' : '' }} value="1" id="invalidCheck2257">
                                                                                        <label class="form-check-label" for="invalidCheck2257">
                                                                                            Hazadours
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                            
                                                                            <div class="row row-border-bottom mt-3 mb-3">
                                                                                <div class="col-lg-2">
                                                                                    
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Minimum</label>
                                                                                        <input type="text" class="form-control" name="minimum" id="validationCustom05" value="{{ @$data['rateData']->minimum }}" placeholder="0.00">
                                                            
                                                                                    </div>
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Rate Per</label>
                                                                                        <select class="form-select mb-3 select2" name="rate_per" aria-label="Default select example">
                                                                                            <option selected="">Select Here</option>
                                                                                            <option value="Unit" {{ 'Unit' == @$data['rateData']->rate_per ? 'selected' : '' }}>Unit</option>
                                                                                            <option value="Range" {{ 'Range' == @$data['rateData']->rate_per ? 'selected' : '' }}>Range</option>
                                                                                        </select>
                                                            
                                                                                    </div>
                                                                                </div>
                                                            
                                                                                <div class="col-lg-2">
                                                                                    
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Maximum</label>
                                                                                        <input type="text" class="form-control" name="maximum" id="maximum" value="{{ @$data['rateData']->maximum }}" placeholder="0.00">
                                                            
                                                                                    </div>
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>lb</label>
                                                                                        <input type="text" class="form-control" name="rate_val" id="rate_val" value="{{ @$data['rateData']->rate_val }}" placeholder="1.00">
                                                            
                                                                                    </div>
                                                                                </div>
                                                            
                                                                                <div class="col-lg-8 form-group">
                                                                                    {{-- <a href="javascript:void(0);" style="float: right;" id="AddRateId" class="me-3 text-primary" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Add" aria-label="Add"><i class="mdi mdi-plus font-size-18"></i> Add New</a> --}}
                                                                                    <div class="table-responsive" id="rateHTMLCal">
                                                                                        <table class="table table-centered table-nowrap table-border table-hover mb-0">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    
                                                                                                    <th scope="col">More Than</th>
                                                                                                    <th scope="">Rate</th>
                                                                                                    <th scope="col"></th>
                                                                                                    
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    
                                                                                                    <td>
                                                                                                        <h5 class="font-size-16">
                                                                                                            <input class="form-control" type="text" name="more_than" value="{{ @$data['rateData']->more_than ? @$data['rateData']->more_than : '1.00' }}"> 
                                                                                                        </h5>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <input class="form-control" type="text" name="rateP" value="{{ @$data['rateData']->rateP ? @$data['rateData']->rateP : '0.0000' }}">
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        {{-- <a href="javascript:void(0);" class="me-3 text-primary" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" aria-label="Edit"><i class="mdi mdi-pencil font-size-18"></i></a> --}}
                                                                                                        {{-- <a href="javascript:void(0);" class="text-danger" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="mdi mdi-trash-can font-size-18"></i></a> --}}
                                                                                                    </td>
                                                                                                </tr>

                                                                                                
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="text-align: center;">
                                                            
                                                                                <button class="btn btn-primary" type="submit" name="submit" value="rateGround">Submit</button>
                                                                            </div>
                                
                                                                        </form>
                                                                    </div>
                                
                                                                    <div class="tab-pane " id="rpinfo" role="tabpanel">
                                                                        <form action="{{ route('updateCarrierRateContract') }}" class="custom-validation"
                                                                            method="post" id="formValidatedBillingAddress2ndTab_3">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Effect Date
                                                                                        </label>
                                                                                        <input type="date" class="form-control" name="effect_date" required="" placeholder="" value="{{ @$data['rateData']->effect_date }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Expiration Date
                                                                                        </label>
                                                                                        <input type="date" class="form-control" name="expiratin_date" required="" placeholder="" value="{{ @$data['rateData']->expiratin_date }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Contract Number
                                                                                        </label>
                                                                                        <input type="text" class="form-control" name="contract_number" required="" placeholder="" value="{{ @$data['rateData']->contract_number }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Amendment Number
                                                                                        </label>
                                                                                        <input type="text" class="form-control" name="amendment_number" required="" placeholder="" value="{{ @$data['rateData']->amendment_number }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-0 float-end">
                                                                                <div>
                                                                                    <button type="submit" name="submit" value="saveDOB" class="btn btn-primary waves-effect waves-light me-1">
                                                                                        Save
                                                                                    </button>

                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    
                                                                    <div class="tab-pane " id="rnotes" role="tabpanel">
                                                                        <div class="rates_main">
                                                                            <form action="{{ route('create-rate-notes') }}" class="form-horizontal form" method="post" id="formValidatedBillingAddress2ndTab_4">
                                                                                @csrf
                                                                                <div class="row row-border-bottom mt-3 mb-3">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="mb-3">
                                                                                            <label>Write Note Here</label>
                                                                                            <div>
                                                                                                <textarea required="" name="rate_notes" class="form-control" rows="5">{{ @$data['rateData']->rate_notes }}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="mb-3 form-group">
                                                                                            <label>Is Rate Tab Completed</label>
                                                                                            <div class="form-group">
                                                                                                <div class="form-check form-check-inline">
                                                                                                    <input class="form-check-input" type="radio" name="completed_status" id="inlineRadio1cc" value="1">
                                                                                                <label class="form-check-label" for="inlineRadio1cc">Completed</label>
                                                                                                </div>
                                                                                                <div class="form-check form-check-inline">
                                                                                                    <input class="form-check-input" type="radio" name="completed_status" id="inlineRadio2cc" value="0" checked="">
                                                                                                <label class="form-check-label" for="inlineRadio2cc">Not Completed</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <div>
                                                                                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                                                                    Submit
                                                                                                </button>
                                                                                                
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="charges" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-3">Charge lists
                                                    <button type="button" style="float: right;" data-bs-toggle="modal" data-bs-target=".bs-charge-modal-xl"
                                                        class="btn btn-primary btn-sm waves-effect waves-light">
                                                        <i class="fas fa-plus"></i> 
                                                        @if (empty(Session::has('carrier_charge_id')))
                                                            Add New
                                                        @else
                                                            Edit
                                                        @endif
                                                        
                                                    </button>
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
                                                            <th width="135" class="text-center">Actions</th>
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
                                                                    
                                                                    <td>
                                                                        <button type="reset"
                                                                            class="btn btn-danger btn-sm waves-effect"
                                                                            onclick="deleteChargeTabData({{ $row_val->id }});">
                                                                            <i class="fas fa-trash"></i> Delete
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                        
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                        
                                            </div>

                                            <div class="modal fade bs-charge-modal-xl" id="myModalCharge" role="dialog" aria-labelledby="addcontactdetails" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addcontactdetails">Custom Charge
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="conModalClsCharge" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <ul class="nav nav-tabs nav-tabs-cus" role="tablist">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" data-bs-toggle="tab" href="#chgeneral" id="chgeneral_nav" role="tab" aria-selected="false">
                                                                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                                <span class="d-none d-sm-block">Custom Charge
                                                                                </span>    
                                                                            </a>
                                                                        </li>
                                                                        
                                                                        <li class="nav-item">
                                                                            <a {{ Session::has('carrier_charge_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#chinfo" id="chinfo_nav" role="tab" aria-selected="false">
                                                                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                                <span class="d-none d-sm-block">Automatic Creation
                                                                                </span>    
                                                                            </a>
                                                                        </li>
                                            
                                                                    </ul>
                                            
                                                                    <div class="tab-content p-3 text-muted">
                                            
                                                                        <div class="tab-pane active" id="chgeneral" role="tabpanel">
                                                                            <form action="{{ route('createCarrierCustomCharge') }}" class="custom-validation" method="post"
                                                                                id="formValidatedCharge">
                                                                                @csrf
                                                                                <div class="row row-border-bottom mt-0 mb-3">
                                                                                    <div class="col-lg-8">
                                                                                        <div class="mb-3 form-group">
                                                                                            <label class="form-label">Charge</label>
                                                                                            <select class="form-control select2" name="charge_id">
                                                                                                <option value="">Select</option>
                                                                                                <optgroup label="Description / Method / Code">
                                                                                                    @if (!$data['charge_list']->isEmpty())
                                                                                                        @foreach ($data['charge_list'] as $key => $item_val_ch)
                                                                                                            <option value="{{ @$item_val_ch->id }}"
                                                                                                                {{ @$item_val_ch->id == @$data['chargeData']->charge_id ? 'selected' : '' }}>
                                                                                                                {{ @$item_val_ch->description." / ".@$item_val_ch->account_name." / ".@$item_val_ch->code }}</option>
                                                                                                        @endforeach
                                                                                                    @endif
                                                                                                </optgroup>
                                                                                                
                                                                                            </select>
                                                                
                                                                                        </div>
                                                                                        
                                                                                    </div>

                                                                                    
                                                                                </div>


                                                                                <div class="row row-border-bottom mt-3 mb-3">
                                                                                    <div class="col-lg-8">
                                                                                        <div class="mb-3 form-group">
                                                                                            <label class="form-label">Price</label>
                                                                                            <div class="input-group mb-3">
                                                                                                <span class="input-group-text" id="basic-addon1">USD</span>
                                                                                                <input type="text" class="form-control" placeholder="0.00" name="charge_price" value="{{ @$data['chargeData']->price }}" aria-label="Username" aria-describedby="basic-addon1">
                                                                                              </div>
                                                                
                                                                                        </div>
                                                                                        
                                                                                    </div>

                                                                                    
                                                                                </div>

                                                                                <div class="row row-border-bottom mt-3 mb-3">
                                                                                    <div class="col-lg-8">
                                                                                        <div class="mb-3 form-group">
                                                                                            <label class="form-label">Vendor</label>
                                                                                            <select class="form-control select2" name="vendor">
                                                                                                <option value="">Select...</option>
                                                                                                
                                                                                            </select>
                                                                
                                                                                        </div>
                                                                                        
                                                                                    </div>

                                                                                    
                                                                                </div>
                                                                
                                                                                <div class="row row-border-bottom mt-4 mb-3">
                                                                                    <div class="col-lg-8 form-group">
                                                                                        <div class="form-check mb-3 ml-3" style="display: inline-block;">
                                                                                            
                                                                                            <input class="form-check-input" name="show_in_documents" type="checkbox" {{ '1' == @$data['chargeData']->show_in_documents ? 'checked' : '' }} value="1" id="invalidCheckCharge">
                                                                                            <label class="form-check-label" for="invalidCheckCharge">
                                                                                                Don not show in documents
                                                                                            </label>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-8 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="other_charge" {{ '1' == @$data['chargeData']->other_charge ? 'checked' : '' }} value="1" id="invalidCheckCharge2">
                                                                                            <label class="form-check-label" for="invalidCheckCharge2">
                                                                                                The price for this charge depends on other charges in the transaction
                                                                                            </label>
                                                                                            
                                                                                        </div>
                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                
                                                                                
                                                                                <div style="text-align: center;">
                                                                
                                                                                    <button class="btn btn-primary" type="submit" name="submit" value="customCharge">Submit</button>
                                                                                </div>
                                            
                                                                            </form>
                                                                        </div>
                                            
                                                                        <div class="tab-pane " id="chinfo" role="tabpanel">
                                                                            <form action="{{ route('createCustomChargeAutoCreation') }}" class="custom-validation" method="post"
                                                                                id="formValidatedChargeCreation">
                                                                                @csrf
                                                                                <div class="row mt-0 mb-0">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="mb-0 form-group">
                                                                                            <label class="form-label" style="width: 100%;"><b>Enable Automatic Creation</b> <hr></label>
                                                                                        </div>  
                                                                                    </div>
                                                                                </div>
                                                                                @php
                                                                                    $autoCreationArray = [];

                                                                                    $carrier_charge_id = Session::get('carrier_charge_id');

                                                                                    if(!empty($carrier_charge_id)) {
                                                                                        $carrier_auto_creation = DB::table('carrier_auto_creation')->where('charge_id', @$carrier_charge_id)->orderBy('id', 'desc')->get();

                                                                                        if(!empty($carrier_auto_creation)) {
                                                                                            foreach ($carrier_auto_creation as $key => $value) {
                                                                                                $autoCreationArray[] = $value->auto_creation;
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    
                                                                                @endphp

                                                                                <div class="row mt-0 mb-0">
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3 ml-3" style="display: inline-block;">
                                                                                            
                                                                                            <input class="form-check-input" name="auto_creation[]" type="checkbox" {{ in_array("Warehouse Receipts(WR)", @$autoCreationArray) ? 'checked' : '' }} value="Warehouse Receipts(WR)" id="Warehouse Receipts(WR)">
                                                                                            <label class="form-check-label" for="Warehouse Receipts(WR)">
                                                                                                Warehouse Receipts(WR)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Pickup orders(PK)", @$autoCreationArray) ? 'checked' : '' }} value="Pickup orders(PK)" id="Pickup orders(PK)">
                                                                                            <label class="form-check-label" for="Pickup orders(PK)">
                                                                                                Pickup orders(PK)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Sales Orders(SO)", @$autoCreationArray) ? 'checked' : '' }} value="Sales Orders(SO)" id="Sales Orders(SO)">
                                                                                            <label class="form-check-label" for="Sales Orders(SO)">
                                                                                                Sales Orders(SO)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Quotation(QT)", @$autoCreationArray) ? 'checked' : '' }} value="Quotation(QT)" id="Quotation(QT)">
                                                                                            <label class="form-check-label" for="Quotation(QT)">
                                                                                                Quotation(QT)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Cargo Releases(CR)", @$autoCreationArray) ? 'checked' : '' }} value="Cargo Releases(CR)" id="Cargo Releases(CR)">
                                                                                            <label class="form-check-label" for="Cargo Releases(CR)">
                                                                                                Cargo Releases(CR)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row mt-3 mb-0">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="mb-0 form-group">
                                                                                            <label class="form-label" style="width: 100%;"><b>Export Shipments</b> <hr></label>
                                                                                        </div>  
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row mt-0 mb-0">
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3 ml-3" style="display: inline-block;">
                                                                                            
                                                                                            <input class="form-check-input" name="auto_creation[]" type="checkbox" {{ in_array("Air Master Shipments(AME)", @$autoCreationArray) ? 'checked' : '' }} value="Air Master Shipments(AME)" id="Air Master Shipments(AME)">
                                                                                            <label class="form-check-label" for="Air Master Shipments(AME)">
                                                                                                Air Master Shipments(AME)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Ocean Master Shipments(OME)", @$autoCreationArray) ? 'checked' : '' }} value="Ocean Master Shipments(OME)" id="Ocean Master Shipments(OME)">
                                                                                            <label class="form-check-label" for="Ocean Master Shipments(OME)">
                                                                                                Ocean Master Shipments(OME)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Ground Master Shipments(GME)", @$autoCreationArray) ? 'checked' : '' }} value="Ground Master Shipments(GME)" id="Ground Master Shipments(GME)">
                                                                                            <label class="form-check-label" for="Ground Master Shipments(GME)">
                                                                                                Ground Master Shipments(GME)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Air House Shiments(AHE)", @$autoCreationArray) ? 'checked' : '' }} value="Air House Shiments(AHE)" id="Air House Shiments(AHE)">
                                                                                            <label class="form-check-label" for="Air House Shiments(AHE)">
                                                                                                Air House Shiments(AHE)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Ocean House Shipments(OHE)", @$autoCreationArray) ? 'checked' : '' }} value="Ocean House Shipments(OHE)" id="Ocean House Shipments(OHE)">
                                                                                            <label class="form-check-label" for="Ocean House Shipments(OHE)">
                                                                                                Ocean House Shipments(OHE)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Ground House Shipments(GHE)", @$autoCreationArray) ? 'checked' : '' }} value="Ground House Shipments(GHE)" id="Ground House Shipments(GHE)">
                                                                                            <label class="form-check-label" for="Ground House Shipments(GHE)">
                                                                                                Ground House Shipments(GHE)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row mt-3 mb-0">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="mb-0 form-group">
                                                                                            <label class="form-label" style="width: 100%;"><b>Import Shipments</b> <hr></label>
                                                                                        </div>  
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row mt-0 mb-0">
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3 ml-3" style="display: inline-block;">
                                                                                            
                                                                                            <input class="form-check-input" name="auto_creation[]" type="checkbox" {{ in_array("Air Master Shipments(AMI)", @$autoCreationArray) ? 'checked' : '' }} value="Air Master Shipments(AMI)" id="Air Master Shipments(AMI)">
                                                                                            <label class="form-check-label" for="Air Master Shipments(AMI)">
                                                                                                Air Master Shipments(AMI)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Ocean Master Shipments(OMI)", @$autoCreationArray) ? 'checked' : '' }} value="Ocean Master Shipments(OMI)" id="Ocean Master Shipments(OMI)">
                                                                                            <label class="form-check-label" for="Ocean Master Shipments(OMI)">
                                                                                                Ocean Master Shipments(OMI)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Ground Master Shipments(GMI)", @$autoCreationArray) ? 'checked' : '' }} value="Ground Master Shipments(GMI)" id="Ground Master Shipments(GMI)">
                                                                                            <label class="form-check-label" for="Ground Master Shipments(GMI)">
                                                                                                Ground Master Shipments(GMI)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Air House Shiments(AHI)", @$autoCreationArray) ? 'checked' : '' }} value="Air House Shiments(AHI)" id="Air House Shiments(AHI)">
                                                                                            <label class="form-check-label" for="Air House Shiments(AHI)">
                                                                                                Air House Shiments(AHI)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Ocean House Shipments(OHI)", @$autoCreationArray) ? 'checked' : '' }} value="Ocean House Shipments(OHI)" id="Ocean House Shipments(OHI)">
                                                                                            <label class="form-check-label" for="Ocean House Shipments(OHI)">
                                                                                                Ocean House Shipments(OHI)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4 form-group">
                                                                                        <div class="form-check mb-3" style="display: inline-block;">
                                                                                            <input class="form-check-input" type="checkbox" name="auto_creation[]" {{ in_array("Ground House Shipments(GHI)", @$autoCreationArray) ? 'checked' : '' }} value="Ground House Shipments(GHI)" id="Ground House Shipments(GHI)">
                                                                                            <label class="form-check-label" for="Ground House Shipments(GHI)">
                                                                                                Ground House Shipments(GHI)
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="row mt-3 mb-0">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="mb-0 form-group">
                                                                                            <label class="form-label" style="width: 100%;"><hr></label>
                                                                                        </div>  
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row mt-0 mb-0">
                                                                                    <div class="col-lg-12 form-group">
                                                                                        <div class="form-check mb-3 ml-3" style="display: inline-block;">
                                                                                            
                                                                                            <input class="form-check-input" name="route_assigned" type="checkbox" {{ '1' == @$data['chargeData']->route_assigned ? 'checked' : '' }} value="1" id="route_assigned">
                                                                                            <label class="form-check-label" for="route_assigned">
                                                                                                Don not generate when route is assigned to the operation
                                                                                            </label>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row mt-3 mb-0">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="mb-0 form-group">
                                                                                            <label class="form-label" style="width: 100%;"><hr></label>
                                                                                        </div>  
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row mt-0 mb-0">

                                                                                    <div class="col-lg-12 form-group">
                                                                                        <label>Is Charge Tab Completed?</label>
                                                                                        <div class="form-group">
                                                                                            <div class="form-check form-check-inline">
                                                                                                <input class="form-check-input" type="radio" name="completed_status" id="completed_status" value="1">
                                                                                            <label class="form-check-label" for="completed_status">Completed</label>
                                                                                            </div>
                                                                                            <div class="form-check form-check-inline">
                                                                                                <input class="form-check-input" type="radio" name="completed_status" id="completed_status2" value="0" checked="">
                                                                                            <label class="form-check-label" for="completed_status2">Not Completed</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                
                                                                                
                                                                                <div style="text-align: center;">
                                                                
                                                                                    <button class="btn btn-primary" type="submit" name="submit" value="rateGround">Submit</button>
                                                                                </div>
                                            
                                                                            </form>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane " id="pmttems" role="tabpanel">
                                    <div class="rates_main">
                                        <form action="{{ route('updateCarrierPmtTerms') }}" class="custom-validation"
                                            method="post" id="formValidatedAddress">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <div>
                                                    <textarea style="border:0; color: #8ca3bd!important;" name="pmt_terms" placeholder="Enter the Pmt Terms" class="form-control" rows="3">{{ @$data['carrierData']->pmt_terms }}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mb-0 float-end">
                                                <div>
                                                    <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light me-1" name="submit"
                                                        value="address">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="tab-pane " id="attachments" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                        
                                                        <h4 class="card-title mb-3">Drop your file and attachment here.</h4>
                                                        <!-- <p class="card-title-desc">DropzoneJS is an open source library
                                                            that provides drag’n’drop file uploads with image previews.
                                                        </p> -->
                        
                                                        <div>
                                                            <form action="{{ route('upload-carrier-images') }}" class="form-horizontal form dropzone" method="post" id="formValidatedCarrierGallery">
                                                                @csrf
                                                                <div class="fallback">
                                                                    <input name="file" type="file" multiple="multiple">
                                                                </div>
                                                                <div class="dz-message needsclick">
                                                                    <div class="mb-3">
                                                                        <i class="display-4 text-muted ri-upload-cloud-2-line"></i>
                                                                    </div>
                                                                    
                                                                    <h4>Drop files here or click to upload.</h4>
                                                                </div>
                                                            </form>
                                                        </div>
                        
                                                        <div class="text-center mt-4">
                                                            {{-- <button type="button" class="btn btn-primary waves-effect waves-light">Send Files</button> --}}
                                                            <div class="card">
                                                                <div class="card-body wizard-card">
                                                                    <h4 class="card-title mb-4">Files</h4>
                                                                    <div id="conHTMLForCarrier">
                                                                        <table id="dataTable222" class="table dt-responsive nowrap w-100">
                                                                            <thead>
                                                                               <tr>
                                                                                  <th width="70">#</th>
                                                                                  <th width="400">File</th>
                                                                                  <th>Actions</th>
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
                                                                                        <td>
                                                                                           <button class="btn btn-xs btn-danger" onclick="deleteCarrierImage({{@$row->id}})"><i class="fas fa-trash-alt"></i></button>
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

                                <div class="tab-pane " id="notes" role="tabpanel">
                                    <div class="rates_main">
                                        <form action="{{ route('addCarrierNote') }}" class="custom-validation" method="post" id="formValidatedNotes">
                                        @csrf
                                            <div class="row row-border-bottom mt-3 mb-3">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                        <label>Write Note Here</label>
                                                        <div>
                                                            <textarea required="" class="form-control" name="carrier_notes" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div>
                                                            <button type="submit" name="submit" value="carrierNotes" class="btn btn-primary waves-effect waves-light me-1">
                                                                Submit
                                                            </button>
                                                            {{-- <button type="reset" class="btn btn-secondary waves-effect">
                                                                Cancel
                                                            </button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="tab-pane " id="internalnotes" role="tabpanel">
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
                                                        <th scope="col">Action</th>
                                                        
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

                                                                    
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#editConNote-{{ $row->id }}">
                                                                            <i class="fas fa-edit"></i> Edit
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger btn-sm waves-effect"
                                                                            onclick="deleteNote({{ $row->id }});">
                                                                            <i class="fas fa-trash"></i> Delete
                                                                        </button>
                                                                    </td>
                                                                    
                                                                </tr>
                                                    
                                                                <div class="modal fade" id="editConNote-{{ $row->id }}" tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Note</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="{{ route('saveCarrierNote') }}" class="custom-validation"
                                                                                    method="post" id="formValidatedOtherAddress">
                                                                                    @csrf
                                                                                    <input type="hidden" name="note_id" value="{{ $row->id }}">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Note<code>*</code></label>
                                                                                        <div>
                                                                                            <textarea required="" name="note_edt" class="form-control" rows="5">{{ @$row->notes }}</textarea>
                                                                                        </div>
                                                                                    </div>
    
                                                                                    <div class="form-group mb-3">
                                                                                        <button type="submit" name="submit" value="conNoteEdt"
                                                                                            class="btn btn-primary btn-sm waves-effect waves-light">Save</button>
    
                                                                                        <button type="button" class="btn btn-sm btn-light waves-effect"
                                                                                            data-bs-dismiss="modal">Cancel</button>
                                                                                    </div>
    
                                                                                </form>
                                                                            </div>
                                                                        </div><!-- /.modal-content -->
                                                                    </div><!-- /.modal-dialog -->
                                                                </div>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane " id="moreinfo" role="tabpanel">
                                    <div class="rates_main">
                                        <form action="{{ route('updateCarrierMoreInfo') }}" class="custom-validation"
                                            method="post" id="formValidatedAddress">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <div>
                                                    <textarea style="border:0; color: #8ca3bd!important;" name="more_info" placeholder="More info" class="form-control" rows="3">{{ @$data['carrierData']->more_info }}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mb-0 float-end">
                                                <div>
                                                    <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light me-1" name="submit"
                                                        value="address">
                                                        Save
                                                    </button>
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

        <div class="modal fade" id="otherserviceadd" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateCarrierOtherAddress') }}" class="custom-validation"
                            method="post" id="formValidatedOtherAddress">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Description<code>*</code></label>
                                <div>
                                    <textarea required="" name="other_description" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Contact Name<code>*</code></label>
                                <input type="text" name="other_contact_name" class="form-control" required="">
                            </div>
                            <hr>

                            <div class="form-group mb-3">
                                <label>Street & Number<code>*</code></label>
                                <div>
                                    <textarea required="" name="other_street_number" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>City<code>*</code></label>
                                <input type="text" class="form-control" name="other_city" required=""
                                    placeholder="Type City" value="">
                            </div>
                            <div class="form-group mb-3">
                                <label>Country<code>*</code></label>
                                <select class="form-select select2" name="other_country" id="other_country_id">
                                    <option value="" selected="">Select Country...</option>
                                    @if (!$data['countries']->isEmpty())
                                        @foreach ($data['countries'] as $key => $item_val)
                                            <option value="{{ @$item_val->id }}">
                                                {{ @$item_val->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>State<code>*</code></label>
                                <select class="form-select select2" name="other_state" id="other_state_html">
                                    <option value="" selected="">Select State...</option>

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Zip Code<code>*</code></label>
                                <input type="text" class="form-control" name="other_zip_code" required=""
                                    placeholder="Type Zip Code" value="">
                            </div>
                            <div class="form-group mb-3">
                                <label>Port</label>
                                <select class="form-select select2" name="other_port"
                                    aria-label="Default select example">
                                    <option value="" selected="">Select Port...</option>
                                    @if (!$data['ports']->isEmpty())
                                        @foreach ($data['ports'] as $key => $item_val_1)
                                            <option value="{{ @$item_val_1->name }}">
                                                {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" name="submit" value="otherAddress"
                                    class="btn btn-primary waves-effect waves-light">Save</button>

                                <button type="button" class="btn btn-light waves-effect"
                                    data-bs-dismiss="modal">Cancel</button>
                                {{-- <button type="button" class="btn btn-light waves-effect">Help</button> --}}
                            </div>

                        </form>
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="submit" name="submit" value="otherAddress" class="btn btn-primary waves-effect waves-light">Save</button>

                        <button type="button" class="btn btn-light waves-effect"
                            data-bs-dismiss="modal">Cancel</button>

                    </div> --}}
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
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

        .nav-tabs-cus > li > a {
            color: #445990;
            font-weight: bold;
            font-size: 12px;
        }
    </style>

@endsection
