@extends('layouts.admin-dashboard')
@section('title', 'Edit Employee')

@section('content')

    @php
        $tabCode = 'Airline';
    @endphp

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">{{ $data['title'] }}</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('employees') }}">Employee</a></li>
                                    <li class="breadcrumb-item active">{{ $data['title'] }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card custom-shadow rounded-lg border">
                    <div class="card-body">
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

                            <!-- Way 1: Display All Error Messages -->
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show font-size-12">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-cus" role="tablist" id="myAccordion">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#generale" id="generale_nave"
                                    role="tab" aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">General</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab"
                                    href="#relatedentitiese" id="relatedentitiese_nave" role="tab" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Related Entities</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab"
                                    href="#addresse" id="addresse_nave" role="tab" aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Contact Information</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab"
                                    href="#otheraddressese" id="otheraddressese_nave" role="tab" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Other Addresses</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab"
                                    href="#attachmentse" id="attachmentse_nave" role="tab" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Attachments</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab"
                                    href="#notese" id="notese_nave" role="tab" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Notes</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">

                            <div class="tab-pane active" id="generale" role="tabpanel">
                                <form action="{{ route('updateEmpData', ['id' => $data['employee_id']]) }}" class="custom-validation" method="post"
                                    id="formValidated">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group mb-3">
                                                <label>Name<code>*</code></label>
                                                <input type="text" class="form-control" name="name" value="{{ @$data['userData']->name }}"> 
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-3">
                                                <label>Entity ID</label>
                                                <input type="text" class="form-control" name="entity_id"
                                                    value="{{ @$data['userData']->entity_id }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-3">
                                                <label>Country of citizenship<code>*</code></label>
                                                <select class="form-select select2" aria-label="Default select example"
                                                    name="citizenship">
                                                    <option value="" selected="">Select Citizenship...</option>
                                                    @if (!$data['countries']->isEmpty())
                                                        @foreach ($data['countries'] as $key => $item_val)
                                                            <option value="{{ @$item_val->name }}"
                                                                {{ @$item_val->name == @$data['userData']->citizenship ? 'selected' : '' }}>
                                                                {{ @$item_val->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-3">
                                                <label>Date of Birth</label>
                                                <input type="date" class="form-control" value="{{ @$data['userData']->date_of_birth }}" placeholder=""
                                                    name="date_of_birth">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label>Email<code>*</code></label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ @$data['userData']->email }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
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
                                                                name="indentification_type"
                                                                aria-label="Default select example">
                                                                <option value="" selected="">Select other
                                                                </option>
                                                                @if (!$data['types']->isEmpty())
                                                                    @foreach ($data['types'] as $key => $item)
                                                                        <option value="{{ @$item->name }}"
                                                                            {{ @$item->name == @$data['userData']->indentification_type ? 'selected' : '' }}>
                                                                            {{ @$item->name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <div class="mb-3">
                                                    <div class="form-check-inline mb-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="usr_status" id="formRadios1cc" value="0"
                                                            {{ '0' == @$data['userData']->status ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="formRadios1cc">
                                                            Set as inactive
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <div class="mb-3">
                                                    <div class="form-check-inline mb-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="is_hts_user" id="formRadios1User" value="1"
                                                            {{ '1' == @$data['userData']->is_hts_user ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="formRadios1User">
                                                            Set Employee as a HTS User
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <hr>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <h5>Manage User Information</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                        <label>Username<code>*</code></label>
                                                        <input type="text" class="form-control" name="user_name" value="{{ @$data['userData']->user_name }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                        <label>Password<code>*</code><span style="color: #ff0000; font-size:10px;">(Enter only when you want to change the password)</span></label>
                                                        <input type="password" class="form-control" name="edit_password" id="edit_password" placeholder="******" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label>Pin</label>
                                                                <input type="text" class="form-control"
                                                                    name="pin_number" value="{{ @$data['userData']->pin_number }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label>Confirm Pin</label>
                                                                <input type="text" class="form-control"
                                                                    name="confirm_pin_number" value="{{ @$data['userData']->pin_number }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Divison </label>
                                                    <select class="form-select select2" name="divison"
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
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Warehouse</label>
                                                    <select class="form-select select2" name="warehouse"
                                                        aria-label="Default select example">
                                                        <option value="" selected="">Select...</option>
                                                        @if (!$data['warehouse']->isEmpty())
                                                            @foreach ($data['warehouse'] as $key => $item_2)
                                                                <option value="{{ @$item_2->name }}"
                                                                    {{ @$item_2->name == @$data['userData']->warehouse ? 'selected' : '' }}>
                                                                    {{ @$item_2->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Divison Permission</label>
                                                    <select class="form-select select2" name="divison_permission"
                                                        aria-label="Default select example">
                                                        <option value="" selected="">Select...</option>
           
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <table class="table">
                                             <thead>
                                                <th>Allow Access</th>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                   <td>
                                                      <div class="form-check form-switch">
                                                         <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="hts_explorer" value="1" {{ '1' == @$data['userData']->hts_explorer ? 'checked' : '' }}>
                                                         <label class="form-check-label" for="flexSwitchCheckDefault">HTS Explorer</label>
                                                       </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="form-check form-switch">
                                                         <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="wms_mobile" value="1" {{ '1' == @$data['userData']->wms_mobile ? 'checked' : '' }}>
                                                         <label class="form-check-label" for="flexSwitchCheckDefault">WMS Mobile</label>
                                                       </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="form-check form-switch">
                                                         <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="flow_wms" value="1" {{ '1' == @$data['userData']->flow_wms ? 'checked' : '' }}>
                                                         <label class="form-check-label" for="flexSwitchCheckDefault">Flow WMS</label>
                                                       </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="form-check form-switch">
                                                         <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="final_me" value="1" {{ '1' == @$data['userData']->final_me ? 'checked' : '' }}>
                                                         <label class="form-check-label" for="flexSwitchCheckDefault">Final Me</label>
                                                       </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <div class="form-check form-switch">
                                                         <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="api" value="1" {{ '1' == @$data['userData']->api ? 'checked' : '' }}>
                                                         <label class="form-check-label" for="flexSwitchCheckDefault">API</label>
                                                       </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                            </table>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-0 float-end">
                                                <div>
                                                    <button type="submit" name="submit" value="generalForm"
                                                        class="btn btn-primary waves-effect waves-light me-1">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <div class="tab-pane " id="relatedentitiese" role="tabpanel">
                                <form action="{{ route('updateParentEntityUsr', ['id' => $data['employee_id']]) }}" class="custom-validation" method="post"
                                    id="formValidatedAddressEmp">
                                    @csrf
                                    <div class="mb-3 form-group">
                                        <label>Salesperson</label>
                                        <select class="form-select select2" aria-label="Default select example"
                                                        name="parent_entity" id="parent_entity_emp">
                                            <option value="" selected="">Select...</option>
                                            <optgroup>Name | Entity ID | Type</optgroup>
                                            @if(!empty($data['salesperson']))
                                                @foreach($data['salesperson'] as $key=>$item_val)
                                                    <option value="{{ @$item_val->id }}" {{ @$item_val->id == @$data['userData']->parent_entity ? 'selected' : '' }}>{{ @$item_val->name }} | {{ @$item_val->entity_id }}  | Salespersons</option>
                                                @endforeach
                                            @endif 
                                        </select>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane " id="addresse" role="tabpanel">
                                <form action="{{ route('updateUsrAddressEmp', ['id' => $data['employee_id']]) }}" class="custom-validation"
                                    method="post" id="formValidatedAddress">
                                    @csrf
                                    <div class="row mb-3">
                                       <div class="col-lg-6">
                                          <h5>Contact Numbers</h5>
                                       </div>
                                       <div class="col-lg-6">
                                          
                                       </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                           <div class="form-group mb-3">
                                              <label>Phone</label>
                                              <input type="text" class="form-control" name="phone" required=""
                                                  value="{{ @$data['userData']->phone }}">
                                          </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                               <label>Extension<code>*</code></label>
                                               <input type="text" class="form-control" name="extension" required=""
                                                  value="{{ @$data['userData']->extension }}">
                                           </div>
                                         </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                           <div class="form-group mb-3">
                                              <label>Mobile Phone</label>
                                              <input type="text" class="form-control" name="mobile_phone" required=""
                                                  value="{{ @$data['userData']->mobile_phone }}">
                                          </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                               <label>Fax</label>
                                               <input type="text" class="form-control" name="fax" required=""
                                                  value="{{ @$data['userData']->fax }}">
                                           </div>
                                         </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                           <h5>Main Address</h5>
                                        </div>
                                        <div class="col-lg-6">
                                           <h5>Billing Address <span style="margin-left:10px; font-size:12px;"><input type="checkbox" name="same_as_maddress" {{ '1' == @$data['userData']->same_as_maddress ? 'checked' : '' }} value="1"> Same as Main Address</span></h5>
                                        </div>
                                     </div>

                                    <div class="row">
                                       <div class="col-lg-6">
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
                                                 placeholder="Type Zip Code" value="{{ @$data['userData']->zip_code }}">
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
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="form-group mb-3">
                                             <label>Street & Number<code>*</code></label>
                                             <div>
                                                 <textarea required="" name="billing_street_number" class="form-control" rows="5">{{ @$data['userData']->billing_street_number }}</textarea>
                                             </div>
                                         </div>
                                         <div class="form-group mb-3">
                                             <label>City<code>*</code></label>
                                             <input type="text" class="form-control" name="billing_city" required=""
                                                 placeholder="Type City" value="{{ @$data['userData']->billing_city }}">
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
                                       </div>
                                       
                                   </div>
                                    
                                    <div class="form-group mb-0 float-end">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1"
                                                name="submit" value="address">
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

                            <div class="tab-pane " id="otheraddressese" role="tabpanel">
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
                                                    <th width="20">#</th>
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
                                                                    class="btn btn-primary btn-sm btn-xs waves-effect"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editotherserviceadd-{{ $row->id }}">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </button>
                                                                <button type="reset"
                                                                    class="btn btn-danger btn-sm waves-effect"
                                                                    onclick="deleteUsrOtherAddressEmp({{ $row->id }});">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </button>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade"
                                                            id="editotherserviceadd-{{ $row->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalScrollableTitle">Edit Address
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('saveEmployeeOtherAddressEmp', ['id' => $data['employee_id']]) }}"
                                                                            class="custom-validation" method="post"
                                                                            id="formValidatedOtherAddress">
                                                                            @csrf
                                                                            <input type="hidden" name="other_id"
                                                                                value="{{ $row->id }}">
                                                                            <div class="form-group mb-3">
                                                                                <label>Description<code>*</code></label>
                                                                                <div>
                                                                                    <textarea required="" name="other_description_edt" class="form-control" rows="5">{{ @$row->other_description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Contact Name<code>*</code></label>
                                                                                <input type="text"
                                                                                    name="other_contact_name_edt"
                                                                                    class="form-control"
                                                                                    value="{{ @$row->other_contact_name }}"
                                                                                    required="">
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
                                                                                <input type="text" class="form-control"
                                                                                    name="other_city_edt" required=""
                                                                                    placeholder="Type City"
                                                                                    value="{{ @$row->other_city }}">
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Country<code>*</code></label>
                                                                                <select class="form-select select2"
                                                                                    name="other_country_edt"
                                                                                    id="other_country_id_{{ $row->id }}"
                                                                                    onchange="getOtherState('{{ $row->id }}', this);">
                                                                                    <option value="" selected="">
                                                                                        Select Country...</option>
                                                                                    @if (!$data['countries']->isEmpty())
                                                                                        @foreach ($data['countries'] as $key => $item_val)
                                                                                            <option
                                                                                                value="{{ @$item_val->id }}"
                                                                                                {{ @$item_val->id == @$row->other_country ? 'selected' : '' }}>
                                                                                                {{ @$item_val->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            @php
                                                                                $othetstates = DB::table('states')
                                                                                    ->where('country_id', @$row->other_country)
                                                                                    ->orderBy('name', 'asc')
                                                                                    ->get();
                                                                            @endphp
                                                                            <div class="form-group mb-3">
                                                                                <label>State<code>*</code></label>
                                                                                <select class="form-select select2"
                                                                                    name="other_state_edt"
                                                                                    id="other_state_html_{{ $row->id }}">
                                                                                    <option value="" selected="">
                                                                                        Select State...</option>
                                                                                    @if (!empty($othetstates))
                                                                                        @foreach ($othetstates as $key => $item_val_2)
                                                                                            <option
                                                                                                value="{{ @$item_val_2->id }}"
                                                                                                {{ @$item_val_2->id == @$row->other_state ? 'selected' : '' }}>
                                                                                                {{ @$item_val_2->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Zip Code<code>*</code></label>
                                                                                <input type="text" class="form-control"
                                                                                    name="other_zip_code_edt"
                                                                                    required=""
                                                                                    placeholder="Type Zip Code"
                                                                                    value="{{ @$row->other_zip_code }}">
                                                                            </div>
                                                                            <div class="form-group mb-3">
                                                                                <label>Port</label>
                                                                                <select class="form-select select2"
                                                                                    name="other_port_edt"
                                                                                    aria-label="Default select example">
                                                                                    <option value="" selected="">
                                                                                        Select Port...</option>
                                                                                    @if (!$data['ports']->isEmpty())
                                                                                        @foreach ($data['ports'] as $key => $item_val_1)
                                                                                            <option
                                                                                                value="{{ @$item_val_1->name }}"
                                                                                                {{ @$item_val_1->name == @$row->other_port ? 'selected' : '' }}>
                                                                                                {{ @$item_val_1->name }} - {{ @$item_val_1->port_id }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group mb-3">
                                                                                <button type="submit" name="submit"
                                                                                    value="otherAddress_edt"
                                                                                    class="btn btn-primary waves-effect waves-light">Save</button>

                                                                                <button type="button"
                                                                                    class="btn btn-light waves-effect"
                                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                                {{-- <button type="button" class="btn btn-light waves-effect">Help</button> --}}
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

                            <div class="tab-pane " id="attachmentse" role="tabpanel">
                                <div class="rates_main">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">

                                                    <h4 class="card-title mb-3">Drop your file and attachment here.</h4>

                                                    <div>
                                                        <form action="{{ route('upload-employee-images-edt', ['id' => $data['employee_id']]) }}"
                                                            class="form-horizontal form dropzone" method="post"
                                                            id="formValidatedEmployeeGalleryEdt">
                                                            @csrf
                                                            <input type="hidden" name="usrId" id="usrId" value="{{ $data['employee_id'] }}">
                                                            <div class="fallback">
                                                                <input name="file" type="file" multiple="multiple">
                                                            </div>
                                                            <div class="dz-message needsclick">
                                                                <div class="mb-3">
                                                                    <i
                                                                        class="display-4 text-muted ri-upload-cloud-2-line"></i>
                                                                </div>

                                                                <h4>Drop files here or click to upload.</h4>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="text-center mt-4">
                                                        <div class="card">
                                                            <div class="card-body wizard-card">
                                                                <h4 class="card-title mb-4">Files</h4>
                                                                <div id="hTMLForEmployee">
                                                                    <table id="dataTable222"
                                                                        class="table dt-responsive nowrap w-100">
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="70">#</th>
                                                                                <th width="400">File</th>
                                                                                <th>Actions</th>
                                                                            </tr>
                                                                        </thead>


                                                                        <tbody>
                                                                            @if (!empty($data['gallery']))
                                                                                @foreach ($data['gallery'] as $key => $row)
                                                                                    <tr>
                                                                                        <td>{{ $key + 1 }}</td>
                                                                                        <td>
                                                                                            @if (@$row->filename && file_exists('public/uploads/files/' . @$row->filename))
                                                                                                @php
                                                                                                    $ext = pathinfo(asset('/uploads/files/' . @$row->filename), PATHINFO_EXTENSION);
                                                                                                @endphp

                                                                                                @if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'gif')
                                                                                                    <img id="output_image"
                                                                                                        src="{{ asset('/uploads/files/' . @$row->filename) }}"
                                                                                                        alt="image">
                                                                                                @else
                                                                                                    <a href="{{ asset('/uploads/files/' . @$row->filename) }}"
                                                                                                        target="__blank">{{ @$row->filename }}</a>
                                                                                                @endif
                                                                                            @else
                                                                                                <img id="output_image"
                                                                                                    src="{{ asset('/images/small.jpg') }}"
                                                                                                    alt="Header Avatar">
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>
                                                                                            <button
                                                                                                class="btn btn-xs btn-danger"
                                                                                                onclick="deleteEmployeeImageEdt({{ @$row->id }})"><i
                                                                                                    class="fas fa-trash-alt"></i></button>
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

                            <div class="tab-pane " id="notese" role="tabpanel">
                                <div class="rates_main">
                                    <form action="{{ route('addUsrNoteEdt', ['id' => $data['employee_id']]) }}" class="custom-validation"
                                        method="post" id="formValidatedEmpNotes">
                                        @csrf
                                        <div class="row row-border-bottom mt-3 mb-3">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label>Write Note Here</label>
                                                    <div>
                                                        <textarea required="" class="form-control" name="usr_note" rows="5">{{ @$data['userData']->usr_note }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div>
                                                        <button type="submit" name="submit" value="carrierNotes"
                                                            class="btn btn-primary waves-effect waves-light me-1">
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
                        <form action="{{ route('updateUsrOtherAddressEmp', ['id' => $data['employee_id']]) }}" class="custom-validation"
                            method="post" id="formValidatedOtherEmpAddress">
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
                            </div>

                        </form>
                    </div>
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

        .nav-tabs-cus>li>a {
            color: #445990;
            font-weight: bold;
            font-size: 12px;
        }
    </style>

@endsection
