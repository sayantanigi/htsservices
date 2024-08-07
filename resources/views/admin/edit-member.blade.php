@extends('layouts.admin-dashboard')
@section('title', 'Edit User Data')

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
                        <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
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

               <!-- Way 1: Display All Error Messages -->
               @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show font-size-12">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                           @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </ul>
                  </div>
               @endif
            </div>
            
            <form action="{{ route('updateUser', ['id' => $data['userData']->id]) }}" method="post" enctype="multipart/form-data" id="loginForm">
               @csrf

               <div class="row">
                  <div class="col-lg-4">
                     <div class="form-group mb-3">
                        <label>Image</label>
                        <input type='file' name='image' class="form-control" accept="image/*" onchange="preview_image(event)" />
                        <input type='hidden' name='oldProfileImage' value='{{ @$data['userData']->profile_image }}' />
                     </div>
                  </div>
                  <div class="col-lg-2">
                     <div class="form-group mb-3">
                        <label></label>
                        @if(@$data['userData']->profile_image && file_exists( 'public/uploads/users/'.$data['userData']->profile_image))
                           <img id="output_image" src="{{asset('/uploads/users/'.@$data['userData']->profile_image)}}" alt="profile_image">
                        @else
                           <img id="output_image" src="{{ asset('/images/small.jpg') }}" alt="Header Avatar">
                        @endif
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group mb-3">
                        <label>User Type<code>*</code></label>
                        <select name="user_type" class="form-control select2" id="user_type">
                           <option value="">Choose Type...</option>
                           <option value="1" {{@$data['userData']->user_type == "1"  ? 'selected' : ''}}>Buyer</option>
                           <option value="2" {{@$data['userData']->user_type == "2"  ? 'selected' : ''}}>Seller</option>
                           <option value="3" {{@$data['userData']->user_type == "3"  ? 'selected' : ''}}>Agent</option>
                           <option value="4" {{@$data['userData']->user_type == "4"  ? 'selected' : ''}}>Others</option>
                        </select>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group mb-3">
                        <label>First Name<code>*</code></label>
                        <input type="text" class="form-control" name="fname" value="{{$data['userData']->fname}}">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group mb-3">
                        <label>Last Name<code>*</code></label>
                        <input type="text" class="form-control" name="lname" value="{{$data['userData']->lname}}">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group mb-3">
                     <label> Phone Number</label>
                        <input type="text" class="form-control" placeholder="Phone Number" name="phone" value="{{$data['userData']->phone}}">
                     </div>
                  </div>
                  <div class="col-lg-6">
                        <div class="form-group mb-3">
                           <label> Address</label>
                           <input type="text" class="form-control" placeholder="1234 Main St" name="address" value="{{$data['userData']->address}}">
                        </div>
                     </div>
               </div>

               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group mb-3">
                        <label>Email<code>*</code></label>
                        <input type="email" class="form-control" name="email" value="{{$data['userData']->email}}">
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group mb-3">
                        <label>Password<code>(Enter only when you want to change the password)</code></label>
                        <input type="password" class="form-control" name="edpassword">
                     </div>
                  </div>
               </div>
               
               <div class="text-end">
                  <!-- <button class="btn btn-outline-primary">Cancel</button> -->
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </form>
  
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
</style>
 @endsection