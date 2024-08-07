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
                                <h4 class="mb-0">{{ $data['title'] }}                                    
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
                               
                              
                                <li class="nav-item">
                                    <a class="nav-link" {{ Session::has('hts_user_id') ? '' : 'disabled' }}
                                        data-bs-toggle="tab" href="#pmttems" id="pmttems_nav" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Pmt Tems</span>
                                    </a>
                                </li>
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
                                
                            </ul>

                            <!-- Tab panes -->
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

        .nav-tabs-cus > li > a {
            color: #445990;
            font-weight: bold;
            font-size: 12px;
        }
    </style>

@endsection
