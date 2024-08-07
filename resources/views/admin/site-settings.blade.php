@extends('layouts.admin-dashboard')

@section('content')
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
                        </div>
                        <form action="{{ url('settings/save') }}" class="form-horizontal" method="post"
                            enctype="multipart/form-data" id="quickFormValidation">
                            @csrf
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                
                                                <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Address :<span class="red">*</span>
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="address"
                                                            id="address" value="<?= $data['setting']->address ?>"
                                                            autocomplete="off" required="">
                                                        <input type="hidden" id="longitude">
                                                        <input type="hidden" id="latitude">
                                                        <input type="hidden" id="route">
                                                        <input type="hidden" id="street_number">
                                                        <input type="hidden" id="locality">
                                                        <input type="hidden" id="postal_code">
                                                        <input type="hidden" id="administrative_area_level_1">
                                                        <input type="hidden" id="country">
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Address Map :<span class="red">*</span>
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="test" class="form-control" name="address_map"
                                                            id="address_map" value="<?= $data['setting']->address_map ?>"
                                                            autocomplete="off" required="">
                                                    </div>
                                                </div> --}}
                                                <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Email :<span class="red">*</span>
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="email"
                                                            id="email" value="<?= @$data['setting']->email ?>"
                                                            autocomplete="off" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Support Email :<span class="red">*</span>
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" name="support_email"
                                                            id="support_email"
                                                            value="<?= $data['setting']->support_email ?>"
                                                            autocomplete="off" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Phone :<span class="red">*</span>
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="phone"
                                                            id="phone" value="<?= $data['setting']->phone ?>"
                                                            autocomplete="off" required="">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Website Name:
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="website_name"
                                                            id="website_name"
                                                            value="<?= $data['setting']->website_name ?>"
                                                            autocomplete="off" required="">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Website Url:
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="website"
                                                            id="website" value="<?= $data['setting']->website ?>"
                                                            autocomplete="off" required="">
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group mb-3">
                                                    <label class="col-sm-6 text-right">
                                                        Cost of posting at Rank 1(Cent):<span class="red">*</span>
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="validationTooltipUsernamePrepend">&cent;</span>
                                                            </div>
                                                            <input type="number" class="form-control" id="validationTooltipUsername"
                                                                placeholder="Rank Price"
                                                                aria-describedby="validationTooltipUsernamePrepend" name="rank_price"
                                                                 value="<?= $data['setting']->rank_price ?>" required>
                                                            <div class="invalid-tooltip">
                                                                Please choose a unique and valid username.
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div> --}}

                                                {{-- <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Social search:<span class="red">*</span>
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" type="radio" name="social_search"
                                                                id="formRadios1" value="1" {{ (@$data['setting']->social_search == '1') ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="formRadios1">
                                                                Yes
                                                            </label>
                                                            
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="social_search"
                                                                id="formRadios2" value="0" {{ (@$data['setting']->social_search == '0') ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="formRadios2">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                            </div>
                                        </div>
                                        <h3 class="box-title m-b-20 m-b-30 mt-3">Social Media Settings</h3>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Facebook :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="facebook"
                                                            id="facebook" value="<?= $data['setting']->facebook ?>"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Twitter :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="twitter"
                                                            id="twitter" value="<?= $data['setting']->twitter ?>"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Instagram :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="instagram"
                                                            id="instagram" value="<?= $data['setting']->instagram ?>"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Pinterest :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="pinterest"
                                                            id="pinterest" value="<?= $data['setting']->pinterest ?>"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="col-sm-2 text-right">
                                                        Youtube :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="youtube"
                                                            id="youtube" value="<?= $data['setting']->youtube ?>"
                                                            autocomplete="off">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-4 col-sm-offset-4">
                                                <div class="form-group mb-3">
                                                    <input type="submit" class="btn btn-primary" name="settings"
                                                        id="settings" value="Save" />
                                                </div>
                                            </div>
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
    <style>
        .form-check {
            display: inline-block;
            margin-right: 15px;
        }
        .red{
            color:red;
        }
    </style>
@endsection
