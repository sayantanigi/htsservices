@extends('layouts.admin-dashboard')
@section('title', 'Profile')

@section('content')

<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0">{{$data['title']}}</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{$data['title']}}</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
 
         <div class="card custom-shadow rounded-lg border">
         	<div class="card-body">
             <div class="col-sm-12">

                @if(\Session::has('error'))
                     <div class="alert alert-danger alert-dismissible fade show font-size-12">{{ \Session::get('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                     {{ \Session::forget('error') }}
               @endif

               @if(\Session::has('success'))
                     <div class="alert alert-success alert-dismissible fade show font-size-12">{{ \Session::get('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                     {{ \Session::forget('success') }}
               @endif
            </div>
               <form action="{{ route('updateAdProfile') }}" method="post" enctype="multipart/form-data" id="loginForm">
                @csrf
                  <div class="row">
                     <div class="col-lg-2">
                        <figure class="group-dp">
                           @if(@$data['userData']->profile_image && file_exists( 'public/uploads/users/'.@$data['userData']->profile_image))
                                <img id="output_image" src="{{asset('/uploads/users/'.@$data['userData']->profile_image)}}" alt="profile_image">
                            @else
                                <img id="output_image" src="{{ asset('/images/small.jpg') }}" alt="Header Avatar">
                            @endif
                           
                           <label class="uploadprofileImg custom-shadow">
                              <i class="fas fa-camera"></i> 
                              <input type='file' name='image' accept="image/*" onchange="preview_image(event)" />
                              <input type='hidden' name='oldProfileImage' value='{{ @$data['userData']->profile_image }}' />
                           </label>
                        </figure>
                     </div>
                     <div class="col-lg-10">
                        
                        <div class="mt-3">
                           <div class="form-group mb-3">
                              <div class="row align-items-center">
                                 <label class="col-lg-3 fw-bold font-size-13">Name:</label>
                                 <div class="col-lg-6 form-group">
                                    <input type="text"  value="{{@$data['userData']->name}}" class="form-control font-size-13 custom-shadow" name="fname">
                                 </div>
                              </div>
                           </div>

                           <div class="form-group mb-3">
                              <div class="row align-items-center">
                                 <label class="col-lg-3 fw-bold font-size-13">Email:</label>
                                 <div class="col-lg-6 form-group">
                                    <input type="email" value="{{@$data['userData']->email}}" class="form-control font-size-13 custom-shadow" name="email">
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="row align-items-center">
                                 <label class="col-lg-3 fw-bold font-size-13">Phone Number:</label>
                                 <div class="col-lg-6 form-group">
                                    <input type="text" value="{{@$data['userData']->phone}}" class="form-control font-size-13 custom-shadow" name="phone">
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="row">
                                 <div class="col-lg-6 offset-lg-3">
                                    <button class="btn btn-primary custom-shadow">Update Profile</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>

               <form action="{{ route('updateAdPassword') }}" class="form-horizontal" method="post" id="formValidated">
               @csrf
                  <div class="row">
                     <div class="col-lg-10 offset-lg-2">
                        <div class="mt-4">
                           <h3 class="h5 mb-3 text-uppercase fw-bold">Change Password</h3>
                           <div class="form-group mb-3">
                              <div class="row align-items-center">
                                 <label class="col-lg-3 fw-bold font-size-13">Current Password: <span>*</span></label>
                                 <div class="col-lg-6 form-group">
                                    <input type="password" class="form-control font-size-13 custom-shadow" name="c_password" id="c_password" autocomplete="off">
                                   
                                 </div>
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="row align-items-center">
                                 <label class="col-lg-3 fw-bold font-size-13">New Password: <span>*</span></label>
                                 <div class="col-lg-6 form-group">
                                    <input type="password" class="form-control font-size-13 custom-shadow" name="password" id="password" autocomplete="off"> </div>
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="row align-items-center">
                                 <label class="col-lg-3 fw-bold font-size-13">Confirm Password: <span>*</span></label>
                                 <div class="col-lg-6 form-group">
                                    <input type="password" class="form-control font-size-13 custom-shadow" name="confirm_password" id="confirm_password" autocomplete="off">
                                      </div>
                              </div>
                           </div>
                           <div class="form-group mb-3">
                              <div class="row">
                                 <div class="col-lg-6 offset-lg-3">
                                    <button class="btn btn-primary custom-shadow">Change Password</button>
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
 @endsection