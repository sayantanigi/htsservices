@extends('layouts.admin-dashboard')
@section('title', 'Dashboard')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Dashboard</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row h-100">
                            <div class="col-md-6 col-xl-3">
                                <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="font-size-15 text-uppercase mb-0">Total Carriers</h5>
                                            <div class="avatar-xs">
                                                <span
                                                    class="avatar-title rounded bg-soft-primary font-size-20 mini-stat-icon">
                                                    <i class="ri-exchange-line text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h3 class="font-size-24">0</h3>
                                        <p class="text-muted mb-0">View all</p>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
                            <div class="col-md-6 col-xl-3">
                                <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="font-size-15 text-uppercase mb-0">Total Customers</h5>
                                            <div class="avatar-xs">
                                                <span
                                                    class="avatar-title rounded bg-soft-warning font-size-20 mini-stat-icon">
                                                    <i class="ri-group-line text-warning"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h3 class="font-size-24">0</h3>
                                        <p class="text-muted mb-0">View all</p>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col-->
                            <div class="col-xl-3">
                                <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="font-size-15 text-uppercase mb-0">Total Employees</h5>
                                            <div class="avatar-xs">
                                                <span
                                                    class="avatar-title rounded bg-soft-danger font-size-20 mini-stat-icon">
                                                    <i class="ri-group-line text-danger"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h3 class="font-size-24">0</h3>
                                        <p class="text-muted mb-0">View All</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3">
                                <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="font-size-15 text-uppercase mb-0">Total Consignments</h5>
                                            <div class="avatar-xs">
                                                <span
                                                    class="avatar-title rounded bg-soft-success font-size-20 mini-stat-icon">
                                                    <i class="ri-exchange-fill text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h3 class="font-size-24">0</h3>
                                        <p class="text-muted mb-0">View all</p>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row-->
            </div>
        </div>
        <!-- End Page-content -->
    @endsection
