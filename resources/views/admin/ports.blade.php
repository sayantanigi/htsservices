@extends('layouts.admin-dashboard')
@section('title', 'Ports List')

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
                        <th width="50">Code</th>
                        <th width="130">Name</th>
                        <th width="130">Method</th>
                        <th width="130">Countries</th>
                        <th width="130">Subdivision</th>
                        <th width="40">Used</th>
                        <th width="60">Actions</th>
                     </tr>
                  </thead>


                  <tbody>
                     @if(!$data['list']->isEmpty())
                        @foreach($data['list'] as $key=>$row)
                       
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                                 @if (@$row->port_id)
                                       {{ $row->port_id }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 @if (@$row->name)
                                       {{ $row->name }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 @if (!empty(@$row->transportation_method))
                                    @php
                                        $methodArr = explode(",", @$row->transportation_method);
                                        echo $methodValue = implode(" ", @$methodArr);
                                    @endphp
                                       
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 @if (@$row->country_id)
                                       {{ @$row->country_name }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 @if (@$row->subdivision)
                                       {{ $row->subdivision }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 @if (@$row->used_by_company=="1")
                                       <span class="text-success">Yes</span>
                                 @else
                                       <span class="text-danger">No</span>
                                 @endif
                              </td>

                              <td>
                                 <a href="javascript:void(0);" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ @$row->id }}"><i class="far fa-edit"></i></a>
                                 <button class="btn btn-sm btn-danger" onclick="deletePort({{ @$row->id }})"><i class="fas fa-trash-alt"></i></button>
                              </td>
                           </tr>

                           <div class="modal fade" id="staticBackdrop{{@$row->id}}" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="staticBackdropLabel">Edit for {{ $row->name }}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                       <form action="{{ route('updatePort') }}" method="post" enctype="multipart/form-data" id="formValidated">
                                          @csrf
                                          <input type="hidden" name="port_id" id="port_id" value="{{ $row->id }}">
                                          <input type="hidden"  value="{{ $row->id }}" name="type_id">
                                          <div class="row">

                                             <div class="col-lg-10">
                                                <div class="form-group mb-3">
                                                   <label>Country<code>*</code></label>
                                                   <select class="form-select select2" required aria-label="Default select example"
                                                       name="port_country_edt" id="port_country_edt_{{ $row->id }}">
                                                       <option value="" selected="">Select Country...</option>
                                                       @if (!$data['countries']->isEmpty())
                                                           @foreach ($data['countries'] as $key => $item_val)
                                                               <option value="{{ @$item_val->id }}"
                                                                   {{ @$item_val->id == @$row->country_id ? 'selected' : '' }}>
                                                                   {{ @$item_val->name }}</option>
                                                           @endforeach
                                                       @endif
                                                   </select>
                                               </div>
                                             </div>
                                             
                           
                                             <div class="col-lg-5">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Port ID<code>*</code></label>
                                                   <input type="text"  value="{{ @$row->port_id }}" required class="form-control" required name="port_id_edt" id="port_id">
                                                </div>
                                             </div>

                                             <div class="col-lg-10">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Port Name<code>*</code></label>
                                                   <input type="text"  value="{{ @$row->name }}" class="form-control" required="" name="port_name_edt" id="port_name_edt">
                                                </div>
                                             </div>

                                             <div class="col-lg-10">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Subdivision</label>
                                                   <input type="text"  value="{{ @$row->subdivision }}" class="form-control" name="subdivision_edt" id="subdivision_edt">
                                                </div>
                                             </div>
                           
                                             <div class="col-lg-10">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Remarks</label>
                                                   <input type="text"  value="{{ @$row->remarks }}" class="form-control" name="remarks_edt" id="remarks_edt">
                                                </div>
                                             </div>
                           
                                             <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Transportation Method</label>
                                                   <div class="row">
                                                      <div class="col-lg-5">
                                                         <div class="form-check">
                                                           <input class="form-check-input" type="checkbox" {{ in_array('Ocean', $methodArr) ? 'checked' : '' }} name="transportation_method_edt[]" value="Ocean" id="Ocean">
                                                           <label class="form-check-label" for="Ocean">
                                                             Maritime
                                                           </label>
                                                         </div>
                                                     </div>
                             
                                                     <div class="col-lg-5">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" {{ in_array('Air', $methodArr) ? 'checked' : '' }} name="transportation_method_edt[]" value="Air" id="Air">
                                                          <label class="form-check-label" for="Air">
                                                            Air
                                                          </label>
                                                        </div>
                                                    </div>
                                                   </div>
                           
                                                   <div class="row">
                                                      <div class="col-lg-5">
                                                         <div class="form-check">
                                                           <input class="form-check-input" type="checkbox" {{ in_array('Rail', $methodArr) ? 'checked' : '' }} name="transportation_method_edt[]" value="Rail" id="Rail">
                                                           <label class="form-check-label" for="Rail">
                                                             Rail
                                                           </label>
                                                         </div>
                                                     </div>
                             
                                                     <div class="col-lg-5">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" {{ in_array('Mail', $methodArr) ? 'checked' : '' }} name="transportation_method_edt[]" value="Mail" id="Mail">
                                                          <label class="form-check-label" for="Mail">
                                                            Mail
                                                          </label>
                                                        </div>
                                                    </div>
                                                   </div>
                           
                                                   <div class="row">
                                                      <div class="col-lg-5">
                                                         <div class="form-check">
                                                           <input class="form-check-input" type="checkbox" {{ in_array('Road', $methodArr) ? 'checked' : '' }} name="transportation_method_edt[]" value="Road" id="Road">
                                                           <label class="form-check-label" for="Road">
                                                             Road
                                                           </label>
                                                         </div>
                                                     </div>
                             
                                                     <div class="col-lg-5">
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" {{ in_array('Bording Crossing Point', $methodArr) ? 'checked' : '' }} name="transportation_method_edt[]" value="Bording Crossing Point" id="Bording Crossing Point">
                                                          <label class="form-check-label" for="Bording Crossing Point">
                                                            Bording Crossing Point
                                                          </label>
                                                        </div>
                                                    </div>
                                                   </div>
                                                   
                                                </div>
                                             </div>
                           
                                             <div class="col-lg-10">
                                                <hr>
                                             </div>
                           
                                             <div class="col-lg-10">
                                                <div class="form-group mb-3">
                                                   <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" name="used_by_company_edt" {{ '1' == @$row->used_by_company ? 'checked' : '' }} value="1" id="used_by_company">
                                                      <label class="form-check-label" for="used_by_company">
                                                        This port is used by my company
                                                      </label>
                                                    </div>
                                                </div>
                                             </div>
                           
                                             <div class="col-lg-10">
                                                <div class="form-group mb-3">
                                                   <label class="fw-bold font-size-13">Notes</label>
                                                   <textarea class="form-control" name="notes_edt">{{ @$row->notes }}</textarea>
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

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Add new port</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
            <form action="{{ route('createPort') }}" method="post" enctype="multipart/form-data" id="loginForm">
               @csrf

               <div class="row">
                  <div class="col-lg-10">
                     <div class="form-group mb-3">
                        <label>Country<code>*</code></label>
                        <select class="form-select select2" aria-label="Default select example"
                            name="port_country" id="port_country">
                            <option value="" selected="">Select Country...</option>
                            @if (!$data['countries']->isEmpty())
                                @foreach ($data['countries'] as $key => $item_val)
                                    <option value="{{ @$item_val->id }}"
                                        {{ @$item_val->id == @$data['carrierData']->country ? 'selected' : '' }}>
                                        {{ @$item_val->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                  </div>
                  

                  <div class="col-lg-5">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Port ID<code>*</code></label>
                        <input type="text"  value="" class="form-control" name="port_id" id="port_id">
                     </div>
                  </div>

                  <div class="col-lg-10">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Port Name<code>*</code></label>
                        <input type="text"  value="" class="form-control" name="port_name" id="port_name">
                     </div>
                  </div>

                  <div class="col-lg-10">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Subdivision</label>
                        <input type="text"  value="" class="form-control" name="subdivision" id="subdivision">
                     </div>
                  </div>

                  <div class="col-lg-10">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Remarks</label>
                        <input type="text"  value="" class="form-control" name="remarks" id="remarks">
                     </div>
                  </div>

                  <div class="col-lg-12">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Transportation Method</label>
                        <div class="row">
                           <div class="col-lg-5">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transportation_method[]" value="Ocean" id="Ocean">
                                <label class="form-check-label" for="Ocean">
                                  Maritime
                                </label>
                              </div>
                          </div>
  
                          <div class="col-lg-5">
                             <div class="form-check">
                               <input class="form-check-input" type="checkbox" name="transportation_method[]" value="Air" id="Air">
                               <label class="form-check-label" for="Air">
                                 Air
                               </label>
                             </div>
                         </div>
                        </div>

                        <div class="row">
                           <div class="col-lg-5">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transportation_method[]" value="Rail" id="Rail">
                                <label class="form-check-label" for="Rail">
                                  Rail
                                </label>
                              </div>
                          </div>
  
                          <div class="col-lg-5">
                             <div class="form-check">
                               <input class="form-check-input" type="checkbox" name="transportation_method[]" value="Mail" id="Mail">
                               <label class="form-check-label" for="Mail">
                                 Mail
                               </label>
                             </div>
                         </div>
                        </div>

                        <div class="row">
                           <div class="col-lg-5">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="transportation_method[]" value="Road" id="Road">
                                <label class="form-check-label" for="Road">
                                  Road
                                </label>
                              </div>
                          </div>
  
                          <div class="col-lg-5">
                             <div class="form-check">
                               <input class="form-check-input" type="checkbox" name="transportation_method[]" value="Bording Crossing Point" id="Bording Crossing Point">
                               <label class="form-check-label" for="Bording Crossing Point">
                                 Bording Crossing Point
                               </label>
                             </div>
                         </div>
                        </div>
                        
                     </div>
                  </div>

                  <div class="col-lg-10">
                     <hr>
                  </div>

                  <div class="col-lg-10">
                     <div class="form-group mb-3">
                        <div class="form-check">
                           <input class="form-check-input" type="checkbox" name="used_by_company" checked value="1" id="used_by_company">
                           <label class="form-check-label" for="used_by_company">
                             This port is used by my company
                           </label>
                         </div>
                     </div>
                  </div>

                  <div class="col-lg-10">
                     <div class="form-group mb-3">
                        <label class="fw-bold font-size-13">Notes</label>
                        <textarea class="form-control" name="notes"></textarea>
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