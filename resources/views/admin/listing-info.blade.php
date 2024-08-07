@extends('layouts.admin-dashboard')
@section('title', 'Enter Listing Information')

@section('content')

@php
    if (Session::has('listing_step')) {
        // do some thing if the key is exist
        $listing_step = Session::get('listing_step');
    } 
@endphp



    <div class="main-content">
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
                                    <li class="breadcrumb-item"><a href="{{ route('view-listings') }}">View your listings</a></li>
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

                <div class="row">
                    <div class="col-lg-12" id="htmlWizard">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body wizard-card">
                                    <h4 class="card-title mb-4">Listing Informations</h4>                        
                                    <div id="progrss-wizard" class="twitter-bs-wizard">
                                        <ul class="twitter-bs-wizard-nav nav-justified mb-4">
                                            <li class="nav-item">
                                                <a href="#progress-property-details" class="nav-link steptb1 {{ Session::get('listing_step') == '1' ? 'active' : '' }}" data-toggle="tab">
                                                    <span class="step-number">01</span>
                                                    <span class="step-title">Enter APN or Address</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#progress-general-detail" class="nav-link steptb2 {{ Session::get('listing_step') == '2' ? 'active' : '' }}" data-toggle="tab">
                                                    <span class="step-number">02</span>
                                                    <span class="step-title">Verify Map Pin Placement</span>
                                                </a>
                                            </li>
    
                                            <li class="nav-item">
                                                <a href="#progress-interior-detail" class="nav-link steptb3 {{ Session::get('listing_step') == '3' ? 'active' : '' }}" data-toggle="tab">
                                                    <span class="step-number">03</span>
                                                    <span class="step-title">Enter Listing Information</span>
                                                </a>
                                            </li>
    
                                        </ul>
                                        
                                        <div class="tab-content twitter-bs-wizard-tab-content property-type">
    
                                            <div class="tab-pane  {{ Session::get('listing_step') == '1' ? 'active' : '' }} step1" id="progress-property-details">
                                                <form action="{{ route('listingStep1') }}" method="post" enctype="multipart/form-data" id="listingInformations1">
                                                @csrf 
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="row mb-3">
                                                                <div class="col-lg-3">
                                                                    <label for="">Property Type<code>*</code></label>
                                                                </div>
                                                                <div class="col-lg-9 form-group">
                                                                    <select class="form-control select2" name="property_type" id="property_type">
                                                                        <option value="">Choose Type...</option>
                                                                        @if (!$data['property_types']->isEmpty())
                                                                            @foreach ($data['property_types'] as $key => $row)
                                                                                <option value="{{ @$row->id }}" {{ ( $row->id == $data['listingsDetails']->property_type) ? 'selected' : '' }}>
                                                                                    {{ @$row->type_name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-lg-3">
                                                                    <label for="">County<code>*</code></label>
                                                                </div>
                                                                <div class="col-lg-9 form-group">
                                                                    <select class="form-control select2" name="state_county" id="state_county">
                                                                        <option value="">Choose...</option>
                                                                        @if (!$data['county']->isEmpty())
                                                                            @foreach ($data['county'] as $key => $row)
                                                                                <option value="{{ @$row->id }}" {{ ( $row->id == $data['listingsDetails']->county) ? 'selected' : '' }}>
                                                                                    {{ @$row->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-lg-3">
                                                                    <label for="">City<code>*</code></label>
                                                                </div>
                                                                <div class="col-lg-9 form-group">
                                                                    <select class="form-control select2" name="city" id="city_html">
                                                                        <option value="">Select city...</option>
                                                                        @if (!$data['cities']->isEmpty())
                                                                            @foreach ($data['cities'] as $key => $row)
                                                                                <option value="{{ @$row->id }}" {{ ( $row->id == $data['listingsDetails']->city) ? 'selected' : '' }}>
                                                                                    {{ @$row->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-lg-3">
                                                                    <label for="">APN<code>*</code></label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="row form-group">
                                                                        <div class="col-lg-3 form-group">
                                                                            <input type="text" class="form-control" name="apn_1" id="apn_1" value="{{ $data['listingsDetails']->apn_1 }}">
                                                                        </div>
                                                                        <div class="col-lg-3 form-group">
                                                                            <input type="text" class="form-control" name="apn_2" id="apn_2" value="{{ $data['listingsDetails']->apn_2 }}">
                                                                        </div>
                                                                        <div class="col-lg-3 form-group">
                                                                            <input type="text" class="form-control" name="apn_3"  id="apn_3"value="{{ $data['listingsDetails']->apn_3 }}">
                                                                        </div>
                                                                        <div class="col-lg-3 form-group">
                                                                            <input type="text" class="form-control" name="apn_4" id="apn_4" value="{{ $data['listingsDetails']->apn_4 }}">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-lg-3">
                                                                    <label for="">Street Modifier</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 form-group">
                                                                            <input type="text" class="form-control" name="street_modifier_1" value="{{ $data['listingsDetails']->street_modifier_1 }}">
                                                                        </div>
                                                                        <div class="col-lg-6 form-group">
                                                                            <input type="text" class="form-control" name="street_modifier_2" value="{{ $data['listingsDetails']->street_modifier_2 }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-lg-3">
                                                                    <label for="">Direction</label>
                                                                </div>
                                                                <div class="col-lg-9 form-group">
                                                                    <input type="text" class="form-control" name="direction" value="{{ $data['listingsDetails']->direction }}">
                                                                    {{-- <select class="form-control select2">
                                                                        <option>Select</option>
                                                                            <option value="AK">Alaska</option>
                                                                            <option value="HI">Hawaii</option>
                                                                            <option value="CA">California</option>
                                                                            <option value="NV">Nevada</option>
                                                                            <option value="OR">Oregon</option>
                                                                            <option value="WA">Washington</option>
                                                                    </select> --}}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-lg-3">
                                                                    <label for="">Street Name</label>
                                                                </div>
                                                                <div class="col-lg-9 form-group">
                                                                    <input type="text" class="form-control" name="street_name" value="{{ $data['listingsDetails']->street_name }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-lg-3">
                                                                    <label for="">Suffix<code>*</code></label>
                                                                </div>
                                                                <div class="col-lg-9 form-group">
                                                                    <select class="form-control select2" name="suffix" id="suffix">
                                                                        <option value="">Select</option>
                                                                            <option value="Alley" {{ ( 'Alley' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Alley</option>
                                                                            <option value="Avenue" {{ ( 'Avenue' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Avenue</option>
                                                                            <option value="Boulevard" {{ ( 'Boulevard' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Boulevard</option>
                                                                            <option value="Canyon" {{ ( 'Canyon' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Canyon</option>
                                                                            <option value="Center" {{ ( 'Center' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Center</option>
                                                                            <option value="Circle" {{ ( 'Circle' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Circle</option>
                                                                            <option value="Common" {{ ( 'Common' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Common</option>
                                                                            <option value="Corner" {{ ( 'Corner' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Corner</option>
                                                                            <option value="Course" {{ ( 'Course' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Course</option>
                                                                            <option value="Court" {{ ( 'Court' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Court</option>
                                                                            <option value="Cove" {{ ( 'Cove' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Cove</option>
                                                                            <option value="Creek" {{ ( 'Creek' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Creek</option>
                                                                            <option value="Drive" {{ ( 'Drive' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Drive</option>
                                                                            <option value="Glen" {{ ( 'Glen' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Glen</option>
                                                                            <option value="Grove" {{ ( 'Grove' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Grove</option>
                                                                            <option value="Harbor" {{ ( 'Harbor' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Harbor</option>
                                                                            <option value="Heights" {{ ( 'Heights' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Heights</option>
                                                                            <option value="Highway" {{ ( 'Highway' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Highway</option>
                                                                            <option value="Hills" {{ ( 'Hills' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Hills</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-lg-3">
                                                                    <label for="">Unit #</label>
                                                                </div>
                                                                <div class="col-lg-9 form-group">
                                                                    <input type="text" class="form-control" name="unit" value="{{ $data['listingsDetails']->unit }}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row mb-3">
                                                                <div class="col-lg-3">
                                                                    <label for="">ZIP Code<code>*</code></label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 form-group">
                                                                            <input type="text" class="form-control" name="zipcode_1" id="zipcode_1" value="{{ $data['listingsDetails']->zipcode_1 }}">
        
                                                                        </div>
                                                                        <div class="col-lg-6 form-group">
                                                                            <input type="text" class="form-control" name="zipcode_2" value="{{ $data['listingsDetails']->zipcode_2 }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-lg-3">
                                                                    <label for="">Map Pointer Address<code>*</code></label>
                                                                </div>
                                                                <div class="col-lg-9 form-group">
                                                                    <input type="text" class="form-control" name="location" id="location" value="{{ $data['listingsDetails']->location }}">
                                                                    <input type="hidden" class="form-control" name="latitude" id="search_lat" value="{{ $data['listingsDetails']->latitude }}">
                                                                    <input type="hidden" class="form-control" name="longitude" id="search_lon" value="{{ $data['listingsDetails']->longitude }}">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 text-center">
                                                                <button class="clear-btn reset" id="resetAllFileds" type="reset" name="reset" value="reset">Clear All Fields</button>
                                                                <button class="map-btn" type="submit" name="submit" value="listing1" id="step1Submit">Place Pin On MAp</button>
                                                            </div>
                                                            {{-- <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                                <li class="previous"><a href="javascript: void(0);">Previous</a></li>
                                                                <li class="next"><a href="javascript: void(0);">Next</a></li>
                                                            </ul> --}}
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <img src="./images/usa_map.png" style="width:100%; height:580px;">
                                                            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117925.35231226787!2d88.26495206437285!3d22.53540637507455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1684232861192!5m2!1sen!2sin"   allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
    
                                            <div class="tab-pane {{ Session::get('listing_step') == '2' ? 'active' : '' }} step2" id="progress-general-detail">
                                                
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="row mb-3">
                                                            <div class="col-lg-3">
                                                                <label for="">Property Type</label>
                                                            </div>
                                                            <div class="col-lg-9 form-group">
                                                                <select class="form-control no-drop select2" disabled>
                                                                    <option value="">Choose Type...</option>
                                                                    @if (!$data['property_types']->isEmpty())
                                                                        @foreach ($data['property_types'] as $key => $row)
                                                                            <option value="{{ @$row->id }}"
                                                                                {{ $row->id == $data['listingsDetails']->property_type ? 'selected' : '' }}>
                                                                                {{ @$row->type_name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-3">
                                                                <label for="">County</label>
                                                            </div>
                                                            <div class="col-lg-9 form-group">
                                                                <select class="form-control no-drop select2" disabled>
                                                                    <option value="">Choose...</option>
                                                                    @if (!$data['county']->isEmpty())
                                                                        @foreach ($data['county'] as $key => $row)
                                                                            <option value="{{ @$row->id }}"
                                                                                {{ $row->id == $data['listingsDetails']->county ? 'selected' : '' }}>
                                                                                {{ @$row->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-3">
                                                                <label for="">City<code>*</code></label>
                                                            </div>
                                                            <div class="col-lg-9 form-group">
                                                                <select class="form-control no-drop select2" disabled>
                                                                    <option value="">Select city...</option>
                                                                    @if (!$data['cities']->isEmpty())
                                                                        @foreach ($data['cities'] as $key => $row)
                                                                            <option value="{{ @$row->id }}"
                                                                                {{ $row->id == $data['listingsDetails']->city ? 'selected' : '' }}>
                                                                                {{ @$row->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-3">
                                                                <label for="">APN</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="row form-group">
                                                                    <div class="col-lg-3 form-group">
                                                                        <input disabled type="text" class="form-control no-drop" value="{{ $data['listingsDetails']->apn_1 }}">
                                                                    </div>
                                                                    <div class="col-lg-3 form-group">
                                                                        <input disabled type="text" class="form-control no-drop" value="{{ $data['listingsDetails']->apn_2 }}">
                                                                    </div>
                                                                    <div class="col-lg-3 form-group">
                                                                        <input disabled type="text" class="form-control no-drop" value="{{ $data['listingsDetails']->apn_3 }}">
                                                                    </div>
                                                                    <div class="col-lg-3 form-group">
                                                                        <input disabled type="text" class="form-control no-drop" value="{{ $data['listingsDetails']->apn_4 }}">
                                                                    </div>
                                                                </div>
                                        
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-3">
                                                                <label for="">Street Modifier</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="row">
                                                                    <div class="col-lg-6 form-group">
                                                                        <input disabled type="text" class="form-control no-drop" value="{{ $data['listingsDetails']->street_modifier_1 }}">
                                                                    </div>
                                                                    <div class="col-lg-6 form-group">
                                                                        <input disabled type="text" class="form-control no-drop" value="{{ $data['listingsDetails']->street_modifier_2 }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-3">
                                                                <label for="">Direction</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="text" disabled class="form-control no-drop" value="{{ $data['listingsDetails']->direction }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-3">
                                                                <label for="">Street Name</label>
                                                            </div>
                                                            <div class="col-lg-9 form-group">
                                                                <input type="text" disabled class="form-control no-drop" value="{{ $data['listingsDetails']->street_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-3">
                                                                <label for="">Direction</label>
                                                            </div>
                                                            <div class="col-lg-9 form-group">
                                                                <select class="form-control select2 no-drop" disabled>
                                                                    <option value="">Select</option>
                                                                    <option value="Alley"
                                                                        {{ 'Alley' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Alley</option>
                                                                    <option value="Avenue"
                                                                        {{ 'Avenue' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Avenue</option>
                                                                    <option value="Boulevard"
                                                                        {{ 'Boulevard' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Boulevard
                                                                    </option>
                                                                    <option value="Canyon"
                                                                        {{ 'Canyon' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Canyon</option>
                                                                    <option value="Center"
                                                                        {{ 'Center' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Center</option>
                                                                    <option value="Circle"
                                                                        {{ 'Circle' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Circle</option>
                                                                    <option value="Common"
                                                                        {{ 'Common' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Common</option>
                                                                    <option value="Corner"
                                                                        {{ 'Corner' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Corner</option>
                                                                    <option value="Course"
                                                                        {{ 'Course' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Course</option>
                                                                    <option value="Court"
                                                                        {{ 'Court' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Court</option>
                                                                    <option value="Cove"
                                                                        {{ 'Cove' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Cove</option>
                                                                    <option value="Creek"
                                                                        {{ 'Creek' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Creek</option>
                                                                    <option value="Drive"
                                                                        {{ 'Drive' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Drive</option>
                                                                    <option value="Glen"
                                                                        {{ 'Glen' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Glen</option>
                                                                    <option value="Grove"
                                                                        {{ 'Grove' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Grove</option>
                                                                    <option value="Harbor"
                                                                        {{ 'Harbor' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Harbor</option>
                                                                    <option value="Heights"
                                                                        {{ 'Heights' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Heights
                                                                    </option>
                                                                    <option value="Highway"
                                                                        {{ 'Highway' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Highway
                                                                    </option>
                                                                    <option value="Hills"
                                                                        {{ 'Hills' == $data['listingsDetails']->suffix ? 'selected' : '' }}>Hills</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-3">
                                                                <label for="">Unit</label>
                                                            </div>
                                                            <div class="col-lg-9 form-group">
                                                                <input type="text" disabled class="form-control no-drop" value="{{ $data['listingsDetails']->unit }}">
                                                            </div>
                                                        </div>
                        
                                                        <div class="row mb-3">
                                                            <div class="col-lg-3">
                                                                <label for="">ZIP Code</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="row">
                                                                    <div class="col-lg-6 form-group">
                                                                        <input type="text"disabled class="form-control no-drop" value="{{ $data['listingsDetails']->zipcode_1 }}">
                                        
                                                                    </div>
                                                                    <div class="col-lg-6 form-group">
                                                                        <input type="text" disabled class="form-control no-drop" value="{{ $data['listingsDetails']->zipcode_2 }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-lg-3">
                                                                <label for="">Map Pointer Address<code>*</code></label>
                                                            </div>
                                                            <div class="col-lg-9 form-group">
                                                                <input type="text" disabled class="form-control no-drop" value="{{ $data['listingsDetails']->location }}">
                                                                <input type="hidden" disabled value="{{ $data['listingsDetails']->latitude }}">
                                                                <input type="hidden" disabled value="{{ $data['listingsDetails']->longitude }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 text-center">
                                                            <button type="text" class="btn btn-secondary no-drop" disabled>Clear All Fields</button>
                                                            <button ype="text" class="btn btn-secondary no-drop" disabled>Place Pin On MAp</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3 text-center">
                                                            <form style="display: inline-block;" action="{{ route('createListingUpdate') }}" method="post" enctype="multipart/form-data" id="listingInformations2">
                                                            @csrf 
                                                                <button type="submit" name="modifiyaddress" value="modifiyaddress" class="address-btn"><i class="fas fa-arrow-circle-left"></i> Modify Address </button>
                                                            </form>

                                                            <form style="display: initial;" action="{{ route('listingStep2') }}" method="post" enctype="multipart/form-data" id="listingInformations3">
                                                            @csrf 
                                                                <button type="submit" name="ContinuetolistngAddress" value="ContinuetolistngAddress" class="listing-btn">Continue to listng Address <i class=" fas fa-arrow-alt-circle-right"></i></button>
                                                            </form>
                                                        </div>
                                                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwnPm0pAcIiMcMIeNFRxPmg-6OL_t3YFI&libraries=places&callback=initMap&v=weekly"></script>
                                                        <div id="map" style="width: 100%; height: 560px;"></div>

                                                        <script type="text/javascript">
                                                            var locations = [
                                                            ['', {{ $data['listingsDetails']->latitude }}, {{ $data['listingsDetails']->longitude }}, 18],
                                                            ];
                                                            
                                                            var map = new google.maps.Map(document.getElementById('map'), {
                                                            zoom: 18,
                                                            center: new google.maps.LatLng({{ $data['listingsDetails']->latitude }}, {{ $data['listingsDetails']->longitude }}),
                                                            mapTypeId: google.maps.MapTypeId.ROADMAP
                                                            });
                                                            
                                                            var infowindow = new google.maps.InfoWindow();

                                                            var marker, i;
                                                            
                                                            for (i = 0; i < locations.length; i++) {  
                                                            marker = new google.maps.Marker({
                                                                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                                                map: map
                                                            });
                                                            
                                                            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                                                return function() {
                                                                infowindow.setContent(locations[i][0]);
                                                                // infowindow.open(map, marker);
                                                                }
                                                            })(marker, i));
                                                            }
                                                        </script>

                                                        {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117925.35231226787!2d88.26495206437285!3d22.53540637507455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1684232861192!5m2!1sen!2sin"   allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="tab-pane {{ Session::get('listing_step') == '3' ? 'active' : '' }} step3" id="progress-interior-detail">
                                                <div>
                                                    <h5>Listing Information (<code>*indicates required field</code>)</h5><hr>
                                                    <form action="{{ route('listingFinalStep') }}" method="post" enctype="multipart/form-data" id="listingFinalStepValidation">
                                                        @csrf 
                                                            <div class="row">
                                                                @php
                                                                    $property_subtype = DB::table('property_subtypes')->where('property_type', $data['listingsDetails']->property_type)->orderBy('id','asc')->get();
                                                                @endphp

                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Property Subtype<code>*</code></label>
                                                                    <div class="form-group">
                                                                        <select class="form-control select2" name="property_subtype" id="property_subtype">
                                                                            <option value="">Choose Type...</option>
                                                                            @if (!$property_subtype->isEmpty())
                                                                                @foreach ($property_subtype as $key => $row)
                                                                                    <option value="{{ @$row->id }}" {{ ( $row->id == $data['listingsDetails']->property_subtype) ? 'selected' : '' }}>
                                                                                        {{ @$row->subtype_name }}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">APN<code>*</code></label>
                                                                    <div class="row form-group">
                                                                        <div class="col-lg-3 form-group">
                                                                            <input type="text" class="form-control" disabled value="{{ $data['listingsDetails']->apn_1 }}">
                                                                        </div>
                                                                        <div class="col-lg-3 form-group">
                                                                            <input type="text" class="form-control" disabled value="{{ $data['listingsDetails']->apn_2 }}">
                                                                        </div>
                                                                        <div class="col-lg-3 form-group">
                                                                            <input type="text" class="form-control"  disabled value="{{ $data['listingsDetails']->apn_3 }}">
                                                                        </div>
                                                                        <div class="col-lg-3 form-group">
                                                                            <input type="text" class="form-control" disabled value="{{ $data['listingsDetails']->apn_4 }}">
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">County<code>*</code></label>
                                                                    <div class="form-group">
                                                                        <select class="form-control select2" disabled>
                                                                            <option value="">Choose...</option>
                                                                            @if (!$data['county']->isEmpty())
                                                                                @foreach ($data['county'] as $key => $row)
                                                                                    <option value="{{ @$row->id }}" {{ ( $row->id == $data['listingsDetails']->county) ? 'selected' : '' }}>
                                                                                        {{ @$row->name }}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">City<code>*</code></label>
                                                                    <div class="form-group">
                                                                        <select class="form-control select2" disabled>
                                                                            <option value="">Select city...</option>
                                                                            @if (!$data['cities']->isEmpty())
                                                                                @foreach ($data['cities'] as $key => $row)
                                                                                    <option value="{{ @$row->id }}" {{ ( $row->id == $data['listingsDetails']->city) ? 'selected' : '' }}>
                                                                                        {{ @$row->name }}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Street Modifier</label>
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 form-group">
                                                                                <input type="text" class="form-control" disabled value="{{ $data['listingsDetails']->street_modifier_1 }}">
                                                                            </div>
                                                                            <div class="col-lg-6 form-group">
                                                                                <input type="text" class="form-control" disabled value="{{ $data['listingsDetails']->street_modifier_2 }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Direction</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" disabled value="{{ $data['listingsDetails']->direction }}">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Street Name</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" disabled value="{{ $data['listingsDetails']->street_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Suffix<code>*</code></label>
                                                                    <div class="form-group">
                                                                        <select class="form-control select2" disabled>
                                                                            <option value="">Select</option>
                                                                                <option value="Alley" {{ ( 'Alley' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Alley</option>
                                                                                <option value="Avenue" {{ ( 'Avenue' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Avenue</option>
                                                                                <option value="Boulevard" {{ ( 'Boulevard' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Boulevard</option>
                                                                                <option value="Canyon" {{ ( 'Canyon' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Canyon</option>
                                                                                <option value="Center" {{ ( 'Center' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Center</option>
                                                                                <option value="Circle" {{ ( 'Circle' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Circle</option>
                                                                                <option value="Common" {{ ( 'Common' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Common</option>
                                                                                <option value="Corner" {{ ( 'Corner' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Corner</option>
                                                                                <option value="Course" {{ ( 'Course' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Course</option>
                                                                                <option value="Court" {{ ( 'Court' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Court</option>
                                                                                <option value="Cove" {{ ( 'Cove' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Cove</option>
                                                                                <option value="Creek" {{ ( 'Creek' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Creek</option>
                                                                                <option value="Drive" {{ ( 'Drive' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Drive</option>
                                                                                <option value="Glen" {{ ( 'Glen' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Glen</option>
                                                                                <option value="Grove" {{ ( 'Grove' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Grove</option>
                                                                                <option value="Harbor" {{ ( 'Harbor' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Harbor</option>
                                                                                <option value="Heights" {{ ( 'Heights' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Heights</option>
                                                                                <option value="Highway" {{ ( 'Highway' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Highway</option>
                                                                                <option value="Hills" {{ ( 'Hills' == $data['listingsDetails']->suffix) ? 'selected' : '' }}>Hills</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Cross Street</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="cross_street" id="cross_street" value="{{ $data['listingsDetails']->cross_street }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Unit #</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" disabled value="{{ $data['listingsDetails']->unit }}">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">ZIP Code<code>*</code></label>
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 form-group">
                                                                                <input type="text" class="form-control" disabled value="{{ $data['listingsDetails']->zipcode_1 }}">
            
                                                                            </div>
                                                                            <div class="col-lg-6 form-group">
                                                                                <input type="text" class="form-control" disabled value="{{ $data['listingsDetails']->zipcode_2 }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Office ID<code>*</code></label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="office_id" id="office_id" value="{{ $data['listingsDetails']->office_id }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Agent ID<code>*</code></label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="agent_id" id="agent_id"  value="{{ $data['listingsDetails']->agent_id }}">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Co-Office ID</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="co_office_id" id="co_office_id" value="{{ $data['listingsDetails']->co_office_id }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Co-Agent ID</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="co_agent_id" id="co_agent_id" value="{{ $data['listingsDetails']->co_agent_id }}">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Property For<code>*</code></label>
                                                                    <div class="form-group">
                                                                        <select class="form-control select2" name="property_for" id="property_for">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->property_for) ? 'selected' : '' }}>Select...</option>
                                                                            <option value="Sale" {{ ( 'Sale' == $data['listingsDetails']->property_for) ? 'selected' : '' }}>Sale</option>
                                                                            <option value="Rent" {{ ( 'Rent' == $data['listingsDetails']->property_for) ? 'selected' : '' }}>Rent</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Status</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control select2" name="status" id="">
                                                                            <option value="">Select...</option>
                                                                                <option value="Active" selected>Active</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Listing Service</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control select2" name="listing_service" id="">
                                                                            <option value="">Select</option>
                                                                                <option value="Full Service" {{ ( 'Full Service' == $data['listingsDetails']->listing_service) ? 'selected' : '' }}>Full Service</option>
                                                                                <option value="Limited Service" {{ ( 'Limited Service' == $data['listingsDetails']->listing_service) ? 'selected' : '' }}>Limited Service</option>
                                                                                <option value="Entry Only" {{ ( 'Entry Only' == $data['listingsDetails']->listing_service) ? 'selected' : '' }}>Entry Only</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>

                                                            @php
                                                                $listing_conditions = [];

                                                                if(!empty($data['listingsDetails']->listing_conditions)) {
                                                                    $listing_conditions = json_decode($data['listingsDetails']->listing_conditions);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Special Listing Conditions</label>
                                                                    
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox1" value="Auction" {{ in_array('Auction',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox1">Auction</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox2" value="Housing Assist Program" {{ in_array('Housing Assist Program',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox2">Housing Assist Program</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox3" value="HUD Owned" {{ in_array('HUD Owned',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox3">HUD Owned</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox4" value="In Foreclosure" {{ in_array('In Foreclosure',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox4">In Foreclosure</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox5" value="Notice Of Default" {{ in_array('Notice Of Default',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox5">Notice Of Default</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox6" value="Offer As Is" {{ in_array('Offer As Is',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox6">Offer As Is</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox7" value="Pending Litigation" {{ in_array('Pending Litigation',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox7">Pending Litigation</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox8" value="Probate Listing" {{ in_array('Probate Listing',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox8">Probate Listing</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox9" value="Real Estate Owned" {{ in_array('Real Estate Owned',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox9">Real Estate Owned</label>
                                                                          </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox10" value="Release Clause" {{ in_array('Release Clause',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox10">Release Clause</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox11" value="Short Sale" {{ in_array('Short Sale',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox11">Short Sale</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox12" value="Subject to Court Confirmation" {{ in_array('Subject to Court Confirmation',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox12">Subject to Court Confirmation</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox13" value="Subject to Lender Confirmation" {{ in_array('Subject to Lender Confirmation',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox13">Subject to Lender Confirmation</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox14" value="Successor Trustee Sale" {{ in_array('Successor Trustee Sale',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox14">Successor Trustee Sale</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox15" value="VA Repo" {{ in_array('VA Repo',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox15">VA Repo</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox16" value="None" {{ in_array('None',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox16">None</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="listing_conditions[]" id="sinlineCheckbox17" value="Other" {{ in_array('Other',$listing_conditions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="sinlineCheckbox17">Other</label>
                                                                          </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Listing Price<code>*</code></label>
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                                        <input type="number" class="form-control" name="listing_price" value="{{ $data['listingsDetails']->listing_price }}" placeholder="Price" aria-label="Price" aria-describedby="basic-addon1">
                                                                      </div>
                                                                </div>
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Listing Date<code>*</code></label>
                                                                    <div class="form-group">
                                                                        <input type="date" class="form-control" name="listing_date" value="{{ @$data['listingsDetails']->listing_date }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Expiration Date</label>
                                                                    <div class="form-group">
                                                                        <input type="date" class="form-control" name="expiration_date" value="{{ @$data['listingsDetails']->expiration_date }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">On Market Date</label>
                                                                    <div class="form-group">
                                                                        <input type="date" class="form-control" name="on_market_date" value="{{ @$data['listingsDetails']->on_market_date }}">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Commission Type</label>
                                                                    <div class="form-group">
                                                                       <select name="commission_type" id="" class="form-control select2">
                                                                        <option value="" {{ ( '' == $data['listingsDetails']->commission_type) ? 'selected' : '' }}>Choose type...</option>
                                                                        <option value="$" {{ ( '$' == $data['listingsDetails']->commission_type) ? 'selected' : '' }}>$</option>
                                                                        <option value="%" {{ ( '%' == $data['listingsDetails']->commission_type) ? 'selected' : '' }}>%</option>
                                                                       </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Commission to Buyer Office</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="commission_to_buyer" value="{{ $data['listingsDetails']->commission_to_buyer }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Dual Variable Compensation</label>
                                                                    <div class="form-group">
                                                                        <select name="dual_variable_compensation" id="" class="form-control select2">
                                                                         <option value="" {{ ( '' == $data['listingsDetails']->dual_variable_compensation) ? 'selected' : '' }}>Choose...</option>
                                                                         <option value="Yes" {{ ( 'Yes' == $data['listingsDetails']->dual_variable_compensation) ? 'selected' : '' }}>Yes</option>
                                                                         <option value="No" {{ ( 'No' == $data['listingsDetails']->dual_variable_compensation) ? 'selected' : '' }}>No</option>
                                                                        </select>
                                                                     </div>
                                                                </div>
                                                                
                                                            </div>

                                                            @php
                                                                $showing_instructions = [];

                                                                if(!empty($data['listingsDetails']->showing_instructions)) {
                                                                    $showing_instructions = json_decode($data['listingsDetails']->showing_instructions);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Showing Instructions</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox1" value="24 Hour Notice" {{ in_array('24 Hour Notice',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox1">24 Hour Notice</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox2" value="Alarm Code in Lockbox" {{ in_array('Alarm Code in Lockbox',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox2">Alarm Code in Lockbox</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox3" value="Appointment Only" {{ in_array('Appointment Only',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox3">Appointment Only</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox4" value="Call 1st Lockbox" {{ in_array('Call 1st Lockbox',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox4">Call 1st Lockbox</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox5" value="Call Showing Contact" {{ in_array('Call Showing Contact',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox5">Call Showing Contact</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox6" value="CBS Restricted-CLA" {{ in_array('CBS Restricted-CLA',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox6">CBS Restricted-CLA</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox7" value="Do Not Disturb" {{ in_array('Do Not Disturb',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox7">Do Not Disturb</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox8" value="Do Not Show" {{ in_array('Do Not Show',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox8">Do Not Show</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox9" value="Gate Code Provided" {{ in_array('Gate Code Provided',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox9">Gate Code Provided</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox10" value="Gate Code-CLA" {{ in_array('Gate Code-CLA',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox10">Gate Code-CLA</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox11" value="Go Directly" {{ in_array('Go Directly',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox11">Go Directly</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox12" value="Key In Office" {{ in_array('Key In Office',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox12">Key In Office</label>
                                                                          </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox13" value="Leave Card" {{ in_array('Leave Card',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox13">Leave Card</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox14" value="No Photos Allowed" {{ in_array('No Photos Allowed',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox14">No Photos Allowed</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox15" value="Pets-See Confidential Remarks" {{ in_array('Pets-See Confidential Remarks',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox15">Pets-See Confidential Remarks</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox16" value="Restricted Hours" {{ in_array('Restricted Hours',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox16">Restricted Hours</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox17" value="Security System" {{ in_array('Security System',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox17">Security System</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox18" value="Supra iBox" {{ in_array('Supra iBox',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox18">Supra iBox</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox19" value="Surveillance Equipment In Use" {{ in_array('Surveillance Equipment In Use',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox19">Surveillance Equipment In Use</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox20" value="Text Showing Contact" {{ in_array('Text Showing Contact',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox20">Text Showing Contact</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox21" value="Vacant" {{ in_array('Vacant',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox21">Vacant</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox22" value="Vacant w/Lockbox" {{ in_array('Vacant w/Lockbox',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox22">Vacant w/Lockbox</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox23" value="See Remarks" {{ in_array('See Remarks',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox23">See Remarks</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="showing_instructions[]" id="inlineCheckbox24" value="Other" {{ in_array('Other',$showing_instructions) ?'checked':null }}>
                                                                            <label class="form-check-label" for="inlineCheckbox24">Other</label>
                                                                          </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Primary Showing Contact Type</label>
                                                                    <div class="form-group">
                                                                       <select name="primary_showing_contact" id="" class="form-control select2">
                                                                        <option value="" {{ ( '' == $data['listingsDetails']->primary_showing_contact) ? 'selected' : '' }}>Choose type...</option>
                                                                        <option value="Agent" {{ ( 'Agent' == $data['listingsDetails']->primary_showing_contact) ? 'selected' : '' }}>Agent</option>
                                                                        <option value="Caretaker" {{ ( 'Caretaker' == $data['listingsDetails']->primary_showing_contact) ? 'selected' : '' }}>Caretaker</option>
                                                                        <option value="Listing Office" {{ ( 'Listing Office' == $data['listingsDetails']->primary_showing_contact) ? 'selected' : '' }}>Listing Office</option>
                                                                        <option value="Owner" {{ ( 'Owner' == $data['listingsDetails']->primary_showing_contact) ? 'selected' : '' }}>Owner</option>
                                                                        <option value="Property Manager" {{ ( 'Property Manager' == $data['listingsDetails']->primary_showing_contact) ? 'selected' : '' }}>Property Manager</option>
                                                                        <option value="Tenant" {{ ( 'Tenant' == $data['listingsDetails']->primary_showing_contact) ? 'selected' : '' }}>Tenant</option>
                                                                        <option value="Vacant" {{ ( 'Vacant' == $data['listingsDetails']->primary_showing_contact) ? 'selected' : '' }}>Vacant</option>
                                                                        <option value="Other" {{ ( 'Other' == $data['listingsDetails']->primary_showing_contact) ? 'selected' : '' }}>Other</option>
                                                                       </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Secondary Showing Contact Type</label>
                                                                    <div class="form-group">
                                                                        <select name="secondary_showing_contact" id="" class="form-control select2">
                                                                         <option value="" {{ ( '' == $data['listingsDetails']->secondary_showing_contact) ? 'selected' : '' }}>Choose type...</option>
                                                                         <option value="Agent" {{ ( 'Agent' == $data['listingsDetails']->secondary_showing_contact) ? 'selected' : '' }}>Agent</option>
                                                                         <option value="Caretaker" {{ ( 'Caretaker' == $data['listingsDetails']->secondary_showing_contact) ? 'selected' : '' }}>Caretaker</option>
                                                                         <option value="Listing Office" {{ ( 'Listing Office' == $data['listingsDetails']->secondary_showing_contact) ? 'selected' : '' }}>Listing Office</option>
                                                                         <option value="Owner" {{ ( 'Owner' == $data['listingsDetails']->secondary_showing_contact) ? 'selected' : '' }}>Owner</option>
                                                                         <option value="Property Manager" {{ ( 'Property Manager' == $data['listingsDetails']->secondary_showing_contact) ? 'selected' : '' }}>Property Manager</option>
                                                                         <option value="Tenant" {{ ( 'Tenant' == $data['listingsDetails']->secondary_showing_contact) ? 'selected' : '' }}>Tenant</option>
                                                                         <option value="Vacant" {{ ( 'Vacant' == $data['listingsDetails']->secondary_showing_contact) ? 'selected' : '' }}>Vacant</option>
                                                                         <option value="Other" {{ ( 'Other' == $data['listingsDetails']->secondary_showing_contact) ? 'selected' : '' }}>Other</option>
                                                                        </select>
                                                                     </div>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 mb-3">
                                                                    <label for="">Lockbox Location</label>
                                                                    <div class="form-group">
                                                                       <textarea name="lockbox_location" id="lockbox_location" class="form-control" rows="7">{{ $data['listingsDetails']->lockbox_location }}</textarea>
                                                                       <span><code>Where the box is placed if other than on the front door. Only reference MetroList iBox.</code></span>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Gate/Access Code</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="get_access_code" value="{{ $data['listingsDetails']->get_access_code }}" placeholder="" aria-label="get_access_code" aria-describedby="basic-addon1">
                                                                        <code>Code for gated community, building, parking garage access (not to enter garage to get in the home), chain on gate to access land
                                                                            listings, or to access any amenities other than the actual home being sold.</code>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Occupant Type</label>
                                                                    <div class="form-group">
                                                                        <select name="occupant_type" id="occupant_type" class="form-control select2">
                                                                         <option value="" {{ ( '' == $data['listingsDetails']->occupant_type) ? 'selected' : '' }}>Choose type...</option>
                                                                         <option value="Owner" {{ ( 'Owner' == $data['listingsDetails']->occupant_type) ? 'selected' : '' }}>Owner</option>
                                                                         <option value="Tenant" {{ ( 'Tenant' == $data['listingsDetails']->occupant_type) ? 'selected' : '' }}>Tenant</option>
                                                                         <option value="Vacant" {{ ( 'Vacant' == $data['listingsDetails']->occupant_type) ? 'selected' : '' }}>Vacant</option>
                                                                        </select>
                                                                     </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Current Rent</label>
                                                                    <div class="form-group">
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">$</span>
                                                                            <input type="number" class="form-control" name="current_rent" value="{{ $data['listingsDetails']->current_rent }}" placeholder="" aria-label="current_rent" aria-describedby="basic-addon1">
                                                                            <code>Current Rent of property being charged by Seller who does not live at the property.</code>
                                                                          </div>
                                                                     </div>
                                                                </div>  
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Zoning</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="zoning" value="{{ $data['listingsDetails']->zoning }}" placeholder="" aria-label="zoning" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Census Tract</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="census_tract" value="{{ $data['listingsDetails']->census_tract }}" placeholder="" aria-label="census_tract" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Elevation</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="elevation" value="{{ $data['listingsDetails']->elevation }}" placeholder="" aria-label="elevation" aria-describedby="basic-addon1">
                                                                        <code>Elevation of the property in feet above sea level, not the elevation of the actual home from the foundation.</code>
                                                                    </div>
                                                                </div>  
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Area/District</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="area_district" value="{{ $data['listingsDetails']->area_district }}" placeholder="" aria-label="area_district" aria-describedby="basic-addon1">
                
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Approx SqFt</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="approx_sqft" value="{{ $data['listingsDetails']->approx_sqft }}" placeholder="" aria-label="approx_sqft" aria-describedby="basic-addon1">
                                                                        
                                                                     </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">SqFt Source</label>
                                                                    <div class="form-group">
                                                                        <select name="sqft_source" id="sqft_source" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Choose...</option>
                                                                            <option value="Against Co Policy" {{ ( 'Against Co Policy' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Against Co Policy</option>
                                                                            <option value="Appraiser" {{ ( 'Appraiser' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Appraiser</option>
                                                                            <option value="Architect" {{ ( 'Architect' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Architect</option>
                                                                            <option value="Broker" {{ ( 'Broker' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Broker</option>
                                                                            <option value="Builder" {{ ( 'Builder' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Builder</option>
                                                                            <option value="Condo Map" {{ ( 'Condo Map' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Condo Map</option>
                                                                            <option value="Graphic Artist" {{ ( 'Graphic Artist' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Graphic Artist</option>
                                                                            <option value="Housing Community Development" {{ ( 'Housing Community Development' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Housing Community Development</option>
                                                                            <option value="Measured by Agent" {{ ( 'Measured by Agent' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Measured by Agent</option>
                                                                            <option value="Not Available" {{ ( 'Not Available' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Not Available</option>
                                                                            <option value="Not Verified" {{ ( 'Not Verified' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Not Verified</option>
                                                                            <option value="Owner" {{ ( 'Owner' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Owner</option>
                                                                            <option value="Verified" {{ ( 'Verified' == $data['listingsDetails']->sqft_source) ? 'selected' : '' }}>Verified</option>
                                                                           </select>
                                                                     </div>
                                                                </div>  
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Bedrooms</label>
                                                                    <div class="form-group">
                                                                        <select name="bedrooms" id="bedrooms" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->bedrooms) ? 'selected' : '' }}>Choose...</option>
                                                                            <?php for ($i=1; $i <=50 ; $i++) { ?>
                                                                                <option value="<?php echo $i; ?>" {{ ( $i == $data['listingsDetails']->bedrooms) ? 'selected' : '' }}><?php echo $i; ?></option>
                                                                            <?php } ?>
                                                                           </select>
                                                                     </div>
                                                                </div>

                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Total Possible Bedrooms</label>
                                                                    <div class="form-group">
                                                                        <select name="total_possible_bedrooms" id="total_possible_bedrooms" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->total_possible_bedrooms) ? 'selected' : '' }}>Choose...</option>
                                                                            <?php for ($i=1; $i <=50 ; $i++) { ?>
                                                                                <option value="<?php echo $i; ?>" {{ ( $i == $data['listingsDetails']->total_possible_bedrooms) ? 'selected' : '' }}><?php echo $i; ?></option>
                                                                            <?php } ?>
                                                                           </select>
                                                                     </div>
                                                                </div>

                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Bathrooms(Full Baths)</label>
                                                                    <div class="form-group">
                                                                        <select name="full_baths" id="full_baths" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->full_baths) ? 'selected' : '' }}>Choose...</option>
                                                                            <?php for ($i=1; $i <=50 ; $i++) { ?>
                                                                                <option value="<?php echo $i; ?>" {{ ( $i == $data['listingsDetails']->full_baths) ? 'selected' : '' }}><?php echo $i; ?></option>
                                                                            <?php } ?>
                                                                           </select>
                                                                     </div>
                                                                </div>  

                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Bathrooms(Partial Bathrooms)</label>
                                                                    <div class="form-group">
                                                                        <select name="partial_bathrooms" id="partial_bathrooms" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->partial_bathrooms) ? 'selected' : '' }}>Choose...</option>
                                                                            <?php for ($i=1; $i <=50 ; $i++) { ?>
                                                                                <option value="<?php echo $i; ?>" {{ ( $i == $data['listingsDetails']->partial_bathrooms) ? 'selected' : '' }}><?php echo $i; ?></option>
                                                                            <?php } ?>
                                                                           </select>
                                                                     </div>
                                                                </div> 
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-8 mb-3">
                                                                    <label for=""># of Rooms</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="of_rooms" value="{{ $data['listingsDetails']->of_rooms }}" placeholder="" aria-label="of_rooms" aria-describedby="basic-addon1">
                
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">ADU/2nd Unit</label>
                                                                    <div class="form-group">
                                                                        <select name="adu_2nd_unit" id="adu_2nd_unit" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->adu_2nd_unit) ? 'selected' : '' }}>Choose...</option>
                                                                            <option value="Yes" {{ ( 'Yes' == $data['listingsDetails']->adu_2nd_unit) ? 'selected' : '' }}>Yes</option>
                                                                            <option value="No" {{ ( 'No' == $data['listingsDetails']->adu_2nd_unit) ? 'selected' : '' }}>No</option>
                                                                           </select>
                                                                     </div>
                                                                </div>  
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Year Built</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="year_built" value="{{ $data['listingsDetails']->year_built }}" placeholder="" aria-label="year_built" aria-describedby="basic-addon1">
                
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Year Built Source</label>
                                                                    <div class="form-group">
                                                                        <select name="year_built_source" id="year_built_source" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->year_built_source) ? 'selected' : '' }}>Choose...</option>
                                                                            <option value="Appraiser" {{ ( 'Appraiser' == $data['listingsDetails']->year_built_source) ? 'selected' : '' }}>Appraiser</option>
                                                                            <option value="Assessor Agent-Fill" {{ ( 'Assessor Agent-Fill' == $data['listingsDetails']->year_built_source) ? 'selected' : '' }}>Assessor Agent-Fill</option>
                                                                            <option value="Assessor Auto-Fill" {{ ( 'Assessor Auto-Fill' == $data['listingsDetails']->year_built_source) ? 'selected' : '' }}>Assessor Auto-Fill</option>
                                                                            <option value="Builder" {{ ( 'Builder' == $data['listingsDetails']->year_built_source) ? 'selected' : '' }}>Builder</option>
                                                                            <option value="Owner" {{ ( 'Owner' == $data['listingsDetails']->year_built_source) ? 'selected' : '' }}>Owner</option>
                                                                            <option value="Other" {{ ( 'Other' == $data['listingsDetails']->year_built_source) ? 'selected' : '' }}>Other</option>
                                                                           </select>
                                                                     </div>
                                                                </div>  
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Lot Size</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check form-check-inline" style="padding-left: 0;">
                                                                            <input type="text" class="form-control" name="lot_size" value="{{ $data['listingsDetails']->lot_size }}" placeholder="" aria-label="lot_size" aria-describedby="basic-addon1">
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="lot_size_type" id="inlineRadio1SqFt" value="SqFt" {{ ( 'SqFt' == $data['listingsDetails']->lot_size_type) ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="inlineRadio1SqFt">SqFt</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="lot_size_type" id="inlineRadio2Acres" value="Acres" {{ ( 'Acres' == $data['listingsDetails']->lot_size_type) ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="inlineRadio2Acres">Acres</label>
                                                                        </div>
                                                                          
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Lot Size Source</label>
                                                                    <div class="form-group">
                                                                        <select name="lot_size_source" id="lot_size_source" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Choose...</option>
                                                                            <option value="Against Co Policy" {{ ( 'Against Co Policy' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Against Co Policy</option>
                                                                            <option value="Appraiser" {{ ( 'Appraiser' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Appraiser</option>
                                                                            <option value="Architect" {{ ( 'Architect' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Architect</option>
                                                                            <option value="Assessor Agent-Fill" {{ ( 'Assessor Agent-Fill' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Assessor Agent-Fill</option>
                                                                            <option value="Assessor Auto-Fill" {{ ( 'Assessor Auto-Fill' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Assessor Auto-Fill</option>
                                                                            <option value="Builder" {{ ( 'Builder' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Builder</option>
                                                                            <option value="Graphic Artist" {{ ( 'Graphic Artist' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Graphic Artist</option>
                                                                            <option value="Condo Map" {{ ( 'Condo Map' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Condo Map</option>
                                                                            <option value="Graphic Artist" {{ ( 'Graphic Artist' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Graphic Artist</option>
                                                                            <option value="Measured by Agent" {{ ( 'Measured by Agent' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Measured by Agent</option>
                                                                            <option value="Not Available" {{ ( 'Not Available' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Not Available</option>
                                                                            <option value="Not Verified" {{ ( 'Not Verified' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Not Verified</option>
                                                                            <option value="Owner" {{ ( 'Owner' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Owner</option>
                                                                            <option value="Verified" {{ ( 'Verified' == $data['listingsDetails']->lot_size_source) ? 'selected' : '' }}>Verified</option>
                                                                           </select>
                                                                     </div>
                                                                </div> 
                                                                
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Lot Size Dimensions</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="lot_size_dimensions" value="{{ $data['listingsDetails']->lot_size_dimensions }}" placeholder="" aria-label="lot_size_dimensions" aria-describedby="basic-addon1">
                
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">School District (County)</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="school_district_county" value="{{ $data['listingsDetails']->school_district_county }}" placeholder="" aria-label="school_district_county" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">School Type 1</label>
                                                                    <div class="form-group">
                                                                        <select name="school_type_1" id="school_type_1" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->school_type_1) ? 'selected' : '' }}>Choose...</option>
                                                                            <option value="Elementary School District" {{ ( 'Elementary School District' == $data['listingsDetails']->school_type_1) ? 'selected' : '' }}>Elementary School District</option>
                                                                            <option value="Middle Or Junior School District" {{ ( 'Middle Or Junior School District' == $data['listingsDetails']->school_type_1) ? 'selected' : '' }}>Middle Or Junior School District</option>
                                                                            <option value="Senior High School District" {{ ( 'Senior High School District' == $data['listingsDetails']->school_type_1) ? 'selected' : '' }}>Senior High School District</option>
                                                                           </select>
                                                                     </div>
                                                                </div> 
                                                                
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="school_type_1_value" value="{{ $data['listingsDetails']->school_type_1_value }}" placeholder="" aria-label="school_type_1_value" aria-describedby="basic-addon1">
                
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">School Type 2</label>
                                                                    <div class="form-group">
                                                                        <select name="school_type_2" id="school_type_2" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->school_type_2) ? 'selected' : '' }}>Choose...</option>
                                                                            <option value="Elementary School District" {{ ( 'Elementary School District' == $data['listingsDetails']->school_type_2) ? 'selected' : '' }}>Elementary School District</option>
                                                                            <option value="Middle Or Junior School District" {{ ( 'Middle Or Junior School District' == $data['listingsDetails']->school_type_2) ? 'selected' : '' }}>Middle Or Junior School District</option>
                                                                            <option value="Senior High School District" {{ ( 'Senior High School District' == $data['listingsDetails']->school_type_2) ? 'selected' : '' }}>Senior High School District</option>
                                                                           </select>
                                                                     </div>
                                                                </div> 
                                                                
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="school_type_2_value" value="{{ $data['listingsDetails']->school_type_2_value }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">School Type 3</label>
                                                                    <div class="form-group">
                                                                        <select name="school_type_3" id="school_type_3" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->school_type_3) ? 'selected' : '' }}>Choose...</option>
                                                                            <option value="Elementary School District" {{ ( 'Elementary School District' == $data['listingsDetails']->school_type_3) ? 'selected' : '' }}>Elementary School District</option>
                                                                            <option value="Middle Or Junior School District" {{ ( 'Middle Or Junior School District' == $data['listingsDetails']->school_type_3) ? 'selected' : '' }}>Middle Or Junior School District</option>
                                                                            <option value="Senior High School District" {{ ( 'Senior High School District' == $data['listingsDetails']->school_type_3) ? 'selected' : '' }}>Senior High School District</option>
                                                                           </select>
                                                                     </div>
                                                                </div> 
                                                                
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="school_type_3_value" value="{{ $data['listingsDetails']->school_type_3_value }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Subdivision</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="subdivision" value="{{ $data['listingsDetails']->subdivision }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                     </div>
                                                                </div> 
                                                                
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Subdivision Developer</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="subdivision_developer" value="{{ $data['listingsDetails']->subdivision_developer }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Builder Model</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="builder_model" value="{{ $data['listingsDetails']->builder_model }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                     </div>
                                                                </div> 
                                                                
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="">Builder Name</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="builder_name" value="{{ $data['listingsDetails']->builder_name }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>

                                                            @php
                                                                $subtype_description = [];

                                                                if(!empty($data['listingsDetails']->subtype_description)) {
                                                                    $subtype_description = json_decode($data['listingsDetails']->subtype_description);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Subtype Description</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox1" value="Attached" {{ in_array('Attached',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox1">Attached</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox2" value="Custom" {{ in_array('Custom',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox2">Custom</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox3" value="Detached" {{ in_array('Detached',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox3">Detached</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox4" value="Flat" {{ in_array('Flat',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox4">Flat</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox5" value="Full" {{ in_array('Full',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox5">Full</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox6" value="Junior" {{ in_array('Junior',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox6">Junior</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox7" value="Live/Work" {{ in_array('Live/Work',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox7">Live/Work</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox8" value="Loft" {{ in_array('Loft',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox8">Loft</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox9" value="Luxury" {{ in_array('Luxury',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox9">Luxury</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox10" value="Modified" {{ in_array('Modified',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox10">Modified</label>
                                                                          </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox11" value="Planned Unit Develop" {{ in_array('Planned Unit Develop',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox11">Planned Unit Develop</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox12" value="Ranchette/Country" {{ in_array('Ranchette/Country',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox12">Ranchette/Country</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox13" value="Semi-Attached" {{ in_array('Semi-Attached',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox13">Semi-Attached</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox14" value="Semi-Custom" {{ in_array('Semi-Custom',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox14">Semi-Custom</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox15" value="Studio" {{ in_array('Studio',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox15">Studio</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox16" value="Tract" {{ in_array('Tract',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox16">Tract</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox17" value="Low-Rise (1-3)" {{ in_array('Low-Rise (1-3)',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox17">Low-Rise (1-3)</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox18" value="Mid-Rise (4-8)" {{ in_array('Mid-Rise (4-8)',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox18">Mid-Rise (4-8)</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="subtype_description[]" id="bsinlineCheckbox19" value="Hi-Rise (9+)" {{ in_array('Hi-Rise (9+)',$subtype_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bsinlineCheckbox19">Hi-Rise (9+)</label>
                                                                          </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $architectural_style = [];

                                                                if(!empty($data['listingsDetails']->architectural_style)) {
                                                                    $architectural_style = json_decode($data['listingsDetails']->architectural_style);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Architectural Style</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox1" value="A-Frame" {{ in_array('A-Frame',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox1">A-Frame</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox2" value="Art Deco" {{ in_array('Art Deco',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox2">Art Deco</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox3" value="Arts & Crafts" {{ in_array('Arts & Crafts',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox3">Arts & Crafts</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox4" value="Barn Type" {{ in_array('Barn Type',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox4">Barn Type</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox5" value="Bungalow" {{ in_array('Bungalow',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox5">Bungalow</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox6" value="Cabin" {{ in_array('Cabin',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox6">Cabin</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox7" value="Cape Cod" {{ in_array('Cape Cod',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox7">Cape Cod</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox8" value="Chalet" {{ in_array('Chalet',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox8">Chalet</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox9" value="Colonial" {{ in_array('Colonial',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox9">Colonial</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox10" value="Contemporary" {{ in_array('Contemporary',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox10">Contemporary</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox11" value="Conversion" {{ in_array('Conversion',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox11">Conversion</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox12" value="Cottage" {{ in_array('Cottage',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox12">Cottage</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox13" value="Craftsman" {{ in_array('Craftsman',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox13">Craftsman</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox14" value="Dome" {{ in_array('Dome',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox14">Dome</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox15" value="Edwardian" {{ in_array('Edwardian',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox15">Edwardian</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox16" value="English" {{ in_array('English',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox16">English</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox17" value="Farmhouse" {{ in_array('Farmhouse',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox17">Farmhouse</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox18" value="Flat" {{ in_array('Flat',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox18">Flat</label>
                                                                          </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox19" value="French" {{ in_array('French',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox19">French</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox20" value="French Normandy" {{ in_array('French Normandy',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox20">French Normandy</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox21" value="Georgian" {{ in_array('Georgian',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox21">Georgian</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox22" value="Log" {{ in_array('Log',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox22">Log</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox23" value="Marina" {{ in_array('Marina',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox23">Marina</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox24" value="Mediterranean" {{ in_array('Mediterranean',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox24">Mediterranean</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox25" value="Mid-Century" {{ in_array('Mid-Century',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox25">Mid-Century</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox26" value="Modern/High Tech" {{ in_array('Modern/High Tech',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox26">Modern/High Tech</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox27" value="Ranch" {{ in_array('Ranch',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox27">Ranch</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox28" value="Rustic" {{ in_array('Rustic',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox28">Rustic</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox29" value="Spanish" {{ in_array('Spanish',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox29">Spanish</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox30" value="Traditional" {{ in_array('Traditional',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox30">Traditional</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox31" value="Tudor" {{ in_array('Tudor',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox31">Tudor</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox32" value="Victorian" {{ in_array('Victorian',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox32">Victorian</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox33" value="Vintage" {{ in_array('Vintage',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox33">Vintage</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox34" value="Yurt" {{ in_array('Yurt',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox34">Yurt</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox35" value="See Remarks" {{ in_array('See Remarks',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox35">See Remarks</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="architectural_style[]" id="absinlineCheckbox36" value="Other" {{ in_array('Other',$architectural_style) ?'checked':null }}>
                                                                            <label class="form-check-label" for="absinlineCheckbox36">Other</label>
                                                                          </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Property Faces</label>
                                                                    <div class="form-group">
                                                                        <select name="property_faces" id="property_faces" class="form-control select2">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->property_faces) ? 'selected' : '' }}>Choose...</option>
                                                                            <option value="East" {{ ( 'East' == $data['listingsDetails']->property_faces) ? 'selected' : '' }}>East</option>
                                                                            <option value="North" {{ ( 'North' == $data['listingsDetails']->property_faces) ? 'selected' : '' }}>North</option>
                                                                            <option value="Northeast" {{ ( 'Northeast' == $data['listingsDetails']->property_faces) ? 'selected' : '' }}>Northeast</option>
                                                                            <option value="Northwest" {{ ( 'Northwest' == $data['listingsDetails']->property_faces) ? 'selected' : '' }}>Northwest</option>
                                                                            <option value="South" {{ ( 'South' == $data['listingsDetails']->property_faces) ? 'selected' : '' }}>South</option>
                                                                            <option value="Southeast" {{ ( 'Southeast' == $data['listingsDetails']->property_faces) ? 'selected' : '' }}>Southeast</option>
                                                                            <option value="Southwest" {{ ( 'Southwest' == $data['listingsDetails']->property_faces) ? 'selected' : '' }}>Southwest</option>
                                                                            <option value="West" {{ ( 'West' == $data['listingsDetails']->property_faces) ? 'selected' : '' }}>West</option>
                                                                           </select>
                                                                     </div>
                                                                </div> 
                                                                
                                                                <div class="col-lg-6 mb-3">
                                                                    
                                                                </div>
                                                                
                                                            </div>

                                                            @php
                                                                $construction_materials = [];

                                                                if(!empty($data['listingsDetails']->construction_materials)) {
                                                                    $construction_materials = json_decode($data['listingsDetails']->construction_materials);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Construction Materials</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox1" value="Adobe" {{ in_array('Adobe',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox1">Adobe</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox2" value="Aluminum Siding" {{ in_array('Aluminum Siding',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox2">Aluminum Siding</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox3" value="Block" {{ in_array('Block',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox3">Block</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox4" value="Brick" {{ in_array('Brick',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox4">Brick</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox5" value="Brick Veneer" {{ in_array('Brick Veneer',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox5">Brick Veneer</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox6" value="Ceiling Insulation" {{ in_array('Ceiling Insulation',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox6">Ceiling Insulation</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox7" value="Cement Siding" {{ in_array('Cement Siding',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox7">Cement Siding</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox8" value="Concrete" {{ in_array('Concrete',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox8">Concrete</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox9" value="Fiber Cement" {{ in_array('Fiber Cement',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox9">Fiber Cement</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox10" value="Fiberglass Siding" {{ in_array('Fiberglass Siding',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox10">Fiberglass Siding</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox11" value="Floor Insulation" {{ in_array('Floor Insulation',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox11">Floor Insulation</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox12" value="Frame" {{ in_array('Frame',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox12">Frame</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox13" value="Glass" {{ in_array('Glass',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox13">Glass</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox14" value="Lap Siding" {{ in_array('Lap Siding',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox14">Lap Siding</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox15" value="Log" {{ in_array('Log',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox15">Log</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox16" value="Masonry Reinforced" {{ in_array('Masonry Reinforced',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox16">Masonry Reinforced</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox17" value="Masonry Unreinforced" {{ in_array('Masonry Unreinforced',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox17">Masonry Unreinforced</label>
                                                                          </div>

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">

                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox18" value="Metal" {{ in_array('Metal',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox18">Metal</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox19" value="Metal Siding" {{ in_array('Metal Siding',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox19">Metal Siding</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox20" value="Partial Insulation" {{ in_array('Partial Insulation',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox20">Partial Insulation</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox21" value="Plaster" {{ in_array('Plaster',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox21">Plaster</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox22" value="Prefabricated" {{ in_array('Prefabricated',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox22">Prefabricated</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox23" value="Rammed Earth" {{ in_array('Rammed Earth',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox23">Rammed Earth</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox24" value="Redwood Siding" {{ in_array('Redwood Siding',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox24">Redwood Siding</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox25" value="Shingle Siding" {{ in_array('Shingle Siding',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox25">Shingle Siding</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox26" value="Stone" {{ in_array('Stone',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox26">Stone</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox27" value="Straw" {{ in_array('Straw',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox27">Straw</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox28" value="Stucco" {{ in_array('Stucco',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox28">Stucco</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox29" value="Vinyl Siding" {{ in_array('Vinyl Siding',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox29">Vinyl Siding</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox30" value="Wall Insulation" {{ in_array('Wall Insulation',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox30">Wall Insulation</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox31" value="Wood" {{ in_array('Wood',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox31">Wood</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox32" value="Wood Siding" {{ in_array('Wood Siding',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox32">Wood Siding</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox33" value="See Remarks" {{ in_array('See Remarks',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox33">See Remarks</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="construction_materials[]" id="cabsinlineCheckbox34" value="Other" {{ in_array('Other',$construction_materials) ?'checked':null }}>
                                                                            <label class="form-check-label" for="cabsinlineCheckbox34">Other</label>
                                                                          </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $foundation = [];

                                                                if(!empty($data['listingsDetails']->foundation)) {
                                                                    $foundation = json_decode($data['listingsDetails']->foundation);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Foundation</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox1" value="Block" {{ in_array('Block',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox1">Block</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox2" value="Brick/Mortar" {{ in_array('Brick/Mortar',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox2">Brick/Mortar</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox3" value="Capped Brick" {{ in_array('Capped Brick',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox3">Capped Brick</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox4" value="Combination" {{ in_array('Combination',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox4">Combination</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox5" value="Concrete" {{ in_array('Concrete',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox5">Concrete</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox6" value="Concrete Grid" {{ in_array('Concrete Grid',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox6">Concrete Grid</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox7" value="Concrete Perimeter" {{ in_array('Concrete Perimeter',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox7">Concrete Perimeter</label>
                                                                          </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox8" value="Masonry Perimeter" {{ in_array('Masonry Perimeter',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox8">Masonry Perimeter</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox9" value="Piling" {{ in_array('Piling',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox9">Piling</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox10" value="Pillar/Post/Pier" {{ in_array('Pillar/Post/Pier',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox10">Pillar/Post/Pier</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox11" value="Raised" {{ in_array('Raised',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox11">Raised</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox12" value="Slab" {{ in_array('Slab',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox12">Slab</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox13" value="See Remarks" {{ in_array('See Remarks',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox13">See Remarks</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="foundation[]" id="fcabsinlineCheckbox14" value="Other" {{ in_array('Other',$foundation) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fcabsinlineCheckbox14">Other</label>
                                                                          </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $view_description = [];

                                                                if(!empty($data['listingsDetails']->view_description)) {
                                                                    $view_description = json_decode($data['listingsDetails']->view_description);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">View Description</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox1" value="Bridges" {{ in_array('Bridges',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox1">Bridges</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox2" value="Canyon" {{ in_array('Canyon',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox2">Canyon</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox3" value="City" {{ in_array('City',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox3">City</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox4" value="City Lights" {{ in_array('City Lights',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox4">City Lights</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox5" value="Downtown" {{ in_array('Downtown',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox5">Downtown</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox6" value="Forest" {{ in_array('Forest',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox6">Forest</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox7" value="Garden/Greenbelt" {{ in_array('Garden/Greenbelt',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox7">Garden/Greenbelt</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox8" value="Golf Course" {{ in_array('Golf Course',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox8">Golf Course</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox9" value="Hills" {{ in_array('Hills',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox9">Hills</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox10" value="Lake" {{ in_array('Lake',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox10">Lake</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox11" value="Marina" {{ in_array('Marina',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox11">Marina</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox12" value="Mountains" {{ in_array('Mountains',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox12">Mountains</label>
                                                                          </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox13" value="Orchard" {{ in_array('Orchard',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox13">Orchard</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox14" value="Panoramic" {{ in_array('Panoramic',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox14">Panoramic</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox15" value="Park" {{ in_array('Park',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox15">Park</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox16" value="Pasture" {{ in_array('Pasture',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox16">Pasture</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox17" value="Ridge" {{ in_array('Ridge',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox17">Ridge</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox18" value="River" {{ in_array('River',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox18">River</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox19" value="Valley" {{ in_array('Valley',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox19">Valley</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox20" value="Vineyard" {{ in_array('Vineyard',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox20">Vineyard</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox21" value="Water" {{ in_array('Water',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox21">Water</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox22" value="Woods" {{ in_array('Woods',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox22">Woods</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="view_description[]" id="vfcabsinlineCheckbox23" value="Other" {{ in_array('Other',$view_description) ?'checked':null }}>
                                                                            <label class="form-check-label" for="vfcabsinlineCheckbox23">Other</label>
                                                                          </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $parking_features = [];

                                                                if(!empty($data['listingsDetails']->parking_features)) {
                                                                    $parking_features = json_decode($data['listingsDetails']->parking_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Parking Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox1" value="1/2 Car Space" {{ in_array('1/2 Car Space',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox1">1/2 Car Space</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox2" value="24'+ Deep Garage" {{ in_array("24'+ Deep Garage",$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox2">24'+ Deep Garage</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox3" value="Alley Access" {{ in_array('Alley Access',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox3">Alley Access</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox4" value="Assigned" {{ in_array('Assigned',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox4">Assigned</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox5" value="Attached" {{ in_array('Attached',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox5">Attached</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox6" value="Boat Dock" {{ in_array('Boat Dock',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox6">Boat Dock</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox7" value="Boat Storage" {{ in_array('Boat Storage',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox7">Boat Storage</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox8" value="Converted Garage" {{ in_array('Converted Garage',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox8">Converted Garage</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox9" value="Covered" {{ in_array('Covered',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox9">Covered</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox10" value="Deck" {{ in_array('Deck',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox10">Deck</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox11" value="Detached" {{ in_array('Detached',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox11">Detached</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox12" value="Drive Thru Garage" {{ in_array('Drive Thru Garage',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox12">Drive Thru Garage</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox13" value="Enclosed" {{ in_array('Enclosed',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox13">Enclosed</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox14" value="EV Charging" {{ in_array('EV Charging',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox14">EV Charging</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox15" value="Garage Door Opener" {{ in_array('Garage Door Opener',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox15">Garage Door Opener</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox16" value="Garage Facing Front" {{ in_array('Garage Facing Front',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox16">Garage Facing Front</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox17" value="Garage Facing Rear" {{ in_array('Garage Facing Rear',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox17">Garage Facing Rear</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox18" value="Garage Facing Side" {{ in_array('Garage Facing Side',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox18">Garage Facing Side</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox19" value="Golf Cart" {{ in_array('Golf Cart',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox19">Golf Cart</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox20" value="Guest Parking Available" {{ in_array('Guest Parking Available',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox20">Guest Parking Available</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox21" value="Interior Access" {{ in_array('Interior Access',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox21">Interior Access</label>
                                                                          </div>

                                                                          <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox22" value="Mechanical Lift" {{ in_array('Mechanical Lift',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox22">Mechanical Lift</label>
                                                                          </div>             
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                    <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox23" value="No Garage" {{ in_array('No Garage',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox23">No Garage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox24" value="Permit Required" {{ in_array('Permit Required',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox24">Permit Required</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox25" value="Plane Port" {{ in_array('Plane Port',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox25">Plane Port</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox26" value="Private" {{ in_array('Private',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox26">Private</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox27" value="Restrictions" {{ in_array('Restrictions',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox27">Restrictions</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox28" value="Rotational" {{ in_array('Rotational',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox28">Rotational</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox29" value="RV Access" {{ in_array('RV Access',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox29">RV Access</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox30" value="RV Garage Attached" {{ in_array('RV Garage Attached',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox30">RV Garage Attached</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox31" value="RV Garage Detached" {{ in_array('RV Garage Detached',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox31">RV Garage Detached</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox32" value="RV Possible" {{ in_array('RV Possible',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox32">RV Possible</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox33" value="RV Storage" {{ in_array('RV Storage',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox33">RV Storage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox34" value="Side-by-Side" {{ in_array('Side-by-Side',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox34">Side-by-Side</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox35" value="Size Limited" {{ in_array('Size Limited',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox35">Size Limited</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox36" value="Tandem Garage" {{ in_array('Tandem Garage',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox36">Tandem Garage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox37" value="Unassigned" {{ in_array('Unassigned',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox37">Unassigned</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox38" value="Uncovered Parking Space" {{ in_array('Uncovered Parking Space',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox38">Uncovered Parking Space</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox39" value="Uncovered Parking Spaces 2+" {{ in_array('Uncovered Parking Spaces 2+',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox39">Uncovered Parking Spaces 2+</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox40" value="Underground Parking" {{ in_array('Underground Parking',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox40">Underground Parking</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox41" value="Valet" {{ in_array('Valet',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox41">Valet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox42" value="Workshop in Garage" {{ in_array('Workshop in Garage',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox42">Workshop in Garage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox43" value="See Remarks" {{ in_array('See Remarks',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox43">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="parking_features[]" id="pvfcabsinlineCheckbox44" value="Other" {{ in_array('Other',$parking_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="pvfcabsinlineCheckbox44">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Garage Spaces</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="garage_spaces" value="{{ $data['listingsDetails']->garage_spaces }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                     </div>
                                                                </div> 
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Carport Spaces</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="carport_spaces" value="{{ $data['listingsDetails']->carport_spaces }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Open Parking Spaces</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="open_parking_spaces" value="{{ $data['listingsDetails']->open_parking_spaces }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                     </div>
                                                                </div> 
                                                            </div>

                                                            @php
                                                                $driveway_sidewalks = [];

                                                                if(!empty($data['listingsDetails']->driveway_sidewalks)) {
                                                                    $driveway_sidewalks = json_decode($data['listingsDetails']->driveway_sidewalks);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Driveway/Sidewalks</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="driveway_sidewalks[]" id="dvfcabsinlineCheckbox1" value="Gated" {{ in_array('Gated',$driveway_sidewalks) ?'checked':null }}>
                                                                            <label class="form-check-label" for="dvfcabsinlineCheckbox1">Gated</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="driveway_sidewalks[]" id="dvfcabsinlineCheckbox2" value="Gravel" {{ in_array('Gravel',$driveway_sidewalks) ?'checked':null }}>
                                                                            <label class="form-check-label" for="dvfcabsinlineCheckbox2">Gravel</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="driveway_sidewalks[]" id="dvfcabsinlineCheckbox3" value="Maintenance Agreement" {{ in_array('Maintenance Agreement',$driveway_sidewalks) ?'checked':null }}>
                                                                            <label class="form-check-label" for="dvfcabsinlineCheckbox3">Maintenance Agreement</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="driveway_sidewalks[]" id="dvfcabsinlineCheckbox4" value="Paved Driveway" {{ in_array('Paved Driveway',$driveway_sidewalks) ?'checked':null }}>
                                                                            <label class="form-check-label" for="dvfcabsinlineCheckbox4">Paved Driveway</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="driveway_sidewalks[]" id="dvfcabsinlineCheckbox5" value="Paved Sidewalk" {{ in_array('Paved Sidewalk',$driveway_sidewalks) ?'checked':null }}>
                                                                            <label class="form-check-label" for="dvfcabsinlineCheckbox5">Paved Sidewalk</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="driveway_sidewalks[]" id="dvfcabsinlineCheckbox6" value="Shared Driveway" {{ in_array('Shared Driveway',$driveway_sidewalks) ?'checked':null }}>
                                                                            <label class="form-check-label" for="dvfcabsinlineCheckbox6">Shared Driveway</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="driveway_sidewalks[]" id="dvfcabsinlineCheckbox7" value="Sidewalk/Curb/Gutter" {{ in_array('Sidewalk/Curb/Gutter',$driveway_sidewalks) ?'checked':null }}>
                                                                            <label class="form-check-label" for="dvfcabsinlineCheckbox7">Sidewalk/Curb/Gutter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="driveway_sidewalks[]" id="dvfcabsinlineCheckbox8" value="Unpaved" {{ in_array('Unpaved',$driveway_sidewalks) ?'checked':null }}>
                                                                            <label class="form-check-label" for="dvfcabsinlineCheckbox8">Unpaved</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 mb-3">
                                                                    <label for="">Stories</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="stories" value="{{ $data['listingsDetails']->stories }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                     </div>
                                                                </div> 
                                                            </div>

                                                            @php
                                                                $levels = [];

                                                                if(!empty($data['listingsDetails']->levels)) {
                                                                    $levels = json_decode($data['listingsDetails']->levels);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Levels</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="levels[]" id="lvfcabsinlineCheckbox1" value="One" {{ in_array('One',$levels) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lvfcabsinlineCheckbox1">One</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="levels[]" id="lvfcabsinlineCheckbox2" value="Two" {{ in_array('Two',$levels) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lvfcabsinlineCheckbox2">Two</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="levels[]" id="lvfcabsinlineCheckbox3" value="Three Or More" {{ in_array('Three Or More',$levels) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lvfcabsinlineCheckbox3">Three Or More</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="levels[]" id="lvfcabsinlineCheckbox4" value="Multi/Split" {{ in_array('Multi/Split',$levels) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lvfcabsinlineCheckbox4">Multi/Split</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $lower_level = [];

                                                                if(!empty($data['listingsDetails']->lower_level)) {
                                                                    $lower_level = json_decode($data['listingsDetails']->lower_level);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Lower Level</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox1" value="Bedroom(s)" {{ in_array('Bedroom(s)',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox1">Bedroom(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox2" value="Dining Room" {{ in_array('Dining Room',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox2">Dining Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox3" value="Family Room" {{ in_array('Family Room',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox3">Family Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox4" value="Full Bath(s)" {{ in_array('Full Bath(s)',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox4">Full Bath(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox5" value="Garage" {{ in_array('Garage',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox5">Garage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox6" value="Kitchen" {{ in_array('Kitchen',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox6">Kitchen</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox7" value="Living Room" {{ in_array('Living Room',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox7">Living Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox8" value="Loft" {{ in_array('Loft',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox8">Loft</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox9" value="Master Bedroom" {{ in_array('Master Bedroom',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox9">Master Bedroom</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox10" value="Partial Bath(s)" {{ in_array('Partial Bath(s)',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox10">Partial Bath(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox11" value="Retreat" {{ in_array('Retreat',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox11">Retreat</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lower_level[]" id="llvfcabsinlineCheckbox12" value="Street Entrance" {{ in_array('Street Entrance',$lower_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="llvfcabsinlineCheckbox12">Street Entrance</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $main_level = [];

                                                                if(!empty($data['listingsDetails']->main_level)) {
                                                                    $main_level = json_decode($data['listingsDetails']->main_level);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Main Level</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox1" value="Bedroom(s)" {{ in_array('Bedroom(s)',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox1">Bedroom(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox2" value="Dining Room" {{ in_array('Dining Room',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox2">Dining Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox3" value="Family Room" {{ in_array('Family Room',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox3">Family Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox4" value="Full Bath(s)" {{ in_array('Full Bath(s)',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox4">Full Bath(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox5" value="Garage" {{ in_array('Garage',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox5">Garage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox6" value="Kitchen" {{ in_array('Kitchen',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox6">Kitchen</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox7" value="Living Room" {{ in_array('Living Room',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox7">Living Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox8" value="Loft" {{ in_array('Loft',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox8">Loft</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox9" value="Master Bedroom" {{ in_array('Master Bedroom',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox9">Master Bedroom</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox10" value="Partial Bath(s)" {{ in_array('Partial Bath(s)',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox10">Partial Bath(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox11" value="Retreat" {{ in_array('Retreat',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox11">Retreat</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="main_level[]" id="mllvfcabsinlineCheckbox12" value="Street Entrance" {{ in_array('Street Entrance',$main_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mllvfcabsinlineCheckbox12">Street Entrance</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $upper_level = [];

                                                                if(!empty($data['listingsDetails']->upper_level)) {
                                                                    $upper_level = json_decode($data['listingsDetails']->upper_level);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Upper Level</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox1" value="Bedroom(s)" {{ in_array('Bedroom(s)',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox1">Bedroom(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox2" value="Dining Room" {{ in_array('Dining Room',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox2">Dining Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox3" value="Family Room" {{ in_array('Family Room',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox3">Family Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox4" value="Full Bath(s)" {{ in_array('Full Bath(s)',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox4">Full Bath(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox5" value="Garage" {{ in_array('Garage',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox5">Garage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox6" value="Kitchen" {{ in_array('Kitchen',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox6">Kitchen</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox7" value="Living Room" {{ in_array('Living Room',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox7">Living Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox8" value="Loft" {{ in_array('Loft',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox8">Loft</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox9" value="Master Bedroom" {{ in_array('Master Bedroom',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox9">Master Bedroom</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox10" value="Partial Bath(s)" {{ in_array('Partial Bath(s)',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox10">Partial Bath(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox11" value="Retreat" {{ in_array('Retreat',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox11">Retreat</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="upper_level[]" id="ullvfcabsinlineCheckbox12" value="Street Entrance" {{ in_array('Street Entrance',$upper_level) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox12">Street Entrance</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $basement = [];

                                                                if(!empty($data['listingsDetails']->basement)) {
                                                                    $basement = json_decode($data['listingsDetails']->basement);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Basement</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="basement[]" id="ullvfcabsinlineCheckbox1w" value="Full" {{ in_array('Full',$basement) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox1w">Full</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="basement[]" id="ullvfcabsinlineCheckbox2w" value="Partial" {{ in_array('Partial',$basement) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ullvfcabsinlineCheckbox2w">Partial</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $interior_features = [];

                                                                if(!empty($data['listingsDetails']->interior_features)) {
                                                                    $interior_features = json_decode($data['listingsDetails']->interior_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Interior Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="interior_features[]" id="ifvfcabsinlineCheckbox1" value="Cathedral Ceiling" {{ in_array('Cathedral Ceiling',$interior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ifvfcabsinlineCheckbox1">Cathedral Ceiling</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="interior_features[]" id="ifvfcabsinlineCheckbox2" value="Formal Entry" {{ in_array('Formal Entry',$interior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ifvfcabsinlineCheckbox2">Formal Entry</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="interior_features[]" id="ifvfcabsinlineCheckbox3" value="Open Beam Ceiling" {{ in_array('Open Beam Ceiling',$interior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ifvfcabsinlineCheckbox3">Open Beam Ceiling</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="interior_features[]" id="ifvfcabsinlineCheckbox4" value="Skylight Tube" {{ in_array('Skylight Tube',$interior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ifvfcabsinlineCheckbox4">Skylight Tube</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="interior_features[]" id="ifvfcabsinlineCheckbox5" value="Skylight(s)" {{ in_array('Skylight(s)',$interior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ifvfcabsinlineCheckbox5">Skylight(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="interior_features[]" id="ifvfcabsinlineCheckbox6" value="Storage Area(s)" {{ in_array('Storage Area(s)',$interior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ifvfcabsinlineCheckbox6">Storage Area(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="interior_features[]" id="ifvfcabsinlineCheckbox7" value="Wet Bar" {{ in_array('Wet Bar',$interior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="ifvfcabsinlineCheckbox7">Wet Bar</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $room_type = [];

                                                                if(!empty($data['listingsDetails']->room_type)) {
                                                                    $room_type = json_decode($data['listingsDetails']->room_type);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Room Type</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox1" value="Atrium" {{ in_array('Atrium',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox1">Atrium</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox2" value="Attic" {{ in_array('Attic',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox2">Attic</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox3" value="Baths Other" {{ in_array('Baths Other',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox3">Baths Other</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox4" value="Bonus Room" {{ in_array('Bonus Room',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox4">Bonus Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox5" value="Converted Garage" {{ in_array('Converted Garage',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox5">Converted Garage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox6" value="Den" {{ in_array('Den',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox6">Den</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox7" value="Dining Room" {{ in_array('Dining Room',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox7">Dining Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox8" value="Family Room" {{ in_array('Family Room',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox8">Family Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox9" value="Game Room" {{ in_array('Game Room',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox9">Game Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox10" value="Great Room" {{ in_array('Great Room',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox10">Great Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox11" value="Guest Quarters" {{ in_array('Guest Quarters',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox11">Guest Quarters</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox12" value="Home Theater" {{ in_array('Home Theater',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox12">Home Theater</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox13" value="In Law Apartment" {{ in_array('In Law Apartment',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox13">In Law Apartment</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox14" value="Kitchen" {{ in_array('Kitchen',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox14">Kitchen</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox15" value="Laundry" {{ in_array('Laundry',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox15">Laundry</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox16" value="Library" {{ in_array('Library',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox16">Library</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox17" value="Living Room" {{ in_array('Living Room',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox17">Living Room</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox18" value="Loft" {{ in_array('Loft',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox18">Loft</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox19" value="Master Bathroom" {{ in_array('Master Bathroom',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox19">Master Bathroom</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox20" value="Master Bedroom" {{ in_array('Master Bedroom',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox20">Master Bedroom</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox21" value="Master Bedrooms 2+" {{ in_array('Master Bedrooms 2+',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox21">Master Bedrooms 2+</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox22" value="Media Room" {{ in_array('Media Room',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox22">Media Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox23" value="Office" {{ in_array('Office',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox23">Office</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox24" value="Possible Guest" {{ in_array('Possible Guest',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox24">Possible Guest</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox25" value="Solarium" {{ in_array('Solarium',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox25">Solarium</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox26" value="Storage" {{ in_array('Storage',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox26">Storage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox27" value="Studio" {{ in_array('Studio',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox27">Studio</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox28" value="Sun Room" {{ in_array('Sun Room',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox28">Sun Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox29" value="Temp Controlled Room" {{ in_array('Temp Controlled Room',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox29">Temp Controlled Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox30" value="Wine Cellar" {{ in_array('Wine Cellar',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox30">Wine Cellar</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox31" value="Wine Storage Area" {{ in_array('Wine Storage Area',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox31">Wine Storage Area</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox32" value="Workshop" {{ in_array('Workshop',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox32">Workshop</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="room_type[]" id="rtvfcabsinlineCheckbox33" value="Other" {{ in_array('Other',$room_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox33">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $living_room_features = [];

                                                                if(!empty($data['listingsDetails']->living_room_features)) {
                                                                    $living_room_features = json_decode($data['listingsDetails']->living_room_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Living Room Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="living_room_features[]" id="rtvfcabsinlineCheckbox1" value="Cathedral/Vaulted" {{ in_array('Cathedral/Vaulted',$living_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox1">Cathedral/Vaulted</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="living_room_features[]" id="rtvfcabsinlineCheckbox2" value="Deck Attached" {{ in_array('Deck Attached',$living_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox2">Deck Attached</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="living_room_features[]" id="rtvfcabsinlineCheckbox3" value="Great Room" {{ in_array('Great Room',$living_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox3">Great Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="living_room_features[]" id="rtvfcabsinlineCheckbox4" value="Open Beam Ceiling" {{ in_array('Open Beam Ceiling',$living_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox4">Open Beam Ceiling</label>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="living_room_features[]" id="rtvfcabsinlineCheckbox5" value="Skylight(s)" {{ in_array('Skylight(s)',$living_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox5">Skylight(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="living_room_features[]" id="rtvfcabsinlineCheckbox6" value="Sunken" {{ in_array('Sunken',$living_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox6">Sunken</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="living_room_features[]" id="rtvfcabsinlineCheckbox7" value="View" {{ in_array('View',$living_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox7">View</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="living_room_features[]" id="rtvfcabsinlineCheckbox8" value="Other" {{ in_array('Other',$living_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rtvfcabsinlineCheckbox8">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $family_room_features = [];

                                                                if(!empty($data['listingsDetails']->family_room_features)) {
                                                                    $family_room_features = json_decode($data['listingsDetails']->family_room_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Family Room Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family_room_features[]" id="frmvfcabsinlineCheckbox1" value="Cathedral/Vaulted" {{ in_array('Cathedral/Vaulted',$family_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="frmvfcabsinlineCheckbox1">Cathedral/Vaulted</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family_room_features[]" id="frmvfcabsinlineCheckbox2" value="Deck Attached" {{ in_array('Deck Attached',$family_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="frmvfcabsinlineCheckbox2">Deck Attached</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family_room_features[]" id="frmvfcabsinlineCheckbox3" value="Great Room" {{ in_array('Great Room',$family_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="frmvfcabsinlineCheckbox3">Great Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family_room_features[]" id="frmvfcabsinlineCheckbox4" value="Open Beam Ceiling" {{ in_array('Open Beam Ceiling',$family_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="frmvfcabsinlineCheckbox4">Open Beam Ceiling</label>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family_room_features[]" id="frmvfcabsinlineCheckbox5" value="Skylight(s)" {{ in_array('Skylight(s)',$family_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="frmvfcabsinlineCheckbox5">Skylight(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family_room_features[]" id="frmvfcabsinlineCheckbox6" value="Sunken" {{ in_array('Sunken',$family_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="frmvfcabsinlineCheckbox6">Sunken</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family_room_features[]" id="frmvfcabsinlineCheckbox7" value="View" {{ in_array('View',$family_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="frmvfcabsinlineCheckbox7">View</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="family_room_features[]" id="frmvfcabsinlineCheckbox8" value="Other" {{ in_array('Other',$family_room_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="frmvfcabsinlineCheckbox8">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $kitchen_features = [];

                                                                if(!empty($data['listingsDetails']->kitchen_features)) {
                                                                    $kitchen_features = json_decode($data['listingsDetails']->kitchen_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Kitchen Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox1" value="Breakfast Area" {{ in_array('Breakfast Area',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox1">Breakfast Area</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox2" value="Breakfast Room" {{ in_array('Breakfast Room',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox2">Breakfast Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox3" value="Butcher Block Counters" {{ in_array('Butcher Block Counters',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox3">Butcher Block Counters</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox4" value="Butlers Pantry" {{ in_array('Butlers Pantry',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox4">Butlers Pantry</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox5" value="Ceramic Counter" {{ in_array('Ceramic Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox5">Ceramic Counter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox6" value="Concrete Counter" {{ in_array('Concrete Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox6">Concrete Counter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox7" value="Dumb Waiter" {{ in_array('Dumb Waiter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox7">Dumb Waiter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox8" value="Granite Counter" {{ in_array('Granite Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox8">Granite Counter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox9" value="Island" {{ in_array('Island',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox9">Island</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox10" value="Island w/Sink" {{ in_array('Island w/Sink',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox10">Island w/Sink</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox11" value="Kitchen/Family Combo" {{ in_array('Kitchen/Family Combo',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox11">Kitchen/Family Combo</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox12" value="Laminate Counter" {{ in_array('Laminate Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox12">Laminate Counter</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox13" value="Marble Counter" {{ in_array('Marble Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox13">Marble Counter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox14" value="Metal/Steel Counter" {{ in_array('Metal/Steel Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox14">Metal/Steel Counter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox15" value="Other Counter" {{ in_array('Other Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox15">Other Counter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox16" value="Pantry Cabinet" {{ in_array('Pantry Cabinet',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox16">Pantry Cabinet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox17" value="Pantry Closet" {{ in_array('Pantry Closet',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox17">Pantry Closet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox18" value="Quartz Counter" {{ in_array('Quartz Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox18">Quartz Counter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox19" value="Skylight(s)" {{ in_array('Skylight(s)',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox19">Skylight(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox20" value="Slab Counter" {{ in_array('Slab Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox20">Slab Counter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox21" value="Stone Counter" {{ in_array('Stone Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox21">Stone Counter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox22" value="Synthetic Counter" {{ in_array('Synthetic Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox22">Synthetic Counter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox23" value="Tile Counter" {{ in_array('Tile Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox23">Tile Counter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="kitchen_features[]" id="kfvfcabsinlineCheckbox24" value="Wood Counter" {{ in_array('Wood Counter',$kitchen_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox24">Wood Counter</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $appliances = [];

                                                                if(!empty($data['listingsDetails']->appliances)) {
                                                                    $appliances = json_decode($data['listingsDetails']->appliances);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Appliances</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox1" value="Built-In BBQ" {{ in_array('Built-In BBQ',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox1">Built-In BBQ</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox2" value="Built-In Electric Oven" {{ in_array('Built-In Electric Oven',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox2">Built-In Electric Oven</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox3" value="Built-In Electric Range" {{ in_array('Built-In Electric Range',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox3">Built-In Electric Range</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox4" value="Built-In Freezer" {{ in_array('Built-In Freezer',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox4">Built-In Freezer</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox5" value="Built-In Gas Oven" {{ in_array('Built-In Gas Oven',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox5">Built-In Gas Oven</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox6" value="Built-In Gas Range" {{ in_array('Built-In Gas Range',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox6">Built-In Gas Range</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox7" value="Built-In Refrigerator" {{ in_array('Built-In Refrigerator',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox7">Built-In Refrigerator</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox8" value="Compactor" {{ in_array('Compactor',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox8">Compactor</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox9" value="Dishwasher" {{ in_array('Dishwasher',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox9">Dishwasher</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox10" value="Disposal" {{ in_array('Disposal',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox10">Disposal</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox11" value="Double Oven" {{ in_array('Double Oven',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox11">Double Oven</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox12" value="Dual Fuel" {{ in_array('Dual Fuel',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox12">Dual Fuel</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox13" value="Electric Cook Top" {{ in_array('Electric Cook Top',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox13">Electric Cook Top</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox14" value="Electric Water Heater" {{ in_array('Electric Water Heater',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox14">Electric Water Heater</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox15" value="ENERGY STAR Qualified Appliances" {{ in_array('ENERGY STAR Qualified Appliances',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox15">ENERGY STAR Qualified Appliances</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox16" value="Free Standing Electric Oven" {{ in_array('Free Standing Electric Oven',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox16">Free Standing Electric Oven</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox17" value="Free Standing Electric Range" {{ in_array('Free Standing Electric Range',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox17">Free Standing Electric Range</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox18" value="Free Standing Freezer" {{ in_array('Free Standing Freezer',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox18">Free Standing Freezer</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox19" value="Free Standing Gas Oven" {{ in_array('Free Standing Gas Oven',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox19">Free Standing Gas Oven</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox20" value="Free Standing Gas Range" {{ in_array('Free Standing Gas Range',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox20">Free Standing Gas Range</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox21" value="Free Standing Refrigerator" {{ in_array('Free Standing Refrigerator',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox21">Free Standing Refrigerator</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox22" value="Gas Cook Top" {{ in_array('Gas Cook Top',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox22">Gas Cook Top</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox23" value="Gas Plumbed" {{ in_array('Gas Plumbed',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox23">Gas Plumbed</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox24" value="Gas Water Heater" {{ in_array('Gas Water Heater',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox24">Gas Water Heater</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox25" value="Hood Over Range" {{ in_array('Hood Over Range',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox25">Hood Over Range</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox26" value="Ice Maker" {{ in_array('Ice Maker',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox26">Ice Maker</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox27" value="Insulated Water Heater" {{ in_array('Insulated Water Heater',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox27">Insulated Water Heater</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox28" value="Microwave" {{ in_array('Microwave',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox28">Microwave</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox29" value="Plumbed For Ice Maker" {{ in_array('Plumbed For Ice Maker',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox29">Plumbed For Ice Maker</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox30" value="Self/Cont Clean Oven" {{ in_array('Self/Cont Clean Oven',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox30">Self/Cont Clean Oven</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox31" value="Solar Water Heater" {{ in_array('Solar Water Heater',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox31">Solar Water Heater</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox32" value="Tankless Water Heater" {{ in_array('Tankless Water Heater',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox32">Tankless Water Heater</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox33" value="Warming Drawer" {{ in_array('Warming Drawer',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox33">Warming Drawer</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox34" value="Wine Refrigerator" {{ in_array('Wine Refrigerator',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox34">Wine Refrigerator</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox35" value="See Remarks" {{ in_array('See Remarks',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox35">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="appliances[]" id="kfvfcabsinlineCheckbox36" value="Other" {{ in_array('Other',$appliances) ?'checked':null }}>
                                                                            <label class="form-check-label" for="kfvfcabsinlineCheckbox36">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $master_bedroom_features = [];

                                                                if(!empty($data['listingsDetails']->master_bedroom_features)) {
                                                                    $master_bedroom_features = json_decode($data['listingsDetails']->master_bedroom_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Master Bedroom Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bedroom_features[]" id="mbfvfcabsinlineCheckbox1" value="Balcony" {{ in_array('Balcony',$master_bedroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mbfvfcabsinlineCheckbox1">Balcony</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bedroom_features[]" id="mbfvfcabsinlineCheckbox2" value="Closet" {{ in_array('Closet',$master_bedroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mbfvfcabsinlineCheckbox2">Closet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bedroom_features[]" id="mbfvfcabsinlineCheckbox3" value="Ground Floor" {{ in_array('Ground Floor',$master_bedroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mbfvfcabsinlineCheckbox3">Ground Floor</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bedroom_features[]" id="mbfvfcabsinlineCheckbox4" value="Outside Access" {{ in_array('Outside Access',$master_bedroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mbfvfcabsinlineCheckbox4">Outside Access</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bedroom_features[]" id="mbfvfcabsinlineCheckbox5" value="Sitting Area" {{ in_array('Sitting Area',$master_bedroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mbfvfcabsinlineCheckbox5">Sitting Area</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bedroom_features[]" id="mbfvfcabsinlineCheckbox6" value="Sitting Room" {{ in_array('Sitting Room',$master_bedroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mbfvfcabsinlineCheckbox6">Sitting Room</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bedroom_features[]" id="mbfvfcabsinlineCheckbox7" value="Surround Sound" {{ in_array('Surround Sound',$master_bedroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mbfvfcabsinlineCheckbox7">Surround Sound</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bedroom_features[]" id="mbfvfcabsinlineCheckbox8" value="Walk-In Closet" {{ in_array('Walk-In Closet',$master_bedroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mbfvfcabsinlineCheckbox8">Walk-In Closet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bedroom_features[]" id="mbfvfcabsinlineCheckbox9" value="Walk-In Closet 2+" {{ in_array('Walk-In Closet 2+',$master_bedroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mbfvfcabsinlineCheckbox9">Walk-In Closet 2+</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bedroom_features[]" id="mbfvfcabsinlineCheckbox10" value="Wet Bar" {{ in_array('Wet Bar',$master_bedroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="mbfvfcabsinlineCheckbox10">Wet Bar</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $master_bathroom_features = [];

                                                                if(!empty($data['listingsDetails']->master_bathroom_features)) {
                                                                    $master_bathroom_features = json_decode($data['listingsDetails']->master_bathroom_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Master Bathroom Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox1" value="Bidet" {{ in_array('Bidet',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox1">Bidet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox2" value="Closet" {{ in_array('Closet',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox2">Closet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox3" value="Double Sinks" {{ in_array('Double Sinks',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox3">Double Sinks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox4" value="Dual Flush Toilet" {{ in_array('Dual Flush Toilet',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox4">Dual Flush Toilet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox5" value="Fiberglass" {{ in_array('Fiberglass',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox5">Fiberglass</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox6" value="Granite" {{ in_array('Granite',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox6">Granite</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox7" value="Jetted Tub" {{ in_array('Jetted Tub',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox7">Jetted Tub</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox8" value="Low-Flow Shower(s)" {{ in_array('Low-Flow Shower(s)',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox8">Low-Flow Shower(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox9" value="Low-Flow Toilet(s)" {{ in_array('Low-Flow Toilet(s)',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox9">Low-Flow Toilet(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox10" value="Marble" {{ in_array('Marble',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox10">Marble</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox11" value="Multiple Shower Heads" {{ in_array('Multiple Shower Heads',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox11">Multiple Shower Heads</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox12" value="Outside Access" {{ in_array('Outside Access',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox12">Outside Access</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox13" value="Quartz" {{ in_array('Quartz',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox13">Quartz</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox14" value="Radiant Heat" {{ in_array('Radiant Heat',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox14">Radiant Heat</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                    <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox15" value="Sauna" {{ in_array('Sauna',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox15">Sauna</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox16" value="Shower Stall(s)" {{ in_array('Shower Stall(s)',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox16">Shower Stall(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox17" value="Sitting Area" {{ in_array('Sitting Area',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox17">Sitting Area</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox18" value="Skylight/Solar Tube" {{ in_array('Skylight/Solar Tube',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox18">Skylight/Solar Tube</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox19" value="Soaking Tub" {{ in_array('Soaking Tub',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox19">Soaking Tub</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox20" value="Steam" {{ in_array('Steam',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox20">Steam</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox21" value="Stone" {{ in_array('Stone',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox21">Stone</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox22" value="Sunken Tub" {{ in_array('Sunken Tub',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox22">Sunken Tub</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox23" value="Tile" {{ in_array('Tile',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox23">Tile</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox24" value="Tub" {{ in_array('Tub',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox24">Tub</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox25" value="Tub w/Shower Over" {{ in_array('Tub w/Shower Over',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox25">Tub w/Shower Over</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox26" value="Walk-In Closet" {{ in_array('Walk-In Closet',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox26">Walk-In Closet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox27" value="Walk-In Closet 2+" {{ in_array('Walk-In Closet 2+',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox27">Walk-In Closet 2+</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="master_bathroom_features[]" id="msftkfvfcabsinlineCheckbox28" value="Window" {{ in_array('Window',$master_bathroom_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="msftkfvfcabsinlineCheckbox28">Window</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $bath_features = [];

                                                                if(!empty($data['listingsDetails']->bath_features)) {
                                                                    $bath_features = json_decode($data['listingsDetails']->bath_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Bath Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox1" value="Bidet" {{ in_array('Bidet',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox1">Bidet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox2" value="Closet" {{ in_array('Closet',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox2">Closet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox3" value="Double Sinks" {{ in_array('Double Sinks',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox3">Double Sinks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox4" value="Dual Flush Toilet" {{ in_array('Dual Flush Toilet',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox4">Dual Flush Toilet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox5" value="Fiberglass" {{ in_array('Fiberglass',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox5">Fiberglass</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox6" value="Granite" {{ in_array('Granite',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox6">Granite</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox7" value="Jack & Jill" {{ in_array('Jack & Jill',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox7">Jack & Jill</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox8" value="Jetted Tub" {{ in_array('Jetted Tub',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox8">Jetted Tub</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox9" value="Low-Flow Shower(s)" {{ in_array('Low-Flow Shower(s)',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox9">Low-Flow Shower(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox10" value="Low-Flow Toilet(s)" {{ in_array('Low-Flow Toilet(s)',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox10">Low-Flow Toilet(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox11" value="Marble" {{ in_array('Marble',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox11">Marble</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox12" value="Multiple Shower Heads" {{ in_array('Multiple Shower Heads',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox12">Multiple Shower Heads</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox13" value="Outside Access" {{ in_array('Outside Access',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox13">Outside Access</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox14" value="Quartz" {{ in_array('Quartz',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox14">Quartz</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox15" value="Radiant Heat" {{ in_array('Radiant Heat',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox15">Radiant Heat</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox16" value="Sauna" {{ in_array('Sauna',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox16">Sauna</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox17" value="Shower Stall(s)" {{ in_array('Shower Stall(s)',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox17">Shower Stall(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox18" value="Skylight/Solar Tube" {{ in_array('Skylight/Solar Tube',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox18">Skylight/Solar Tube</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox19" value="Split Bath" {{ in_array('Split Bath',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox19">Split Bath</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox20" value="Steam" {{ in_array('Steam',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox20">Steam</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox21" value="Stone" {{ in_array('Stone',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox21">Stone</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox22" value="Sunken Tub" {{ in_array('Sunken Tub',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox22">Sunken Tub</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox23" value="Tile" {{ in_array('Tile',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox23">Tile</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox24" value="Tub" {{ in_array('Tub',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox24">Tub</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox25" value="Tub w/Shower Over" {{ in_array('Tub w/Shower Over',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox25">Tub w/Shower Over</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox26" value="Window" {{ in_array('Window',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox26">Window</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox27" value="None" {{ in_array('None',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox27">None</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox28" value="See Remarks" {{ in_array('See Remarks',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox28">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="bath_features[]" id="bftkfvfcabsinlineCheckbox29" value="Other" {{ in_array('Other',$bath_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="bftkfvfcabsinlineCheckbox29">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $laundry_features = [];

                                                                if(!empty($data['listingsDetails']->laundry_features)) {
                                                                    $laundry_features = json_decode($data['listingsDetails']->laundry_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Laundry Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox1" value="Cabinets" {{ in_array('Cabinets',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox1">Cabinets</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox2" value="Chute" {{ in_array('Chute',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox2">Chute</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox3" value="Dryer Included" {{ in_array('Dryer Included',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox3">Dryer Included</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox4" value="Electric" {{ in_array('Electric',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox4">Electric</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox5" value="Gas Hook-Up" {{ in_array('Gas Hook-Up',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox5">Gas Hook-Up</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox6" value="Ground Floor" {{ in_array('Ground Floor',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox6">Ground Floor</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox7" value="Hookups Only" {{ in_array('Hookups Only',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox7">Hookups Only</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox8" value="In Basement" {{ in_array('In Basement',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox8">In Basement</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox9" value="In Garage" {{ in_array('In Garage',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox9">In Garage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox10" value="In Kitchen" {{ in_array('In Kitchen',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox10">In Kitchen</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox11" value="Inside Area" {{ in_array('Inside Area',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox11">Inside Area</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox12" value="Inside Room" {{ in_array('Inside Room',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox12">Inside Room</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox13" value="Laundry Closet" {{ in_array('Laundry Closet',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox13">Laundry Closet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox14" value="No Hookups" {{ in_array('No Hookups',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox14">No Hookups</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox15" value="Sink" {{ in_array('Sink',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox15">Sink</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox16" value="Space For Frzr/Refr" {{ in_array('Space For Frzr/Refr',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox16">Space For Frzr/Refr</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox17" value="Stacked Only" {{ in_array('Stacked Only',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox17">Stacked Only</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox18" value="Upper Floor" {{ in_array('Upper Floor',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox18">Upper Floor</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox19" value="Washer Included" {{ in_array('Washer Included',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox19">Washer Included</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox20" value="Washer/Dryer Stacked Included" {{ in_array('Washer/Dryer Stacked Included',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox20">Washer/Dryer Stacked Included</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox21" value="None" {{ in_array('None',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox21">None</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox22" value="See Remarks" {{ in_array('See Remarks',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox22">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="laundry_features[]" id="lfttkfvfcabsinlineCheckbox23" value="Other" {{ in_array('Other',$laundry_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lfttkfvfcabsinlineCheckbox23">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $flooring = [];

                                                                if(!empty($data['listingsDetails']->flooring)) {
                                                                    $flooring = json_decode($data['listingsDetails']->flooring);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Flooring</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox1" value="Bamboo" {{ in_array('Bamboo',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox1">Bamboo</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox2" value="Carpet" {{ in_array('Carpet',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox2">Carpet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox3" value="Concrete" {{ in_array('Concrete',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox3">Concrete</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox4" value="Cork" {{ in_array('Cork',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox4">Cork</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox5" value="Granite" {{ in_array('Granite',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox5">Granite</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox6" value="Laminate" {{ in_array('Laminate',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox6">Laminate</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox7" value="Linoleum" {{ in_array('Linoleum',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox7">Linoleum</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox8" value="Marble" {{ in_array('Marble',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox8">Marble</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox9" value="Painted/Stained" {{ in_array('Painted/Stained',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox9">Painted/Stained</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox10" value="Parquet" {{ in_array('Parquet',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox10">Parquet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox11" value="Quartz" {{ in_array('Quartz',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox11">Quartz</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox12" value="Reclaimed" {{ in_array('Reclaimed',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox12">Reclaimed</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox13" value="Recycled Carpet" {{ in_array('Recycled Carpet',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox13">Recycled Carpet</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox14" value="Simulated Wood" {{ in_array('Simulated Wood',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox14">Simulated Wood</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox15" value="Slate" {{ in_array('Slate',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox15">Slate</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox16" value="Stamped" {{ in_array('Stamped',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox16">Stamped</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox17" value="Stone" {{ in_array('Stone',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox17">Stone</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox18" value="Tile" {{ in_array('Tile',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox18">Tile</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox19" value="Vinyl" {{ in_array('Vinyl',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox19">Vinyl</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox20" value="Wood" {{ in_array('Wood',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox20">Wood</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox21" value="See Remarks" {{ in_array('See Remarks',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox21">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="flooring[]" id="flortkfvfcabsinlineCheckbox22" value="Other" {{ in_array('Other',$flooring) ?'checked':null }}>
                                                                            <label class="form-check-label" for="flortkfvfcabsinlineCheckbox22">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $cooling = [];

                                                                if(!empty($data['listingsDetails']->cooling)) {
                                                                    $cooling = json_decode($data['listingsDetails']->cooling);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Cooling</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox1" value="Ceiling Fan(s)" {{ in_array('Ceiling Fan(s)',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox1">Ceiling Fan(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox2" value="Central" {{ in_array('Central',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox2">Central</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox3" value="Ductless" {{ in_array('Ductless',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox3">Ductless</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox4" value="Evaporative Cooler" {{ in_array('Evaporative Cooler',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox4">Evaporative Cooler</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox5" value="Heat Pump" {{ in_array('Heat Pump',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox5">Heat Pump</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox6" value="MultiUnits" {{ in_array('MultiUnits',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox6">Laminate</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox7" value="MultiZone" {{ in_array('MultiZone',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox7">MultiZone</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox8" value="Room Air" {{ in_array('Room Air',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox8">Room Air</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox9" value="Smart Vent" {{ in_array('Smart Vent',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox9">Smart Vent</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox10" value="Wall Unit(s)" {{ in_array('Wall Unit(s)',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox10">Wall Unit(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox11" value="Whole House Fan" {{ in_array('Whole House Fan',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox11">Whole House Fan</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox12" value="Window Unit(s)" {{ in_array('Window Unit(s)',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox12">Window Unit(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox13" value="None" {{ in_array('None',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox13">None</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox14" value="See Remarks" {{ in_array('See Remarks',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox14">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="cooling[]" id="coolinlineCheckbox15" value="Other" {{ in_array('Other',$cooling) ?'checked':null }}>
                                                                            <label class="form-check-label" for="coolinlineCheckbox15">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $heating = [];

                                                                if(!empty($data['listingsDetails']->heating)) {
                                                                    $heating = json_decode($data['listingsDetails']->heating);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Heating</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox1" value="Baseboard" {{ in_array('Baseboard',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox1">Baseboard</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox2" value="Bio Diesel Furnace" {{ in_array('Bio Diesel Furnace',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox2">Bio Diesel Furnace</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox3" value="Central" {{ in_array('Central',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox3">Central</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox4" value="Ductless" {{ in_array('Ductless',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox4">Ductless</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox5" value="Electric" {{ in_array('Electric',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox5">Electric</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox6" value="Fireplace Insert" {{ in_array('Fireplace Insert',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox6">Fireplace Insert</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox7" value="Fireplace(s)" {{ in_array('Fireplace(s)',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox7">Fireplace(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox8" value="Floor Furnace" {{ in_array('Floor Furnace',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox8">Floor Furnace</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox9" value="Gas" {{ in_array('Gas',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox9">Gas</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox10" value="Heat Pump" {{ in_array('Heat Pump',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox10">Heat Pump</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox11" value="Hot Water" {{ in_array('Hot Water',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox11">Hot Water</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox12" value="MultiUnits" {{ in_array('MultiUnits',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox12">MultiUnits</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox13" value="MultiZone" {{ in_array('MultiZone',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox13">MultiZone</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox14" value="Natural Gas" {{ in_array('Natural Gas',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox14">Natural Gas</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox15" value="Oil" {{ in_array('Oil',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox15">Oil</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox16" value="Pellet Stove" {{ in_array('Pellet Stove',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox16">Pellet Stove</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox17" value="Propane" {{ in_array('Propane',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox17">Propane</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox18" value="Propane Stove" {{ in_array('Propane Stove',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox18">Propane Stove</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox19" value="Radiant" {{ in_array('Radiant',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox19">Radiant</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox20" value="Radiant Floor" {{ in_array('Radiant Floor',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox20">Radiant Floor</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox21" value="Smart Vent" {{ in_array('Smart Vent',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox21">Smart Vent</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox22" value="Solar Heating" {{ in_array('Solar Heating',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox22">Solar Heating</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox23" value="Solar w/Backup" {{ in_array('Solar w/Backup',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox23">Solar w/Backup</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox24" value="Steam" {{ in_array('Steam',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox24">Steam</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox25" value="Wall Furnace" {{ in_array('Wall Furnace',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox25">Wall Furnace</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox26" value="Wood Stove" {{ in_array('Wood Stove',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox26">Wood Stove</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox27" value="None" {{ in_array('None',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox27">None</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox28" value="See Remarks" {{ in_array('See Remarks',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox28">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="heating[]" id="heatlineCheckbox29" value="Other" {{ in_array('Other',$heating) ?'checked':null }}>
                                                                            <label class="form-check-label" for="heatlineCheckbox29">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $green_building_verification_type = [];

                                                                if(!empty($data['listingsDetails']->green_building_verification_type)) {
                                                                    $green_building_verification_type = json_decode($data['listingsDetails']->green_building_verification_type);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Green Building Verification Type</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="green_building_verification_type[]" id="gbvtlineCheckbox1" value="ENERGY STAR Certified Homes" {{ in_array('ENERGY STAR Certified Homes',$green_building_verification_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="gbvtlineCheckbox1">ENERGY STAR Certified Homes</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="green_building_verification_type[]" id="gbvtlineCheckbox2" value="Green Point" {{ in_array('Green Point',$green_building_verification_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="gbvtlineCheckbox2">Green Point</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="green_building_verification_type[]" id="gbvtlineCheckbox3" value="HERS Index Score" {{ in_array('HERS Index Score',$green_building_verification_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="gbvtlineCheckbox3">HERS Index Score</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="green_building_verification_type[]" id="gbvtlineCheckbox4" value="LEED For Homes" {{ in_array('LEED For Homes',$green_building_verification_type) ?'checked':null }}>
                                                                            <label class="form-check-label" for="gbvtlineCheckbox4">LEED For Homes</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Green Verification Rating</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="green_verification_rating" value="{{ $data['listingsDetails']->green_verification_rating }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                     </div>
                                                                </div> 
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Green Verification Body</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="green_verification_body" value="{{ $data['listingsDetails']->green_verification_body }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 mb-3">
                                                                    <label for="">Green Verification Year</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="green_verification_year" value="{{ $data['listingsDetails']->green_verification_year }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                     </div>
                                                                </div> 
                                                            </div>

                                                            @php
                                                                $energy_efficient = [];

                                                                if(!empty($data['listingsDetails']->energy_efficient)) {
                                                                    $energy_efficient = json_decode($data['listingsDetails']->energy_efficient);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Energy Efficient</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox1" value="Appliances" {{ in_array('Appliances',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox1">Appliances</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox2" value="Construction" {{ in_array('Construction',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox2">Construction</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox3" value="Cooling" {{ in_array('Cooling',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox3">Cooling</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox4" value="Doors" {{ in_array('Doors',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox4">Doors</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox5" value="Exposure/Shade" {{ in_array('Exposure/Shade',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox5">Exposure/Shade</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox6" value="Heating" {{ in_array('Heating',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox6">Heating</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                    <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox7" value="Insulation" {{ in_array('Insulation',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox7">Insulation</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox8" value="Lighting" {{ in_array('Lighting',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox8">Lighting</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox9" value="Roof" {{ in_array('Roof',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox9">Roof</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox10" value="Thermostat" {{ in_array('Thermostat',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox10">Thermostat</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox11" value="Water Heater" {{ in_array('Water Heater',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox11">Water Heater</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="energy_efficient[]" id="energylineCheckbox12" value="Windows" {{ in_array('Windows',$energy_efficient) ?'checked':null }}>
                                                                            <label class="form-check-label" for="energylineCheckbox12">Windows</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $window_features = [];

                                                                if(!empty($data['listingsDetails']->window_features)) {
                                                                    $window_features = json_decode($data['listingsDetails']->window_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Window Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox1" value="Bay Window(s)" {{ in_array('Bay Window(s)',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox1">Bay Window(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox2" value="Caulked/Sealed" {{ in_array('Caulked/Sealed',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox2">Caulked/Sealed</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox3" value="Dual Pane Full" {{ in_array('Dual Pane Full',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox3">Dual Pane Full</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox4" value="Dual Pane Partial" {{ in_array('Dual Pane Partial',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox4">Dual Pane Partial</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox5" value="Greenhouse Window(s)" {{ in_array('Greenhouse Window(s)',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox5">Greenhouse Window(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox6" value="Low E Glass Full" {{ in_array('Low E Glass Full',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox6">Low E Glass Full</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox7" value="Low E Glass Partial" {{ in_array('Low E Glass Partial',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox7">Low E Glass Partial</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox8" value="Solar Screens" {{ in_array('Solar Screens',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox8">Solar Screens</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox9" value="Storm Windows" {{ in_array('Storm Windows',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox9">Storm Windows</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox10" value="Triple Pane Full" {{ in_array('Triple Pane Full',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox10">Triple Pane Full</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox11" value="Triple Pane Partial" {{ in_array('Triple Pane Partial',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox11">Triple Pane Partial</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox12" value="Weather Stripped" {{ in_array('Weather Stripped',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox12">Weather Stripped</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox13" value="Window Coverings" {{ in_array('Window Coverings',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox13">Window Coverings</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="window_features[]" id="windowfeaturelineCheckbox14" value="Window Screens" {{ in_array('Window Screens',$window_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="windowfeaturelineCheckbox14">Window Screens</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 mb-3">
                                                                    <label for=""># of Fireplaces</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="fireplaces" value="{{ $data['listingsDetails']->fireplaces }}" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                     </div>
                                                                </div> 
                                                            </div>

                                                            @php
                                                                $security_features = [];

                                                                if(!empty($data['listingsDetails']->security_features)) {
                                                                    $security_features = json_decode($data['listingsDetails']->security_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Security Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox1" value="Carbon Mon Detector" {{ in_array('Carbon Mon Detector',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox1">Carbon Mon Detector</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox2" value="Double Strapped Water Heater" {{ in_array('Double Strapped Water Heater',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox2">Double Strapped Water Heater</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox3" value="Fire Alarm" {{ in_array('Fire Alarm',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox3">Fire Alarm</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox4" value="Fire Extinguisher" {{ in_array('Fire Extinguisher',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox4">Fire Extinguisher</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox5" value="Fire Suppression System" {{ in_array('Fire Suppression System',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox5">Fire Suppression System</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox6" value="Guarded Gate" {{ in_array('Guarded Gate',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox6">Guarded Gate</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox7" value="Panic Alarm" {{ in_array('Panic Alarm',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox7">Panic Alarm</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox8" value="Secured Access" {{ in_array('Secured Access',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox8">Secured Access</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox9" value="Security Fence" {{ in_array('Security Fence',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox9">Security Fence</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox10" value="Security Gate" {{ in_array('Security Gate',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox10">Security Gate</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox11" value="Security Patrol" {{ in_array('Security Patrol',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox11">Security Patrol</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox12" value="Security System Leased" {{ in_array('Security System Leased',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox12">Security System Leased</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox13" value="Security System Owned" {{ in_array('Security System Owned',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox13">Security System Owned</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox14" value="Security System Prewired" {{ in_array('Security System Prewired',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox14">Security System Prewired</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox15" value="Smoke Detector" {{ in_array('Smoke Detector',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox15">Smoke Detector</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox16" value="Unguarded Gate" {{ in_array('Unguarded Gate',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox16">Unguarded Gate</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox17" value="Video System" {{ in_array('Video System',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox17">Video System</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox18" value="Window Bars w/Quick Release" {{ in_array('Window Bars w/Quick Release',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox18">Window Bars w/Quick Release</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox19" value="Window Security Bars" {{ in_array('Window Security Bar',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox19">Window Security Bars</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox20" value="See Remarks" {{ in_array('See Remarks',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox20">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="security_features[]" id="securityfeaturelineCheckbox21" value="Other" {{ in_array('Other',$security_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="securityfeaturelineCheckbox21">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $other_equipment = [];

                                                                if(!empty($data['listingsDetails']->other_equipment)) {
                                                                    $other_equipment = json_decode($data['listingsDetails']->other_equipment);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Other Equipment</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox1" value="Air Purifier" {{ in_array('Air Purifier',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox1">Air Purifier</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox2" value="Attic Fan(s)" {{ in_array('Attic Fan(s)',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox2">Attic Fan(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox3" value="Audio/Video Prewired" {{ in_array('Audio/Video Prewired',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox3">Audio/Video Prewired</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox4" value="Central Vac Plumbed" {{ in_array('Central Vac Plumbed',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox4">Central Vac Plumbed</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox5" value="Central Vacuum" {{ in_array('Central Vacuum',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox5">Central Vacuum</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox6" value="DC Well Pump" {{ in_array('DC Well Pump',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox6">DC Well Pump</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox7" value="Dumb Waiter" {{ in_array('Dumb Waiter',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox7">Dumb Waiter</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox8" value="Home Theater Equipment" {{ in_array('Home Theater Equipment',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox8">Home Theater Equipment</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox9" value="Intercom" {{ in_array('Intercom',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox9">Intercom</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox10" value="MultiPhone Lines" {{ in_array('MultiPhone Lines',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox10">MultiPhone Lines</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox11" value="Networked" {{ in_array('Networked',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox11">Networked</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox12" value="Water Cond Equipment Leased" {{ in_array('Water Cond Equipment Leased',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox12">Water Cond Equipment Leased</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox13" value="Water Cond Equipment Owned" {{ in_array('Water Cond Equipment Owned',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox13">Water Cond Equipment Owned</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_equipment[]" id="otherequipmentlineCheckbox14" value="Water Filter System" {{ in_array('Water Filter System',$other_equipment) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherequipmentlineCheckbox14">Water Filter System</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $property_condition = [];

                                                                if(!empty($data['listingsDetails']->property_condition)) {
                                                                    $property_condition = json_decode($data['listingsDetails']->property_condition);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Property Condition</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="property_condition[]" id="propertyconditionlineCheckbox1" value="Fixer" {{ in_array('Fixer',$property_condition) ?'checked':null }}>
                                                                            <label class="form-check-label" for="propertyconditionlineCheckbox1">Fixer</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="property_condition[]" id="propertyconditionlineCheckbox2" value="New Construction" {{ in_array('New Construction',$property_condition) ?'checked':null }}>
                                                                            <label class="form-check-label" for="propertyconditionlineCheckbox2">New Construction</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="property_condition[]" id="propertyconditionlineCheckbox3" value="Original" {{ in_array('Original',$property_condition) ?'checked':null }}>
                                                                            <label class="form-check-label" for="propertyconditionlineCheckbox3">Original</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="property_condition[]" id="propertyconditionlineCheckbox4" value="Under Construction" {{ in_array('Under Construction',$property_condition) ?'checked':null }}>
                                                                            <label class="form-check-label" for="propertyconditionlineCheckbox4">Under Construction</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="property_condition[]" id="propertyconditionlineCheckbox5" value="Updated/Remodeled" {{ in_array('Updated/Remodeled',$property_condition) ?'checked':null }}>
                                                                            <label class="form-check-label" for="propertyconditionlineCheckbox5">Updated/Remodeled</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row" data-select2-id="76">
                                                                <div class="col-lg-6 mb-3" data-select2-id="75">
                                                                    <label for="">Remodeled/Updated</label>
                                                                    <div class="form-group">
                                                                        <select name="remodeled_updated" id="remodeled_updated" class="form-control select2" data-select2-id="remodeled_updated" tabindex="-1" aria-hidden="true">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->remodeled_updated) ? 'selected' : '' }}>Choose...</option>
                                                                            <option value="Yes" {{ ( 'Yes' == $data['listingsDetails']->remodeled_updated) ? 'selected' : '' }}>Yes</option>
                                                                            <option value="No" {{ ( 'No' == $data['listingsDetails']->remodeled_updated) ? 'selected' : '' }}>No</option>
                                                                            <option value="Unknown" {{ ( 'Unknown' == $data['listingsDetails']->remodeled_updated) ? 'selected' : '' }}>Unknown</option>
                                                                        </select>
                                                                     </div>
                                                                </div> 
                                                            </div>

                                                            @php
                                                                $accessibility_features = [];

                                                                if(!empty($data['listingsDetails']->accessibility_features)) {
                                                                    $accessibility_features = json_decode($data['listingsDetails']->accessibility_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Accessibility Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox1" value="Accessible Approach with Ramp" {{ in_array('Accessible Approach with Ramp',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox1">Accessible Approach with Ramp</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox2" value="Accessible Doors" {{ in_array('Accessible Doors',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox2">Accessible Doors</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox3" value="Accessible Elevator Installed" {{ in_array('Accessible Elevator Installed',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox3">Accessible Elevator Installed</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox4" value="Accessible Full Bath" {{ in_array('Accessible Full Bath',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox4">Accessible Full Bath</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox5" value="Accessible Kitchen" {{ in_array('Accessible Kitchen',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox5">Accessible Kitchen</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox6" value="Flashing Warnings" {{ in_array('Flashing Warnings',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox6">Flashing Warnings</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox7" value="Grab Bars" {{ in_array('Grab Bars',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox7">Grab Bars</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox8" value="Kitchen Cabinets" {{ in_array('Kitchen Cabinets',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox8">Kitchen Cabinets</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox9" value="Lowered Switch(s)" {{ in_array('Lowered Switch(s)',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox9">Lowered Switch(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox10" value="Parking" {{ in_array('Parking',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox10">Parking</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox11" value="Roll-In Shower" {{ in_array('Roll-In Shower',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox11">Roll-In Shower</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox12" value="Shower(s)" {{ in_array('Shower(s)',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox12">Shower(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox13" value="Wheelchair Access" {{ in_array('Wheelchair Access',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox13">Wheelchair Access</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox14" value="See Remarks" {{ in_array('See Remarks',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox14">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="accessibility_features[]" id="accessibilityfeatureslineCheckbox15" value="Other" {{ in_array('Other',$accessibility_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="accessibilityfeatureslineCheckbox15">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $exterior_features = [];

                                                                if(!empty($data['listingsDetails']->exterior_features)) {
                                                                    $exterior_features = json_decode($data['listingsDetails']->exterior_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Exterior Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="exterior_features[]" id="exteriorfeatureslineCheckbox1" value="Balcony" {{ in_array('Balcony',$exterior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="exteriorfeatureslineCheckbox1">Balcony</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="exterior_features[]" id="exteriorfeatureslineCheckbox2" value="BBQ Built-In" {{ in_array('BBQ Built-In',$exterior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="exteriorfeatureslineCheckbox2">BBQ Built-In</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="exterior_features[]" id="exteriorfeatureslineCheckbox3" value="Covered Courtyard" {{ in_array('Covered Courtyard',$exterior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="exteriorfeatureslineCheckbox3">Covered Courtyard</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="exterior_features[]" id="exteriorfeatureslineCheckbox4" value="Dog Run" {{ in_array('Dog Run',$exterior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="exteriorfeatureslineCheckbox4">Dog Run</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="exterior_features[]" id="exteriorfeatureslineCheckbox5" value="Entry Gate" {{ in_array('Entry Gate',$exterior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="exteriorfeatureslineCheckbox5">Entry Gate</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="exterior_features[]" id="exteriorfeatureslineCheckbox6" value="Fire Pit" {{ in_array('Fire Pit',$exterior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="exteriorfeatureslineCheckbox6">Fire Pit</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="exterior_features[]" id="exteriorfeatureslineCheckbox7" value="Fireplace" {{ in_array('Fireplace',$exterior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="exteriorfeatureslineCheckbox7">Fireplace</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="exterior_features[]" id="exteriorfeatureslineCheckbox8" value="Kitchen" {{ in_array('Kitchen',$exterior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="exteriorfeatureslineCheckbox8">Kitchen</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="exterior_features[]" id="exteriorfeatureslineCheckbox9" value="Misting System" {{ in_array('Misting System',$exterior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="exteriorfeatureslineCheckbox9">Misting System</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="exterior_features[]" id="exteriorfeatureslineCheckbox10" value="Uncovered Courtyard" {{ in_array('Uncovered Courtyard',$exterior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="exteriorfeatureslineCheckbox10">Uncovered Courtyard</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="exterior_features[]" id="exteriorfeatureslineCheckbox11" value="Wet Bar" {{ in_array('Wet Bar',$exterior_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="exteriorfeatureslineCheckbox11">Wet Bar</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $roof = [];

                                                                if(!empty($data['listingsDetails']->roof)) {
                                                                    $roof = json_decode($data['listingsDetails']->roof);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Roof</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox1" value="Bitumen" {{ in_array('Bitumen',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox1">Bitumen</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox2" value="Cement" {{ in_array('Cement',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox2">Cement</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox3" value="Composition" {{ in_array('Composition',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox3">Composition</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox4" value="Elastomeric" {{ in_array('Elastomeric',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox4">Elastomeric</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox5" value="Fiberglass" {{ in_array('Fiberglass',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox5">Fiberglass</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox6" value="Flat" {{ in_array('Flat',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox6">Flat</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox7" value="Foam" {{ in_array('Foam',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox7">Foam</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox8" value="Metal" {{ in_array('Metal',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox8">Metal</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox9" value="Rock" {{ in_array('Rock',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox9">Rock</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox10" value="Shake" {{ in_array('Shake',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox10">Shake</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox11" value="Shingle" {{ in_array('Shingle',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox11">Shingle</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox12" value="Slate" {{ in_array('Slate',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox12">Slate</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox13" value="Spanish Tile" {{ in_array('Spanish Tile',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox13">Spanish Tile</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox14" value="Tar/Gravel" {{ in_array('Tar/Gravel',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox14">Tar/Gravel</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox15" value="Tile" {{ in_array('Tile',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox15">Tile</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox16" value="Wood" {{ in_array('Wood',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox16">Wood</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox17" value="See Remarks" {{ in_array('See Remarks',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox17">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="roof[]" id="rooflineCheckbox18" value="Other" {{ in_array('Other',$roof) ?'checked':null }}>
                                                                            <label class="form-check-label" for="rooflineCheckbox18">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $patio_porch_features = [];

                                                                if(!empty($data['listingsDetails']->patio_porch_features)) {
                                                                    $patio_porch_features = json_decode($data['listingsDetails']->patio_porch_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Patio And Porch Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="patio_porch_features[]" id="patioporchfeatureslineCheckbox1" value="Awning" {{ in_array('Awning',$patio_porch_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="patioporchfeatureslineCheckbox1">Awning</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="patio_porch_features[]" id="patioporchfeatureslineCheckbox2" value="Back Porch" {{ in_array('Back Porch',$patio_porch_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="patioporchfeatureslineCheckbox2">Back Porch</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="patio_porch_features[]" id="patioporchfeatureslineCheckbox3" value="Covered Deck" {{ in_array('Covered Deck',$patio_porch_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="patioporchfeatureslineCheckbox3">Covered Deck</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="patio_porch_features[]" id="patioporchfeatureslineCheckbox4" value="Covered Patio" {{ in_array('Covered Patio',$patio_porch_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="patioporchfeatureslineCheckbox4">Covered Patio</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="patio_porch_features[]" id="patioporchfeatureslineCheckbox5" value="Enclosed Deck" {{ in_array('Enclosed Deck',$patio_porch_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="patioporchfeatureslineCheckbox5">Enclosed Deck</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="patio_porch_features[]" id="patioporchfeatureslineCheckbox6" value="Enclosed Patio" {{ in_array('Enclosed Patio',$patio_porch_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="patioporchfeatureslineCheckbox6">Enclosed Patio</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="patio_porch_features[]" id="patioporchfeatureslineCheckbox7" value="Front Porch" {{ in_array('Front Porch',$patio_porch_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="patioporchfeatureslineCheckbox7">Front Porch</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="patio_porch_features[]" id="patioporchfeatureslineCheckbox8" value="Roof Deck" {{ in_array('Roof Deck',$patio_porch_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="patioporchfeatureslineCheckbox8">Roof Deck</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="patio_porch_features[]" id="patioporchfeatureslineCheckbox9" value="Uncovered Deck" {{ in_array('Uncovered Deck',$patio_porch_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="patioporchfeatureslineCheckbox9">Uncovered Deck</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="patio_porch_features[]" id="patioporchfeatureslineCheckbox10" value="Uncovered Patio" {{ in_array('Uncovered Patio',$patio_porch_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="patioporchfeatureslineCheckbox10">Uncovered Patio</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="patio_porch_features[]" id="patioporchfeatureslineCheckbox11" value="Wrap Around Porch" {{ in_array('Wrap Around Porch',$patio_porch_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="patioporchfeatureslineCheckbox11">Wrap Around Porch</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row" data-select2-id="76">
                                                                <div class="col-lg-6 mb-3" data-select2-id="75">
                                                                    <label for="">Pool</label>
                                                                    <div class="form-group">
                                                                        <select name="pool" id="pool" class="form-control select2" data-select2-id="pool" tabindex="-1" aria-hidden="true">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->pool) ? 'selected' : '' }}>Choose...</option>
                                                                            <option value="Yes" {{ ( 'Yes' == $data['listingsDetails']->pool) ? 'selected' : '' }}>Yes</option>
                                                                            <option value="No" {{ ( 'No' == $data['listingsDetails']->pool) ? 'selected' : '' }}>No</option>
                                                                        </select>
                                                                     </div>
                                                                </div> 
                                                                <div class="col-lg-6 mb-3" data-select2-id="75">
                                                                    <label for="">Spa</label>
                                                                    <div class="form-group">
                                                                        <select name="spa" id="spa" class="form-control select2" data-select2-id="spa" tabindex="-1" aria-hidden="true">
                                                                            <option value="" {{ ( '' == $data['listingsDetails']->spa) ? 'selected' : '' }}>Choose...</option>
                                                                            <option value="Yes" {{ ( 'Yes' == $data['listingsDetails']->spa) ? 'selected' : '' }}>Yes</option>
                                                                            <option value="No" {{ ( 'No' == $data['listingsDetails']->spa) ? 'selected' : '' }}>No</option>
                                                                        </select>
                                                                     </div>
                                                                </div> 
                                                            </div>

                                                            @php
                                                                $fencing = [];

                                                                if(!empty($data['listingsDetails']->fencing)) {
                                                                    $fencing = json_decode($data['listingsDetails']->fencing);
                                                                }   

                                                            @endphp
                                          
                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Fencing</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox1" value="Back Yard" {{ in_array('Back Yard',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox1">Back Yard</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox2" value="Barbed Wire" {{ in_array('Barbed Wire',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox2">Barbed Wire</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox3" value="Chain Link" {{ in_array('Chain Link',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox3">Chain Link</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox4" value="Cross Fenced" {{ in_array('Cross Fenced',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox4">Cross Fenced</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox5" value="Electric" {{ in_array('Electric',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox5">Electric</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox6" value="Fenced" {{ in_array('Fenced',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox6">Fenced</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox7" value="Front Yard" {{ in_array('Front Yard',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox7">Front Yard</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox8" value="Full" {{ in_array('Full',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox8">Full</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox9" value="Masonry" {{ in_array('Masonry',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox9">Masonry</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox10" value="Metal" {{ in_array('Metal',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox10">Metal</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox11" value="Partial" {{ in_array('Partial',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox11">Partial</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox12" value="Partial Cross" {{ in_array('Partial Cross',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox12">Partial Cross</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox13" value="Vinyl" {{ in_array('Vinyl',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox13">Vinyl</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox14" value="Wire" {{ in_array('Wire',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox14">Wire</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox15" value="Wood" {{ in_array('Wood',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox15">Wood</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox16" value="None" {{ in_array('None',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox16">None</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox17" value="See Remarks" {{ in_array('See Remarks',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox17">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="fencing[]" id="fencinglineCheckbox18" value="Other" {{ in_array('Other',$fencing) ?'checked':null }}>
                                                                            <label class="form-check-label" for="fencinglineCheckbox18">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $other_structures = [];

                                                                if(!empty($data['listingsDetails']->other_structures)) {
                                                                    $other_structures = json_decode($data['listingsDetails']->other_structures);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Other Structures</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox1" value="Barn(s)" {{ in_array('Barn(s)',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox1">Barn(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox2" value="Cave(s)" {{ in_array('Cave(s)',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox2">Cave(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox3" value="Gazebo" {{ in_array('Gazebo',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox3">Gazebo</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox4" value="Greenhouse" {{ in_array('Greenhouse',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox4">Greenhouse</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox5" value="Guest House" {{ in_array('Guest House',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox5">Guest House</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox6" value="Kennel/Dog Run" {{ in_array('Kennel/Dog Run',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox6">Kennel/Dog Run</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox7" value="Outbuilding" {{ in_array('Outbuilding',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox7">Outbuilding</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox8" value="Pergola" {{ in_array('Pergola',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox8">Pergola</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox9" value="Second Garage" {{ in_array('Second Garage',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox9">Second Garage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox10" value="Shed(s)" {{ in_array('Shed(s)',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox10">Shed(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox11" value="Storage" {{ in_array('Storage',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox11">Storage</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox12" value="Workshop" {{ in_array('Workshop',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox12">Workshop</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox13" value="Yurt" {{ in_array('Yurt',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox13">Yurt</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="other_structures[]" id="otherstructureslineCheckbox14" value="Other" {{ in_array('Other',$other_structures) ?'checked':null }}>
                                                                            <label class="form-check-label" for="otherstructureslineCheckbox14">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $lot_features = [];

                                                                if(!empty($data['listingsDetails']->lot_features)) {
                                                                    $lot_features = json_decode($data['listingsDetails']->lot_features);
                                                                }   

                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Lot Features</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox1" value="Adjacent to Golf Course" {{ in_array('Adjacent to Golf Course',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox1">Adjacent to Golf Course</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox2" value="Auto Sprinkler F&R" {{ in_array('Auto Sprinkler F&R',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox2">Auto Sprinkler F&R</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox3" value="Auto Sprinkler Front" {{ in_array('Auto Sprinkler Front',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox3">Auto Sprinkler Front</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox4" value="Auto Sprinkler Rear" {{ in_array('Auto Sprinkler Rear',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox4">Auto Sprinkler Rear</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox5" value="Close to Clubhouse" {{ in_array('Close to Clubhouse',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox5">Close to Clubhouse</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox6" value="Corner" {{ in_array('Corner',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox6">Corner</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox7" value="Court" {{ in_array('Court',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox7">Court</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox8" value="Cul-De-Sac" {{ in_array('Cul-De-Sac',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox8">Cul-De-Sac</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox9" value="Curb(s)" {{ in_array('Curb(s)',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox9">Curb(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox10" value="Curb(s)/Gutter(s)" {{ in_array('Curb(s)/Gutter(s)',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox10">Curb(s)/Gutter(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox11" value="Dead End" {{ in_array('Dead End',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox11">Dead End</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox12" value="Flag Lot" {{ in_array('Flag Lot',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox12">Flag Lot</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox13" value="Garden" {{ in_array('Garden',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox13">Garden</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox14" value="Gated Community" {{ in_array('Gated Community',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox14">Gated Community</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox15" value="Grass Artificial" {{ in_array('Grass Artificial',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox15">Grass Artificial</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox16" value="Grass Painted" {{ in_array('Grass Painted',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox16">Grass Painted</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox17" value="Greenbelt" {{ in_array('Greenbelt',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox17">Greenbelt</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox18" value="Lake Access" {{ in_array('Lake Access',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox18">Lake Access</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox19" value="Land Locked" {{ in_array('Land Locked',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox19">Land Locked</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox20" value="Landscape Back" {{ in_array('Landscape Back',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox20">Landscape Back</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox21" value="Landscape Front" {{ in_array('Landscape Front',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox21">Landscape Front</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox22" value="Landscape Misc" {{ in_array('Landscape Misc',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox22">Landscape Misc</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox23" value="Low Maintenance" {{ in_array('Low Maintenance',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox23">Low Maintenance</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox24" value="Manual Sprinkler F&R" {{ in_array('Manual Sprinkler F&R',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox24">Manual Sprinkler F&R</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox25" value="Manual Sprinkler Front" {{ in_array('Manual Sprinkler Front',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox25">Manual Sprinkler Front</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox26" value="Manual Sprinkler Rear" {{ in_array('Manual Sprinkler Rear',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox26">Manual Sprinkler Rear</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox27" value="Meadow East" {{ in_array('Meadow East',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox27">Meadow East</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox28" value="Meadow West" {{ in_array('Meadow West',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox28">Meadow West</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox29" value="Navigable Waterway" {{ in_array('Navigable Waterway',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox29">Navigable Waterway</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox30" value="Navigable Waterway" {{ in_array('Navigable Waterway',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox30">Pond Seasonal</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox31" value="Pond Year Round" {{ in_array('Pond Year Round',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox31">Pond Year Round</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox32" value="Private" {{ in_array('Private',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox32">Private</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox33" value="Reservoir" {{ in_array('Reservoir',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox33">Reservoir</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox34" value="River Access" {{ in_array('River Access',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox34">River Access</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox35" value="Secluded" {{ in_array('Secluded',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox35">Secluded</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox36" value="Shape Irregular" {{ in_array('Shape Irregular',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox36">Shape Irregular</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox37" value="Shape Regular" {{ in_array('Shape Regular',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox37">Shape Regular</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox38" value="Split Possible" {{ in_array('Split Possible',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox38">Split Possible</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox39" value="Storm Drain" {{ in_array('Storm Drain',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox39">Storm Drain</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox40" value="Stream Seasonal" {{ in_array('Stream Seasonal',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox40">Stream Seasonal</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox41" value="Stream Year Round" {{ in_array('Stream Year Round',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox41">Stream Year Round</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox42" value="Street Lights" {{ in_array('Street Lights',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox42">Street Lights</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox43" value="Zero Lot Line" {{ in_array('Zero Lot Line',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox43">Zero Lot Line</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox44" value="See Remarks" {{ in_array('See Remarks',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox44">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="lot_features[]" id="lotfeatureslineCheckbox45" value="Other" {{ in_array('Other',$lot_features) ?'checked':null }}>
                                                                            <label class="form-check-label" for="lotfeatureslineCheckbox45">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Topography</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox1" value="Downslope">
                                                                            <label class="form-check-label" for="topographylineCheckbox1">Downslope</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox2" value="Forest">
                                                                            <label class="form-check-label" for="topographylineCheckbox2">Forest</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox3" value="Hillside">
                                                                            <label class="form-check-label" for="topographylineCheckbox3">Hillside</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox4" value="Level">
                                                                            <label class="form-check-label" for="topographylineCheckbox4">Level</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox5" value="Lot Grade Varies">
                                                                            <label class="form-check-label" for="topographylineCheckbox5">Lot Grade Varies</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox6" value="Lot Sloped">
                                                                            <label class="form-check-label" for="topographylineCheckbox6">Lot Sloped</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox7" value="Ridge">
                                                                            <label class="form-check-label" for="topographylineCheckbox7">Ridge</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox8" value="Rock Outcropping">
                                                                            <label class="form-check-label" for="topographylineCheckbox8">Rock Outcropping</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox9" value="Rolling">
                                                                            <label class="form-check-label" for="topographylineCheckbox9">Rolling</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox10" value="Snow Line Above">
                                                                            <label class="form-check-label" for="topographylineCheckbox10">Snow Line Above</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox11" value="Snow Line Below">
                                                                            <label class="form-check-label" for="topographylineCheckbox11">Snow Line Below</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox12" value="South Sloped">
                                                                            <label class="form-check-label" for="topographylineCheckbox12">South Sloped</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox13" value="Steep Hill">
                                                                            <label class="form-check-label" for="topographylineCheckbox13">Steep Hill</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox14" value="Trees Few">
                                                                            <label class="form-check-label" for="topographylineCheckbox14">Trees Few</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox15" value="Trees Many">
                                                                            <label class="form-check-label" for="topographylineCheckbox15">Trees Many</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="topography[]" id="topographylineCheckbox16" value="Upslope">
                                                                            <label class="form-check-label" for="topographylineCheckbox16">Upslope</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Land Use</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox1" value="Agricultural">
                                                                            <label class="form-check-label" for="landuselineCheckbox1">Agricultural</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox2" value="Dairy">
                                                                            <label class="form-check-label" for="landuselineCheckbox2">Dairy</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox3" value="Farm">
                                                                            <label class="form-check-label" for="landuselineCheckbox3">Farm</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox4" value="Fishery">
                                                                            <label class="form-check-label" for="landuselineCheckbox4">Fishery</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox5" value="Livestock">
                                                                            <label class="form-check-label" for="landuselineCheckbox5">Livestock</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox6" value="Logging">
                                                                            <label class="form-check-label" for="landuselineCheckbox6">Logging</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox7" value="Nursery">
                                                                            <label class="form-check-label" for="landuselineCheckbox7">Nursery</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox8" value="Orchard">
                                                                            <label class="form-check-label" for="landuselineCheckbox8">Orchard</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox9" value="Pasture">
                                                                            <label class="form-check-label" for="landuselineCheckbox9">Pasture</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox10" value="Plantable">
                                                                            <label class="form-check-label" for="landuselineCheckbox10">Plantable</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox11" value="Poultry">
                                                                            <label class="form-check-label" for="landuselineCheckbox11">Poultry</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox12" value="Ranch">
                                                                            <label class="form-check-label" for="landuselineCheckbox12">Ranch</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox13" value="Residential">
                                                                            <label class="form-check-label" for="landuselineCheckbox13">Residential</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox14" value="Tree Farm">
                                                                            <label class="form-check-label" for="landuselineCheckbox14">Tree Farm</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox15" value="Vineyard">
                                                                            <label class="form-check-label" for="landuselineCheckbox15">Vineyard</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox16" value="See Remarks">
                                                                            <label class="form-check-label" for="landuselineCheckbox16">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="land_use[]" id="landuselineCheckbox17" value="Other">
                                                                            <label class="form-check-label" for="landuselineCheckbox17">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Current Use</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="current_use[]" id="currentuselineCheckbox1" value="Bed & Breakfast">
                                                                            <label class="form-check-label" for="currentuselineCheckbox1">Bed & Breakfast</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="current_use[]" id="currentuselineCheckbox2" value="Day Care">
                                                                            <label class="form-check-label" for="currentuselineCheckbox2">Day Care</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="current_use[]" id="currentuselineCheckbox3" value="Senior Care">
                                                                            <label class="form-check-label" for="currentuselineCheckbox3">Senior Care</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="current_use[]" id="currentuselineCheckbox4" value="Tasting Room">
                                                                            <label class="form-check-label" for="currentuselineCheckbox4">Tasting Room</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="current_use[]" id="currentuselineCheckbox5" value="Vacation Rental">
                                                                            <label class="form-check-label" for="currentuselineCheckbox5">Vacation Rental</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="current_use[]" id="currentuselineCheckbox6" value="Vineyard">
                                                                            <label class="form-check-label" for="currentuselineCheckbox6">Vineyard</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="current_use[]" id="currentuselineCheckbox7" value="Winery">
                                                                            <label class="form-check-label" for="currentuselineCheckbox7">Winery</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row" data-select2-id="76">
                                                                <div class="col-lg-6 mb-3" data-select2-id="75">
                                                                    <label for="">Horse Property</label>
                                                                    <div class="form-group">
                                                                        <select name="horse_property" id="horse_property" class="form-control select2" data-select2-id="horse_property" tabindex="-1" aria-hidden="true">
                                                                            <option value="" data-select2-id="73">Choose...</option>
                                                                            <option value="Yes" data-select2-id="84">Yes</option>
                                                                            <option value="No" data-select2-id="85">No</option>
                                                                        </select>
                                                                     </div>
                                                                </div> 
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Road Responsibility</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="road_responsibility[]" id="roadresponsibilitylineCheckbox1" value="Private Maintained Road">
                                                                            <label class="form-check-label" for="roadresponsibilitylineCheckbox1">Private Maintained Road</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="road_responsibility[]" id="roadresponsibilitylineCheckbox2" value="Public Maintained Road">
                                                                            <label class="form-check-label" for="roadresponsibilitylineCheckbox2">Public Maintained Road</label>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="road_responsibility[]" id="roadresponsibilitylineCheckbox3" value="Road Maintenance Agreement">
                                                                            <label class="form-check-label" for="roadresponsibilitylineCheckbox3">Road Maintenance Agreement</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Road Surface Type</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="road_surface_type[]" id="roadsurfacetypelineCheckbox1" value="Asphalt">
                                                                            <label class="form-check-label" for="roadsurfacetypelineCheckbox1">Asphalt</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="road_surface_type[]" id="roadsurfacetypelineCheckbox2" value="Chip And Seal">
                                                                            <label class="form-check-label" for="roadsurfacetypelineCheckbox2">Chip And Seal</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="road_surface_type[]" id="roadsurfacetypelineCheckbox3" value="Gravel">
                                                                            <label class="form-check-label" for="roadsurfacetypelineCheckbox3">Gravel</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="road_surface_type[]" id="roadsurfacetypelineCheckbox4" value="Paved">
                                                                            <label class="form-check-label" for="roadsurfacetypelineCheckbox4">Paved</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="road_surface_type[]" id="roadsurfacetypelineCheckbox5" value="Unimproved">
                                                                            <label class="form-check-label" for="roadsurfacetypelineCheckbox5">Unimproved</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Frontage Type</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="frontage_type[]" id="frontagetypelineCheckbox1" value="Borders Government Land">
                                                                            <label class="form-check-label" for="frontagetypelineCheckbox1">Borders Government Land</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="frontage_type[]" id="frontagetypelineCheckbox2" value="Golf Course">
                                                                            <label class="form-check-label" for="frontagetypelineCheckbox2">Golf Course</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="frontage_type[]" id="frontagetypelineCheckbox3" value="Lakefront">
                                                                            <label class="form-check-label" for="frontagetypelineCheckbox3">Lakefront</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="frontage_type[]" id="frontagetypelineCheckbox4" value="River">
                                                                            <label class="form-check-label" for="frontagetypelineCheckbox4">River</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="frontage_type[]" id="frontagetypelineCheckbox5" value="Waterfront">
                                                                            <label class="form-check-label" for="frontagetypelineCheckbox5">Waterfront</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row" data-select2-id="76">
                                                                <div class="col-lg-6 mb-3" data-select2-id="75">
                                                                    <label for="">Distance To Public Transportation</label>
                                                                    <div class="form-group">
                                                                        <select name="distance_public_transportation" id="distance_public_transportation" class="form-control select2" data-select2-id="distance_public_transportation" tabindex="-1" aria-hidden="true">
                                                                            <option value="" data-select2-id="73">Choose...</option>
                                                                            <option value="1 Block" data-select2-id="84">1 Block</option>
                                                                            <option value="2 Block" data-select2-id="85">2 Block</option>
                                                                            <option value="3 Block" data-select2-id="86">3 Block</option>
                                                                            <option value="4+ Block" data-select2-id="87">4+ Block</option>
                                                                            <option value="< Mile" data-select2-id="88">< Mile</option>
                                                                            <option value="1-2 Mile" data-select2-id="89">1-2 Mile</option>
                                                                            <option value="3 or More Miles" data-select2-id="90">3 or More Miles</option>
                                                                            <option value="On Transit Line" data-select2-id="91">On Transit Line</option>
                                                                            <option value="See Remarks" data-select2-id="92">See Remarks</option>
                                                                            <option value="Other" data-select2-id="93">Other</option>
                                                                        </select>
                                                                     </div>
                                                                </div> 
                                                            </div>

                                                            <div class="row" data-select2-id="76">
                                                                <div class="col-lg-6 mb-3" data-select2-id="75">
                                                                    <label for="">Distance To Shopping</label>
                                                                    <div class="form-group">
                                                                        <select name="distance_to_shopping" id="distance_to_shopping" class="form-control select2" data-select2-id="distance_to_shopping" tabindex="-1" aria-hidden="true">
                                                                            <option value="" data-select2-id="73">Choose...</option>
                                                                            <option value="1 Block" data-select2-id="84">1 Block</option>
                                                                            <option value="2 Block" data-select2-id="85">2 Block</option>
                                                                            <option value="3 Block" data-select2-id="86">3 Block</option>
                                                                            <option value="4+ Block" data-select2-id="87">4+ Block</option>
                                                                            <option value="On Street" data-select2-id="88">On Street</option>
                                                                        </select>
                                                                     </div>
                                                                </div> 
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Utilities</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox1" value="Cable Available">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox1">Cable Available</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox2" value="Cable Connected">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox2">Cable Connected</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox3" value="Diesel">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox3">Diesel</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox4" value="Dish Antenna">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox4">Dish Antenna</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox5" value="DSL Available">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox5">DSL Available</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox6" value="Electric">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox6">Electric</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox7" value="Generator">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox7">Generator</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox8" value="Internet Available">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox8">Internet Available</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox9" value="Natural Gas Available">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox9">Natural Gas Available</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox10" value="Natural Gas Connected">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox10">Natural Gas Connected</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox11" value="Off Grid">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox11">Off Grid</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox12" value="Oil">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox12">Oil</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox13" value="Propane Tank Leased">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox13">Propane Tank Leased</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox14" value="Propane Tank Owned">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox14">Propane Tank Owned</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox15" value="Public">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox15">Public</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox16" value="Solar">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox16">Solar</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox17" value="TV Antenna">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox17">TV Antenna</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox18" value="Underground Utilities">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox18">Underground Utilities</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox19" value="Wind">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox19">Wind</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox20" value="None">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox20">None</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox21" value="See Remarks">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox21">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="utilities[]" id="utilitieslineCheckbox22" value="Other">
                                                                            <label class="form-check-label" for="utilitieslineCheckbox22">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Electric</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox1" value="3 Phase">
                                                                            <label class="form-check-label" for="electriclineCheckbox1">3 Phase</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox2" value="220 Volts">
                                                                            <label class="form-check-label" for="electriclineCheckbox2">220 Volts</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox3" value="220 Volts in Kitchen">
                                                                            <label class="form-check-label" for="electriclineCheckbox3">220 Volts in Kitchen</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox4" value="220 Volts in Laundry">
                                                                            <label class="form-check-label" for="electriclineCheckbox4">220 Volts in Laundry</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox5" value="440 Volts">
                                                                            <label class="form-check-label" for="electriclineCheckbox5">440 Volts</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox6" value="Battery Backup">
                                                                            <label class="form-check-label" for="electriclineCheckbox6">Battery Backup</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox7" value="Bi-Direct Meter">
                                                                            <label class="form-check-label" for="electriclineCheckbox7">Bi-Direct Meter</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox8" value="Passive Solar">
                                                                            <label class="form-check-label" for="electriclineCheckbox8">Passive Solar</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox9" value="Photovoltaics Seller Owned">
                                                                            <label class="form-check-label" for="electriclineCheckbox9">Photovoltaics Seller Owned</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox10" value="Photovoltaics Third-Party Owned">
                                                                            <label class="form-check-label" for="electriclineCheckbox10">Photovoltaics Third-Party Owned</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox11" value="Prewired for PVSolar">
                                                                            <label class="form-check-label" for="electriclineCheckbox11">Prewired for PVSolar</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox12" value="Prewired for WindGen">
                                                                            <label class="form-check-label" for="electriclineCheckbox12">Prewired for WindGen</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox13" value="PV-Battery Backup">
                                                                            <label class="form-check-label" for="electriclineCheckbox13">PV-Battery Backup</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox14" value="PV-Off Grid">
                                                                            <label class="form-check-label" for="electriclineCheckbox14">PV-Off Grid</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox15" value="PV-On Grid">
                                                                            <label class="form-check-label" for="electriclineCheckbox15">PV-On Grid</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox16" value="Solar Chamber">
                                                                            <label class="form-check-label" for="electriclineCheckbox16">Solar Chamber</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox17" value="Solar Plumbed">
                                                                            <label class="form-check-label" for="electriclineCheckbox17">Solar Plumbed</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox18" value="Wind Turbine(s)">
                                                                            <label class="form-check-label" for="electriclineCheckbox18">Wind Turbine(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox19" value="See Remarks">
                                                                            <label class="form-check-label" for="electriclineCheckbox19">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="electric[]" id="electriclineCheckbox20" value="Other">
                                                                            <label class="form-check-label" for="electriclineCheckbox20">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Irrigation</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox1" value="Agricultural Well">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox1">Agricultural Well</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox2" value="Irrigation Available">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox2">Irrigation Available</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox3" value="Irrigation Connected">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox3">Irrigation Connected</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox4" value="Irrigation District">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox4">Irrigation District</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox5" value="Meter Available">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox5">Meter Available</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox6" value="Meter on Site">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox6">Meter on Site</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox7" value="Meter Paid">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox7">Meter Paid</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox8" value="Meter Required">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox8">Meter Required</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox9" value="Private District">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox9">Private District</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox10" value="Public District">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox10">Public District</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox11" value="Riparian Rights">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox11">Riparian Rights</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox12" value="Shares Domestic Well">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox12">Shares Domestic Well</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox13" value="Spring(s)">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox13">Spring(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox14" value="None">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox14">None</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox15" value="See Remarks">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox15">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="irrigation[]" id="irrigationlineCheckbox16" value="Other">
                                                                            <label class="form-check-label" for="irrigationlineCheckbox16">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Sewer</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox1" value="Abandoned Septic">
                                                                            <label class="form-check-label" for="sewerlineCheckbox1">Abandoned Septic</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox2" value="Engineered Septic">
                                                                            <label class="form-check-label" for="sewerlineCheckbox2">Engineered Septic</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox3" value="Holding Tank">
                                                                            <label class="form-check-label" for="sewerlineCheckbox3">Holding Tank</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox4" value="In & Connected">
                                                                            <label class="form-check-label" for="sewerlineCheckbox4">In & Connected</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox5" value="Private Sewer">
                                                                            <label class="form-check-label" for="sewerlineCheckbox5">Private Sewer</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox6" value="Public Sewer">
                                                                            <label class="form-check-label" for="sewerlineCheckbox6">Public Sewer</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox7" value="Septic Connected">
                                                                            <label class="form-check-label" for="sewerlineCheckbox7">Septic Connected</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox8" value="Septic Pump">
                                                                            <label class="form-check-label" for="sewerlineCheckbox8">Septic Pump</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox9" value="Septic System">
                                                                            <label class="form-check-label" for="sewerlineCheckbox9">Septic System</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox10" value="Sewer Connected">
                                                                            <label class="form-check-label" for="sewerlineCheckbox10">Sewer Connected</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox11" value="Sewer Connected & Paid">
                                                                            <label class="form-check-label" for="sewerlineCheckbox11">Sewer Connected & Paid</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox12" value="Sewer in Street">
                                                                            <label class="form-check-label" for="sewerlineCheckbox12">Sewer in Street</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox13" value="Shared Septic">
                                                                            <label class="form-check-label" for="sewerlineCheckbox13">Shared Septic</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox14" value="Special System">
                                                                            <label class="form-check-label" for="sewerlineCheckbox14">Special System</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox15" value="None">
                                                                            <label class="form-check-label" for="sewerlineCheckbox15">None</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox16" value="See Remarks">
                                                                            <label class="form-check-label" for="sewerlineCheckbox16">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="sewer[]" id="sewerlineCheckbox17" value="Other">
                                                                            <label class="form-check-label" for="sewerlineCheckbox17">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">Restrictions</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="restrictions[]" id="restrictionslineCheckbox1" value="Age Restrictions">
                                                                            <label class="form-check-label" for="restrictionslineCheckbox1">Age Restrictions</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="restrictions[]" id="restrictionslineCheckbox2" value="Board Approval">
                                                                            <label class="form-check-label" for="restrictionslineCheckbox2">Board Approval</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="restrictions[]" id="restrictionslineCheckbox3" value="Exterior Alterations">
                                                                            <label class="form-check-label" for="restrictionslineCheckbox3">Exterior Alterations</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="restrictions[]" id="restrictionslineCheckbox4" value="Guests">
                                                                            <label class="form-check-label" for="restrictionslineCheckbox4">Guests</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="restrictions[]" id="restrictionslineCheckbox5" value="Owner/Coop Interview">
                                                                            <label class="form-check-label" for="restrictionslineCheckbox5">Owner/Coop Interview</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="restrictions[]" id="restrictionslineCheckbox6" value="Parking">
                                                                            <label class="form-check-label" for="restrictionslineCheckbox6">Parking</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="">&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="restrictions[]" id="restrictionslineCheckbox7" value="Rental(s)">
                                                                            <label class="form-check-label" for="restrictionslineCheckbox7">Rental(s)</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="restrictions[]" id="restrictionslineCheckbox8" value="Signs">
                                                                            <label class="form-check-label" for="restrictionslineCheckbox8">Signs</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="restrictions[]" id="restrictionslineCheckbox9" value="Tree Ordinance">
                                                                            <label class="form-check-label" for="restrictionslineCheckbox9">Tree Ordinance</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="restrictions[]" id="restrictionslineCheckbox10" value="See Remarks">
                                                                            <label class="form-check-label" for="restrictionslineCheckbox10">See Remarks</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="restrictions[]" id="restrictionslineCheckbox11" value="Other">
                                                                            <label class="form-check-label" for="restrictionslineCheckbox11">Other</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}

                                                    

                                                            {{-- https://onedrive.live.com/?authkey=%21ALEdxubFXPqrqa0&id=BD3F4C3C86FB2C5B%2148082&cid=BD3F4C3C86FB2C5B --}}

                                                            
                                                            <div class="row mb-3 mt-3">
                                                                
                                                                <div class="mb-3 text-center">
                                                                    <a href="{{ route('updateStep1') }}" class="clear-btn"><i class="fas fa-arrow-circle-left"></i> Modify Address </a>
                                                                    <button class="map-btn" type="submit" name="submit" value="listing2" id="step2Submit">Save</button>
                                                                </div>
                                                                
                                                            </div>
                                                        </form>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    {{-- <ul class="pager wizard twitter-bs-wizard-pager-link">
                                        <li class="previous"><a href="javascript: void(0);">Previous</a></li>
                                        <li class="next"><a href="javascript: void(0);">Next</a></li>
                                    </ul> --}}
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

        .property-type iframe{
            width: 100%;
            height: 580px;
        }

        .clear-btn{
            border: 1px solid #f00;
            background: #ff0000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .map-btn{
            border: 1px solid #000;
            background: #000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            margin-left: 10px;
        }

        .address-btn{
            border: 1px solid #000;
            background: #000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            margin-left: 10px;
        }
        .listing-btn{
            border: 1px solid #000;
            background: #000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            margin-left: 10px;
        }

        .no-drop {
            cursor: not-allowed;
        }

        .select2-container--default.select2-container--disabled .select2-selection--single {
            cursor: not-allowed;
        }

        label {
            font-weight: 500;
        }

        .form-check-label {
            font-weight: 400;
        }
    </style>

@endsection
