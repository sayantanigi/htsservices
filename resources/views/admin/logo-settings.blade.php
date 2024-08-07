@extends('layouts.admin-dashboard')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title"><?= $data['title'] ?></h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('admin-dashboard') }}">Home</a></li>
                        <li class="active"><?= $data['title'] ?></li>
                    </ol>
                </div>
            </div>

            <form action="{{ url('settings/logosave') }}" class="form-horizontal" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-30"><?= $data['title'] ?></h3>
                            <div class="row">
                                <div class="col-sm-12">

                                    <?php if ($errors->any()){ ?>
                                    <?php
								}else{
								?>
                                    @include('layouts.flash-message')
                                    <?php
									}
								?>

                                    <?php if ($errors->any()){ ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php foreach ($errors->all() as $error){ ?>
                                            <li><?php echo $error; ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                    <?php if(Session::has('message')) { ?>
                                    <div class="alert alert-success"> <?php echo Session::get('message'); ?> </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label for="old_password" class="col-sm-2 text-right">
                                            Logo : <span>*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: auto;">
                                                    <?php if ($data['setting']->logo != '' && !is_null($data['setting']->logo)) { ?>
                                                    <img src="{{ asset('uploads/logo/' . $data['setting']->logo) }}"
                                                        alt="">
                                                    <?php } else { ?>
                                                    <img src="{{ asset('adminassets/dist/images/noimage.jpg') }}"
                                                        alt="">
                                                    <?php } ?>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                    style="max-width: 200px; max-height: auto;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="logo" accept="images/*">
                                                        <input type="hidden" name="oldLogo"
                                                            value="<?= $data['setting']->logo ?>" required="">
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                        data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10 m-b-20" style="display: block;">
                                                <span class="label label-main">Format</span>
                                                jpg, jpeg, png&nbsp;&nbsp;
                                                <span class="label label-main">Max Size</span>
                                                10 MB
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="old_password" class="col-sm-2 text-right">
                                            Favicon : <span>*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: auto;">
                                                    <?php if ($data['setting']->favicon != '' && !is_null($data['setting']->favicon)) { ?>
                                                    <img src="{{ asset('uploads/logo/' . $data['setting']->favicon) }}"
                                                        alt="">
                                                    <?php } else { ?>
                                                    <img src="{{ asset('adminassets/dist/images/noimage.jpg') }}"
                                                        alt="">
                                                    <?php } ?>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                    style="max-width: 200px; max-height: auto;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="favicon" accept="images/*">
                                                        <input type="hidden" name="oldFavicon"
                                                            value="<?= $data['setting']->favicon ?>" required="">
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                        data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10 m-b-20" style="display: block;">
                                                <span class="label label-main">Format</span>
                                                png, ico&nbsp;&nbsp;
                                                <span class="label label-main">Max Size</span>
                                                10 MB
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="old_password" class="col-sm-2 text-right">
                                            Title Logo : <span>*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="title" id="title"
                                                autocomplete="off" value="<?= @$data['setting']->title ?>" required="">
                                        </div>
                                    </div>
                                    <!----------Footer Logo--------------->
                                    {{-- <div class="form-group">
                                        <label for="old_password" class="col-sm-2 text-right">
                                            Footer Logo : <span>*</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: auto;">
                                                    <?php if ($data['setting']->footer_logo != '' && !is_null($data['setting']->footer_logo)) { ?>
                                                    <img src="{{ asset('uploads/logo/' . $data['setting']->footer_logo) }}"
                                                        alt="">
                                                    <?php } else { ?>
                                                    <img src="{{ asset('adminassets/dist/images/noimage.jpg') }}" alt="">
                                                    <?php } ?>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                    style="max-width: 200px; max-height: auto;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="footer_logo" accept="images/*">
                                                        <input type="hidden" name="oldfooterLogo"
                                                            value="<?= $data['setting']->footer_logo ?>" required="">
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                        data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10 m-b-20" style="display: block;">
                                                <span class="label label-main">Format</span>
                                                jpg, jpeg, png&nbsp;&nbsp;
                                                <span class="label label-main">Max Size</span>
                                                10 MB
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!----------------------->
                                </div>
                                <div class="col-sm-4 col-sm-offset-3">
                                    <input type="submit" class="btn btn-primary" name="logo_settings" id="logo_settings"
                                        value="Save" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endsection
