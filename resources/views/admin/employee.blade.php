@extends('layouts.admin-dashboard')
@section('title', 'User List')

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

            <div class="">
               <table id="dataTable" class="table dt-responsive nowrap w-100">
                  <thead>
                     <tr>
                        <th width="10">#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Mobile Phone</th>
                        <th width="100">Email</th>
                        <th>Fax</th>
                        <th>Website</th>
                        <th width="40">Status</th>
                        <th width="90">Actions</th>
                     </tr>
                  </thead>


                  <tbody>
                     @if(!$data['list']->isEmpty())
                        @foreach($data['list'] as $key=>$row)
                       
                           <tr>
                              <td>{{ $key+1 }}</td>
                              {{-- <td>
                                 @if(@$row->profile_image && file_exists( 'public/uploads/users/'.@$row->profile_image))
                                    <img id="output_image" src="{{asset('/uploads/users/'.@$row->profile_image)}}" alt="profile_image">
                                 @else
                                    <img id="output_image" src="{{ asset('/images/small.jpg') }}" alt="Header Avatar">
                                 @endif
                              </td> --}}
                              <td>
                                 @if (@$row->name)
                                       {{ $row->name }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>
                              <td>
                                 @if (@$row->phone)
                                       {{ $row->phone }}
                                 @else
                                       &#8212;
                                 @endif
                              </td>
                              <td>
                                 @if (@$row->phone)
                                       {{ $row->phone }}
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
                                    <input type="checkbox" id="square-switch{{ @$row->id }}" value="{{ @$row->status }}" switch="info" {{ (@$row->status == 1)? 'checked="checked"' : '' }} onchange="changeUserStatus({{ @$row->id }}, $(this))" />
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
                                 {{-- <a href="{{ route('viewUser', ['id' => $row->id]) }}" class="btn btn-sm btn-warning"><i class="far fa-eye"></i></a> --}}
                                 <a href="{{ route('viewEmployee', ['id' => $row->id]) }}" class="btn btn-sm btn-warning"><i class="far fa-eye"></i></a>
                                 <a href="{{ route('editEmployee', ['id' => $row->id]) }}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                 <button class="btn btn-sm btn-danger" onclick="deleteUser({{@$row->id}})"><i class="fas fa-trash-alt"></i></button>
                              </td>
                           </tr>
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
<style>
   #output_image {
      height: 67px;
      width: 67px;
      padding: 2px;
      border: 1px solid #c01e2f;
   }
</style>
 @endsection