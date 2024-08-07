@extends('layouts.admin-dashboard')
@section('title', 'Carrier Commodity List')

@section('content')

<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0">{{$data['title']}}
                     <button type="button" style="margin-left:10px;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-plus"></i> Add New</button>
                  </h4>
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

            <div class="">
               <table id="dataTable" class="table dt-responsive nowrap w-100">
                  <thead>
                     <tr>
                        <th width="10">#</th>
                        <th width="130">Name</th>
                        <th width="40">Status</th>
                        <th width="40">Created At</th>
                        <th width="60">Actions</th>
                     </tr>
                  </thead>


                  <tbody>
                     @if(!$data['list']->isEmpty())
                        @foreach($data['list'] as $key=>$row)
                       
                           <tr>
                              <td>{{ $key+1 }}</td>
                              <td>
                                 @if (@$row->name)
                                       {{ $row->name }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 <div class="square-switch">
                                    <input type="checkbox" id="square-switch{{ @$row->id }}" value="{{ @$row->status }}" switch="info" {{ (@$row->status == 1)? 'checked="checked"' : '' }} onchange="changeCommodityStatus({{ @$row->id }}, $(this))" />
                                    <label for="square-switch{{ @$row->id }}" data-on-label="Yes" data-off-label="No"></label>
                                 </div>
                             </td>
                              <td>
                                 @if (@$row->created_at)
                                       {{ date("jS M, Y", strtotime($row->created_at)) }}<br>
                                 @else
                                       &#8212;
                                 @endif
                              </td>
                              <td>
                                 <a href="javascript:void(0);" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ @$row->id }}"><i class="far fa-edit"></i></a>
                                 <button class="btn btn-sm btn-danger" onclick="deleteCommodity({{ @$row->id }})"><i class="fas fa-trash-alt"></i></button>
                              </td>
                           </tr>

                           <div class="modal fade" id="staticBackdrop{{@$row->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="staticBackdropLabel">Edit for {{ $row->name }}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                       <form action="{{ route('updateCommodity') }}" method="post" enctype="multipart/form-data" id="formValidated">
                                          @csrf
                                          <input type="hidden" name="port_id" id="port_id" value="{{ $row->id }}">
                                          <div class="row">
                                             <div class="col-lg-10">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Name:</label>
                                                   <input type="text"  value="{{ $row->name }}" class="form-control" required="" name="type_name_edt" id="type_name_edt">
                                                   <input type="hidden"  value="{{ $row->id }}" name="type_id">
                                                </div>
                                             </div>
                                          </div>
                           
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                             <button type="submit" name="submit" value="Update" class="btn btn-primary waves-effect waves-light">Save</button>
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

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add new commodity</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
            <form action="{{ route('createCommodity') }}" method="post" enctype="multipart/form-data" id="loginForm">
               @csrf

               <div class="row">
                  <div class="col-lg-10">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Name:</label>
                        <input type="text"  value="" class="form-control" name="port_name" id="port_name">
                     </div>
                  </div>
               </div>

               <div class="modal-footer">
                  <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="submit" value="Save" class="btn btn-primary waves-effect waves-light">Save</button>
              </div>
            </form>
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
    width: 100% !important;
   }
</style>
 @endsection