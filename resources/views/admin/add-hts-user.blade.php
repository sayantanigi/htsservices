@extends('layouts.admin-dashboard')
@section('title', $data['title'])
@section('content')
    <div class="tab-main-box">
        <div class="main-content tab-box" id="tab-1" style="display:block;">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">{{ $data['title'] }}    </h4>
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
                            <ul class="nav nav-tabs nav-tabs-cus" role="tablist" id="myAccordion">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#general" id="general_nav" role="tab"
                                        aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">General</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#address" id="address_nav" role="tab" aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Address</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#billing" id="billing_nav" role="tab" aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Billing Address</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#otheraddresses" id="otheraddresses_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Other Addresses</span>
                                    </a>
                                </li>
                                @if($data['userType']!="6")
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#relatedentities" id="relatedentities_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Related Entities</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#contacts" id="contacts_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Contacts</span>
                                    </a>
                                </li>
                                @endif
                                @if($data['userType']=="1")
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#participation" id="participation_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Participation</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#agent" id="agent_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Agent</span>
                                    </a>
                                </li>
                                @endif
                                @if($data['userType']=="5")
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#participation" id="participation_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Participation</span>
                                    </a>
                                </li>
                                @endif
                                @if($data['userType']=="1" || $data['userType']=="3")
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#airbaybills" id="airbaybills_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Air Waybills</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#rates" id="rates_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Rates</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#charges" id="charges_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Charges</span>
                                    </a>
                                </li>
                                @endif
                                @if($data['userType']=="4")
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#charges" id="charges_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Charges</span>
                                    </a>
                                </li>
                                @endif
                                @if($data['userType']!="6")
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#pmttems" id="pmttems_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Pmt Tems</span>
                                    </a>
                                </li>
                                @endif
                                @if($data['userType']=="3" || $data['userType']=="4" || $data['userType']=="5" || $data['userType']=="6")
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#personalInfoC" id="personalInfoC_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Personal Info</span>
                                    </a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#attachments" id="attachments_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Attachments</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#notes" id="notes_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Notes</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#internalnotes" id="internalnotes_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Internal Notes</span>
                                    </a>
                                </li>
                                @if($data['userType']=="3")
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#moreinfo" id="moreinfo_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">More Info</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="general" role="tabpanel">
                                    <form action="{{ route('createHtsUser') }}" class="custom-validation" method="post"
                                        id="formValidated">
                                        @csrf
                                        <input type="hidden" name="user_type" value="{{ @$data['userType'] }}">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Name<code>*</code></label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ @$data['userData']->name }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Entity ID</label>
                                                    <input type="text" class="form-control" name="entity_id"
                                                        value="{{ @$data['userData']->entity_id }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Phone </label>
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" name="phone"
                                                                value="{{ @$data['userData']->phone }}">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="number" class="form-control" name="phone_1"
                                                                value="{{ @$data['userData']->phone_1 }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Mobile Phone</label>
                                                    <input type="text" class="form-control" name="mobile_phone"
                                                        value="{{ @$data['userData']->mobile_phone }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Fax </label>
                                                    <input type="text" class="form-control" name="fax"
                                                        value="{{ @$data['userData']->fax }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Email<code>*</code></label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ @$data['userData']->email }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Website </label>
                                                    <input type="text" class="form-control" name="website"
                                                        value="{{ @$data['userData']->website }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Account Number </label>
                                                    <input type="text" class="form-control" name="account_number"
                                                        value="{{ @$data['userData']->account_number }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Contact First Name </label>
                                                    <input type="text" class="form-control" name="contact_first_name"
                                                        value="{{ @$data['userData']->contact_first_name }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Contact Last Name </label>
                                                    <input type="text" class="form-control" name="contact_last_name"
                                                        value="{{ @$data['userData']->contact_last_name }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>Indentification Number </label>
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control"
                                                                name="identification_number"
                                                                value="{{ @$data['userData']->identification_number }}">
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
                                                                                {{ @$item->name == @$data['userData']->identification_other ? 'selected' : '' }}>
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
                                                                            {{ @$item_2->name == @$data['userData']->division ? 'selected' : '' }}>
                                                                            {{ @$item_2->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Network ID </label>
                                                            <input type="text" class="form-control" name="network_id"
                                                                value="{{ @$data['userData']->network_id }}">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>&nbsp; </label>
                                                            <div class="mb-3">
                                                                <div class="form-check-inline mb-3">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="network_status" id="formRadios1"
                                                                        value="1"
                                                                        {{ '1' == @$data['userData']->network_status ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="formRadios1">
                                                                        Active
                                                                    </label>
                                                                </div>
                                                                <div class="form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="network_status" id="formRadios2"
                                                                        value="0"
                                                                        {{ '0' == @$data['userData']->network_status ? 'checked' : '' }}>
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
                                    <form action="{{ route('updateHtsUserAddress') }}" class="custom-validation"
                                        method="post" id="formValidatedAddress">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label>Street & Number<code>*</code></label>
                                            <div>
                                                <textarea required="" name="street_number" class="form-control" rows="5">{{ @$data['userData']->street_number }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>City<code>*</code></label>
                                            <input type="text" class="form-control" name="city" required=""
                                                placeholder="Type City" value="{{ @$data['userData']->city }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Country<code>*</code></label>
                                            <select class="form-select select2" aria-label="Default select example"
                                                name="country" id="country_id">
                                                <option value="" selected="">Select Country...</option>
                                                @if (!$data['countries']->isEmpty())
                                                    @foreach ($data['countries'] as $key => $item_val)
                                                        <option value="{{ @$item_val->id }}"
                                                            {{ @$item_val->id == @$data['userData']->country ? 'selected' : '' }}>
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
                                                            {{ @$item_val_2->id == @$data['userData']->state ? 'selected' : '' }}>
                                                            {{ @$item_val_2->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Zip Code<code>*</code></label>
                                            <input type="text" class="form-control" name="zip_code" required=""
                                                placeholder="Type Zip Code"
                                                value="{{ @$data['userData']->zip_code }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Port</label>
                                            <select class="form-select select2" name="port"
                                                aria-label="Default select example">
                                                <option value="" selected="">Select Port...</option>
                                                @if (!$data['ports']->isEmpty())
                                                    @foreach ($data['ports'] as $key => $item_val_1)
                                                        <option value="{{ @$item_val_1->name }}"
                                                            {{ @$item_val_1->name == @$data['userData']->port ? 'selected' : '' }}>
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
                                    <form action="{{ route('updateHtsBillingAddress') }}" class="custom-validation"
                                        method="post" id="formValidatedBillingAddress">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label>Street & Number<code>*</code></label>
                                            <div>
                                                <textarea required="" name="billing_street_number" class="form-control" rows="5">{{ @$data['userData']->billing_street_number }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>City<code>*</code></label>
                                            <input type="text" class="form-control" name="billing_city"
                                                required="" placeholder="Type City"
                                                value="{{ @$data['userData']->billing_city }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Country<code>*</code></label>
                                            <select class="form-select select2" aria-label="Default select example"
                                                name="billing_country" id="billing_country_id">
                                                <option value="" selected="">Select Country...</option>
                                                @if (!$data['countries']->isEmpty())
                                                    @foreach ($data['countries'] as $key => $item_val)
                                                        <option value="{{ @$item_val->id }}"
                                                            {{ @$item_val->id == @$data['userData']->billing_country ? 'selected' : '' }}>
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
                                                            {{ @$item_val_2->id == @$data['userData']->billing_state ? 'selected' : '' }}>
                                                            {{ @$item_val_2->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Zip Code<code>*</code></label>
                                            <input type="text" class="form-control" name="billing_zip_code"
                                                required="" placeholder="Type Zip Code"
                                                value="{{ @$data['userData']->billing_zip_code }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Port</label>
                                            <select class="form-select select2" name="billing_port"
                                                aria-label="Default select example">
                                                <option value="" selected="">Select Port...</option>
                                                @if (!$data['ports']->isEmpty())
                                                    @foreach ($data['ports'] as $key => $item_val_1)
                                                        <option value="{{ @$item_val_1->name }}"
                                                            {{ @$item_val_1->name == @$data['userData']->billing_port ? 'selected' : '' }}>
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
                                                        <th width="50">#</th>
                                                        <th width="250">Description</th>
                                                        <th width="100">Contact Name</th>
                                                        <th width="200">Contact Details</th>
                                                        <th width="100">Country</th>
                                                        <th width="100">Port</th>
                                                        <th width="100">City</th>
                                                        <th width="100">State</th>
                                                        <th width="100">Street & Number</th>
                                                        <th width="100">Zip Code</th>
                                                        <th width="180" class="text-center">Actions</th>
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
                                                                    <p>
                                                                    @if (@$row->other_contact_phone)
                                                                        {{ $row->other_contact_phone_code." ".$row->other_contact_phone }}
                                                                    @else
                                                                        &#8212;
                                                                    @endif
                                                                    </p>
                                                                    <p>
                                                                    @if (@$row->other_contact_email)
                                                                        {{ $row->other_contact_email }}
                                                                    @else
                                                                        &#8212;
                                                                    @endif
                                                                    </p>
                                                                    <p>
                                                                    @if (@$row->other_contact_fax)
                                                                        {{ $row->other_contact_fax }}
                                                                    @else
                                                                        &#8212;
                                                                    @endif
                                                                    </p>
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
                                                                        onclick="deleteHtsOtherAddress({{ $row->id }});">
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
                                                                            <form action="{{ route('saveHtsOtherAddress') }}" class="custom-validation" method="post" id="formValidatedOtherAddress">
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
                                                                                <div class="form-group mb-3">
                                                                                    <label>Phone<code>*</code></label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" name="other_contact_phone_edt" class="form-control" value="{{ @$row->other_contact_phone }}" required="">
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <input type="text" class="form-control" name="other_contact_phone_code_edt" value="{{ @$row->other_contact_phone_code }}" >
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group mb-3">
                                                                                    <label>FAX<code>*</code></label>
                                                                                    <input type="text" name="other_contact_fax_edt" class="form-control" value="{{ @$row->other_contact_fax }}" required="">
                                                                                </div>
                                                                                <div class="form-group mb-3">
                                                                                    <label>Email<code>*</code></label>
                                                                                    <input type="text" name="other_contact_email_edt" class="form-control" value="{{ @$row->other_contact_email }}" required="">
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
                                        if(!empty(@$data['userData']->parent_entity)) {
                                            $carriers_single = DB::table('hts_users')->where('id', @$data['userData']->parent_entity)->select('id','name','entity_id','parent_entity','user_type')->first();
                                            $carriers_types_v = DB::table('hts_user_types')->where('id', $carriers_single->user_type)->select('name')->first();
                                            $carrieryTitle = @$carriers_single->name." - ".@$carriers_single->entity_id." - ".@$carriers_types_v->name." Agent";
                                        } else {
                                            $carrieryTitle = "";
                                        }

                                        if(!empty(@$data['userData']->sales_person)) {
                                            $carriers_singlesp = DB::table('hts_users')->where('id', @$data['userData']->sales_person)->select('id','name','entity_id','sales_person','user_type')->first();
                                            $carriers_types_vsp = DB::table('hts_user_types')->where('id', $carriers_singlesp->user_type)->select('name')->first();
                                            $carrieryTitlesp = @$carriers_singlesp->name." - ".@$carriers_singlesp->entity_id." - ".@$carriers_types_vsp->name." Agent";
                                        } else {
                                            $carrieryTitlesp = "";
                                        }

                                        if(!empty(@$data['userData']->destination_agent)) {
                                            $carriers_singleda = DB::table('hts_users')->where('id', @$data['userData']->destination_agent)->select('id','name','entity_id','destination_agent','user_type')->first();
                                            $carriers_types_vda = DB::table('hts_user_types')->where('id', $carriers_singleda->user_type)->select('name')->first();
                                            $carrieryTitleda = @$carriers_singleda->name." - ".@$carriers_singleda->entity_id." - ".@$carriers_types_vda->name." Agent";
                                        } else {
                                            $carrieryTitleda = "";
                                        }

                                    @endphp
                                    <div class="col-12">
                                        <div class="col-6" style="display: inline-block; float: left; padding: 0px 30px 0px 0px;">
                                            <div class="mb-3">
                                                <label>Parent Entity</label>
                                                <input type="text" class="form-control" required="" value="{{ @$carrieryTitle }}" placeholder="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            </div>
                                        </div>
                                        <div class="col-6" style="display: inline-block; float: left;">
                                            <div class="mb-3">
                                                <label>Sales Person</label>
                                                <input type="text" class="form-control" required="" value="{{ @$carrieryTitlesp }}" placeholder="" data-bs-toggle="modal" data-bs-target="#staticBackdropsales">
                                            </div>
                                        </div>
                                        <div class="col-6" style="display: inline-block; float: left; padding: 0px 30px 0px 0px;">
                                            <div class="mb-3">
                                                <label>Destination Agent</label>
                                                <input type="text" class="form-control" required="" value="{{ @$carrieryTitleda }}" placeholder="" data-bs-toggle="modal" data-bs-target="#staticBackdropdestination">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade bs-example-modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <form action="{{ route('updateHtsParentEntity') }}" class="custom-validation" method="post" id="formValidatedParentEntity">
                                                            <div style="max-height: 450px; overflow-y: auto;">
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
                                                                    @if(!empty($data['all_users']))
                                                                        @foreach($data['all_users'] as $key=>$item_val)
                                                                        @php
                                                                        $usertypes = DB::table('hts_user_types')->where('id', $item_val->user_type)->select('name')->first();
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
                                                                                @if (@$item_val->user_type)
                                                                                    {{ $usertypes->name }}
                                                                                @else
                                                                                    &#8212;
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input class="table-radio" type="radio" {{ @$item_val->id == @$data['userData']->parent_entity ? 'checked' : '' }} name="parent_entity" required id="parent_entity_{{ @$item_val->id }}" value="{{ @$item_val->id }}">
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
                                                                <button type="submit" name="submit" value="Parententity" class="btn btn-primary waves-effect waves-light">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade bs-example-modal-lg" id="staticBackdropsales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <form action="{{ route('updateHtsSalesPerson') }}" class="custom-validation" method="post" id="formValidatedParentEntity">
                                                            <div style="max-height: 450px; overflow-y: auto;">
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
                                                                    @if(!empty($data['all_salesusers']))
                                                                        @foreach($data['all_salesusers'] as $key=>$item_val)
                                                                        @php
                                                                        $usertypes = DB::table('hts_user_types')->where('id', $item_val->user_type)->select('name')->first();
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
                                                                                @if (@$item_val->user_type)
                                                                                    {{ $usertypes->name }}
                                                                                @else
                                                                                    &#8212;
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input class="table-radio" type="radio" {{ @$item_val->id == @$data['userData']->sales_person ? 'checked' : '' }} name="sales_person" required id="sales_person_{{ @$item_val->id }}" value="{{ @$item_val->id }}">
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
                                                                <button type="submit" name="submit" value="Parententity" class="btn btn-primary waves-effect waves-light">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade bs-example-modal-lg" id="staticBackdropdestination" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <form action="{{ route('updateHtsDestinationAgent') }}" class="custom-validation" method="post" id="formValidatedParentEntity">
                                                            <div style="max-height: 450px; overflow-y: auto;">
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
                                                                    @if(!empty($data['all_agentusers']))
                                                                        @foreach($data['all_agentusers'] as $key=>$item_val)
                                                                        @php
                                                                        $usertypes = DB::table('hts_user_types')->where('id', $item_val->user_type)->select('name')->first();
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
                                                                                @if (@$item_val->user_type)
                                                                                    {{ $usertypes->name }}
                                                                                @else
                                                                                    &#8212;
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input class="table-radio" type="radio" {{ @$item_val->id == @$data['userData']->destination_agent ? 'checked' : '' }} name="destination_agent" required id="destination_agent_{{ @$item_val->id }}" value="{{ @$item_val->id }}">
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
                                                                <button type="submit" name="submit" value="Parententity" class="btn btn-primary waves-effect waves-light">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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
                                                        <button type="button" style="float: right;" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl" class="btn btn-primary btn-sm waves-effect waves-light">
                                                            <i class="fas fa-plus"></i>
                                                            @if (empty(Session::has('hts_cont_id')))
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
                                                                                onclick="deleteHtsConTabData({{ $row->id }});">
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
                                                        <h5 class="modal-title" id="addcontactdetails">Contacts</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="conModalCls" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <ul class="nav nav-tabs nav-tabs-cus" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-bs-toggle="tab" href="#cgeneral" id="cgeneral_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                            <span class="d-none d-sm-block">General</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('hts_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#caddress" id="caddress_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                            <span class="d-none d-sm-block">Address</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('hts_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#cbaddress" id="cbaddress_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Billing Address</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('hts_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#coaddress" id="coaddress_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Other Address</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('hts_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#cpinfo" id="cpinfo_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Personal Info</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('hts_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#cattachment" id="cattachment_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Attachments</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('hts_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#cnotes" id="cnotes_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Notes</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('hts_cont_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#cinternalnotes" id="cinternalnotes_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Internal Notes</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content p-3 text-muted">
                                                                    <div class="tab-pane active" id="cgeneral" role="tabpanel">
                                                                        <form action="{{ route('createHtsContact') }}" class="custom-validation" method="post" id="formValidatedContact">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>First Name<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="contact_first_name" value="{{ @$data['contactData']->contact_first_name }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Last Name<code>*</code> </label>
                                                                                        <input type="text" class="form-control" name="contact_last_name" value="{{ @$data['contactData']->contact_last_name }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Name<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="name" value="{{ @$data['contactData']->name }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Parent </label>
                                                                                        <select class="form-select select2" aria-label="Default select example" name="con_parent" id="con_parent">
                                                                                            <option value="" selected="">Select...</option>
                                                                                            @if (!empty($data['all_carriers_contact']))
                                                                                                @foreach ($data['all_carriers_contact'] as $key => $item_val)
                                                                                                <option value="{{ @$item_val->id }}" {{ @$item_val->id == @$data['contactData']->parent ? 'selected' : '' }}> {{ @$item_val->name." - ".@$item_val->entity_id }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Divison </label>
                                                                                        <select class="form-select select2" name="division" aria-label="Default select example">
                                                                                            <option value="" selected="">Select...</option>
                                                                                            @if (!$data['divisons']->isEmpty())
                                                                                                @foreach ($data['divisons'] as $key => $item_2)
                                                                                                    <option value="{{ @$item_2->name }}" {{ @$item_2->name == @$data['contactData']->division ? 'selected' : '' }}> {{ @$item_2->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Entity ID<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="entity_id" value="{{ @$data['contactData']->entity_id }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Phone </label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-9">
                                                                                                <input type="text" class="form-control" name="phone" value="{{ @$data['contactData']->phone }}">
                                                                                            </div>
                                                                                            <div class="col-sm-3">
                                                                                                <input type="text" class="form-control" name="phone_1" value="{{ @$data['contactData']->phone_1 }}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Mobile Phone</label>
                                                                                        <input type="text" class="form-control" name="mobile_phone" value="{{ @$data['contactData']->mobile_phone }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Fax </label>
                                                                                        <input type="text" class="form-control" name="fax" value="{{ @$data['contactData']->fax }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Email<code>*</code></label>
                                                                                        <input type="email" class="form-control" name="email" value="{{ @$data['contactData']->email }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Website </label>
                                                                                        <input type="text" class="form-control" name="website" value="{{ @$data['contactData']->website }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Account Number<code>*</code> </label>
                                                                                        <input type="text" class="form-control" name="account_number" value="{{ @$data['contactData']->account_number }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Indentification Number<code>*</code> </label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-9">
                                                                                                <input type="text" class="form-control" name="identification_number" value="{{ @$data['contactData']->identification_number }}">
                                                                                            </div>
                                                                                            <div class="col-sm-3">
                                                                                                <div class="mb-3">
                                                                                                    <select class="form-select select2" name="identification_other" aria-label="Default select example">
                                                                                                        <option value="" selected="">Select other</option>
                                                                                                        @if (!$data['types']->isEmpty())
                                                                                                            @foreach ($data['types'] as $key => $item)
                                                                                                                <option value="{{ @$item->name }}" {{ @$item->name == @$data['contactData']->identification_other ? 'selected' : '' }}> {{ @$item->name }}</option>
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
                                                                                            <button type="submit" name="submit" value="generalContactForm"class="btn btn-primary waves-effect waves-light me-1">Save</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="tab-pane" id="caddress" role="tabpanel">
                                                                        <form action="{{ route('updateConHtsAddress') }}" class="custom-validation"
                                                                            method="post" id="formValidatedAddress2ndTab">
                                                                            @csrf
                                                                            <div class="form-group mb-3">
                                                                                <label>Street & Number<code>*</code></label>
                                                                                <div>
                                                                                    <textarea required="" name="street_number" class="form-control" rows="">{{ @$data['contactData']->street_number }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12" style="display: inline-block;">
                                                                                <div class="col-4" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Country<code>*</code></label>
                                                                                        <select class="form-select select2" aria-label="Default select example" name="country" id="cont_country_id">
                                                                                            <option value="" selected="">Select Country...</option>
                                                                                            @if (!$data['countries']->isEmpty())
                                                                                            @foreach ($data['countries'] as $key => $item_val)
                                                                                            <option value="{{ @$item_val->id }}" {{ @$item_val->id == @$data['contactData']->country ? 'selected' : '' }}> {{ @$item_val->name }}</option>
                                                                                            @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>State<code>*</code></label>
                                                                                        <select class="form-select select2" aria-label="Default select example" name="state" id="cont_state_html">
                                                                                            <option value="" selected="">Select State...</option>
                                                                                            @if (!empty($data['constates']))
                                                                                            @foreach ($data['constates'] as $key => $item_val_2)
                                                                                            <option value="{{ @$item_val_2->id }}" {{ @$item_val_2->id == @$data['contactData']->state ? 'selected' : '' }}> {{ @$item_val_2->name }}</option>
                                                                                            @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4" style="display: inline-block; float: left; padding: 0px">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>City<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="city" required="" placeholder="Type City" value="{{ @$data['contactData']->city }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12" style="display: inline-block;">
                                                                                <div class="col-6" style="display: inline-block; float: left; padding: 0 10px 0px 0;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Zip Code<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="zip_code" required="" placeholder="Type Zip Code" value="{{ @$data['contactData']->zip_code }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6" style="display: inline-block; float: left; padding: 0px;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Port</label>
                                                                                        <select class="form-select select2" name="port" aria-label="Default select example">
                                                                                            <option value="" selected="">Select Port...</option>
                                                                                            @if (!$data['ports']->isEmpty())
                                                                                                @foreach ($data['ports'] as $key => $item_val_1)
                                                                                                <option value="{{ @$item_val_1->name }}" {{ @$item_val_1->name == @$data['contactData']->port ? 'selected' : '' }}> {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group mb-0 float-end">
                                                                                <div>
                                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1" name="submit" value="address">Save</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="tab-pane " id="cbaddress" role="tabpanel">
                                                                        <form action="{{ route('updateHtsConBillingAddress') }}" class="custom-validation" method="post" id="formValidatedBillingAddress2ndTab">
                                                                            @csrf
                                                                            <div class="form-group mb-3">
                                                                                <label>Street & Number<code>*</code></label>
                                                                                <div>
                                                                                    <textarea required="" name="billing_street_number" class="form-control" rows="0">{{ @$data['contactData']->billing_street_number }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12" style="display: inline-block;">
                                                                                <div class="col-4" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Country<code>*</code></label>
                                                                                        <select class="form-select select2" aria-label="Default select example" name="billing_country" id="con_billing_country_id">
                                                                                            <option value="" selected="">Select Country...</option>
                                                                                            @if (!$data['countries']->isEmpty())
                                                                                                @foreach ($data['countries'] as $key => $item_val)
                                                                                                <option value="{{ @$item_val->id }}" {{ @$item_val->id == @$data['contactData']->billing_country ? 'selected' : '' }}>{{ @$item_val->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>State<code>*</code></label>
                                                                                        <select class="form-select select2" aria-label="Default select example"
                                                                                            name="billing_state" id="con_billing_state_html">
                                                                                            <option value="" selected="">Select State...</option>
                                                                                            @if (!empty($data['conbillingstates']))
                                                                                                @foreach ($data['conbillingstates'] as $key => $item_val_2)
                                                                                                <option value="{{ @$item_val_2->id }}" {{ @$item_val_2->id == @$data['contactData']->billing_state ? 'selected' : '' }}>{{ @$item_val_2->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4" style="display: inline-block; float: left; padding: 0px">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>City<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="billing_city" required="" placeholder="Type City" value="{{ @$data['contactData']->billing_city }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12" style="display: inline-block;">
                                                                                <div class="col-6" style="display: inline-block; float: left; padding: 0 10px 0px 0;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Zip Code<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="billing_zip_code" required="" placeholder="Type Zip Code" value="{{ @$data['contactData']->billing_zip_code }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6" style="display: inline-block; float: left; padding: 0px;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Port</label>
                                                                                        <select class="form-select select2" name="billing_port"
                                                                                            aria-label="Default select example">
                                                                                            <option value="" selected="">Select Port...</option>
                                                                                            @if (!$data['ports']->isEmpty())
                                                                                                @foreach ($data['ports'] as $key => $item_val_1)
                                                                                                <option value="{{ @$item_val_1->name }}" {{ @$item_val_1->name == @$data['contactData']->billing_port ? 'selected' : '' }}>{{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group mb-0 float-end">
                                                                                <div>
                                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1" name="submit" value="address">Save</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="tab-pane " id="coaddress" role="tabpanel">
                                                                        <form action="{{ route('updateHtsContOtherAddress') }}" class="custom-validation" method="post" id="formValidatedBillingAddress2ndTab_2">
                                                                            @csrf
                                                                            <div class="mb-3 form-group">
                                                                                <label>Address</label>
                                                                                <div>
                                                                                    <textarea required="" name="other_address" class="form-control" rows="0">{{ @$data['contactData']->other_address }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Description</label>
                                                                                <div>
                                                                                    <textarea required="" name="other_description" class="form-control" rows="0">{{ @$data['contactData']->other_description }}</textarea>
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
                                                                                    <textarea required="" name="other_street_number" class="form-control" rows="0">{{ @$data['contactData']->other_street_number }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12" style="display: inline-block;">
                                                                                <div class="col-4" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Country<code>*</code></label>
                                                                                        <select class="form-select select2" aria-label="Default select example" name="other_country_2" id="other_country_id_2">
                                                                                            <option value="" selected="">Select Country...</option>
                                                                                            @if (!$data['countries']->isEmpty())
                                                                                                @foreach ($data['countries'] as $key => $item_val)
                                                                                                <option value="{{ @$item_val->id }}" {{ @$item_val->id == @$data['contactData']->other_country ? 'selected' : '' }}>{{ @$item_val->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4" style="display: inline-block;float: left;padding: 0 0px 0 0px;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>State<code>*</code></label>
                                                                                        <select class="form-select select2" aria-label="Default select example" name="other_state_2" id="other_state_html_2">
                                                                                            <option value="" selected="">Select State...</option>
                                                                                            @if (!empty($data['conConstates']))
                                                                                                @foreach ($data['conConstates'] as $key => $item_val_2)
                                                                                                <option value="{{ @$item_val_2->id }}" {{ @$item_val_2->id == @$data['contactData']->other_state ? 'selected' : '' }}>{{ @$item_val_2->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4" style="display: inline-block;float: left;padding: 0 0px 0 10px;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>City<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="other_city" required="" placeholder="Type City" value="{{ @$data['contactData']->other_city }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12" style="display: inline-block;">
                                                                                <div class="col-6" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Zip Code<code>*</code></label>
                                                                                        <input type="text" class="form-control" name="other_zipcode" required="" placeholder="Type Zip Code" value="{{ @$data['contactData']->other_zipcode }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6" style="display: inline-block; float: left;">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>Port</label>
                                                                                        <select class="form-select select2" name="other_port"
                                                                                            aria-label="Default select example">
                                                                                            <option value="" selected="">Select Port...</option>
                                                                                            @if (!$data['ports']->isEmpty())
                                                                                                @foreach ($data['ports'] as $key => $item_val_1)
                                                                                                <option value="{{ @$item_val_1->name }}"{{ @$item_val_1->name == @$data['contactData']->other_port ? 'selected' : '' }}>{{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-0 float-end">
                                                                                <div>
                                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1" name="submit" value="address">Save</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="tab-pane " id="cpinfo" role="tabpanel">
                                                                        <form action="{{ route('updateHtsContDateOfBirth') }}" class="custom-validation" method="post" id="formValidatedBillingAddress2ndTab_3">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Country of Citizenship</label>
                                                                                        <select class="form-select select2" aria-label="Default select example" name="country_of_citizenship" id="country_of_citizenship">
                                                                                            <option value="" selected="">Select Country...</option>
                                                                                            @if (!$data['countries']->isEmpty())
                                                                                                @foreach ($data['countries'] as $key => $item_val)
                                                                                                <option value="{{ @$item_val->id }}" {{ @$item_val->id == @$data['contactData']->country_of_citizenship ? 'selected' : '' }}>{{ @$item_val->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label>Date Of Birth</label>
                                                                                        <input type="date" class="form-control" name="date_of_birth" required="" placeholder="" value="{{ @$data['contactData']->date_of_birth }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-0 float-end">
                                                                                <div>
                                                                                    <button type="submit" name="submit" value="saveDOB" class="btn btn-primary waves-effect waves-light me-1">Save</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="tab-pane " id="cattachment" role="tabpanel">
                                                                        <div>
                                                                            <form action="{{ route('upload-hts-images') }}" class="form-horizontal form dropzone" method="post" id="formValidatedConHtsGallery">
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
                                                                        <div class="card">
                                                                            <div class="card-body wizard-card">
                                                                                <h4 class="card-title mb-4">Files</h4>
                                                                                <div id="conHtsHTML">
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
                                                                                                    <button class="btn btn-xs btn-danger" onclick="deleteHtsListingImage({{@$row->id}})"><i class="fas fa-trash-alt"></i></button>
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
                                                                            <form action="{{ route('create-hts-notes') }}" class="form-horizontal form" method="post" id="formValidatedBillingAddress2ndTab_4">
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
                                                                                                <button type="submit" name="submit" value="" class="btn btn-primary waves-effect waves-light me-1">Submit</button>
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
                                                                                                <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="deleteHtsConNote({{ $row->id }});">
                                                                                                    <i class="fas fa-trash"></i> Delete
                                                                                                </button>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <div class="modal fade" id="editConNote-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Note</h5>
                                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <form action="{{ route('saveHtsConNote') }}" class="custom-validation" method="post" id="formValidatedOtherAddress">
                                                                                                            @csrf
                                                                                                            <input type="hidden" name="note_id" value="{{ $row->id }}">
                                                                                                            <div class="form-group mb-3">
                                                                                                                <label>Note<code>*</code></label>
                                                                                                                <div>
                                                                                                                    <textarea required="" name="conn_note_edt" class="form-control" rows="5">{{ @$row->notes }}</textarea>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group mb-3">
                                                                                                                <button type="submit" name="submit" value="conNoteEdt" class="btn btn-primary waves-effect waves-light">Save</button>
                                                                                                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cancel</button>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="participation" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-3">Participation lists
                                                    <button type="button" style="float: right;" data-bs-toggle="modal" data-bs-target=".bs-participation-modal-xl"
                                                        class="btn btn-primary btn-sm waves-effect waves-light">
                                                        <i class="fas fa-plus"></i>
                                                        @if (empty(Session::has('hts_charge_id')))
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
                                                            <th width="10">#</th>
                                                            <th>Participation</th>
                                                            <th>Charge</th>
                                                            <th>Value</th>
                                                            <th>Type</th>
                                                            <th>Air Import</th>
                                                            <th>Ocean Import</th>
                                                            <th>Ground Import</th>
                                                            <th>Air Export</th>
                                                            <th>Ocean Export</th>
                                                            <th>Ground Export</th>
                                                            <th>Creaton Date</th>
                                                            <th width="135" class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($data['participations_charges']))
                                                            @foreach ($data['participations_charges'] as $key => $row_val)
                                                                @php
                                                                    $pinfo = DB::table('hts_participations')->where('id', @$row_val->participation_charge_id)->first();
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>
                                                                        @if (@$row_val->participation_type)
                                                                            {{ $row_val->participation_type }}
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (@$row_val->participation_charge_id)
                                                                            {{ @$pinfo->description }}
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
                                                                        @if (@$row_val->type)
                                                                            {{ $row_val->type }}
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (@$row_val->air_import)
                                                                            Yes
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (@$row_val->ocean_import)
                                                                            Yes
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (@$row_val->ground_import)
                                                                            Yes
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (@$row_val->air_export)
                                                                            Yes
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (@$row_val->ocean_export)
                                                                            Yes
                                                                        @else
                                                                            &#8212;
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if (@$row_val->ground_export)
                                                                            Yes
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
                                                                        <button type="reset"
                                                                            class="btn btn-danger btn-sm waves-effect"
                                                                            onclick="deleteParticipationData({{ $row_val->id }});">
                                                                            <i class="fas fa-trash"></i> Delete
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal fade bs-participation-modal-xl" id="myModalParticipation" role="dialog" aria-labelledby="addcontactdetails" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addcontactdetails">Participation
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="conModalClsCharge" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <form action="{{ route('create-participation-inner') }}" class="custom-validation" method="post"
                                                                                id="formValidatedCharge">
                                                                        @csrf
                                                                        <div class="row row-border-bottom mt-0 mb-3">
                                                                            <div class="col-lg-8">
                                                                                <div class="mb-3 form-group">
                                                                                    <label class="form-label">Participation</label>
                                                                                    <select class="form-control select2" name="participation_type" id="participation_type" required>
                                                                                        <option value="">Select</option>
                                                                                       <option value="Charge Participation">Charge Participation</option>
                                                                                       <option value="Shipment Participation">Shipment Participation</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-0 mb-3" id="chargeParticipation">
                                                                            <div class="col-lg-8">
                                                                                <div class="mb-0 form-group">
                                                                                    <label class="form-label">Charge</label>
                                                                                    <select class="form-control select2" name="participation_charge_id" required>
                                                                                        <option value="">Select</option>
                                                                                        <optgroup label="Description / Method / Code">
                                                                                            @if (!$data['participations']->isEmpty())
                                                                                                @foreach ($data['participations'] as $key => $par)
                                                                                                    <option value="{{ @$par->id }}"
                                                                                                        {{ @$par->id == @$data['chargeData']->id ? 'selected' : '' }}>
                                                                                                        {{ @$par->description." / ".@$par->account_name." / ".@$par->code }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </optgroup>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-0 mb-3">
                                                                            <div class="col-lg-8">
                                                                                <div class="mb-0 form-group">
                                                                                    <label class="form-label">Type</label>
                                                                                    <select class="form-control select2" name="type" required>
                                                                                        <option value="">Select</option>
                                                                                       <option value="Percentage of Profit">Percentage of Profit</option>
                                                                                       <option value="Flat Value">Flat Value</option>
                                                                                       <option value="Percentage of Income">Percentage of Income</option>
                                                                                       <option value="Amount per Weight">Amount per Weight</option>
                                                                                       <option value="Amount per Volume">Amount per Volume</option>
                                                                                       <option value="Amount per Pieces">Amount per Pieces</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-3 mb-3">
                                                                            <div class="col-lg-8">
                                                                                <div class="mb-3 form-group">
                                                                                    <label class="form-label">Value</label>
                                                                                    <input type="text" class="form-control" required placeholder="0.00" name="price" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 46 || event.charCode == 0" value="{{ @$data['chargeData']->price }}" >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="contentparticipation" style="display:none;">
                                                                            <div class="row mt-3 mb-3">
                                                                                <div class="col-lg-8">
                                                                                    <div class="mb-3 form-group">
                                                                                        <table class="table table-bordered mb-0">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th></th>
                                                                                                    <th>Air</th>
                                                                                                    <th>Ocean</th>
                                                                                                    <th>Ground</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td>Import</td>
                                                                                                    <td>
                                                                                                        <div class="form-check mb-3">
                                                                                                            <input class="form-check-input" type="checkbox" name="air_import" value="1">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-check mb-3">
                                                                                                            <input class="form-check-input" type="checkbox" name="ocean_import" value="1">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-check mb-3">
                                                                                                            <input class="form-check-input" type="checkbox" name="ground_import" value="1">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Export</td>
                                                                                                    <td>
                                                                                                        <div class="form-check mb-3">
                                                                                                            <input class="form-check-input" type="checkbox" name="air_export" value="1">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-check mb-3">
                                                                                                            <input class="form-check-input" type="checkbox" name="ocean_export" value="1">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-check mb-3">
                                                                                                            <input class="form-check-input" type="checkbox" name="ground_export" value="1">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div style="text-align: center; mt-3">
                                                                            <button class="btn btn-primary" type="submit" name="submit" value="customCharge">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane " id="agent" role="tabpanel">
                                    <form action="{{ route('updateHtsUserAgent') }}" class="custom-validation" method="post" id="formValidatedAgent">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">IATA Code<code>*</code></label>
                                            <div class="col-sm-5">
                                                <input class="form-control" name="ita_code" type="text" placeholder="" value="{{ @$data['userData']->ita_code }}" id="ita_code">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">FMC<code>*</code></label>
                                            <div class="col-sm-5">
                                                <input class="form-control" name="fmc_code" type="text" value="{{ @$data['userData']->fmc_code }}" placeholder="" id="fmc_code">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">SCAC Code Or US Customs Code<code>*</code></label>
                                            <div class="col-sm-5">
                                                <input class="form-control" name="scac_code" type="text" placeholder="" value="{{ @$data['userData']->scac_code }}" id="scac_code">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">TSA Number</label>
                                            <div class="col-sm-5">
                                                <textarea class="form-control" name="tsa_number" rows="5">{{ @$data['userData']->tsa_number }}</textarea>
                                            </div>
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
                                </div>
                                <div class="tab-pane" id="airbaybills" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-3">Air Waybill lists
                                                    <button type="button" style="float: right;" data-bs-toggle="modal" data-bs-target=".bs-air-aybills-modal-xl"
                                                        class="btn btn-primary btn-sm waves-effect waves-light">
                                                        <i class="fas fa-plus"></i>
                                                        Add New
                                                    </button>
                                                </h4>
                                            </div>
                                            <div class="table-responsive fixhei">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th width="10">#</th>
                                                            <th>AWB Number</th>
                                                            <th>Date</th>
                                                            <th>Entity</th>
                                                            <th>Shipment</th>
                                                            <th>Warehouse Receipt</th>
                                                            <th>Booking #</th>
                                                            <th width="135" class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (!empty($data['awb_numbers']))
                                                        @foreach ($data['awb_numbers'] as $key => $row_val)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>
                                                                @if (@$row_val->awb_number)
                                                                    {{ $row_val->awb_number }}
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
                                                                &#8212;
                                                            </td>
                                                            <td>
                                                                &#8212;
                                                            </td>
                                                            <td>
                                                                &#8212;
                                                            </td>
                                                            <td>
                                                                &#8212;
                                                            </td>
                                                            <td>
                                                                <button type="reset"
                                                                    class="btn btn-danger btn-sm waves-effect"
                                                                    onclick="deleteAwbData({{ $row_val->id }});">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal fade bs-air-aybills-modal-xl" id="myModalAirwaybills" role="dialog" aria-labelledby="addcontactdetails" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addcontactdetails">Air Waybills</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="conModalClsCharge" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body_1">
                                                                    <form action="{{route('create-awb-number')}}" class="custom-validation" method="post" id="formValidatedAWB">
                                                                        @csrf
                                                                        <div class="col-12" style="display: inline-block; padding: 10px; float: left; width: 100%; background: #ffffff; margin-top: 0px; box-shadow: 0 0 5px #781911; border-radius: 8px; overflow: hidden;">
                                                                            <div class="row mt-0 mb-3">
                                                                                <div class="col-lg-12">
                                                                                    <div class="modal-title" style="display: flex; flex-direction: row; align-items: center;">
                                                                                        <input type="radio" id="range_airway" name="range_waybillno" value="1" style="margin-right: 10px;"/>
                                                                                        <p style="margin: 0;">Generate a range of Air Waybill Numbers</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-lg-12">
                                                                                    <div class="mb-3 ms-3 form-group">
                                                                                        <label class="form-label">Start at</label>
                                                                                        <input type="text" class="form-control" placeholder="00000000" id="start_awb_number_range" name="start_awb_number_range" value="{{ @$data['chargeData']->start_awb_numbers }}" >
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-lg-12">
                                                                                    <div class="mb-3 ms-3 form-group">
                                                                                        <label class="form-label">End at</label>
                                                                                        <input type="text" class="form-control" placeholder="" id="end_awb_number_range" name="end_awb_number_range" value="{{ @$data['chargeData']->end_awb_numbers }}" >
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12" style="display: inline-block; padding: 10px; float: left; width: 100%; background: #ffffff; margin-top: 12px; box-shadow: 0 0 5px #781911; border-radius: 8px; overflow: hidden;">
                                                                            <div class="row mt-0 mb-3">
                                                                                <div class="col-lg-12">
                                                                                    <div class="modal-title" style="display: flex; flex-direction: row; align-items: center;">
                                                                                        <input type="radio" id="range_airway" name="range_waybillno" value="2" style="margin-right: 10px;"/>
                                                                                        <p style="margin: 0;">Generate an amount of Air Waybill Numbers</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-lg-12">
                                                                                    <div class="mb-3 ms-3 form-group">
                                                                                        <label class="form-label">Start at</label>
                                                                                        <input type="text" class="form-control" placeholder="00000000" id="start_awb_number_amount" name="start_awb_number_amount" value="{{ @$data['chargeData']->start_awb_numbers }}" readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-lg-12">
                                                                                    <div class="mb-3 ms-3 form-group">
                                                                                        <label class="form-label">End at</label>
                                                                                        <input type="text" class="form-control" placeholder="" id="end_awb_number_amount" name="end_awb_number_amount" value="{{ @$data['chargeData']->end_awb_numbers }}" readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="check_digit" style="display: inline-block; float: none; width: 100%; margin-top: 20px;">
                                                                            <input type="checkbox" name="check_digit" id="check_digit" style="display: inline-block; float: left; margin-right: 10px; margin-top: 4px;">
                                                                            <p> Check Digit</p>
                                                                        </div>
                                                                        <div class="row mt-3" style="display: inline-block;">
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-3 ms-3 form-group">
                                                                                    <label class="form-label">&nbsp;</label>
                                                                                    <button class="btn btn-primary" type="submit" name="submit" value="customCharge">Submit</button>
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
                                                            @if (empty(Session::has('hts_rate_id')))
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
                                                                <th width="50">#</th>
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
                                                                                onclick="deleteHtsRateGroundTabData({{ $row_val->id }});">
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
                                                        <h5 class="modal-title" id="addcontactdetails">Carrier Rate-Ground</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="conModalClsRate" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <ul class="nav nav-tabs nav-tabs-cus" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-bs-toggle="tab" href="#rgeneral" id="rgeneral_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                            <span class="d-none d-sm-block">General</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('hts_rate_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#rpinfo" id="rpinfo_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Contract
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a {{ Session::has('hts_rate_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#rnotes" id="rnotes_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Notes
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content p-3 text-muted">
                                                                    <div class="tab-pane active" id="rgeneral" role="tabpanel">
                                                                        <form action="{{ route('createHtsRateGround') }}" class="custom-validation" method="post" id="formValidatedRateGround">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-lg-4 form-group">
                                                                                    <select class="form-control form-select select2" name="hts_rate_method" id="hts_rate_method">
                                                                                        <option value="">Choose...</option>
                                                                                        <option value="Air" {{'Air' == @$data['rateData']->hts_rate_method ? 'selected' : ''}}>Air Rate</option>
                                                                                        <option value="Ocean" {{'Ocean' == @$data['rateData']->hts_rate_method ? 'selected' : ''}}>Ocean Rate</option>
                                                                                        <option value="Ground" {{'Ground' == @$data['rateData']->hts_rate_method ? 'selected' : ''}}>Ground Rate</option>
                                                                                     </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row row-border-bottom mt-3 mb-3">
                                                                                <div class="col-lg-4">
                                                                                    <div class="mb-3 form-group">
                                                                                        <label class="form-label">Mode of Transportation</label>
                                                                                        <select class="form-control select2" name="transportation" id="transportation">
                                                                                            <option value="">Select...</option>
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
                                                                                            <option value="{{ @$data['userData']->id  }}" selected>{{ @$data['userData']->name." ".$data['title']  }}</option>
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
                                                                                    <div class="mb-3 form-group">
                                                                                        <button type="button" style="float: right;" data-bs-toggle="modal" data-bs-target=".bs-rate-modal-xl-qcr" id="bsratemodalxlqcr" class="btn btn-primary btn-sm waves-effect waves-light">
                                                                                        <i class="fas fa-plus"></i> Query Carrier Rates</button>
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
                                                                        <form action="{{ route('updateHtsRateContract') }}" class="custom-validation"
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
                                                                            <form action="{{ route('create-hts-rate-notes') }}" class="form-horizontal form" method="post" id="formValidatedBillingAddress2ndTab_4">
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
                                        <div class="modal fade bs-rate-modal-xl-qcr" id="myModalcarrierRate" role="dialog" aria-labelledby="addcontactdetails" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addcontactdetails">Query Carrier Rates</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="conModalClsRate" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <ul class="nav nav-tabs nav-tabs-cus" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-bs-toggle="tab" href="#crsimple" id="crsimple_nav" role="tab" aria-selected="true">
                                                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                                            <span class="d-none d-sm-block">Simple</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-bs-toggle="tab" href="#cradvance" id="cradvance_nav" role="tab" aria-selected="false">
                                                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                            <span class="d-none d-sm-block">Advance</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content p-3 text-muted">
                                                                    <div class="tab-pane show active" id="crsimple" role="tabpanel">
                                                                        <p id="errmsg" style="color: red;">* All fields are mandatory</p>
                                                                        <form action="{{ route('createHtssimplequerycarrierrates') }}" class="custom-validation qsrsmplform" method="post" id="formValidatedRateGround">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <label class="form-label">Query Type <span style="color:red">*</span></label>
                                                                                        <select class="form-control form-select" name="hts_query_typeqr" id="hts_query_typeqr">
                                                                                            <option value="">Choose One</option>
                                                                                            <option value="Sales" {{'Sales' == @$data['rateData']->hts_rate_method ? 'selected' : ''}}>Sales</option>
                                                                                            <option value="All" {{'All' == @$data['rateData']->hts_rate_method ? 'selected' : ''}}>All</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <label class="form-label">Mode of Transportation <span style="color:red">*</span></label>
                                                                                        <select class="form-control" name="hts_transportationqr" id="hts_transportationqr">
                                                                                            <option value="">Select...</option>
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
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <label class="form-label">Service Type <span style="color:red">*</span></label>
                                                                                        <select class="form-control" name="hts_service_typeqr" id="hts_service_typeqr">
                                                                                            <option value="">Choose One</option>
                                                                                            <option value="any">Any</option>
                                                                                            <option value="dtd">Door to Door</option>
                                                                                            <option value="dtp">Door to Port</option>
                                                                                            <option value="ptp">Port to Port</option>
                                                                                            <option value="ptd">Port to Door</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left;">
                                                                                        <label class="form-label">Frequency <span style="color:red">*</span></label>
                                                                                        <select class="form-control" name="hts_frequencyqr" id="hts_frequencyqr">
                                                                                            <option value="">Choose One</option>
                                                                                            <option value="other">Other</option>
                                                                                            <option value="daily">Daily</option>
                                                                                            <option value="weekly">Weekly</option>
                                                                                            <option value="biweekly">Biweekly</option>
                                                                                            <option value="monthly">Monthly</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <label class="form-label">Query Date <span style="color:red">*</span></label>
                                                                                        <input type="date" class="form-control" name="hts_query_dateqr" id="hts_query_dateqr" required="" placeholder="" value="">
                                                                                    </div>
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <label class="form-label">Carrier <span style="color:red">*</span></label>
                                                                                        <select class="form-select" aria-label="Default select example" name="hts_careerqr" id="hts_careerqr">
                                                                                            <option value="" selected="">Choose One</option>
                                                                                            @if (!empty($data['all_carriers_contact']))
                                                                                                @foreach ($data['all_carriers_contact'] as $key => $item_val)
                                                                                                <option value="{{ @$item_val->id }}" {{ @$item_val->id == @$data['contactData']->parent ? 'selected' : '' }}> {{ @$item_val->name." - ".@$item_val->entity_id }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-lg-6 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <div class="col-6" style="display: inline-block; float: left;">
                                                                                            <label class="form-label">Freight Service Class <span style="color:red">*</span></label>
                                                                                            <select class="form-control" name="hts_freight_service_classqr" id="hts_freight_service_classqr">
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
                                                                                        <!-- <div class="col-6" style="display: inline-block; float: left; margin-top: 30px; padding: 0 10px;">
                                                                                            <button class="btn btn-primary" value="rateGround">Select</button>
                                                                                        </div> -->
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <label class="form-label">Currency <span style="color:red">*</span></label>
                                                                                        <select name="hts_currencyqr" id="hts_currencyqr" class="form-select">
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
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <label class="form-label">Customer/Lead <span style="color:red">*</span></label>
                                                                                        <select class="form-control" name="hts_customerqr" id="hts_customerqr">
                                                                                            <option value="">Select Option <span style="color:red">*</span></option>
                                                                                            <optgroup label="Name / Entity ID / Type">
                                                                                            @php
                                                                                            $customer = DB::table('hts_users')->where('user_type', 3)->select('id','name','entity_id','parent_entity','user_type')->get();
                                                                                            @endphp
                                                                                            @if (!$customer->isEmpty())
                                                                                                @foreach ($customer as $key => $item_val_qr)
                                                                                                @php
                                                                                                $usertypesqr = DB::table('hts_user_types')->where('id', $item_val_qr->user_type)->select('name')->first();
                                                                                                @endphp
                                                                                                <option value="{{@$item_val_qr->id}}" {{@$item_val_qr->id == @$data['rateData']->transportation ? 'selected' : ''}}> {{@$item_val_qr->name." / ".@$item_val_qr->entity_id." / ".@$usertypesqr->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                            </optgroup>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-lg-6 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <div class="col-6" style="display: inline-block; float: left;">
                                                                                            <label class="form-label">Other Charges <span style="color:red">*</span></label>
                                                                                            <select class="form-control" name="hts_other_chargesqr" id="hts_other_chargesqr">
                                                                                                <option value="">Select Option</option>
                                                                                                <optgroup label="Description / Code / Account Name">
                                                                                                @php
                                                                                                $otherCharges = DB::table('charge_list')->where('status', '1')->select('id', 'code', 'account_name', 'description')->get();
                                                                                                @endphp
                                                                                                @if(!empty($otherCharges))
                                                                                                @foreach ($otherCharges as $key => $item_charge)
                                                                                                <option value="{{$item_charge->id}}" {{@$item_charge->id == @$data['rateData']->item_charge ? 'selected' : ''}}> {{@$item_charge->description." / ".@$item_charge->code." / ".@$item_charge->account_name}}</option>
                                                                                                @endforeach
                                                                                                @endif
                                                                                                </optgroup>
                                                                                            </select>
                                                                                        </div>
                                                                                        <!-- <div class="col-6" style="display: inline-block; float: left; margin-top: 30px; padding: 0 10px;">
                                                                                            <button class="btn btn-primary" value="rateGround">Select</button>
                                                                                        </div> -->
                                                                                    </div>
                                                                                </div>
                                                                                <hr style="margin-top: 20px;">
                                                                                <div class="col-12">
                                                                                    <div class="col-6" style="display: inline-block; float: left; border-right: 2px solid #666;">
                                                                                        <h4>Origin</h4>
                                                                                        <div class="col-lg-8 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                            <div class="col-9" style="display: inline-block; float: left;">
                                                                                                <label class="form-label">Port of lading <span style="color:red">*</span></label>
                                                                                                <select class="form-control form-select" name="hts_port_ladingqr" id="hts_port_ladingqr">
                                                                                                    <option value="">Choose One</option>
                                                                                                    @php
                                                                                                    $postList = DB::table('port_lists')->where('status', '1')->select('id', 'port_id', 'name')->get();
                                                                                                    @endphp
                                                                                                    @if(!empty($postList))
                                                                                                    @foreach ($postList as $key => $plist)
                                                                                                    <option value="{{$plist->id}}" {{@$plist->id == @$data['rateData']->port_ladingqr ? 'selected' : ''}}>{{@$plist->port_id." / ".@$plist->name}}</option>
                                                                                                    @endforeach
                                                                                                    @endif
                                                                                                </select>
                                                                                            </div>
                                                                                            <!-- <div class="col-3" style="display: inline-block; float: left; margin-top: 30px; padding: 0 10px;">
                                                                                                <button class="btn btn-primary" value="rateGround">Select</button>
                                                                                            </div> -->
                                                                                        </div>
                                                                                        <div class="col-lg-4 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                            <label class="form-label">Country <span style="color:red">*</span></label>
                                                                                            <select class="form-select" name="hts_origincountryqr" id="hts_origincountryqr">
                                                                                                <option value="" selected="">Select Country...</option>
                                                                                                @if (!$data['countries']->isEmpty())
                                                                                                @foreach ($data['countries'] as $key => $item_val)
                                                                                                <option value="{{@$item_val->id}}">{{@$item_val->name}}</option>
                                                                                                @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-lg-8 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                            <div class="col-9" style="display: inline-block; float: left;">
                                                                                                <label class="form-label">Place of Receipt <span style="color:red">*</span></label>
                                                                                                <select class="form-control form-select" name="hts_port_receiptqr" id="hts_port_receiptqr">
                                                                                                    <option value="">Choose One</option>
                                                                                                    @php
                                                                                                    $postList = DB::table('port_lists')->where('status', '1')->select('id', 'port_id', 'name')->get();
                                                                                                    @endphp
                                                                                                    @if(!empty($postList))
                                                                                                    @foreach ($postList as $key => $plist)
                                                                                                    <option value="{{$plist->id}}" {{@$plist->id == @$data['rateData']->port_ladingqr ? 'selected' : ''}}>{{@$plist->port_id." / ".@$plist->name}}</option>
                                                                                                    @endforeach
                                                                                                    @endif
                                                                                                </select>
                                                                                            </div>
                                                                                            <!-- <div class="col-3" style="display: inline-block; float: left; margin-top: 30px; padding: 0 10px;">
                                                                                                <button class="btn btn-primary" value="rateGround">Select</button>
                                                                                            </div> -->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6" style="display: inline-block; padding: 0px 0px 0px 10px;">
                                                                                        <h4>Destination</h4>
                                                                                        <div class="col-lg-8 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                            <div class="col-9" style="display: inline-block; float: left;">
                                                                                                <label class="form-label">Port of Unlading <span style="color:red">*</span></label>
                                                                                                <select class="form-control form-select" name="hts_port_unladingqr" id="hts_port_unladingqr">
                                                                                                    <option value="">Choose One</option>
                                                                                                    @php
                                                                                                    $postList = DB::table('port_lists')->where('status', '1')->select('id', 'port_id', 'name')->get();
                                                                                                    @endphp
                                                                                                    @if(!empty($postList))
                                                                                                    @foreach ($postList as $key => $plist)
                                                                                                    <option value="{{$plist->id}}" {{@$plist->id == @$data['rateData']->port_unladingqr ? 'selected' : ''}}>{{@$plist->port_id." / ".@$plist->name}}</option>
                                                                                                    @endforeach
                                                                                                    @endif
                                                                                                </select>
                                                                                            </div>
                                                                                            <!-- <div class="col-3" style="display: inline-block; float: left; margin-top: 30px; padding: 0 10px;">
                                                                                                <button class="btn btn-primary" value="rateGround">Select</button>
                                                                                            </div> -->
                                                                                        </div>
                                                                                        <div class="col-lg-4 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                            <label class="form-label">Country <span style="color:red">*</span></label>
                                                                                            <select class="form-select" name="hts_destinationcountryqr" id="hts_destinationcountryqr">
                                                                                                <option value="" selected="">Choose Country</option>
                                                                                                @if (!$data['countries']->isEmpty())
                                                                                                @foreach ($data['countries'] as $key => $item_val)
                                                                                                <option value="{{@$item_val->id}}">{{@$item_val->name}}</option>
                                                                                                @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-lg-8 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                            <div class="col-9" style="display: inline-block; float: left;">
                                                                                                <label class="form-label">Place of Delivery <span style="color:red">*</span></label>
                                                                                                <select class="form-control form-select" name="hts_port_deliveryladingqr" id="hts_port_deliveryladingqr">
                                                                                                    <option value="">Choose One</option>
                                                                                                    @php
                                                                                                    $postList = DB::table('port_lists')->where('status', '1')->select('id', 'port_id', 'name')->get();
                                                                                                    @endphp
                                                                                                    @if(!empty($postList))
                                                                                                    @foreach ($postList as $key => $plist)
                                                                                                    <option value="{{$plist->id}}" {{@$plist->id == @$data['rateData']->port_ladingqr ? 'selected' : ''}}>{{@$plist->port_id." / ".@$plist->name}}</option>
                                                                                                    @endforeach
                                                                                                    @endif
                                                                                                </select>
                                                                                            </div>
                                                                                            <!-- <div class="col-3" style="display: inline-block; float: left; margin-top: 30px; padding: 0 10px;">
                                                                                                <button class="btn btn-primary" value="rateGround">Select</button>
                                                                                            </div> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr style="margin-top: 20px;">
                                                                                <div class="col-12">
                                                                                    <div class="col-6" style="display: inline-block;">
                                                                                        <div class="col-3" style="display: inline-block; float: left;">
                                                                                            <h4>Cargo</h4>
                                                                                        </div>
                                                                                        <div class="col-3" style="display: inline-block; float: left;">
                                                                                            <input type="checkbox" name="hts_containerizedqr" id="hts_containerizedqr" style="display: inline-block; float: left; margin-top: 3px; margin-right: 5px;">
                                                                                            <p style="display: inline-block; float: left;">Containerized</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12" style="display: inline-block">
                                                                                        <div class="col-2" style="display: inline-block; float: left;">
                                                                                            <label>Pieces <span style="color:red">*</span></label>
                                                                                            <input type="text" class="form-control" name="hts_piecesqr" id="hts_piecesqr" required="" placeholder="Pieces (Exp: 1000)" value="">
                                                                                        </div>
                                                                                        <div class="col-5" style="display: flex;float: left;flex-direction: row;align-items: center;flex-wrap: nowrap;justify-content: center;">
                                                                                            <div class="col-5">
                                                                                                <label>Weight <span style="color:red">*</span></label>
                                                                                                <input type="text" class="form-control" name="hts_weightqr" id="hts_weightqr" required="" placeholder="Weight (0.00)" value="">
                                                                                            </div>
                                                                                            <div class="col-6" style="margin: 0px 0px 0px 10px;">
                                                                                                <label>Unit <span style="color:red">*</span></label>
                                                                                                <select class="form-control form-select" name="hts_weight_unitqr" id="hts_weight_unitqr">
                                                                                                    <option value="">Choose an option</option>
                                                                                                    <option value="kilogram">Kilogram (kg)</option>
                                                                                                    <option value="gram">Gram (g)</option>
                                                                                                    <option value="ton">Ton (t)</option>
                                                                                                    <option value="pound">Pound (lb)</option>
                                                                                                    <option value="ounce">Ounce (oz)</option>
                                                                                                    <option value="troyounce">Troy Ounce (ozt)</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5" style="display: flex;float: left;flex-direction: row;align-items: center;flex-wrap: nowrap;justify-content: center;">
                                                                                            <div class="col-5">
                                                                                                <label>Volume <span style="color:red">*</span></label>
                                                                                                <input type="text" class="form-control" name="hts_volumeqr" id="hts_volumeqr" required="" placeholder="0.00" value="">
                                                                                            </div>
                                                                                            <div class="col-6" style="margin: 0px 0px 0px 10px;">
                                                                                                <label>Unit <span style="color:red">*</span></label>
                                                                                                <select class="form-control form-select" name="hts_volume_unitqr" id="hts_volume_unitqr">
                                                                                                    <option value="">Choose an option</option>
                                                                                                    <option value="cubic_inch">Cubic inch (in³)</option>
                                                                                                    <option value="cubic_foot">Cubic foot (ft³)</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12" style="display: inline-block;">
                                                                                        <label>Description/Comodity <span style="color:red">*</span></label>
                                                                                        <select class="form-select mb-3" name="hts_carrier_commodityqr" id="hts_carrier_commodityqr" aria-label="Default select example">
                                                                                            <option value="">Choose an option</option>
                                                                                            @if (!$data['carrier_commodity']->isEmpty())
                                                                                            @foreach ($data['carrier_commodity'] as $key => $item_val_t4)
                                                                                            <option value="{{ @$item_val_t4->name }}" {{ @$item_val_t4->name == @$data['rateData']->carrier_commodity ? 'selected' : '' }}>{{ @$item_val_t4->name }}</option>
                                                                                            @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div style="text-align: center; margin-top: 15px;">
                                                                                <button class="btn btn-primary" type="button" name="submit" id="hts_carrierrates">Submit</button>
                                                                                <input type="hidden" id="query_tabqr" name="query_tabqr" value="simple">
                                                                            </div>
                                                                            <p id="successmsg" style="color: green">Record saved successfully.</p>
                                                                        </form>
                                                                    </div>
                                                                    <div class="tab-pane" id="cradvance" role="tabpanel">
                                                                        <p id="errmsgadvn" style="color: red;">* All fields are mandatory</p>
                                                                        <form action="{{ route('createHtsadvquerycarrierrates') }}" class="custom-validation qsradvncform" method="post" id="formValidatedBillingAddress2ndTab_3">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <label class="form-label">Query Type</label>
                                                                                        <select class="form-control form-select" name="query_typeadvncqr" id="query_typeadvncqr">
                                                                                            <option value="">Choose One</option>
                                                                                            <option value="Sales" {{'Sales' == @$data['rateData']->hts_rate_method ? 'selected' : ''}}>Sales</option>
                                                                                            <option value="All" {{'All' == @$data['rateData']->hts_rate_method ? 'selected' : ''}}>All</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <label class="form-label">Customer/Lead</label>
                                                                                        <select class="form-control" name="customeradvncqr" id="customeradvncqr">
                                                                                            <option value="">Select Option</option>
                                                                                            <optgroup label="Name / Entity ID / Type">
                                                                                            @php
                                                                                            $customer = DB::table('hts_users')->where('user_type', 3)->select('id','name','entity_id','parent_entity','user_type')->get();
                                                                                            @endphp
                                                                                            @if (!$customer->isEmpty())
                                                                                                @foreach ($customer as $key => $item_val_qr)
                                                                                                @php
                                                                                                $usertypesqr = DB::table('hts_user_types')->where('id', $item_val_qr->user_type)->select('name')->first();
                                                                                                @endphp
                                                                                                <option value="{{@$item_val_qr->id}}" {{@$item_val_qr->id == @$data['rateData']->transportation ? 'selected' : ''}}> {{@$item_val_qr->name." / ".@$item_val_qr->entity_id." / ".@$usertypesqr->name }}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                            </optgroup>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <label class="form-label">Mode of Transportation</label>
                                                                                        <select class="form-control" name="transportationadvncqr" id="transportationadvncqr">
                                                                                            <option value="">Choose Once</option>
                                                                                            <optgroup label="Description / Method / Code">
                                                                                                @if (!$data['transportation']->isEmpty())
                                                                                                @foreach ($data['transportation'] as $key => $item_val_t)
                                                                                                <option value="{{ @$item_val_t->id }}" {{ @$item_val_t->id == @$data['rateData']->transportation ? 'selected' : '' }}>{{ @$item_val_t->description." / ".@$item_val_t->method." / ".@$item_val_t->code }}</option>
                                                                                                @endforeach
                                                                                                @endif
                                                                                            </optgroup>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-lg-3 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                        <label class="form-label">Service Type</label>
                                                                                        <select class="form-control" name="servicetypeadvncqr" id="servicetypeadvncqr">
                                                                                            <option value="">Choose One</option>
                                                                                            <option value="any">Any</option>
                                                                                            <option value="dtd">Door to Door</option>
                                                                                            <option value="dtp">Door to Port</option>
                                                                                            <option value="ptp">Port to Port</option>
                                                                                            <option value="ptd">Port to Door</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <hr style="margin-top: 20px;">
                                                                                <div class="col-12">
                                                                                    <div class="col-6" style="display: inline-block; float: left; border-right: 2px solid #666;">
                                                                                        <h4>Origin</h4>
                                                                                        <div class="col-lg-6 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                            <label class="form-label">Place of Receipt</label>
                                                                                            <select class="form-control form-select" name="port_receiptadvncqr" id="port_receiptadvncqr">
                                                                                                <option value="">Choose One</option>
                                                                                                @php
                                                                                                $postList = DB::table('port_lists')->where('status', '1')->select('id', 'port_id', 'name')->get();
                                                                                                @endphp
                                                                                                @if(!empty($postList))
                                                                                                @foreach ($postList as $key => $plist)
                                                                                                <option value="{{$plist->id}}" {{@$plist->id == @$data['rateData']->port_ladingqr ? 'selected' : ''}}>{{@$plist->port_id." / ".@$plist->name}}</option>
                                                                                                @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-lg-6 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                            <label class="form-label">Port of lading</label>
                                                                                            <select class="form-control form-select" name="port_ladingadvncqr" id="port_ladingadvncqr">
                                                                                                <option value="">Choose One</option>
                                                                                                @php
                                                                                                $postList = DB::table('port_lists')->where('status', '1')->select('id', 'port_id', 'name')->get();
                                                                                                @endphp
                                                                                                @if(!empty($postList))
                                                                                                @foreach ($postList as $key => $plist)
                                                                                                <option value="{{$plist->id}}" {{@$plist->id == @$data['rateData']->port_ladingqr ? 'selected' : ''}}>{{@$plist->port_id." / ".@$plist->name}}</option>
                                                                                                @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6" style="display: inline-block; padding: 0px 0px 0px 10px;">
                                                                                        <h4>Destination</h4>
                                                                                        <div class="col-lg-6 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                            <label class="form-label">Port of Unlading</label>
                                                                                            <select class="form-control form-select" name="port_unladingadvncqr" id="port_unladingadvncqr">
                                                                                                <option value="">Choose One</option>
                                                                                                @php
                                                                                                $postList = DB::table('port_lists')->where('status', '1')->select('id', 'port_id', 'name')->get();
                                                                                                @endphp
                                                                                                @if(!empty($postList))
                                                                                                @foreach ($postList as $key => $plist)
                                                                                                <option value="{{$plist->id}}" {{@$plist->id == @$data['rateData']->port_unladingqr ? 'selected' : ''}}>{{@$plist->port_id." / ".@$plist->name}}</option>
                                                                                                @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-lg-6 form-group" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                                                                            <label class="form-label">Place of Delivery</label>
                                                                                            <select class="form-control form-select" name="port_deliveryladingadvncqr" id="port_deliveryladingadvncqr">
                                                                                                <option value="">Choose One</option>
                                                                                                @php
                                                                                                $postList = DB::table('port_lists')->where('status', '1')->select('id', 'port_id', 'name')->get();
                                                                                                @endphp
                                                                                                @if(!empty($postList))
                                                                                                @foreach ($postList as $key => $plist)
                                                                                                <option value="{{$plist->id}}" {{@$plist->id == @$data['rateData']->port_ladingqr ? 'selected' : ''}}>{{@$plist->port_id." / ".@$plist->name}}</option>
                                                                                                @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr style="margin-top: 20px;">
                                                                                <div class="col-12">
                                                                                    <div class="col-6" style="display: inline-block;">
                                                                                        <div class="col-3" style="display: inline-block; float: left;">
                                                                                            <h4>Cargo</h4>
                                                                                        </div>
                                                                                        <div class="col-3" style="display: inline-block; float: left;">
                                                                                            <input type="checkbox" name="containerizedadvncqr" id="containerizedadvncqr" style="display: inline-block; float: left; margin-top: 3px; margin-right: 5px;">
                                                                                            <p style="display: inline-block; float: left;">Containerized</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12" style="display: inline-block">
                                                                                        <div class="col-2" style="display: inline-block; float: left;">
                                                                                            <label>Pieces</label>
                                                                                            <input type="text" class="form-control" name="piecesadvncqr" id="piecesadvncqr" required="" placeholder="Pieces (Exp: 1000)" value="">
                                                                                        </div>
                                                                                        <div class="col-5" style="display: flex;float: left;flex-direction: row;align-items: center;flex-wrap: nowrap;justify-content: center;">
                                                                                            <div class="col-5">
                                                                                                <label>Weight</label>
                                                                                                <input type="text" class="form-control" name="weightadvncqr" id="weightadvncqr" required="" placeholder="Weight (0.00)" value="">
                                                                                            </div>
                                                                                            <div class="col-6" style="margin: 30px 0px 0px 10px;">
                                                                                                <select class="form-control form-select" name="weight_unitadvncqr" id="weight_unitadvncqr">
                                                                                                    <option value="">Choose an option</option>
                                                                                                    <option value="kilogram">Kilogram (kg)</option>
                                                                                                    <option value="gram">Gram (g)</option>
                                                                                                    <option value="ton">Ton (t)</option>
                                                                                                    <option value="pound">Pound (lb)</option>
                                                                                                    <option value="ounce">Ounce (oz)</option>
                                                                                                    <option value="troyounce">Troy Ounce (ozt)</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5" style="display: flex;float: left;flex-direction: row;align-items: center;flex-wrap: nowrap;justify-content: center;">
                                                                                            <div class="col-5">
                                                                                                <label>Volume</label>
                                                                                                <input type="text" class="form-control" name="volumeadvncqr" id="volumeadvncqr" required="" placeholder="0.00" value="">
                                                                                            </div>
                                                                                            <div class="col-6" style="margin: 30px 0px 0px 10px;">
                                                                                                <select class="form-control form-select" name="volume_unitadvncqr" id="volume_unitadvncqr">
                                                                                                    <option value="">Choose an option</option>
                                                                                                    <option value="cubic_inch">Cubic inch (in³)</option>
                                                                                                    <option value="cubic_foot">Cubic foot (ft³)</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-0 float-end" style="width: 100%;display: flex;justify-content: center;margin-top: 20px;">
                                                                                <div>
                                                                                    <button type="button" name="submit" value="saveDOB" class="btn btn-primary waves-effect waves-light me-1" id="hts_advcarrierrates">Save</button>
                                                                                    <input type="hidden" name="query_tabqr" id="query_tabqr" value="advance">
                                                                                </div>
                                                                            </div>
                                                                            <p id="successmsgadvn" style="color: green">Record saved successfully.</p>
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
                                </div>
                                <div class="tab-pane " id="charges" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-3">Charge lists
                                                    <button type="button" style="float: right;" data-bs-toggle="modal" data-bs-target=".bs-charge-modal-xl"
                                                        class="btn btn-primary btn-sm waves-effect waves-light">
                                                        <i class="fas fa-plus"></i>
                                                        @if (empty(Session::has('hts_charge_id')))
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
                                                                            onclick="deleteHtsChargeTabData({{ $row_val->id }});">
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
                                                                            <a {{ Session::has('hts_charge_id') ? '' : 'disabled' }} class="nav-link" data-bs-toggle="tab" href="#chinfo" id="chinfo_nav" role="tab" aria-selected="false">
                                                                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                                <span class="d-none d-sm-block">Automatic Creation
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="tab-content p-3 text-muted">
                                                                        <div class="tab-pane active" id="chgeneral" role="tabpanel">
                                                                            <form action="{{ route('createHtsCustomCharge') }}" class="custom-validation" method="post"
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
                                                                            <form action="{{ route('createHtsCustomChargeAutoCreation') }}" class="custom-validation" method="post"
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
                                                                                    $hts_charge_id = Session::get('hts_charge_id');
                                                                                    if(!empty($hts_charge_id)) {
                                                                                        $carrier_auto_creation = DB::table('hts_auto_creation')->where('charge_id', @$hts_charge_id)->orderBy('id', 'desc')->get();
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
                                        <div class=" mb-3">
                                            <h4 class="card-title mb-3">Payment Terms <hr></h4>
                                        </div>
                                        <form action="{{ route('updatePmtData') }}" method="post" id="formValidatedPMT">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Terms<code>*</code></label>
                                                <div class="col-sm-5 form-group">
                                                    <select class="form-select select2" name="pmt_master_terms" aria-label="Default select example">
                                                        <option value="">Choose...</option>
                                                        <optgroup label="Description / Due Days / Discount pe... / Discount Days / Inactive">
                                                            @if (!empty($data['pmt_master_terms']))
                                                                @foreach ($data['pmt_master_terms'] as $key => $itm)
                                                                @php
                                                                    $status = $itm->status == '0' ? 'No' : 'Yes';
                                                                @endphp
                                                                    <option value="{{ @$itm->id }}"
                                                                        {{ @$itm->id == @$data['userData']->pmt_master_terms ? 'selected' : '' }}>
                                                                        {{ @$itm->description." / ".@$itm->due_days." / ".@$itm->discount_pe." / ".@$itm->discount_days." / ".@$status }}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">The common type of payment is:<code>*</code></label>
                                                <div class="col-sm-5 form-group">
                                                    <select class="form-select select2" name="pmt_common_type_payment" aria-label="Default select example">
                                                        <option value="">Choose...</option>
                                                        <option value="Prepaid" {{ 'Prepaid' == @$data['userData']->pmt_common_type_payment ? 'selected' : '' }}>Prepaid</option>
                                                        <option value="Collect" {{ 'Collect' == @$data['userData']->pmt_common_type_payment ? 'selected' : '' }}>Collect</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Incoterms:<code>*</code></label>
                                                <div class="col-sm-5 form-group">
                                                    <select class="form-select select2" name="pmt_incoterms" aria-label="Default select example">
                                                        <option value="">Choose...</option>
                                                        <optgroup label="Code / Description">
                                                            <option value="CFR / Cost and Freight" {{ 'CFR / Cost and Freight' == @$data['userData']->pmt_incoterms ? 'selected' : '' }}>CFR / Cost and Freight</option>
                                                            <option value="CIF / Cost insurance and Freight" {{ 'CIF / Cost insurance and Freight' == @$data['userData']->pmt_incoterms ? 'selected' : '' }}>CIF / Cost insurance and Freight</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Preferred Currency:<code>*</code></label>
                                                <div class="col-sm-5 form-group">
                                                    <select name="pmt_currency" class="form-select select2">
                                                        <option value="USD" {{ 'USD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>USD United States Dollar</option>
                                                        <option value="EUR" {{ 'EUR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>EUR Euro</option>
                                                        <option value="JPY" {{ 'JPY' == @$data['userData']->pmt_currency ? 'selected' : '' }}>JPY Japanese Yen</option>
                                                        <option value="GBP" {{ 'GBP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>GBP British Pound</option>
                                                        <option disabled>──────────</option>
                                                        <option value="AED" {{ 'AED' == @$data['userData']->pmt_currency ? 'selected' : '' }}>AED United Arab Emirates dirham</option>
                                                        <option value="AFN" {{ 'AFN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>AFN Afghan afghani</option>
                                                        <option value="ALL" {{ 'ALL' == @$data['userData']->pmt_currency ? 'selected' : '' }}>ALL Albanian lek</option>
                                                        <option value="AMD" {{ 'AMD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>AMD Armenian dram</option>
                                                        <option value="ANG" {{ 'ANG' == @$data['userData']->pmt_currency ? 'selected' : '' }}>ANG Netherlands Antillean guilder</option>
                                                        <option value="AOA" {{ 'AOA' == @$data['userData']->pmt_currency ? 'selected' : '' }}>AOA Angolan kwanza</option>
                                                        <option value="ARS" {{ 'ARS' == @$data['userData']->pmt_currency ? 'selected' : '' }}>ARS Argentine peso</option>
                                                        <option value="AUD" {{ 'AUD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>AUD Australian dollar</option>
                                                        <option value="AWG" {{ 'AWG' == @$data['userData']->pmt_currency ? 'selected' : '' }}>AWG Aruban florin</option>
                                                        <option value="AZN" {{ 'AZN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>AZN Azerbaijani manat</option>
                                                        <option value="BAM" {{ 'BAM' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BAM Bosnia and Herzegovina convertible mark</option>
                                                        <option value="BBD" {{ 'BBD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BBD Barbadian dollar</option>
                                                        <option value="BDT" {{ 'BDT' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BDT Bangladeshi taka</option>
                                                        <option value="BGN" {{ 'BGN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BGN Bulgarian lev</option>
                                                        <option value="BHD" {{ 'BHD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BHD Bahraini dinar</option>
                                                        <option value="BIF" {{ 'BIF' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BIF Burundian franc</option>
                                                        <option value="BMD" {{ 'BMD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BMD Bermudian dollar</option>
                                                        <option value="BND" {{ 'BND' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BND Brunei dollar</option>
                                                        <option value="BOB" {{ 'BOB' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BOB Bolivian boliviano</option>
                                                        <option value="BRL" {{ 'BRL' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BRL Brazilian real</option>
                                                        <option value="BSD" {{ 'BSD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BSD Bahamian dollar</option>
                                                        <option value="BTN" {{ 'BTN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BTN Bhutanese ngultrum</option>
                                                        <option value="BWP" {{ 'BWP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BWP Botswana pula</option>
                                                        <option value="BYN" {{ 'BYN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BYN Belarusian ruble</option>
                                                        <option value="BZD" {{ 'BZD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>BZD Belize dollar</option>
                                                        <option value="CAD" {{ 'CAD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>CAD Canadian dollar</option>
                                                        <option value="CDF" {{ 'CDF' == @$data['userData']->pmt_currency ? 'selected' : '' }}>CDF Congolese franc</option>
                                                        <option value="CHF" {{ 'CHF' == @$data['userData']->pmt_currency ? 'selected' : '' }}>CHF Swiss franc</option>
                                                        <option value="CLP" {{ 'CLP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>CLP Chilean peso</option>
                                                        <option value="CNY" {{ 'CNY' == @$data['userData']->pmt_currency ? 'selected' : '' }}>CNY Chinese yuan</option>
                                                        <option value="COP" {{ 'COP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>COP Colombian peso</option>
                                                        <option value="CRC" {{ 'CRC' == @$data['userData']->pmt_currency ? 'selected' : '' }}>CRC Costa Rican colón</option>
                                                        <option value="CUC" {{ 'CUC' == @$data['userData']->pmt_currency ? 'selected' : '' }}>CUC Cuban convertible peso</option>
                                                        <option value="CUP" {{ 'CUP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>CUP Cuban peso</option>
                                                        <option value="CVE" {{ 'CVE' == @$data['userData']->pmt_currency ? 'selected' : '' }}>CVE Cape Verdean escudo</option>
                                                        <option value="CZK" {{ 'CZK' == @$data['userData']->pmt_currency ? 'selected' : '' }}>CZK Czech koruna</option>
                                                        <option value="DJF" {{ 'DJF' == @$data['userData']->pmt_currency ? 'selected' : '' }}>DJF Djiboutian franc</option>
                                                        <option value="DKK" {{ 'DKK' == @$data['userData']->pmt_currency ? 'selected' : '' }}>DKK Danish krone</option>
                                                        <option value="DOP" {{ 'DOP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>DOP Dominican peso</option>
                                                        <option value="DZD" {{ 'DZD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>DZD Algerian dinar</option>
                                                        <option value="EGP" {{ 'EGP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>EGP Egyptian pound</option>
                                                        <option value="ERN" {{ 'ERN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>ERN Eritrean nakfa</option>
                                                        <option value="ETB" {{ 'ETB' == @$data['userData']->pmt_currency ? 'selected' : '' }}>ETB Ethiopian birr</option>
                                                        <option value="EUR" {{ 'EUR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>EUR EURO</option>
                                                        <option value="FJD" {{ 'FJD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>FJD Fijian dollar</option>
                                                        <option value="FKP" {{ 'FKP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>FKP Falkland Islands pound</option>
                                                        <option value="GBP" {{ 'GBP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>GBP British pound</option>
                                                        <option value="GEL" {{ 'GEL' == @$data['userData']->pmt_currency ? 'selected' : '' }}>GEL Georgian lari</option>
                                                        <option value="GGP" {{ 'GGP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>GGP Guernsey pound</option>
                                                        <option value="GHS" {{ 'GHS' == @$data['userData']->pmt_currency ? 'selected' : '' }}>GHS Ghanaian cedi</option>
                                                        <option value="GIP" {{ 'GIP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>GIP Gibraltar pound</option>
                                                        <option value="GMD" {{ 'GMD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>GMD Gambian dalasi</option>
                                                        <option value="GNF" {{ 'GNF' == @$data['userData']->pmt_currency ? 'selected' : '' }}>GNF Guinean franc</option>
                                                        <option value="GTQ" {{ 'GTQ' == @$data['userData']->pmt_currency ? 'selected' : '' }}>GTQ Guatemalan quetzal</option>
                                                        <option value="GYD" {{ 'GYD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>GYD Guyanese dollar</option>
                                                        <option value="HKD" {{ 'HKD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>HKD Hong Kong dollar</option>
                                                        <option value="HNL" {{ 'HNL' == @$data['userData']->pmt_currency ? 'selected' : '' }}>HNL Honduran lempira</option>
                                                        <option value="HRK" {{ 'HRK' == @$data['userData']->pmt_currency ? 'selected' : '' }}>HRK Croatian kuna</option>
                                                        <option value="HTG" {{ 'HTG' == @$data['userData']->pmt_currency ? 'selected' : '' }}>HTG Haitian gourde</option>
                                                        <option value="HUF" {{ 'HUF' == @$data['userData']->pmt_currency ? 'selected' : '' }}>HUF Hungarian forint</option>
                                                        <option value="IDR" {{ 'IDR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>IDR Indonesian rupiah</option>
                                                        <option value="ILS" {{ 'ILS' == @$data['userData']->pmt_currency ? 'selected' : '' }}>ILS Israeli new shekel</option>
                                                        <option value="IMP" {{ 'IMP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>IMP Manx pound</option>
                                                        <option value="INR" {{ 'INR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>INR Indian rupee</option>
                                                        <option value="IQD" {{ 'IQD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>IQD Iraqi dinar</option>
                                                        <option value="IRR" {{ 'IRR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>IRR Iranian rial</option>
                                                        <option value="ISK" {{ 'ISK' == @$data['userData']->pmt_currency ? 'selected' : '' }}>ISK Icelandic króna</option>
                                                        <option value="JEP" {{ 'JEP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>JEP Jersey pound</option>
                                                        <option value="JMD" {{ 'JMD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>JMD Jamaican dollar</option>
                                                        <option value="JOD" {{ 'JOD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>JOD Jordanian dinar</option>
                                                        <option value="JPY" {{ 'JPY' == @$data['userData']->pmt_currency ? 'selected' : '' }}>JPY Japanese yen</option>
                                                        <option value="KES" {{ 'KES' == @$data['userData']->pmt_currency ? 'selected' : '' }}>KES Kenyan shilling</option>
                                                        <option value="KGS" {{ 'KGS' == @$data['userData']->pmt_currency ? 'selected' : '' }}>KGS Kyrgyzstani som</option>
                                                        <option value="KHR" {{ 'KHR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>KHR Cambodian riel</option>
                                                        <option value="KID" {{ 'KID' == @$data['userData']->pmt_currency ? 'selected' : '' }}>KID Kiribati dollar</option>
                                                        <option value="KMF" {{ 'KMF' == @$data['userData']->pmt_currency ? 'selected' : '' }}>KMF Comorian franc</option>
                                                        <option value="KPW" {{ 'KPW' == @$data['userData']->pmt_currency ? 'selected' : '' }}>KPW North Korean won</option>
                                                        <option value="KRW" {{ 'KRW' == @$data['userData']->pmt_currency ? 'selected' : '' }}>KRW South Korean won</option>
                                                        <option value="KWD" {{ 'KWD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>KWD Kuwaiti dinar</option>
                                                        <option value="KYD" {{ 'KYD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>KYD Cayman Islands dollar</option>
                                                        <option value="KZT" {{ 'KZT' == @$data['userData']->pmt_currency ? 'selected' : '' }}>KZT Kazakhstani tenge</option>
                                                        <option value="LAK" {{ 'LAK' == @$data['userData']->pmt_currency ? 'selected' : '' }}>LAK Lao kip</option>
                                                        <option value="LBP" {{ 'LBP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>LBP Lebanese pound</option>
                                                        <option value="LKR" {{ 'LKR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>LKR Sri Lankan rupee</option>
                                                        <option value="LRD" {{ 'LRD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>LRD Liberian dollar</option>
                                                        <option value="LSL" {{ 'LSL' == @$data['userData']->pmt_currency ? 'selected' : '' }}>LSL Lesotho loti</option>
                                                        <option value="LYD" {{ 'LYD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>LYD Libyan dinar</option>
                                                        <option value="MAD" {{ 'MAD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MAD Moroccan dirham</option>
                                                        <option value="MDL" {{ 'MDL' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MDL Moldovan leu</option>
                                                        <option value="MGA" {{ 'MGA' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MGA Malagasy ariary</option>
                                                        <option value="MKD" {{ 'MKD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MKD Macedonian denar</option>
                                                        <option value="MMK" {{ 'MMK' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MMK Burmese kyat</option>
                                                        <option value="MNT" {{ 'MNT' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MNT Mongolian tögrög</option>
                                                        <option value="MOP" {{ 'MOP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MOP Macanese pataca</option>
                                                        <option value="MRU" {{ 'MRU' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MRU Mauritanian ouguiya</option>
                                                        <option value="MUR" {{ 'MUR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MUR Mauritian rupee</option>
                                                        <option value="MVR" {{ 'MVR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MVR Maldivian rufiyaa</option>
                                                        <option value="MWK" {{ 'MWK' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MWK Malawian kwacha</option>
                                                        <option value="MXN" {{ 'MXN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MXN Mexican peso</option>
                                                        <option value="MYR" {{ 'MYR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MYR Malaysian ringgit</option>
                                                        <option value="MZN" {{ 'MZN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>MZN Mozambican metical</option>
                                                        <option value="NAD" {{ 'NAD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>NAD Namibian dollar</option>
                                                        <option value="NGN" {{ 'NGN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>NGN Nigerian naira</option>
                                                        <option value="NIO" {{ 'NIO' == @$data['userData']->pmt_currency ? 'selected' : '' }}>NIO Nicaraguan córdoba</option>
                                                        <option value="NOK" {{ 'NOK' == @$data['userData']->pmt_currency ? 'selected' : '' }}>NOK Norwegian krone</option>
                                                        <option value="NPR" {{ 'NPR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>NPR Nepalese rupee</option>
                                                        <option value="NZD" {{ 'NZD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>NZD New Zealand dollar</option>
                                                        <option value="OMR" {{ 'OMR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>OMR Omani rial</option>
                                                        <option value="PAB" {{ 'PAB' == @$data['userData']->pmt_currency ? 'selected' : '' }}>PAB Panamanian balboa</option>
                                                        <option value="PEN" {{ 'PEN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>PEN Peruvian sol</option>
                                                        <option value="PGK" {{ 'PGK' == @$data['userData']->pmt_currency ? 'selected' : '' }}>PGK Papua New Guinean kina</option>
                                                        <option value="PHP" {{ 'PHP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>PHP Philippine peso</option>
                                                        <option value="PKR" {{ 'PKR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>PKR Pakistani rupee</option>
                                                        <option value="PLN" {{ 'PLN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>PLN Polish złoty</option>
                                                        <option value="PRB" {{ 'PRB' == @$data['userData']->pmt_currency ? 'selected' : '' }}>PRB Transnistrian ruble</option>
                                                        <option value="PYG" {{ 'PYG' == @$data['userData']->pmt_currency ? 'selected' : '' }}>PYG Paraguayan guaraní</option>
                                                        <option value="QAR" {{ 'QAR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>QAR Qatari riyal</option>
                                                        <option value="RON" {{ 'RON' == @$data['userData']->pmt_currency ? 'selected' : '' }}>RON Romanian leu</option>
                                                        <option value="RSD" {{ 'RSD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>RSD Serbian dinar</option>
                                                        <option value="RUB" {{ 'RUB' == @$data['userData']->pmt_currency ? 'selected' : '' }}>RUB Russian ruble</option>
                                                        <option value="RWF" {{ 'RWF' == @$data['userData']->pmt_currency ? 'selected' : '' }}>RWF Rwandan franc</option>
                                                        <option value="SAR" {{ 'SAR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>SAR Saudi riyal</option>
                                                        <option value="SEK" {{ 'SEK' == @$data['userData']->pmt_currency ? 'selected' : '' }}>SEK Swedish krona</option>
                                                        <option value="SGD" {{ 'SGD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>SGD Singapore dollar</option>
                                                        <option value="SHP" {{ 'SHP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>SHP Saint Helena pound</option>
                                                        <option value="SLL" {{ 'SLL' == @$data['userData']->pmt_currency ? 'selected' : '' }}>SLL Sierra Leonean leone</option>
                                                        <option value="SLS" {{ 'SLS' == @$data['userData']->pmt_currency ? 'selected' : '' }}>SLS Somaliland shilling</option>
                                                        <option value="SOS" {{ 'SOS' == @$data['userData']->pmt_currency ? 'selected' : '' }}>SOS Somali shilling</option>
                                                        <option value="SRD" {{ 'SRD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>SRD Surinamese dollar</option>
                                                        <option value="SSP" {{ 'SSP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>SSP South Sudanese pound</option>
                                                        <option value="STN" {{ 'STN' == @$data['userData']->pmt_currency ? 'selected' : '' }}>STN São Tomé and Príncipe dobra</option>
                                                        <option value="SYP" {{ 'SYP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>SYP Syrian pound</option>
                                                        <option value="SZL" {{ 'SZL' == @$data['userData']->pmt_currency ? 'selected' : '' }}>SZL Swazi lilangeni</option>
                                                        <option value="THB" {{ 'THB' == @$data['userData']->pmt_currency ? 'selected' : '' }}>THB Thai baht</option>
                                                        <option value="TJS" {{ 'TJS' == @$data['userData']->pmt_currency ? 'selected' : '' }}>TJS Tajikistani somoni</option>
                                                        <option value="TMT" {{ 'TMT' == @$data['userData']->pmt_currency ? 'selected' : '' }}>TMT Turkmenistan manat</option>
                                                        <option value="TND" {{ 'TND' == @$data['userData']->pmt_currency ? 'selected' : '' }}>TND Tunisian dinar</option>
                                                        <option value="TOP" {{ 'TOP' == @$data['userData']->pmt_currency ? 'selected' : '' }}>TOP Tongan paʻanga</option>
                                                        <option value="TRY" {{ 'TRY' == @$data['userData']->pmt_currency ? 'selected' : '' }}>TRY Turkish lira</option>
                                                        <option value="TTD" {{ 'TTD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>TTD Trinidad and Tobago dollar</option>
                                                        <option value="TVD" {{ 'TVD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>TVD Tuvaluan dollar</option>
                                                        <option value="TWD" {{ 'TWD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>TWD New Taiwan dollar</option>
                                                        <option value="TZS" {{ 'TZS' == @$data['userData']->pmt_currency ? 'selected' : '' }}>TZS Tanzanian shilling</option>
                                                        <option value="UAH" {{ 'UAH' == @$data['userData']->pmt_currency ? 'selected' : '' }}>UAH Ukrainian hryvnia</option>
                                                        <option value="UGX" {{ 'UGX' == @$data['userData']->pmt_currency ? 'selected' : '' }}>UGX Ugandan shilling</option>
                                                        <option value="USD" {{ 'USD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>USD United States dollar</option>
                                                        <option value="UYU" {{ 'UYU' == @$data['userData']->pmt_currency ? 'selected' : '' }}>UYU Uruguayan peso</option>
                                                        <option value="UZS" {{ 'UZS' == @$data['userData']->pmt_currency ? 'selected' : '' }}>UZS Uzbekistani soʻm</option>
                                                        <option value="VES" {{ 'VES' == @$data['userData']->pmt_currency ? 'selected' : '' }}>VES Venezuelan bolívar soberano</option>
                                                        <option value="VND" {{ 'VND' == @$data['userData']->pmt_currency ? 'selected' : '' }}>VND Vietnamese đồng</option>
                                                        <option value="VUV" {{ 'VUV' == @$data['userData']->pmt_currency ? 'selected' : '' }}>VUV Vanuatu vatu</option>
                                                        <option value="WST" {{ 'WST' == @$data['userData']->pmt_currency ? 'selected' : '' }}>WST Samoan tālā</option>
                                                        <option value="XAF" {{ 'XAF' == @$data['userData']->pmt_currency ? 'selected' : '' }}>XAF Central African CFA franc</option>
                                                        <option value="XCD" {{ 'XCD' == @$data['userData']->pmt_currency ? 'selected' : '' }}>XCD Eastern Caribbean dollar</option>
                                                        <option value="XOF" {{ 'XOF' == @$data['userData']->pmt_currency ? 'selected' : '' }}>XOF West African CFA franc</option>
                                                        <option value="XPF" {{ 'XPF' == @$data['userData']->pmt_currency ? 'selected' : '' }}>XPF CFP franc</option>
                                                        <option value="ZAR" {{ 'ZAR' == @$data['userData']->pmt_currency ? 'selected' : '' }}>ZAR South African rand</option>
                                                        <option value="ZMW" {{ 'ZMW' == @$data['userData']->pmt_currency ? 'selected' : '' }}>ZMW Zambian kwacha</option>
                                                        <option value="ZWB" {{ 'ZWB' == @$data['userData']->pmt_currency ? 'selected' : '' }}>ZWB Zimbabwean bonds</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">The Credit limit is:</label>
                                                <div class="col-sm-3 form-group">
                                                    <input class="form-control" name="pmt_credit_limit" type="number" value="{{ @$data['userData']->pmt_credit_limit }}" placeholder="0.00" id="pmt_credit_limit">
                                                </div>
                                                <label for="example-text-input" class="col-sm-1 col-form-label">USD</label>
                                                <div class="col-sm-3 form-group">
                                                    <div class="form-check form-group" style="margin-top:5px;">
                                                        <input class="form-check-input" type="checkbox" name="is_tax_exempt" {{ '1'==@$data['userData']->is_tax_exempt ?
                                                        'checked' : '' }} value="1" id="invalidCheckis_tax_exempt">
                                                        <label class="form-check-label" for="invalidCheckis_tax_exempt">
                                                            Is Tax Exempt
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Invoice Periodically</label>
                                                <div class="col-sm-5 form-group">
                                                    <select class="form-select select2" name="pmt_invoice_periodically" aria-label="Default select example">
                                                        <option value="">Choose...</option>
                                                        <option value="Use Default" {{ 'Use Default' == @$data['userData']->pmt_invoice_periodically ? 'selected' : '' }}>Use Default</option>
                                                        <option value="Never Apply" {{ 'Never Apply' == @$data['userData']->pmt_invoice_periodically ? 'selected' : '' }}>Never Apply</option>
                                                        <option value="Monthly" {{ 'Monthly' == @$data['userData']->pmt_invoice_periodically ? 'selected' : '' }}>Monthly</option>
                                                        <option value="Weekly" {{ 'Weekly' == @$data['userData']->pmt_invoice_periodically ? 'selected' : '' }}>Weekly</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class=" mb-3">
                                                <h4 class="card-title mb-3">TSA Compliance <hr></h4>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-1 col-form-label">&nbsp;</label>
                                                <div class="col-sm-5">
                                                    <div class="form-check form-group" style="margin-top:5px;">
                                                        <input class="form-check-input" type="checkbox" name="is_known_shipper" {{ '1'==@$data['userData']->is_known_shipper ?
                                                        'checked' : '' }} value="1" id="invalidCheckis_tax_exempt2">
                                                        <label class="form-check-label" for="invalidCheckis_tax_exempt2">
                                                            This entity is a known shipper
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-1 col-form-label">&nbsp;</label>
                                                <div class="col-sm-2">
                                                    <label for="example-text-input" class="col-form-label">Known shipper expiration date<code>*</code></label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="date" class="form-control" name="pmt_expiration"  id="pmt_expiration" value="{{ @$data['userData']->pmt_expiration  }}">
                                                </div>
                                            </div>
                                            <div class=" mb-3">
                                                <h4 class="card-title mb-3">Manage Online Payment Accounts <hr></h4>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">&nbsp;</label>
                                                <div class="col-sm-5">
                                                    <select class="form-select select2" name="online_payment_accounts" disabled aria-label="Default select example">
                                                        <option value="">Choose...</option>
                                                    </select>
                                                </div>
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
                                    </div>
                                </div>
                                <div class="tab-pane " id="personalInfoC" role="tabpanel">
                                    <div class="rates_main">
                                        <form action="{{ route('updatePersonalData') }}" method="post" id="formValidatedPsn">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 form-group">
                                                    <label>Country of Citizenship
                                                    </label>
                                                    <select class="form-select select2" aria-label="Default select example"
                                                        name="country_of_citizenship" id="country_of_citizenshipPer">
                                                        <option value="" selected="">Select Country...</option>
                                                        @if (!$data['countries']->isEmpty())
                                                            @foreach ($data['countries'] as $key => $item_val)
                                                                <option value="{{ @$item_val->id }}"
                                                                    {{ @$item_val->id == @$data['userData']->country_of_citizenship ? 'selected' : '' }}>
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
                                                    <input type="date" class="form-control" name="date_of_birth" required="" placeholder="" value="{{ @$data['userData']->date_of_birth }}">
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
                                </div>
                                <div class="tab-pane " id="attachments" role="tabpanel">
                                    <div class="rates_main">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title mb-3">Drop your file and attachment here.</h4>
                                                        <div>
                                                            <form action="{{ route('upload-hts-gallery-images') }}" class="form-horizontal form dropzone" method="post" id="formValidatedHtsGallery">
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
                                                                    <div id="htmlForHTS">
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
                                                                                           <button class="btn btn-xs btn-danger" onclick="deleteHtsMainListingImage({{ @$row->id }})"><i class="fas fa-trash-alt"></i></button>
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
                                        <form action="{{ route('addHtsNote') }}" class="custom-validation" method="post" id="formValidatedNotes">
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
                                                                            onclick="deleteHtsNote({{ $row->id }});">
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
                                                                                <form action="{{ route('saveHtsNote') }}" class="custom-validation"
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
                                        <form action="{{ route('updateMoreInfoData') }}" class="custom-validation"
                                            method="post" id="formValidatedMore">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 form-group">
                                                        <label>Date Of Birth<code>*</code></label>
                                                        <input type="date" class="form-control" name="date_of_birth" required="" placeholder="" value="{{ @$data['userData']->date_of_birth }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Customer Password/PIN<code>*</code></label>
                                                        <input type="text" class="form-control" name="password_pin" required=""
                                                            placeholder="Password/PIN" value="{{ @$data['userData']->password_pin }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Mailing Address<code>*</code></label>
                                                        <input type="text" class="form-control" name="mailing_address" required=""
                                                            placeholder="Mailing Address" value="{{ @$data['userData']->mailing_address }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Authorized to view info</label>
                                                        <select class="form-select select2" aria-label="Default select example"
                                                            name="authorized_person" id="authorized_person">
                                                            <option value="" selected="">Select person...</option>
                                                            @if (!empty($data['all_users']))
                                                                @foreach ($data['all_users'] as $key => $item_val)
                                                                    <option value="{{ @$item_val->id }}"
                                                                        {{ @$item_val->id == @$data['userData']->authorized_person ? 'selected' : '' }}>
                                                                        {{ @$item_val->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div>
                                                    <textarea style="border:0; color: #8ca3bd!important;" name="more_info" placeholder="More info" class="form-control" rows="3">{{ @$data['userData']->more_info }}</textarea>
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
        <div class="modal fade" id="otherserviceadd" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateHtsOtherAddress') }}" class="custom-validation" method="post" id="formValidatedOtherAddress">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Description<code>*</code></label>
                                <div>
                                    <textarea required="" name="other_description" class="form-control" rows="0"></textarea>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Contact Name<code>*</code></label>
                                <input type="text" name="other_contact_name" class="form-control" required="">
                            </div>
                            <div class="form-group mb-3">
                                <label>Phone<code>*</code></label>
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="text" name="other_contact_phone" class="form-control" required="">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="other_contact_phone_code" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" style="display: inline-block;">
                                <div class="col-6" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                    <div class="form-group mb-3">
                                        <label>FAX<code>*</code></label>
                                        <input type="text" name="other_contact_fax" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-6" style="  display: inline-block; padding: 0px 0px 0px 10px;">
                                    <div class="form-group mb-3">
                                        <label>Email<code>*</code></label>
                                        <input type="text" name="other_contact_email" class="form-control" required="">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group mb-3">
                                <label>Street & Number<code>*</code></label>
                                <div>
                                    <textarea required="" name="other_street_number" class="form-control" rows="0"></textarea>
                                </div>
                            </div>
                            <div class="col-12" style="display: inline-block;">
                                <div class="col-4" style="display: inline-block; float: left; padding: 0 10px 0 0;">
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
                                </div>
                                <div class="col-4" style="display: inline-block;float: left;padding: 0 0px 0 0px;">
                                    <div class="form-group mb-3">
                                        <label>State<code>*</code></label>
                                        <select class="form-select select2" name="other_state" id="other_state_html">
                                            <option value="" selected="">Select State...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4" style="display: inline-block;float: left;padding: 0 0px 0 10px;">
                                    <div class="form-group mb-3">
                                        <label>City<code>*</code></label>
                                        <input type="text" class="form-control" name="other_city" required="" placeholder="Type City" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" style="display: inline-block;">
                                <div class="col-6" style="display: inline-block; float: left; padding: 0 10px 0 0;">
                                    <div class="form-group mb-3">
                                        <label>Zip Code<code>*</code></label>
                                        <input type="text" class="form-control" name="other_zip_code" required="" placeholder="Type Zip Code" value="">
                                    </div>
                                </div>
                                <div class="col-6" style="display: inline-block; float: left;">
                                    <div class="form-group mb-3">
                                        <label>Port</label>
                                        <select class="form-select select2" name="other_port" aria-label="Default select example">
                                            <option value="" selected="">Select Port...</option>
                                            @if (!$data['ports']->isEmpty())
                                            @foreach ($data['ports'] as $key => $item_val_1)
                                            <option value="{{ @$item_val_1->name }}"> {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
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
        #output_image{height:67px;width:67px;padding:2px;border:1px solid #f15a24}
        .select2-container{display:block}
        .twitter-bs-wizard .twitter-bs-wizard-pager-link li.finish{float:right}
        .property-type iframe{width:100%;height:580px}
        .clear-btn{border:1px solid red;background:red;color:#fff;padding:10px 20px;border-radius:4px}
        .address-btn,.listing-btn,.map-btn{border:1px solid #000;background:#000;color:#fff;padding:10px 20px;border-radius:4px;margin-left:10px}
        .nav-tabs-cus>li>a{color:#445990;font-weight:700;font-size:12px}
        #errmsg {display: none;}
        #errmsgadvn {display: none;}
        #successmsg {display: none;}
        #successmsgadvn {display: none;}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name = "range_waybillno"]').change(function() {
                var range_waybillno = $('input[name = "range_waybillno"]:checked').val();
                if(range_waybillno == '1') {
                    $('#start_awb_number_range').attr("readonly", false);
                    $('#end_awb_number_range').attr("readonly", false);
                    $('#start_awb_number_amount').attr("readonly", true);
                    $('#end_awb_number_amount').attr("readonly", true);
                    $('#start_awb_number_range').attr("required", true);
                    $('#end_awb_number_range').attr("required", true);
                    $('#start_awb_number_amount').attr("required", false);
                    $('#end_awb_number_amount').attr("required", false);
                } else if (range_waybillno == '2') {
                    $('#start_awb_number_range').attr("readonly", true);
                    $('#end_awb_number_range').attr("readonly", true);
                    $('#start_awb_number_amount').attr("readonly", false);
                    $('#end_awb_number_amount').attr("readonly", false);
                    $('#start_awb_number_range').attr("required", false);
                    $('#end_awb_number_range').attr("required", false);
                    $('#start_awb_number_amount').attr("required", true);
                    $('#end_awb_number_amount').attr("required", true);
                } else {
                    $('#start_awb_number_range').attr("readonly", true);
                    $('#end_awb_number_range').attr("readonly", true);
                    $('#start_awb_number_amount').attr("readonly", true);
                    $('#end_awb_number_amount').attr("readonly", true);
                    $('#start_awb_number_range').attr("required", false);
                    $('#end_awb_number_range').attr("required", false);
                    $('#start_awb_number_amount').attr("required", false);
                    $('#end_awb_number_amount').attr("required", false);
                }
            });
            $('#start_awb_number_range').attr("readonly", true);
            $('#end_awb_number_range').attr("readonly", true);
            $('#start_awb_number_amount').attr("readonly", true);
            $('#end_awb_number_amount').attr("readonly", true);
            $('#start_awb_number_range').attr("required", false);
            $('#end_awb_number_range').attr("required", false);
            $('#start_awb_number_amount').attr("required", false);
            $('#end_awb_number_amount').attr("required", false);

            $('#check_digit').on('click', function() {
                if ($(this).is(':checked')) {
                    $("#check_digit").val("1");
                } else {
                    $("#check_digit").val("0");
                }
            });
            $("#bsratemodalxlqcr").click(function(){
                $("#crsimple_nav").addClass("active");
                $("#crsimple").addClass("active");
            })

            $("#hts_carrierrates").click(function(event) {
                var hts_query_typeqr = $("#hts_query_typeqr").val();
                var hts_transportationqr = $("#hts_transportationqr").val();
                var hts_service_typeqr = $("#hts_service_typeqr").val();
                var hts_frequencyqr = $("#hts_frequencyqr").val();
                var hts_query_dateqr = $("#hts_query_dateqr").val();
                var hts_careerqr = $("#hts_careerqr").val();
                var hts_freight_service_classqr = $("#hts_freight_service_classqr").val();
                var hts_currencyqr = $("#hts_currencyqr").val();
                var hts_customerqr = $("#hts_customerqr").val();
                var hts_other_chargesqr = $("#hts_other_chargesqr").val();
                var hts_port_ladingqr = $("#hts_port_ladingqr").val();
                var hts_origincountryqr = $("#hts_origincountryqr").val();
                var hts_port_receiptqr = $("#hts_port_receiptqr").val();
                var hts_port_unladingqr = $("#hts_port_unladingqr").val();
                var hts_destinationcountryqr = $("#hts_destinationcountryqr").val();
                var hts_port_deliveryladingqr = $("#hts_port_deliveryladingqr").val();
                var hts_containerizedqr = $("#hts_containerizedqr").val();
                var hts_piecesqr = $("#hts_piecesqr").val();
                var hts_weightqr = $("#hts_weightqr").val();
                var hts_weight_unitqr = $("#hts_weight_unitqr").val();
                var hts_volumeqr = $("#hts_volumeqr").val();
                var hts_volume_unitqr = $("#hts_volume_unitqr").val();
                var hts_carrier_commodityqr = $("#hts_carrier_commodityqr").val();
                var query_tabqr = $("#query_tabqr").val();
                if($("#hts_query_typeqr").val().trim() === "" || $("#hts_transportationqr").val().trim() === "" || $("#hts_service_typeqr").val() === "" || $("#hts_frequencyqr").val() === "" || $("#hts_query_dateqr").val().trim() === ""|| $("#hts_careerqr").val() === "" || $("#hts_freight_service_classqr").val() === "" || $("#hts_currencyqr").val() === "" || $("#hts_customerqr").val() === "" || $("#hts_other_chargesqr").val() === "" || $("#hts_port_ladingqr").val() === "" || $("#hts_origincountryqr").val() === "" || $("#hts_port_receiptqr").val() === "" || $("#hts_port_unladingqr").val() === "" || $("#hts_destinationcountryqr").val() === "" || $("#hts_port_deliveryladingqr").val() === "" || $("#hts_piecesqr").val() === "" || $("#hts_weightqr").val() === "" || $("#hts_weight_unitqr").val() === "" || $("#hts_volumeqr").val() === "") {
                    $("#errmsg").show();
                    $("#crsimple_nav").focus();
                    setTimeout(() => {
                        $("#errmsg").hide();
                    }, 3000);
                    event.preventDefault();
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/createHtssimplequerycarrierrates') }}",
                        data: {hts_query_typeqr: hts_query_typeqr, hts_transportationqr: hts_transportationqr, hts_service_typeqr: hts_service_typeqr, hts_frequencyqr: hts_frequencyqr, hts_query_dateqr: hts_query_dateqr, hts_careerqr: hts_careerqr, hts_freight_service_classqr: hts_freight_service_classqr, hts_currencyqr: hts_currencyqr, hts_customerqr: hts_customerqr, hts_other_chargesqr: hts_other_chargesqr, hts_port_ladingqr: hts_port_ladingqr, hts_origincountryqr: hts_origincountryqr, hts_port_receiptqr: hts_port_receiptqr, hts_port_unladingqr: hts_port_unladingqr, hts_destinationcountryqr: hts_destinationcountryqr, hts_port_deliveryladingqr: hts_port_deliveryladingqr, hts_containerizedqr: hts_containerizedqr, hts_piecesqr: hts_piecesqr, hts_weightqr: hts_weightqr, hts_weight_unitqr: hts_weight_unitqr, hts_volumeqr: hts_volumeqr, hts_volume_unitqr: hts_volume_unitqr, hts_carrier_commodityqr: hts_carrier_commodityqr,query_tabqr: query_tabqr, _token: '{{ csrf_token() }}'},
                        beforeSend: function () { },
                        success: function (response) {
                            if(response == '1') {
                                $('.qsrsmplform')[0].reset();
                                $("#successmsg").show();
                                setTimeout(() => {
                                    $("#myModalcarrierRate").hide();
                                }, 2000);
                            }
                        }
                    })
                }
            })

            $("#hts_advcarrierrates").click(function(event) {
                var query_typeadvncqr = $("#query_typeadvncqr").val();
                var customeradvncqr = $("#customeradvncqr").val();
                var transportationadvncqr = $("#transportationadvncqr").val();
                var servicetypeadvncqr = $("#servicetypeadvncqr").val();
                var port_receiptadvncqr = $("#port_receiptadvncqr").val();
                var port_ladingadvncqr = $("#port_ladingadvncqr").val();
                var port_unladingadvncqr = $("#port_unladingadvncqr").val();
                var port_deliveryladingadvncqr = $("#port_deliveryladingadvncqr").val();
                var containerizedadvncqr = $("#containerizedadvncqr").val();
                var piecesadvncqr = $("#piecesadvncqr").val();
                var weightadvncqr = $("#weightadvncqr").val();
                var weight_unitadvncqr = $("#weight_unitadvncqr").val();
                var volumeadvncqr = $("#volumeadvncqr").val();
                var volume_unitadvncqr = $("#volume_unitadvncqr").val();
                var query_tabqr = $("#query_tabqr").val();
                if($("#query_typeadvncqr").val().trim() === "" || $("#customeradvncqr").val() === "" || $("#transportationadvncqr").val() === "" || $("#servicetypeadvncqr").val() === "" || $("#port_receiptadvncqr").val() === "" || $("#port_ladingadvncqr").val() === "" || $("#port_unladingadvncqr").val() === "" || $("#port_deliveryladingadvncqr").val() === "" || $("#containerizedadvncqr").val() === "" || $("#piecesadvncqr").val() === "" || $("#weightadvncqr").val() === "" || $("#weight_unitadvncqr").val() === "" || $("#volumeadvncqr").val() === "" || $("#volume_unitadvncqr").val() === "") {
                    $("#errmsgadvn").show();
                    $("#crsimple_nav").focus();
                    setTimeout(() => {
                        $("#errmsgadvn").hide();
                    }, 3000);
                    event.preventDefault();
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/createHtsadvquerycarrierrates') }}",
                        data: {query_typeadvncqr: query_typeadvncqr,customeradvncqr: customeradvncqr,transportationadvncqr: transportationadvncqr,servicetypeadvncqr: servicetypeadvncqr,port_receiptadvncqr: port_receiptadvncqr,port_ladingadvncqr: port_ladingadvncqr,port_unladingadvncqr: port_unladingadvncqr,port_deliveryladingadvncqr: port_deliveryladingadvncqr,containerizedadvncqr: containerizedadvncqr,piecesadvncqr: piecesadvncqr,weightadvncqr: weightadvncqr,weight_unitadvncqr: weight_unitadvncqr,volumeadvncqr: volumeadvncqr,volume_unitadvncqr: volume_unitadvncqr,query_tabqr: query_tabqr, _token: '{{ csrf_token() }}'},
                        beforeSend: function () { },
                        success: function (response) {
                            if(response == '1') {
                                $('.qsradvncform')[0].reset();
                                $("#successmsgadvn").show();
                                setTimeout(() => {
                                    $("#myModalcarrierRate").hide();
                                }, 2000);
                            }
                        }
                    })
                }
            })
        })
    </script>
@endsection
