@extends('layouts.admin-dashboard')
@section('title', @$title)

@section('content')

<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <!-- start page title -->
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0">{{$title}}</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
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
               <form action="{{ route('salespersons') }}" class="custom-validation" method="post" id="formValidatedOtherAddress">
                  @csrf
                  <div class="row justify-content-center">
                        <div class="col-lg-6 mb-4">
                           <div class="searchwithdrop row bg-light py-3 px-2">
                               
                                 <div class="col-md-10 form-group">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search here" value="{{ @$keyword }}">
                                 </div>
                                 <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" name="submit" value="search"><i class="fa fa-search"></i> Search</button>
                                 </div>
                           </div>
                        </div>
                  </div>
               </form>
               <table id="dataTableNew" class="table dt-responsive nowrap w-100">
                  <thead>
                     <tr>
                        <th width="10">#</th>
                        <th>Name</th>                       
                        <th>Phone</th>
                        <th>Mobile Phone</th>
                        <th>Email</th>
                        <th>Fax</th>
                        <th>Website</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                     </tr>
                  </thead>


                  <tbody>
                    @if(!$list->isEmpty())                                
                        @foreach($list as $key=>$row)
                           @php
                              $state = DB::table('states')->where('id', $row->state)->select('name')->first();
                              $country = DB::table('countries')->where('id', $row->country)->select('name')->first();
                           @endphp                       
                           <tr>
                              <td>{{ $loop->iteration }}. </td>
                              <td>
                                 @if (@$row->name)
                                       {{ $row->name }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>
                            
                              
                              <td>
                                 @if (@$row->phone)
                                       {{ @$row->phone_1." ".@$row->phone }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>
                              <td>
                                 @if (@$row->mobile_phone)
                                       {{ @$row->mobile_phone }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>
                              <td>
                                 @if (@$row->email)
                                       {{ $row->email }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>
                              <td>
                                 @if (@$row->fax)
                                       {{ $row->fax }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>
                              <td>
                                 @if (@$row->website)
                                       {{ $row->website }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>

                              <td>
                                 <div class="square-switch">
                                    <input type="checkbox" id="square-switch{{ @$row->id }}" value="{{ @$row->status }}" switch="info" {{ (@$row->status == 1)? 'checked="checked"' : '' }} onchange="changeHtsUserStatus({{ @$row->id }}, $(this))" />
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
                                 <a href="{{ route('viewAgent', ['id' => $row->id]) }}" class="btn btn-sm btn-warning"><i class="far fa-eye"></i></a>
                                 <a href="{{ route('editAgent', ['id' => $row->id]) }}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                 <button data-toggle="tooltip" title="Delete User" class="btn btn-sm btn-danger" onclick="deleteHtsUsers({{ @$row->id }}, 'salespersons')"><i class="fas fa-trash-alt"></i></button>
                              </td>
                           </tr>

                        @endforeach
                    @else
                      <tr><td colspan="10" class="text-danger">No Data was found.</td></tr>
                    @endif
                  </tbody>
                  
               </table>
               
               <div class="pagination">
                  {!! $list->links() !!}
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
    width: 100% !important;
   }

   /* Style the pagination container */
   .pagination {
      display: flex;
      justify-content: center;
      list-style: none;
   }

   .pagination a {
      margin: 0 4px; /* 0 is for top and bottom. Feel free to change it */
   }

   .page-item.active .page-link{
      background-color: #6c6ff5;
      border-color: #6c6ff5;
   }
</style>
 @endsection