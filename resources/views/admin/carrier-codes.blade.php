@extends('layouts.admin-dashboard')
@section('title', 'Carrier Code List')

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
                        <th width="50">Carrier Type</th>
                        <th width="70">Code</th>
                        <th width="250">Description</th>
                        <th width="40">Status</th>
                        <th width="60">Actions</th>
                     </tr>
                  </thead>


                  <tbody>
                     @if(!$data['list']->isEmpty())
                        @foreach($data['list'] as $key=>$row)
                       
                           <tr>
                              <td>{{ $key+1 }}</td>
                              <td>
                                 @if (@$row->typename)
                                       {{ $row->typename }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 @if (@$row->carrier_code)
                                       {{ $row->carrier_code }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td style="white-space: inherit;">
                                 @if (@$row->carrier_description)
                                       {{ $row->carrier_description }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 <div class="square-switch">
                                    <input type="checkbox" id="square-switch{{ @$row->id }}" value="{{ @$row->status }}" switch="info" {{ (@$row->status == 1)? 'checked="checked"' : '' }} onchange="changeCodeStatus({{ @$row->id }}, $(this))" />
                                    <label for="square-switch{{ @$row->id }}" data-on-label="Yes" data-off-label="No"></label>
                                 </div>
                             </td>
                              {{-- <td>
                                 @if (@$row->created_at)
                                       {{ date("jS M, Y", strtotime($row->created_at)) }}<br>
                                 @else
                                       &#8212;
                                 @endif
                              </td> --}}
                              <td>
                                 <a href="javascript:void(0);" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ @$row->id }}"><i class="far fa-edit"></i></a>
                                 <button class="btn btn-sm btn-danger" onclick="deleteCarrierCode({{ @$row->id }})"><i class="fas fa-trash-alt"></i></button>
                              </td>
                           </tr>

                           <div class="modal fade" id="staticBackdrop{{@$row->id}}" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="staticBackdropLabel">Edit for {{ $row->carrier_code }}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                       <form action="{{ route('updateCarrierCode') }}" method="post" enctype="multipart/form-data" id="formValidated">
                                          @csrf
                                          <input type="hidden" name="code_id" id="code_id" value="{{ $row->id }}">

                                          <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Carrier Type:</label>
                                                   <select class="form-control form-select select2" required name="carrier_type_edt" id="carrier_type_edt_{{ $row->id }}">
                                                      <option value="">Choose...</option>
                                                      <option value="1" {{ '1' == @$row->carrier_type ? 'selected' : '' }}>Air Carrier</option>
                                                      <option value="2" {{ '2' == @$row->carrier_type ? 'selected' : '' }}>Ocean Carrier</option>
                                                      <option value="3" {{ '3' == @$row->carrier_type ? 'selected' : '' }}>Land Carrier</option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                           
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Code:</label>
                                                   <input type="text"  value="{{ $row->carrier_code }}" required class="form-control" name="carrier_code_edt" id="carrier_code_edt">
                                                </div>
                                             </div>
                                          </div>
                           
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Description:</label>
                                                   <textarea name="carrier_description_edt" class="form-control" required id="carrier_description_edt" rows="5">{{ $row->carrier_description }}</textarea>
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
               <h5 class="modal-title" id="staticBackdropLabel">Add new code</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
            <form action="{{ route('createCarrierCode') }}" method="post" enctype="multipart/form-data" id="validateForm">
               @csrf

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Carrier Type:</label>
                        <select class="form-control form-select select2" name="carrier_type">
                           <option value="">Choose...</option>
                           <option value="1">Air Carrier</option>
                           <option value="2">Ocean Carrier</option>
                           <option value="3">Land Carrier</option>
                        </select>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Code:</label>
                        <input type="text"  value="" class="form-control" name="carrier_code" id="carrier_code">
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Description:</label>
                        <textarea name="carrier_description" class="form-control" id="carrier_description" rows="5"></textarea>
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