@extends('layouts.admin-dashboard')
@section('title', 'Payment Terms List')

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
                        <th width="250">Description</th>
                        <th width="70">Due Days</th>
                        <th width="70">Discount pe...</th>
                        <th width="70">Discount Days</th>
                        <th width="40">Status</th>
                        <th width="60">Actions</th>
                     </tr>
                  </thead>


                  <tbody>
                     @if(!$data['list']->isEmpty())
                        @foreach($data['list'] as $key=>$row)
                       
                           <tr>
                              <td>{{ $loop->iteration }}</td>

                              <td style="white-space: inherit;">
                                 @if (@$row->description)
                                       {{ $row->description }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 @if (@$row->due_days)
                                       {{ $row->due_days }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 @if (@$row->discount_pe)
                                       {{ $row->discount_pe }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 @if (@$row->discount_days)
                                       {{ $row->discount_days }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 {{ (@$row->status == 1)? 'Yes' : 'No' }}
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
                                 <button class="btn btn-sm btn-danger" onclick="deletePmtTerms({{ @$row->id }})"><i class="fas fa-trash-alt"></i></button>
                              </td>
                           </tr>

                           <div class="modal fade" id="staticBackdrop{{@$row->id}}" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="staticBackdropLabel">Edit for {{ $row->description }}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                       <form action="{{ route('updatePmtTerms') }}" method="post" enctype="multipart/form-data" id="formValidated">
                                          @csrf
                                          <input type="hidden" name="code_id" id="code_id" value="{{ $row->id }}">
                           
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Due Days:</label>
                                                   <input type="text"  value="{{ $row->due_days }}" required class="form-control" name="due_days_edt" id="due_days">
                                                </div>
                                             </div>
                                          </div>
                           
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Discount Pe...</label>
                                                   <input type="text"  value="{{ $row->discount_pe }}" required class="form-control" name="discount_pe_edt" id="discount_pe">
                                                </div>
                                             </div>
                                          </div>
                           
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Discount Days</label>
                                                   <input type="text"  value="{{ $row->discount_days }}" class="form-control" name="discount_days_edt" id="discount_days">
                                                </div>
                                             </div>
                                          </div>
                           
                                          <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Description:</label>
                                                   <textarea name="description_edt" class="form-control" required id="description_edt" rows="5">{{ $row->description }}</textarea>
                                                </div>
                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Status</label>
                                                   <select name="status" id="" class="form-control select2">
                                                      <option value="1" {{ @$row->status == '1' ? 'selected' : '' }}>Yes</option>
                                                      <option value="0" {{ @$row->status == '0' ? 'selected' : '' }}>No</option>
                                                   </select>
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
               <h5 class="modal-title" id="staticBackdropLabel">Add new Payment Terms</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
            <form action="{{ route('createPmtTerms') }}" method="post" enctype="multipart/form-data" id="validateForm">
               @csrf

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Due Days:</label>
                        <input type="text"  value="" class="form-control" name="due_days" id="due_days">
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Discount Pe...</label>
                        <input type="text"  value="" class="form-control" name="discount_pe" id="discount_pe">
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Discount Days</label>
                        <input type="text"  value="" class="form-control" name="discount_days" id="discount_days">
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Description:</label>
                        <textarea name="description" class="form-control" id="description" rows="5"></textarea>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Status</label>
                        <select name="status" id="" class="form-control select2">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
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