@extends('layouts.admin-dashboard')
@section('title', 'View User Data')

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
            
               <div class="row">
                  <div class="col-lg-12">
                     <div class="col-lg-12 mb-3">
                        <label>Image</label>: 
                           <span>
                                 @if(@$data['userData']->profile_image && file_exists( 'public/uploads/users/'.@$data['userData']->profile_image))
                                    <img id="output_image" src="{{asset('/uploads/users/'.@$data['userData']->profile_image)}}" alt="profile_image">
                                 @else
                                    <img id="output_image" src="{{ asset('/images/small.jpg') }}" alt="Header Avatar">
                                 @endif
                            </span>
                     </div>
                     <div class="col-lg-12 mb-3">
                        <label>User Type</label>: 
                           <span>
                              @if (@$data['userData']->user_type=="1")
                                    Buyer
                              @elseif(@$data['userData']->user_type=="2")
                                    Seller
                              @elseif(@$data['userData']->user_type=="3")
                                    Agent
                              @elseif(@$data['userData']->user_type=="4")
                                    Others
                              @endif
                           </span>
                     </div>
                  </div>
                  <div class="col-lg-12 mb-3">
                     <label>Name</label>: <span>{{$data['userData']->prefix}}. {{$data['userData']->fname}} {{$data['userData']->lname}} </span>
                  </div>
                  <div class="col-lg-12 mb-3">
                     <label>Email Id</label>: <span>{{$data['userData']->email}} </span>
                  </div>
                  <div class="col-lg-12 mb-3">
                     <label>Phone</label>: <span>{{$data['userData']->phone}}</span>
                  </div>
                  <div class="col-lg-12 mb-3">
                     <label>Address</label>: <span>{{$data['userData']->address}} </span>
                  </div>
                  <div class="col-lg-12 mb-3">
                     <label>Status</label>: <span>{{(@$data['userData']->status == 1)? 'Active' : 'Inactive'}} </span>
                  </div>
                  <div class="col-lg-12 mb-3">
                     <label>Created At</label>: <span> {{ date("jS M, Y", strtotime($data['userData']->created_at)) }} </span>
                  </div>
                </div>
  
            </div>
         </div>
      </div>
   </div>
</div>
<style>
   #output_image {
      width: 70px;
      padding: 2px;
      border: 1px solid #c01e2f;
   }
</style>
 @endsection