<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HTS Services, Inc. | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('/admin-assets/images/favicon.png') }}" type="image/x-icon" />
    <link href="{{ asset('/admin-assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/admin-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/admin-assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('/admin-assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/admin-assets/libs/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('/admin-assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />


    <style>
        .select2-hidden-accessible {
            border: 0 !important;
            clip: rect(0 0 0 0) !important;
            height: 1px !important;
            margin: -1px !important;
            overflow: hidden !important;
            padding: 0 !important;
            position: absolute !important;
            width: 1px !important
        }

        .select2-container--default .select2-selection--single,
        .select2-selection .select2-selection--single {
            border: 1px solid #d2d6de;
            border-radius: 0;
            padding: 6px 12px;
            height: 34px
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 28px;
            user-select: none;
            -webkit-user-select: none
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-right: 10px
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0;
            padding-right: 0;
            height: auto;
            margin-top: -3px
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #8ca3bd;
            line-height: 28px
        }

        .select2-container--default .select2-selection--single,
        .select2-selection .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: .25rem;
            padding: 6px 12px;
            height: 38px !important
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 6px !important;
            right: 1px;
            width: 20px
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #495057;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #5897fb;
            color: white;
        }

        .select2-container--default .select2-results>.select2-results__options {
            max-height: auto !important;
            overflow-y: auto;
        }
    </style>

</head>

<body data-topbar="dark">
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <i class="ri-loader-line spin-icon"></i>
            </div>
        </div>
    </div>
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ route('admin-dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('/admin-assets/images/logo.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('/admin-assets/images/logo.png') }}" alt="" height="20">
                            </span>
                        </a>
                        <a href="{{ route('admin-dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('/admin-assets/images/logo.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('/admin-assets/images/logo.png') }}" alt="" height="20">
                            </span>
                        </a>
                    </div>
                    <button type="button"
                        class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                </div>
                <div class="d-flex">
                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            data-bs-toggle="fullscreen">
                            <i class="ri-fullscreen-line"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block user-dropdown group-dp">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            @if (Auth::user()->profile_image && file_exists('public/uploads/users/' . @Auth::user()->profile_image))
                                <img class="rounded-circle header-profile-user"
                                    src="{{ asset('/uploads/users/' . Auth::user()->profile_image) }}" alt="profile_image"
                                    style="padding: 0;">
                            @else
                                <img class="rounded-circle header-profile-user"
                                    src="{{ asset('/admin-assets/images/avtar-image.jpg') }}" alt="Header Avatar"
                                    style="padding: 0;">
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0">Hi,
                                            @if (Auth::user()->name)
                                                {{ Auth::user()->name }}
                                            @else
                                                Administrator
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                <!-- item-->

                                <!-- item-->
                                <a href="{{ route('ad-profile') }}" class="text-reset notification-item">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-3 mt-1">
                                            <span class="avatar-title bg-soft-primary rounded-circle font-size-16">
                                                <i class="ri-settings-2-line text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 text-truncate">
                                            <h6 class="mb-1">Settings</h6>
                                            <p class="mb-0 font-size-12">Manage your account.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- item-->
                            <div class="pt-2 border-top">
                                <div class="d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center"
                                        href="{{ route('adminlogout') }}">
                                        <i class="ri-shut-down-line align-middle me-1"></i> Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('admin-dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('/admin-assets/images/favicon.png') }}" alt="" height="37"
                            style="height: 37px;">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/admin-assets/images/logo.png') }}" alt="" height="50"
                            style="height: 50px;">
                    </span>
                </a>
                <a href="{{ route('admin-dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('/admin-assets/images/favicon.png') }}" alt="" style="margin-left:-10px;">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/admin-assets/images/logo.png') }}" alt="" style="height:22px;">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <div data-simplebar class="sidebar-menu-scroll">
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li><a href="{{ route('admin-dashboard') }}" class="waves-effect"><i class="fas fa-home"></i>
                                Dashboard</a></li>

                        <li class="{{ @$data['page'] == 'lists' ? 'mm-active' : '' }}">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-database-fill"></i>
                                <span>Master Data Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('identification-types') }}"
                                        class="{{ @$data['subpage'] == 'types' ? 'active' : '' }}">List of
                                        Identification Types</a></li>

                                <li><a href="{{ route('divisons') }}"
                                        class="{{ @$data['subpage'] == 'divisons' ? 'active' : '' }}">List of
                                        Divisons</a></li>

                                <li><a href="{{ route('carrier-codes') }}"
                                        class="{{ @$data['subpage'] == 'codes' ? 'active' : '' }}">List of
                                        Carrier Codes</a></li>

                                <li><a href="{{ route('flights') }}"
                                        class="{{ @$data['subpage'] == 'flight' ? 'active' : '' }}">List of
                                        Flights</a></li>

                                <li><a href="{{ route('transportation') }}"
                                        class="{{ @$data['subpage'] == 'transportation' ? 'active' : '' }}">List of
                                        Transportation</a></li>

                                <li><a href="{{ route('freight-service-class') }}"
                                        class="{{ @$data['subpage'] == 'service_class' ? 'active' : '' }}">List of
                                        Freight Service Class</a></li>

                                <li><a href="{{ route('frequency') }}"
                                        class="{{ @$data['subpage'] == 'frequency' ? 'active' : '' }}">List of
                                        Frequency</a></li>

                                <li><a href="{{ route('commodity') }}"
                                        class="{{ @$data['subpage'] == 'commodity' ? 'active' : '' }}">List of
                                        Commodity</a></li>

                                <li><a href="{{ route('custom-charge') }}"
                                        class="{{ @$data['subpage'] == 'charge' ? 'active' : '' }}">List of
                                        Custom Charge</a></li>

                                <li><a href="{{ route('participation') }}"
                                        class="{{ @$data['subpage'] == 'participation' ? 'active' : '' }}">List of
                                        Participation</a></li>

                                <li><a href="{{ route('pmt-terms') }}"
                                        class="{{ @$data['subpage'] == 'pmtTerms' ? 'active' : '' }}">List of
                                        Payment Terms</a></li>

                            </ul>
                        </li>

                        <li class="{{ @$data['page'] == 'carrier' ? 'mm-active' : '' }}">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-community-fill"></i>
                                <span>Carriers Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('add-carrier', ['id' => 1]) }}"
                                        class="{{ @$data['subpage'] == 'aircarrier' ? 'active' : '' }}">Air
                                        Carrier</a></li>
                                <li><a href="{{ route('add-carrier', ['id' => 2]) }}"
                                        class="{{ @$data['subpage'] == 'oceancarrier' ? 'active' : '' }}">Ocean
                                        Carrier</a></li>
                                <li><a href="{{ route('add-carrier', ['id' => 3]) }}"
                                        class="{{ @$data['subpage'] == 'landcarrier' ? 'active' : '' }}">Land
                                        Carrier</a></li>
                                <li><a href="{{ route('carriers') }}"
                                        class="{{ @$data['subpage'] == 'carriers' ? 'active' : '' }}">List of all
                                        Carriers</a></li>
                            </ul>
                        </li>

                        <li class="{{ @$data['page'] == 'agent' ? 'mm-active' : '' }}">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-shield-user-line"></i>
                                <span>Forwarding Agents Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('add-agent', ['id' => 1]) }}"
                                        class="{{ @$data['subpage'] == 'add_agent' ? 'active' : '' }}">Add new
                                        Agent</a></li>
                                <li><a href="{{ route('agents') }}"
                                        class="{{ @$data['subpage'] == 'agents' ? 'active' : '' }}">List of Agents</a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ @$data['page'] == 'provider' ? 'mm-active' : '' }}">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-map-pin-user-line"></i>
                                <span>Warehouse Providers Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('add-provider', ['id' => 2]) }}"
                                        class="{{ @$data['subpage'] == 'add_provider' ? 'active' : '' }}">Add new
                                        Provider</a></li>
                                <li><a href="{{ route('providers') }}"
                                        class="{{ @$data['subpage'] == 'providers' ? 'active' : '' }}">List of
                                        Providers</a></li>
                            </ul>
                        </li>

                        <li class="{{ @$data['page'] == 'customer' ? 'mm-active' : '' }}">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-folder-user-line"></i>
                                <span>Customers Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('add-customer', ['id' => 3]) }}"
                                        class="{{ @$data['subpage'] == 'add_customer' ? 'active' : '' }}">Add new
                                        Customer</a></li>
                                <li><a href="{{ route('customers') }}"
                                        class="{{ @$data['subpage'] == 'customers' ? 'active' : '' }}">List of
                                        Customers</a></li>
                            </ul>
                        </li>

                        <li class="{{ @$data['page'] == 'vendor' ? 'mm-active' : '' }}">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-folder-user-fill"></i>
                                <span>Vendors Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('add-vendor', ['id' => 4]) }}"
                                        class="{{ @$data['subpage'] == 'add_vendor' ? 'active' : '' }}">Add new
                                        Vendor</a></li>
                                <li><a href="{{ route('vendors') }}"
                                        class="{{ @$data['subpage'] == 'vendors' ? 'active' : '' }}">List of
                                        Vendors</a></li>
                            </ul>
                        </li>

                        <li class="{{ @$data['page'] == 'salesperson' ? 'mm-active' : '' }}">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-user-2-line"></i>
                                <span>Salespersons Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('add-salesperson', ['id' => 5]) }}"
                                        class="{{ @$data['subpage'] == 'add_salesperson' ? 'active' : '' }}">Add new
                                        Salesperson</a></li>
                                <li><a href="{{ route('salespersons') }}"
                                        class="{{ @$data['subpage'] == 'salespersons' ? 'active' : '' }}">List of
                                        Salespersons</a></li>
                            </ul>
                        </li>


                        <li class="{{ @$data['page'] == 'contacts' ? 'mm-active' : '' }}">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-contacts-book-line"></i>
                                <span>Contacts Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('add-contact', ['id' => 6]) }}"
                                        class="{{ @$data['subpage'] == 'add_contact' ? 'active' : '' }}">Add new
                                        Contact</a></li>
                                <li><a href="{{ route('contacts') }}"
                                        class="{{ @$data['subpage'] == 'contacts' ? 'active' : '' }}">List of
                                        Contacts</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-user-line"></i>
                                <span>Employee Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('add-employee') }}">Add new Employee</a></li>
                                <li><a href="{{ route('employees') }}">List of Employee</a></li>
                            </ul>
                        </li>

                        <li class="{{ @$data['page'] == 'ports' ? 'mm-active' : '' }}">
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-ship-2-line"></i>
                                <span>Ports Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('ports') }}"
                                        class="{{ @$data['subpage'] == 'ports' ? 'active' : '' }}">List of
                                        Ports</a></li>
                            </ul>
                        </li>



                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-image-fill"></i>
                                <span>Banner Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript:void(0);">List of banners</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-quill-pen-fill"></i>
                                <span>Blog Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript:void(0);">List of blogs</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="ri-file-list-fill"></i>
                                <span>Content Mgmt</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript:void(0);">List of pages</a></li>
                            </ul>
                        </li> --}}

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa fa-cog"></i>
                                <span>Settings</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('site_settings') }}">Site Settings</a></li>
                                <li><a href="{{ route('ad-profile') }}">Admin Profile</a></li>
                                <li><a href="{{ route('adminlogout') }}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        @yield('content')

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-sm-end d-sm-block">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> HTS Services, Inc. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    </div>
    <!-- END layout-wrapper -->

    <!-- /Right-bar -->
    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <style>
        table {
            table-layout: fixed;
        }

        td {
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('/admin-assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
    </script>
    <script
        src="{{ asset('/admin-assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
        </script>
    <script src="{{ asset('/admin-assets/js/pages/dashboard.init.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('/admin-assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('/admin-assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('/admin-assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('/admin-assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('/admin-assets/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('/admin-assets/js/app.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"
        type="text/javascript"></script>

    <!-- twitter-bootstrap-wizard js -->
    {{--
    <script src="{{ asset('/admin-assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    --}}

    <script src="{{ asset('/admin-assets/libs/twitter-bootstrap-wizard/prettify.js') }}"></script>

    <script src="{{ asset('/admin-assets/libs/dropzone/min/dropzone.min.js') }}"></script>

    <script type="text/javascript">
        Dropzone.options.formValidatedConCarrierGallery = {
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.txt,.docx,.doc,.xlsx,.xl,.csv",
            success: function (file, response) {
                console.log(response);
                getImages();
            },
            error: function (file, response) {
                return false;
            }
        };

        function getImages(listing_id) {

            $.ajax({
                url: "{{ url('/getimages') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function () { },
                success: function (response) {
                    $("#conHTML").html(response);
                }
            });
        }

        // For carrier
        Dropzone.options.formValidatedCarrierGallery = {
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.txt,.docx,.doc,.xlsx,.xl,.csv",
            success: function (file, responseC) {
                console.log(responseC);
                getCarrierImages();
            },
            error: function (file, response) {
                return false;
            }
        };

        function getCarrierImages(listing_id) {

            $.ajax({
                url: "{{ url('/getcarrierimages') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function () { },
                success: function (response) {
                    $("#conHTMLForCarrier").html(response);
                }
            });
        }

        // For employee
        Dropzone.options.formValidatedEmployeeGallery = {
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.txt,.docx,.doc,.xlsx,.xl,.csv",
            success: function (file, responseCE) {
                console.log(responseCE);
                getEmployeeImages();
            },
            error: function (file, response) {
                return false;
            }
        };

        // For employee Edit
        Dropzone.options.formValidatedEmployeeGalleryEdt = {
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.txt,.docx,.doc,.xlsx,.xl,.csv",
            success: function (file, responseCE) {
                console.log(responseCE);
                getEmployeeImagesEdt();
            },
            error: function (file, response) {
                return false;
            }
        };

        function getEmployeeImages() {

            $.ajax({
                url: "{{ url('/getemployeeimages') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function () { },
                success: function (responseE) {
                    $("#hTMLForEmployee").html(responseE);
                }
            });
        }

        function getEmployeeImagesEdt() {
            var empid = $("#usrId").val();

            $.ajax({
                url: "{{ url('/getemployeeimagesEdt') }}" + '/' + empid,
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function () { },
                success: function (responseE) {
                    $("#hTMLForEmployee").html(responseE);
                }
            });
        }

        // For Gallery edit
        Dropzone.options.formValidatedConCarrierGalleryEdt = {
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.txt,.docx,.doc,.xlsx,.xl,.csv",
            success: function (file, response) {
                console.log(response);
                getImagesEdt();
            },
            error: function (file, response) {
                return false;
            }
        };

        function getImagesEdt() {
            var carrier_id = $('#carrier_id_edt').val();
            $.ajax({
                url: "{{ url('/getimagesedt') }}",
                type: "POST",
                data: {
                    carrier_id: carrier_id,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function () { },
                success: function (response) {
                    $("#conHTML").html(response);
                }
            });
        }

        // For carrier gallery Edt
        Dropzone.options.formValidatedCarrierGalleryEdt = {
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.txt,.docx,.doc,.xlsx,.xl,.csv",
            success: function (file, responseC) {
                console.log(responseC);
                getCarrierImagesEdt();
            },
            error: function (file, response) {
                return false;
            }
        };

        function getCarrierImagesEdt() {

            var carrier_id = $('#attach_carrier_id').val();

            $.ajax({
                url: "{{ url('/getcarrierimagesedt') }}",
                type: "POST",
                data: {
                    carrier_id: carrier_id,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function () { },
                success: function (response) {
                    $("#conHTMLForCarrier").html(response);
                }
            });
        }

        // For all others users contact gallery
        Dropzone.options.formValidatedConHtsGallery = {
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.txt,.docx,.doc,.xlsx,.xl,.csv",
            success: function (file, response) {
                console.log(response);
                getImagesHts();
            },
            error: function (file, response) {
                return false;
            }
        };

        function getImagesHts() {

            $.ajax({
                url: "{{ url('/gethtsimages') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function () { },
                success: function (htsresponse) {
                    $("#conHtsHTML").html(htsresponse);
                }
            });
        }

        Dropzone.options.formValidatedHtsGallery = {
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.txt,.docx,.doc,.xlsx,.xl,.csv",
            success: function (file, response) {
                console.log(response);
                getImagesHtsGallery();
            },
            error: function (file, response) {
                return false;
            }
        };

        function getImagesHtsGallery() {

            $.ajax({
                url: "{{ url('/gethtsgalleryimages') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function () { },
                success: function (htsresponse) {
                    $("#htmlForHTS").html(htsresponse);
                }
            });
        }


        // var myDropzoneTheFirst = new Dropzone(
        //         //id of drop zone element 1
        //         '#formValidatedCarrierGallery', {
        //             url : "{{ route('upload-carrier-images') }}"
        //         }
        //     );

        // var myDropzoneTheSecond = new Dropzone(
        //         //id of drop zone element 2
        //         '#an-other-form-element', {
        //             url : "uploadUrl/2"
        //         }
        //     );

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        function deleteListingImage(id) {
            swal({
                title: 'Are You sure want to delete this file?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteGalleryImage') }}" + '/' + id
                }
            });
        }

        function deleteHtsListingImage(id) {
            swal({
                title: 'Are You sure want to delete this file?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteHtsGalleryImage') }}" + '/' + id
                }
            });
        }

        function deleteHtsMainListingImage(id) {
            swal({
                title: 'Are You sure want to delete this file?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteHtsMainGalleryImage') }}" + '/' + id
                }
            });
        }

        function deleteListingImageEdt(id) {
            swal({
                title: 'Are You sure want to delete this file?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteGalleryImageEdt') }}" + '/' + id
                }
            });
        }

        function deleteCarrierImage(id) {
            swal({
                title: 'Are You sure want to delete this file?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteCarrierGalleryImage') }}" + '/' + id
                }
            });
        }


        function deleteCarrierImageEdt(id) {
            swal({
                title: 'Are You sure want to delete this file?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteCarrierGalleryImageEdt') }}" + '/' + id
                }
            });
        }

        function deleteEmployeeImage(id) {
            swal({
                title: 'Are You sure want to delete this file?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteEmployeeGalleryImage') }}" + '/' + id
                }
            });
        }

        function deleteEmployeeImageEdt(id) {
            swal({
                title: 'Are You sure want to delete this file?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteEmployeeGalleryImageEdt/') }}" + '/' + id
                }
            });
        }
    </script>

    <!-- form wizard init -->
    {{--
    <script src="{{ asset('/admin-assets/js/pages/form-wizard.init.js') }}"></script> --}}
    <script src="https://cdn.tiny.cloud/1/x6x4f6m4vw9tmo4wqlhi62jlulv8qfgfna8fyt608rkd9dbu/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        var apn_1Masking = $('#apn_1').val();
        $('#apn_1').mask('000');
        $('#apn_1').val(apn_1Masking);

        var apn_2Masking = $('#apn_2').val();
        $('#apn_2').mask('0000');
        $('#apn_2').val(apn_2Masking);

        var apn_3Masking = $('#apn_3').val();
        $('#apn_3').mask('000');
        $('#apn_3').val(apn_3Masking);

        var apn_4Masking = $('#apn_4').val();
        $('#apn_4').mask('0000');
        $('#apn_4').val(apn_4Masking);
    </script>

    <script>
        $(document).ready(function () {

            // $("#basic-pills-wizard").bootstrapWizard({
            //         tabClass: "nav nav-pills nav-justified"
            // }),
            // $("#progrss-wizard").bootstrapWizard({
            //     onTabShow: function(tab, navigation, index) {
            //         var t = ((index + 1) / navigation.find("li").length) * 100;
            //         $("#progrss-wizard")
            //             .find(".progress-bar")
            //             .css({
            //                 width: t + "%"
            //             });

            //         var $total = navigation.find('li').length;
            //         var $current = index + 1;

            //         var $wizard = navigation.closest('.wizard-card');

            //         @if (Session::get('listing_step') == '1')

                //             $($wizard).find('.steptb1').addClass('active');
                //             $($wizard).find('.steptb2').removeClass('active');
                //             $($wizard).find('.steptb3').removeClass('active');

                //             $($wizard).find('.step1').show();
                //             $($wizard).find('.step2').hide();
                //             $($wizard).find('.step3').hide();
            //         @elseif (Session::get('listing_step') == '2')

                //             $($wizard).find('.steptb1').removeClass('active');
                //             $($wizard).find('.steptb2').addClass('active');
                //             $($wizard).find('.steptb3').removeClass('active');

                //             $($wizard).find('.step1').hide();
                //             $($wizard).find('.step2').show();
                //             $($wizard).find('.step3').hide();
            //         @elseif (Session::get('listing_step') == '3')

                //             $($wizard).find('.steptb1').removeClass('active');
                //             $($wizard).find('.steptb2').removeClass('active');
                //             $($wizard).find('.steptb3').addClass('active');

                //             $($wizard).find('.step1').hide();
                //             $($wizard).find('.step2').hide();
                //             $($wizard).find('.step3').show();
            //         @endif

            //         // If it's the last tab then hide the last button and show the finish instead
            //         // if($current >= $total) {
            //         //     $($wizard).find('.next').hide();
            //         //     $($wizard).find('.finish').show();
            //         // } else {
            //         //     $($wizard).find('.next').show();
            //         //     $($wizard).find('.finish').hide();
            //         // }
            //     },
            //     onTabClick: function(tab, navigation, index) {
            //         // alert('On Tab click is disabled');
            //         return false;
            //     },
            //     // onNext: function(tab, navigation, index) {
            //     //     return true;
            //     // },
            // });
        });


        // var triggerTabList = [].slice.call(document.querySelectorAll(".twitter-bs-wizard-nav .nav-link"));
        // triggerTabList.forEach(function (a) {
        //     var r = new bootstrap.Tab(a);
        //     a.addEventListener("click", function (a) {
        //         a.preventDefault(), r.show();
        //     });
        // });


        // this is the id of the form
        // $("#listingInformations1").submit(function(e) {

        //     e.preventDefault(); // avoid to execute the actual submit of the form.

        //     var form = $(this);
        //     var actionUrl = form.attr('action');

        //     var property_type = $('#property_type option:selected').val();
        //     var state_county = $('#state_county option:selected').val();
        //     var city_html = $('#city_html option:selected').val();

        //     var apn_number = $("#apn_number").val();
        //     var suffix = $('#suffix option:selected').val();
        //     var zipcode = $("#zipcode_1").val();
        //     var location = $("#location").val();

        //     if(property_type=="") {

        //         return false;
        //     }

        //     if(state_county=="") {

        //         return false;
        //     }

        //     if(city_html=="") {

        //         return false;
        //     }

        //     if(apn_number=="") {

        //         $("#error_apn_number").show();
        //         $("#error_apn_number").text("Please enter a apn number.");

        //         return false;
        //     }

        //     if(suffix=="") {

        //         $("#error-suffix").show();
        //         $("#error-suffix").text("Please choose suffix.");

        //         return false;
        //     }


        //     if(zipcode=="") {

        //         $("#error-zipcode_1").show();
        //         $("#error-zipcode_1").text("Please enter zipcode.");

        //         return false;
        //     }

        //     if(location=="") {

        //         $("#error-location").show();
        //         $("#error-location").text("Please enter a map address.");

        //         return false;
        //     }




        //     $.ajax({
        //         type: "POST",
        //         url: actionUrl,
        //         data: form.serialize(), // serializes the form's elements.
        //         success: function(data)
        //         {
        //             alert(data); // show response from the php script.
        //         }
        //     });

        // });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            var location = {
                latitude: '',
                longitude: ''
            };

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { }

            function showPosition(position) {
                location.latitude = position.coords.latitude;
                location.longitude = position.coords.longitude;
                var geocoder = new google.maps.Geocoder();
                var latLng = new google.maps.LatLng(location.latitude, location.longitude);

                @if (Session::has('listing_id'))
                @else
                    $('#search_lat').val(location.latitude);
                    $('#search_lon').val(location.longitude);

                    if (geocoder) {
                        geocoder.geocode({
                            'latLng': latLng
                        }, function (results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                // console.log(results);
                                $('#location').val(results[0].formatted_address);
                            } else {
                                $('#location').html('Geocoding failed: ' + status);
                                console.log("Geocoding failed: " + status);
                            }
                        });
                    }
                @endif
            }
        });


        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('location'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var mesg = "Address: " + address;
                mesg += "\nLatitude: " + latitude;
                mesg += "\nLongitude: " + longitude;
                $('#search_lat').val(latitude);

                $('#search_lon').val(longitude);

                var whole_address = place.address_components; //alert(whole_address + 'whole_address');
                console.log(whole_address);
                $('#ownCity').val('');
                $('#ownState').val('');
                $('#ownCountry').val('');
                $('#ownPinCode').val('');
                $('#ownLocality').val('');
                $('#neighborHood').val('');

                $.each(whole_address, function (key1, value1) {
                    if ((value1.types[0]) == 'locality') {
                        var prev_long_name_city = value1.long_name;
                        $('#ownCity').val(prev_long_name_city);
                    }

                    if ((value1.types[0]) == 'route') {
                        var prev_Route = value1.long_name;
                        $('#ownLocality').val(prev_Route);
                    }

                    if ((value1.types[0]) == 'sublocality_level_1') {
                        var prev_sublocality = value1.long_name;
                        $('#neighborHood').val(prev_sublocality);
                    }


                    if ((value1.types[0]) == 'administrative_area_level_1') {
                        var prev_long_name_state = value1.long_name;
                        $('#ownState').val(prev_long_name_state);
                    }

                    if ((value1.types[0]) == 'country') {
                        var prev_long_name_country = value1.long_name;
                        $('#ownCountry').val(prev_long_name_country);
                    }

                    if ((value1.types[0]) == 'postal_code') {
                        var prev_long_name_pincode = value1.long_name;
                        $('#ownPinCode').val(prev_long_name_pincode);
                    }

                });

            });

        });
    </script>

    <script>
        $(document).ready(function () {

            tinymce.init({
                selector: '#basic-example',
                height: 200,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | fontsizeselect ' +
                    'bold italic | backcolor forecolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                // content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
                content_style: 'body { font-family:"Work Sans",sans-serif; font-size:15px }'
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // $('#example').DataTable();
            $('#dataTable').DataTable({
                aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 100
                // iDisplayLength: -1
            });
        });
    </script>

    <script>
        function alert_func(data) {
            swal({
                title: data[0],
                type: data[1],
                confirmButtonColor: data[2]
            });
        }

        function confirm_yes(msg, ptype, okclose, btn, colors) {
            if (typeof btn === "undefined" || btn === null) {
                btn = ['Yes', 'No'];
            }
            if (typeof colors === "undefined" || colors === null) {
                colors = ['#A5DC86', '#DD6B55'];
            }
            if (typeof okclose === "undefined" || okclose === null) {
                okclose = false;
            } else {
                okclose = true;
            }
            swal({
                title: msg,
                type: ptype,
                showCancelButton: true,
                confirmButtonColor: colors[0],
                cancelButtonColor: colors[1],
                confirmButtonText: btn[0],
                cancelButtonText: btn[1],
                closeOnConfirm: okclose,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    return true;
                } else {
                    return false
                }
            });
        }
    </script>

    @if (Session::has('msg'))
        @if (Session::get('msg') == 'error')
            <script>
                alert_func(["Some error occured, Please try again!", "error", "#DD6B55"]);
            </script>
        @else
            <script>
                alert_func({{ Session::get('msg') }});
            </script>
        @endif
    @endif

    @if (Session::has('carrier_tab'))
        <script>
            // Get all tab panes by their class
            var navLinks = $('.nav-link');
            var tabPanes = $('.tab-pane');
            var nav = '_nav';

            // Remove the 'active' class from all tab panes
            navLinks.removeClass('active');
            tabPanes.removeClass('active');

            var addrNav = '#{{ Session::get('carrier_tab') }}' + nav;
            var addrId = '#{{ Session::get('carrier_tab') }}';

            $(addrNav).addClass('active');
            $(addrId).addClass('active');

            @if (empty(Session::get('carrier_con_tab')))
                $('#cgeneral_nav').addClass('active');
                $('#cgeneral').addClass('active');
            @endif

            @if (empty(Session::get('carrier_rate_tab')))
                $('#rgeneral_nav').addClass('active');
                $('#rgeneral').addClass('active');
            @endif

            @if (empty(Session::get('carrier_charge_tab')))
                $('#chgeneral_nav').addClass('active');
                $('#chgeneral').addClass('active');
            @endif
        </script>
    @else
        <script>
            $('#general_nav').addClass('active');
            $('#general').addClass('active');
        </script>
    @endif

    @if (Session::has('carrier_con_tab'))
        <script>
            // Get all tab panes by their class
            var navC = '_nav';

            var addrNavC = '#{{ Session::get('carrier_con_tab') }}' + navC;
            var addrIdC = '#{{ Session::get('carrier_con_tab') }}';

            $(addrNavC).addClass('active');
            $(addrIdC).addClass('active');

            $("#myModal").addClass("hide");
            $("#myModal").removeClass("show");
            $("#myModal").css('display', 'none');

            $("#conModalCls").click(function () {
                $("#myModal").addClass("hide");
                $("#myModal").removeClass("show");
                $("#myModal").css('display', 'none');
            });
        </script>
    @endif

    @if (
            Session::get('carrier_con_tab') == 'cgeneral' ||
            Session::get('carrier_con_tab') == 'caddress' ||
            Session::get('carrier_con_tab') == 'cbaddress' ||
            Session::get('carrier_con_tab') == 'coaddress' ||
            Session::get('carrier_con_tab') == 'cpinfo' ||
            Session::get('carrier_con_tab') == 'cattachment' ||
            Session::get('carrier_con_tab') == 'cnotes' ||
            Session::get('carrier_con_tab') == 'cinternalnotes'
        )
            <script>
                $("#myModal").addClass("show");
                $("#myModal").css('display', 'block');
            </script>
    @endif

    @if (Session::has('carrier_rate_tab'))
        <script>
            // Get all tab panes by their class
            var navC = '_nav';

            var addrNavC = '#{{ Session::get('carrier_rate_tab') }}' + navC;
            var addrIdC = '#{{ Session::get('carrier_rate_tab') }}';

            $(addrNavC).addClass('active');
            $(addrIdC).addClass('active');

            $("#myModalRate").addClass("hide");
            $("#myModalRate").removeClass("show");
            $("#myModalRate").css('display', 'none');

            $("#conModalClsRate").click(function () {
                $("#myModalRate").addClass("hide");
                $("#myModalRate").removeClass("show");
                $("#myModalRate").css('display', 'none');
            });
        </script>
    @endif

    @if (
            Session::get('carrier_rate_tab') == 'rgeneral' ||
            Session::get('carrier_rate_tab') == 'rpinfo' ||
            Session::get('carrier_rate_tab') == 'rnotes'
        )
            <script>
                $("#myModalRate").addClass("show");
                $("#myModalRate").css('display', 'block');
            </script>
    @endif

    @if (Session::has('employee_tab'))
        <script>
            // Get all tab panes by their class
            var navLinks = $('.nav-link');
            var tabPanes = $('.tab-pane');
            var nav = '_nave';

            // Remove the 'active' class from all tab panes
            navLinks.removeClass('active');
            tabPanes.removeClass('active');

            var addrNav = '#{{ Session::get('employee_tab') }}' + nav;
            var addrId = '#{{ Session::get('employee_tab') }}';

            $(addrNav).addClass('active');
            $(addrId).addClass('active');
        </script>
    @else
        <script>
            // Get all tab panes by their class
            // var navLinks = $('.nav-link');
            // var tabPanes = $('.tab-pane');
            // var nav = '_nave';

            // navLinks.removeClass('active');
            // tabPanes.removeClass('active');
            $('#generale_nave').addClass('active');
            $('#generale').addClass('active');
        </script>
    @endif

    @if (Session::has('carrier_charge_tab'))
        <script>
            // Get all tab panes by their class
            var navC = '_nav';

            var addrNavC = '#{{ Session::get('carrier_charge_tab') }}' + navC;
            var addrIdC = '#{{ Session::get('carrier_charge_tab') }}';

            $(addrNavC).addClass('active');
            $(addrIdC).addClass('active');

            $("#myModalCharge").addClass("hide");
            $("#myModalCharge").removeClass("show");
            $("#myModalCharge").css('display', 'none');

            $("#conModalClsCharge").click(function () {
                $("#myModalCharge").addClass("hide");
                $("#myModalCharge").removeClass("show");
                $("#myModalCharge").css('display', 'none');
            });
        </script>
    @endif

    @if (Session::get('carrier_charge_tab') == 'chgeneral' || Session::get('carrier_charge_tab') == 'chinfo')
        <script>
            $("#myModalCharge").addClass("show");
            $("#myModalCharge").css('display', 'block');
        </script>
    @endif

    @if (Session::has('carrier_edt_tab'))
        <script>
            // Get all tab panes by their class
            var navLinks = $('.nav-link');
            var tabPanes = $('.tab-pane');
            var nav = '_nav';

            // Remove the 'active' class from all tab panes
            navLinks.removeClass('active');
            tabPanes.removeClass('active');

            var addrNav = '#{{ Session::get('carrier_edt_tab') }}' + nav;
            var addrId = '#{{ Session::get('carrier_edt_tab') }}';

            $(addrNav).addClass('active');
            $(addrId).addClass('active');

            @if (empty(Session::get('carrier_con_tab')))
                $('#cgeneral_nav').addClass('active');
                $('#cgeneral').addClass('active');
            @endif

            @if (Session::get('carrier_con_tab') == 'cgeneral')
                $('#cgeneral_nav').addClass('active');
                $('#cgeneral').addClass('active');
            @endif

            @if (Session::has('carrier_con_tab'))
                // Get all tab panes by their class
                var navC = '_nav';

                var addrNavC = '#{{ Session::get('carrier_con_tab') }}' + navC;
                var addrIdC = '#{{ Session::get('carrier_con_tab') }}';

                $(addrNavC).addClass('active');
                $(addrIdC).addClass('active');
            @endif

            @if (empty(Session::get('carrier_rate_tab')))
                $('#rgeneral_nav').addClass('active');
                $('#rgeneral').addClass('active');
            @endif

            @if (Session::has('carrier_rate_tab'))
                // Get all tab panes by their class
                var navC = '_nav';

                var addrNavC = '#{{ Session::get('carrier_rate_tab') }}' + navC;
                var addrIdC = '#{{ Session::get('carrier_rate_tab') }}';

                $(addrNavC).addClass('active');
                $(addrIdC).addClass('active');
            @endif

            @if (empty(Session::get('carrier_charge_tab')))
                $('#chgeneral_nav').addClass('active');
                $('#chgeneral').addClass('active');
            @endif

            @if (Session::has('carrier_charge_tab'))
                // Get all tab panes by their class
                var navC = '_nav';

                var addrNavC = '#{{ Session::get('carrier_charge_tab') }}' + navC;
                var addrIdC = '#{{ Session::get('carrier_charge_tab') }}';

                $(addrNavC).addClass('active');
                $(addrIdC).addClass('active');
            @endif
        </script>
    @else
        <script>
            $('#generalce_nav').addClass('active');
            $('#generalce').addClass('active');
        </script>
    @endif

    <script>
        var activeNavLink = $('#myAccordion .nav-link.active');

        $(document).ready(function () {
            $('#myAccordion a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                var activeTab = e.target; // The active tab element
                var activeTabId = activeTab.getAttribute('id'); // ID of the active tab
                var activeTabText = $(activeTab).text(); // Text content of the active tab
                // console.log('Active Tab ID: ' + activeTabId);
                // console.log('Active Tab Text: ' + activeTabText);

                if (activeTabId == "contacts_nav") {
                    $("#myModal").addClass("hide");
                    $("#myModal").removeClass("show");
                    $("#myModal").css('display', 'none');
                }

                if (activeTabId == "rates_nav") {
                    $("#myModalRate").addClass("hide");
                    $("#myModalRate").removeClass("show");
                    $("#myModalRate").css('display', 'none');
                }
            });
        });

        var activeNavLinkEdt = $('#myAccordionEdt .nav-link.active');

        // $('#generalce_nav').addClass('active');
        // $('#generalce').addClass('active');

        $(document).ready(function () {
            $('#myAccordionEdt a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {

                var activeTab = e.target; // The active tab element
                var activeTabId = activeTab.getAttribute('id'); // ID of the active tab
                var activeTabText = $(activeTab).text(); // Text content of the active tab
                // console.log('Active Tab ID: ' + activeTabId);
                // console.log('Active Tab Text: ' + activeTabText);

                // if(activeTabId=="generalce_nav") {
                //     $("#myModal").addClass("hide");
                //     $("#myModal").removeClass("show");
                //     $("#myModal").css('display', 'none');
                // }

                // if(activeTabId=="rates_nav") {
                //     $("#myModalRate").addClass("hide");
                //     $("#myModalRate").removeClass("show");
                //     $("#myModalRate").css('display', 'none');
                // }
            });
        });
    </script>

    <style type="text/css" media="screen">
        .invalid-feedback {
            width: 100% !important;
            margin-top: 0.25rem;
            font-size: 80%;
            color: #dc3545 !important;
            font-weight: 500;
            top: 32px;
            text-align: left;
        }


        .form-control.is-invalid,
        .was-validated .form-control:invalid {
            border-color: #dc3545;
            padding-right: 2.25rem;
            background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e);
            background-repeat: no-repeat;
            background-position: right calc(.375em + .1875rem) center;
            background-size: calc(.75em + .375rem) calc(.75em + .375rem);
        }
    </style>

    <script>
        $("#formValidated").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                c_password: {
                    required: true,
                    minlength: 6
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
                user_name: {
                    required: true
                },
                first_name: {
                    required: true
                },
                property_type: {
                    required: true
                },
                name: {
                    required: true
                },
                carrier_type_edt: {
                    required: true
                },
                carrier_code_edt: {
                    required: true
                },
                carrier_description_edt: {
                    required: true
                },
                citizenship: {
                    required: true
                },
                date_of_birth: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter an email address",
                },
                c_password: {
                    required: "Please provide a current password",
                    minlength: "Your password must be at least 6 characters long"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                confirm_password: {
                    required: "Please provide a Confirm password",
                    minlength: "Your password must be at least 6 characters long"
                },
                contact_phone: {
                    required: "Please enter an valid phone number"
                },
                user_name: {
                    required: "Please enter user name"
                },
                first_name: {
                    required: "Please enter first name"
                },
                property_type: {
                    required: "Please choose property type"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedAddress").validate({
            ignore: [],
            rules: {
                street_number: {
                    required: true,
                },
                city: {
                    required: true
                },
                country: {
                    required: true
                },
                state: {
                    required: true
                },
                zip_code: {
                    required: true
                },
            },
            messages: {
                street_number: {
                    required: "Please enter a street number",
                },
                city: {
                    required: "Please provide a city",
                },
                country: {
                    required: "Please choose a country",
                },
                state: {
                    required: "Please choose a state",
                },
                zip_code: {
                    required: "Please enter a valid zip code"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedAddressEmp").validate({
            ignore: [],
            rules: {
                parent_entity: {
                    required: true,
                },
            },
            messages: {
                parent_entity: {
                    required: "Please choose parent entity",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedBillingAddress").validate({
            ignore: [],
            rules: {
                billing_street_number: {
                    required: true,
                },
                billing_city: {
                    required: true
                },
                billing_country: {
                    required: true
                },
                billing_state: {
                    required: true
                },
                billing_zip_code: {
                    required: true
                },
            },
            messages: {
                billing_street_number: {
                    required: "Please enter a street number",
                },
                billing_city: {
                    required: "Please provide a city",
                },
                billing_country: {
                    required: "Please choose a country",
                },
                billing_state: {
                    required: "Please choose a state",
                },
                billing_zip_code: {
                    required: "Please enter a valid zip code"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedOtherAddress").validate({
            ignore: [],
            rules: {
                other_description: {
                    required: true,
                },
                other_contact_name: {
                    required: true,
                },
                other_street_number: {
                    required: true,
                },
                other_city: {
                    required: true
                },
                other_country: {
                    required: true
                },
                other_state: {
                    required: true
                },
                other_zip_code: {
                    required: true
                },
                carrier_type: {
                    required: true
                },
            },
            messages: {
                other_street_number: {
                    required: "Please enter a street number",
                },
                other_city: {
                    required: "Please provide a city",
                },
                other_country: {
                    required: "Please choose a country",
                },
                other_state: {
                    required: "Please choose a state",
                },
                other_zip_code: {
                    required: "Please enter a valid zip code"
                },
                carrier_type: {
                    required: "Please choose a type"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedOtherEmpAddress").validate({
            ignore: [],
            rules: {
                other_description: {
                    required: true,
                },
                other_contact_name: {
                    required: true,
                },
                other_street_number: {
                    required: true,
                },
                other_city: {
                    required: true
                },
                other_country: {
                    required: true
                },
                other_state: {
                    required: true
                },
                other_zip_code: {
                    required: true
                },
                carrier_type: {
                    required: true
                },
            },
            messages: {
                other_street_number: {
                    required: "Please enter a street number",
                },
                other_city: {
                    required: "Please provide a city",
                },
                other_country: {
                    required: "Please choose a country",
                },
                other_state: {
                    required: "Please choose a state",
                },
                other_zip_code: {
                    required: "Please enter a valid zip code"
                },
                carrier_type: {
                    required: "Please choose a type"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedContact").validate({
            ignore: [],
            rules: {
                contact_first_name: {
                    required: true,
                },
                contact_last_name: {
                    required: true,
                },
                name: {
                    required: true,
                },
                entity_id: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                account_number: {
                    required: true
                },
                identification_number: {
                    required: true
                },
            },
            messages: {
                contact_first_name: {
                    required: "Please enter a first name",
                },
                contact_last_name: {
                    required: "Please enter a lastname",
                },
                name: {
                    required: "Please enter a name",
                },
                entity_id: {
                    required: "Please enter a entity Id",
                },
                email: {
                    required: "Please enter an email address"
                },
                account_number: {
                    required: "Please enter a valid account number"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedRateGround").validate({
            // ignore: [],
            rules: {
                hts_rate_method: {
                    required: true
                },
                transportation: {
                    required: true
                },
                freight_service_class: {
                    required: true
                },
                currency: {
                    required: true
                },
                carrier_frequency: {
                    required: true
                },
                transit_time: {
                    required: true
                },
                port_of_landing: {
                    required: true
                },
                port_of_landing_country: {
                    required: true
                },
                port_of_unlanding_country: {
                    required: true
                },
                port_of_unlanding: {
                    required: true
                },
            },
            messages: {
                transportation: {
                    required: "Please choose transportation",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedCharge").validate({
            // ignore: [],
            rules: {
                charge_id: {
                    required: true
                },
                charge_price: {
                    required: true
                },
            },
            messages: {
                charge_id: {
                    required: "Please choose charges",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedChargeCreation").validate({
            // ignore: [],
            rules: {
                'auto_creation[]': {
                    required: true
                },
            },
            messages: {
                'auto_creation[]': {
                    required: "Please choose...",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedAddress2ndTab").validate({
            ignore: [],
            rules: {
                street_number: {
                    required: true,
                },
                city: {
                    required: true
                },
                country: {
                    required: true
                },
                state: {
                    required: true
                },
                zip_code: {
                    required: true
                },
            },
            messages: {
                street_number: {
                    required: "Please enter a street number",
                },
                city: {
                    required: "Please provide a city",
                },
                country: {
                    required: "Please choose a country",
                },
                state: {
                    required: "Please choose a state",
                },
                zip_code: {
                    required: "Please enter a valid zip code"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedBillingAddress2ndTab").validate({
            ignore: [],
            rules: {
                billing_street_number: {
                    required: true,
                },
                billing_city: {
                    required: true
                },
                billing_country: {
                    required: true
                },
                billing_state: {
                    required: true
                },
                billing_zip_code: {
                    required: true
                },
            },
            messages: {
                billing_street_number: {
                    required: "Please enter a street number",
                },
                billing_city: {
                    required: "Please provide a city",
                },
                billing_country: {
                    required: "Please choose a country",
                },
                billing_state: {
                    required: "Please choose a state",
                },
                billing_zip_code: {
                    required: "Please enter a valid zip code"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedBillingAddress2ndTab_2").validate({
            ignore: [],
            rules: {
                other_address: {
                    required: true,
                },
                other_contact: {
                    required: true
                },
                other_country_2: {
                    required: true
                },
                other_state_2: {
                    required: true
                },
            },
            messages: {
                other_address: {
                    required: "Please enter a address",
                },
                other_contact: {
                    required: "Please enter a contact name",
                },
                other_country_2: {
                    required: "Please choose a country",
                },
                billing_state: {
                    required: "Please choose a state",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedBillingAddress2ndTab_3").validate({
            ignore: [],
            rules: {
                country_of_citizenship: {
                    required: true,
                },
                date_of_birth: {
                    required: true
                },
            },
            messages: {
                country_of_citizenship: {
                    required: "Please choose a country",
                },
                date_of_birth: {
                    required: "Please choose date of birth",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedBillingAddress2ndTab_4").validate({
            ignore: [],
            rules: {
                con_notes: {
                    required: true,
                },
            },
            messages: {
                con_notes: {
                    required: "Please enter a note",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedParentEntity").validate({
            rules: {
                parent_entity: {
                    required: true,
                },
            },
            messages: {
                parent_entity: {
                    required: "Please choose a carrier",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedirline").validate({
            rules: {
                IATA_account_number: {
                    required: true,
                },
                airline_code: {
                    required: true,
                },
                airline_prefix: {
                    required: true,
                },
            },
            messages: {
                IATA_account_number: {
                    required: "Please enter a IATA Account Number",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedNotes").validate({
            rules: {
                carrier_notes: {
                    required: true,
                },
            },
            messages: {
                carrier_notes: {
                    required: "Please enter a note",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedEmpNotes").validate({
            rules: {
                usr_note: {
                    required: true,
                },
            },
            messages: {
                usr_note: {
                    required: "Please enter a note",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedAgent").validate({
            ignore: [],
            rules: {
                ita_code: {
                    required: true,
                },
                fmc_code: {
                    required: true
                },
                scac_code: {
                    required: true
                },
            },
            messages: {
                ita_code: {
                    required: "Please enter a ita code",
                },
                fmc_code: {
                    required: "Please enter a fmc",
                },
                scac_code: {
                    required: "Please enter a scac code",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        /*$("#formValidatedAWB").validate({
            ignore: [],
            rules: {
                start_awb_number: {
                    required: true,
                    digits: true,
                },
                end_awb_number: {
                    required: true,
                    digits: true,
                },
            },
            messages: {
                start_awb_number: {
                    required: "Please enter a start value",
                },
                end_awb_number: {
                    required: "Please enter a end value",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;
            }
        });*/

        $("#formValidatedPMT").validate({
            ignore: [],
            rules: {
                pmt_master_terms: {
                    required: true
                },
                pmt_common_type_payment: {
                    required: true
                },
                pmt_incoterms: {
                    required: true
                },
                pmt_currency: {
                    required: true
                },
                pmt_expiration: {
                    required: true
                },
            },
            messages: {
                pmt_master_terms: {
                    required: "Please choose terms",
                },
                pmt_common_type_payment: {
                    required: "Please choose common type of payment",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedPsn").validate({
            ignore: [],
            rules: {
                country_of_citizenship: {
                    required: true
                },
                date_of_birth: {
                    required: true
                },
            },
            messages: {
                country_of_citizenship: {
                    required: "Please choose citizenship",
                },
                date_of_birth: {
                    required: "Please choose date of birth",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });

        $("#formValidatedMore").validate({
            ignore: [],
            rules: {
                date_of_birth: {
                    required: true
                },
            },
            messages: {
                date_of_birth: {
                    required: "Please choose date of birth",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
                // console.log(form.action);
                return true;

            }

        });
    </script>

    <script>
        $(document).ready(function () {
            // alert("kkk");
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    return true;
                }
            });

            $.validator.addMethod("ssn_validate", function (value, element) {
                let ssn = value;
                if (!(/^\(?([0-9]{3})\)?[- ]?([0-9]{2})[- ]?([0-9]{4})$/.test(ssn))) {
                    return false;
                }
                return true;
            }, 'SSN number must be in xxx-xx-xxxx format');

            $('#loginForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirm_password: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    // phone: {
                    //     required: true,
                    //     number: true
                    // },
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    user_type: {
                        required: true
                    },
                    property_type: {
                        required: true
                    },
                    type_name: {
                        required: true,
                        remote: {
                            url: "{{ url('/filter_data_exist') }}",
                            type: "post",
                            async: false,
                            data: {
                                type_name: function () {
                                    return $("#type_name").val();
                                }
                            }
                        }
                    },
                    divison_name: {
                        required: true
                    },
                    port_country: {
                        required: true
                    },
                    port_name: {
                        required: true
                    },
                    port_id: {
                        required: true
                    },
                    amenity_name: {
                        required: true,
                        remote: {
                            url: "{{ url('/is_amenity_exist') }}",
                            type: "post",
                            async: false,
                            data: {
                                amenity_name: function () {
                                    return $("#amenity_name").val();
                                }
                            }
                        }
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    confirm_password: {
                        required: "Please provide a Confirm password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    first_name: {
                        required: "Please enter first name"
                    },
                    last_name: {
                        required: "Please enter last name"
                    },
                    property_type: {
                        required: "Please choose property type"
                    },
                    user_type: {
                        required: "Please choose user type"
                    },
                    divison_name: {
                        required: "Please enter a divison name"
                    },
                    type_name: {
                        remote: 'Property type already in use.',
                        required: "Please enter a property type"
                    },
                    amenity_name: {
                        remote: 'Amenity already in use.',
                        required: "Please enter a amenity"
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        function getNotificationId(id) {
            $('#notification_id').val(id);
        }

        $("#resetAllFileds").click(function () {
            //$("#property_type").empty().trigger('change');
            $("#property_type").val('').trigger('change');
            $("#state_county").val('').trigger('change');
            $("#city_html").val('').trigger('change');
            $("#suffix").val('').trigger('change');
        });

        $('#ssn_number').mask('000-00-0000');
    </script>

    <script>
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    return true;
                }
            });

            $('#validateForm').validate({
                ignore: [],
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirm_password: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    state_county: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    carrier_type: {
                        required: true
                    },
                    carrier_code: {
                        required: true
                    },
                    carrier_description: {
                        required: true
                    },
                    carrier_method: {
                        required: true
                    },
                    account_name: {
                        required: true
                    },
                    due_days: {
                        required: true
                    },
                    discount_pe: {
                        required: true
                    },
                    discount_days: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    confirm_password: {
                        required: "Please provide a Confirm password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    first_name: {
                        required: "Please enter first name"
                    },
                    last_name: {
                        required: "Please enter last name"
                    },
                    state_county: {
                        required: "Please choose county."
                    },
                    city: {
                        required: "Please choose city."
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

    <script>
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {

                    var form = $(this);
                    var actionUrl = form.attr('action');

                    var latitude = $("#search_lat").val();
                    var longitude = $("#search_lon").val();

                    if (latitude == "" && longitude == "") {

                        return false;
                    }

                    $.ajax({
                        type: "POST",
                        url: actionUrl,
                        data: form.serialize(), // serializes the form's elements.
                        success: function (data) {
                            alert(data); // show response from the php script.
                        }
                    });

                    return true;
                }
            });

            $('#listingInformations1').validate({
                ignore: [],
                rules: {
                    property_type: {
                        required: true
                    },
                    property_subtype: {
                        required: true
                    },
                    state_county: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    apn_1: {
                        required: true,
                        digits: true,
                        minlength: 3,
                        maxlength: 3
                    },
                    apn_2: {
                        required: true,
                        digits: true,
                        minlength: 4,
                        maxlength: 4
                    },
                    apn_3: {
                        required: true,
                        digits: true,
                        minlength: 3,
                        maxlength: 3
                    },
                    apn_4: {
                        required: true,
                        digits: true,
                        minlength: 4,
                        maxlength: 4
                    },
                    suffix: {
                        required: true
                    },
                    zipcode_1: {
                        required: true
                    },
                    location: {
                        required: true
                    },
                    office_id: {
                        required: true
                    },
                    agent_id: {
                        required: true
                    },
                    property_for: {
                        required: true
                    },
                },
                messages: {
                    property_type: {
                        required: "Please choose property type."
                    },
                    state_county: {
                        required: "Please choose county."
                    },
                    city: {
                        required: "Please choose city."
                    },
                    apn_1: {
                        required: "Please enter a apn number."
                    },
                    suffix: {
                        required: "Please choose suffix."
                    },
                    zipcode_1: {
                        required: "Please enter a zipcode."
                    },
                    location: {
                        required: "Please enter a location for map."
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('#listingFinalStepValidation').validate({
                ignore: [],
                rules: {
                    property_subtype: {
                        required: true
                    },
                    property_for: {
                        required: true
                    },
                    office_id: {
                        required: true
                    },
                    agent_id: {
                        required: true
                    },
                    listing_price: {
                        required: true
                    },
                    listing_date: {
                        required: true
                    },
                },
                messages: {
                    property_subtype: {
                        required: "Please choose property subtype"
                    },
                    property_for: {
                        required: "Please choose"
                    },
                    office_id: {
                        required: "Please enter a office Id"
                    },
                    agent_id: {
                        required: "Please enter a agent Id"
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

    <script>
        $(function () {
            $('.notifi-btn').click(function () {
                $('.notification-menu').toggle();
            });
        });

        // $('#htmlContinue').click(function() {
        //         $('#htmlCounty').hide();
        //         $('#htmlWizard').show();
        //     });

        $(".alert").delay(7000).fadeOut(1500);
    </script>

    <script>
        $(document).ready(function () {
            var max_fields = 3; //maximum input boxes allowed
            var wrapper = $(".phone-box"); //Fields wrapper
            var add_button = $(".add-phone"); //Add button ID

            var x = 1; //initlal box count

            $(add_button).click(function (e) { //on add input button click
                var numItems = $('.usrPhone').length;
                x = numItems;
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="row form-row usrPhone"><div class="col-lg-12"><div class="row mb-3"><div class="col-md-2"><div class="form-group"><select class="form-control select2" name="phonetype[]"><option value="">Choose Type</option><option value="Home">Home</option><option value="Work">Work</option><option value="Mobile">Mobile</option></select></div></div><div class="col-md-5"><div class="form-group"><input type="text" class="form-control" placeholder="Phone Number" name=phone[]></div></div><div class="col-md-1"><div class="form-group"><button class="btn btn-danger remove btn-sm" style=""><i class="fa fa-minus"></i></button></div></div></div></div></div>'
                    ); //add input box
                    $(".select2").select2();
                }
            });

            $(wrapper).on("click", ".remove", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parents(".form-row").remove();
                x--;
            });
        });

        $(document).ready(function () {
            var max_fields = 2; //maximum input boxes allowed
            var wrapper = $(".email-box"); //Fields wrapper
            var add_button = $(".add-email"); //Add button ID

            var x = 1; //initlal box count

            $(add_button).click(function (e) { //on add input button click
                var numItems = $('.usrEmailBox').length;
                x = numItems;
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="row form-row usrEmailBox"><div class="col-md-12"><div class="row mb-3"><div class="col-md-2"><div class="form-group"><select class="form-control select2" name="emailtype[]"><option selected disabled>Choose Type</option><option  value="Work">Work</option><option value="Personal">Personal</option></select></div></div><div class="col-md-5"><div class="form-group"><input type="email" class="form-control" placeholder="Email Address" name="usremail[]"></div></div><div class="col-md-1"><div class="form-group"><button class="btn btn-danger remove btn-sm" style=""><i class="fa fa-minus"></i></button></div></div></div></div></div>'
                    ); //add input box
                    $(".select2").select2();
                }
            });

            $(wrapper).on("click", ".remove", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parents(".form-row").remove();
                x--;
            })
        });

        $(document).ready(function () {
            var max_fields = 2; //maximum input boxes allowed
            var wrapper = $(".address-box"); //Fields wrapper
            var add_button = $(".add-address"); //Add button ID

            var x = 1; //initlal box count

            $(add_button).click(function (e) { //on add input button click
                var numItems = $('.usrAddressBox').length;
                x = numItems;
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div class="form-row b-t-1 usrAddressBox"><div class="col-md-12"><div class="row mb-3"><div class="col-md-2"><div class="form-group"><label for="inputAddress" class="col-form-label">Address Type</label><select class="form-control select2" name="addresstype[]"><option selected disabled>Choose Type</option><option value="Work">Work</option><option value="Home">Home</option></select></div></div><div class="col-md-9"><div class="form-group"><label for="inputAddress" class="col-form-label">Street Address</label><input type="text" class="form-control" placeholder="1234 Main St" name="street[]"></div></div><div class="col-md-1"><button style="position:relative;top:38px;" class="btn btn-danger remove btn-sm"><i class="fa fa-minus"></i></button></div><div class="form-group col-md-3"><label for="inputCity" class="col-form-label">City</label><input type="text" class="form-control"  name="city[]"></div><div class="form-group col-md-3"><label for="inputState" class="col-form-label">State</label><input type="text" class="form-control" name="state[]"></div><div class="form-group col-md-3"><label for="inputState" class="col-form-label">Country</label><input type="text" class="form-control" name="country[]"></div><div class="form-group col-md-3"><label for="inputZip" class="col-form-label">Postcode/Zip</label><input type="text" class="form-control" name="postcode[]"></div></div></div></div>'
                    ); //add input box
                    $(".select2").select2();
                }
            });

            $(wrapper).on("click", ".remove", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parents(".form-row").remove();
                x--;
            })
        });


        function removeUsrPh(id) {
            $('#usrPhone-' + id).remove();
        }

        function removeUsrMail(id) {
            $('#usrEmailBox-' + id).remove();
        }

        function removeUsrAddr(id) {
            $('#usrAddressBox-' + id).remove();
        }

        function removeUsrInstallment(id) {
            $('#remove_install_' + id).remove();
        }
    </script>



    <script>
        function deleteUser(userId) {
            swal({
                title: 'Are You sure want to delete this user?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteUser') }}" + '/' + userId
                }
            });
        }

        function deleteListing(id) {
            swal({
                title: 'Are You sure want to delete this listing?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteListing') }}" + '/' + id
                }
            });
        }

        function deleteListingImage(id) {
            swal({
                title: 'Are You sure want to delete this listing image?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteGalleryImage') }}" + '/' + id
                }
            });
        }

        function deleteIdentificationType(id) {
            swal({
                title: 'Are You sure want to delete this type?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteIdentificationType') }}" + '/' + id
                }
            });
        }

        function deleteDivison(id) {
            swal({
                title: 'Are You sure want to delete this divison?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteDivison') }}" + '/' + id
                }
            });
        }

        function deletePort(id) {
            swal({
                title: 'Are You sure want to delete this port?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deletePort') }}" + '/' + id
                }
            });
        }

        function deleteFrequency(id) {
            swal({
                title: 'Are You sure want to delete this frequency?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteFrequency') }}" + '/' + id
                }
            });
        }

        function deleteCommodity(id) {
            swal({
                title: 'Are You sure want to delete this Commodity?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteCommodity') }}" + '/' + id
                }
            });
        }

        function deleteCarrierCode(id) {
            swal({
                title: 'Are You sure want to delete this code?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteCode') }}" + '/' + id
                }
            });
        }

        function deleteTransportation(id) {
            swal({
                title: 'Are You sure want to delete this transportation?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteTransportation') }}" + '/' + id
                }
            });
        }

        function deletePmtTerms(id) {
            swal({
                title: 'Are You sure want to delete this terms?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deletePmtTerms') }}" + '/' + id
                }
            });
        }

        function deleteFreightServiceClass(id) {
            swal({
                title: 'Are You sure want to delete this freight service class?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteFreightServiceClass') }}" + '/' + id
                }
            });
        }

        function deleteCustomCharge(id) {
            swal({
                title: 'Are You sure want to delete this charge?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteCustomCharge') }}" + '/' + id
                }
            });
        }

        function deleteFlight(id) {
            swal({
                title: 'Are You sure want to delete this?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteFlight') }}" + '/' + id
                }
            });
        }

        function deleteCarrier(id) {
            swal({
                title: 'Are You sure want to delete this carrier?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteCarrier') }}" + '/' + id
                }
            });
        }

        function deleteHtsUsers(id, routeurl) {
            swal({
                title: 'Are You sure want to delete this user?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteHtsUser') }}" + '/' + id + '/' + routeurl
                }
            });
        }

        function deleteOtherAddress(id) {
            swal({
                title: 'Are You sure want to delete this address?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteOtherAddress') }}" + '/' + id
                }
            });
        }

        function deleteHtsOtherAddress(id) {
            swal({
                title: 'Are You sure want to delete this address?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteHtsOtherAddress') }}" + '/' + id
                }
            });
        }

        function deleteOtherAddressEdt(id) {
            swal({
                title: 'Are You sure want to delete this address?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteOtherAddressEdt') }}" + '/' + id
                }
            });
        }

        function deleteUsrOtherAddress(id) {
            swal({
                title: 'Are You sure want to delete this address?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteUsrOtherAddress') }}" + '/' + id
                }
            });
        }

        function deleteUsrOtherAddressEmp(id) {
            swal({
                title: 'Are You sure want to delete this address?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteUsrOtherAddressEmp') }}" + '/' + id
                }
            });
        }

        function deleteConNote(id) {
            swal({
                title: 'Are You sure want to delete this note?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteConNote') }}" + '/' + id
                }
            });
        }

        function deleteHtsConNote(id) {
            swal({
                title: 'Are You sure want to delete this note?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteHtsConNote') }}" + '/' + id
                }
            });
        }

        function deleteConNoteEdt(id) {
            swal({
                title: 'Are You sure want to delete this note?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteConNoteEdt') }}" + '/' + id
                }
            });
        }

        function deleteNote(id) {
            swal({
                title: 'Are You sure want to delete this note?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteNote') }}" + '/' + id
                }
            });
        }

        function deleteHtsNote(id) {
            swal({
                title: 'Are You sure want to delete this note?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteHtsNote') }}" + '/' + id
                }
            });
        }

        function deleteNoteEdt(id) {
            swal({
                title: 'Are You sure want to delete this note?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteNoteEdt') }}" + '/' + id
                }
            });
        }

        function deleteConTabData(id) {
            swal({
                title: 'Are You sure want to delete this contact all details?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteConTabData') }}" + '/' + id
                }
            });
        }

        function deleteHtsConTabData(id) {
            swal({
                title: 'Are You sure want to delete this contact all details?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteHtsConTabData') }}" + '/' + id
                }
            });
        }

        function deleteConTabDataEdt(id) {
            swal({
                title: 'Are You sure want to delete this contact all details?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteConTabDataEdt') }}" + '/' + id
                }
            });
        }

        function deleteRateGroundTabData(id) {
            swal({
                title: 'Are You sure want to delete this rate ground all details?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteRateGroundTabData') }}" + '/' + id
                }
            });
        }

        function deleteHtsRateGroundTabData(id) {
            swal({
                title: 'Are You sure want to delete this rate ground all details?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteHtsRateGroundTabData') }}" + '/' + id
                }
            });
        }

        function deleteRateGroundTabDataEdt(id) {
            swal({
                title: 'Are You sure want to delete this rate ground all details?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteRateGroundTabDataEdt') }}" + '/' + id
                }
            });
        }

        function deleteChargeTabData(id) {
            swal({
                title: 'Are You sure want to delete this custom charge all details?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteChargeTabData') }}" + '/' + id
                }
            });
        }

        function deleteHtsChargeTabData(id) {
            swal({
                title: 'Are You sure want to delete this custom charge all details?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteHtsChargeTabData') }}" + '/' + id
                }
            });
        }

        function deleteChargeTabDataEdt(id) {
            swal({
                title: 'Are You sure want to delete this custom charge all details?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteChargeTabDataEdt') }}" + '/' + id
                }
            });
        }

        function deleteAmenity(id) {
            swal({
                title: 'Are You sure want to delete this amenity?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('deleteAmenity') }}" + '/' + id
                }
            });
        }

        function deleteParticipation(id) {
            swal({
                title: 'Are You sure want to delete this participation?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('delete-participation') }}" + '/' + id
                }
            });
        }

        function deleteParticipationData(id) {
            swal({
                title: 'Are You sure want to delete this participation all details?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('delete-participation-details') }}" + '/' + id
                }
            });
        }

        function deleteAwbData(id) {
            swal({
                title: 'Are You sure want to delete this awb number?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = "{{ url('delete-awb-details') }}" + '/' + id
                }
            });
        }

        function changeUserStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/updateUserStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeIdentiTypeStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/updateIdentiTypeStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeDivisonStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/changeDivisonStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changePortStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/changePortStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeHtsUserStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/changeHtsUserStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeFrequencyStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/changeFrequencyStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeCommodityStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/changeCommodityStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeCodeStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/changeCodeStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeTransportationStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/changeTransportationStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeFreightServiceClass(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/changeFreightServiceClass') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeCusomCharge(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/changeChargeStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeFlightStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/changeFlightStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeAmenityStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/updateAmenityStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeListingStatus(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('/updateListingStatus') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        function changeParticipation(id, thisSwitch) {
            var newStatus;
            if (thisSwitch.val() == 1) {
                thisSwitch.val('0');
                newStatus = '0';
            } else {
                thisSwitch.val('1');
                newStatus = '1';
            }

            $.ajax({
                url: "{{ url('change-participation-status') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: String(id),
                    status: String(newStatus),
                    _token: '{{ csrf_token() }}'
                },
            })
                .done(function (data) {
                    alert_func(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        }

        $('.paydiv').hide();

        $('.radioButtons').click(function () {
            if ($("input[name='part_payment']").prop('checked')) {
                //implement your logic
                $('.paydiv').show(500);
            } else {
                $('.paydiv').hide(500);
                //do something else as radio not checked
            }
        });

        $('.radioButtonsTaxPy').click(function () {
            var taxapplicable = $("input[name='taxapplicable'].radioButtonsTaxPy:checked").val();

            if (taxapplicable == "Tax") {
                $('#gstrw').hide(500);
            } else {
                $('#gstrw').show(500);
            }
        });
    </script>

    <script>
        $('#project_created').datepicker({
            format: 'yyyy-mm-dd',
            // startDate: new Date(),
            todayHighlight: true,
            autoclose: true
        });

        $('#datepicker1').datepicker({
            format: 'yyyy-mm-dd',
            // startDate: new Date(),
            todayHighlight: true,
            autoclose: true
        });

        $(document).ready(function () {
            var max_fields = 31; //maximum input boxes allowed
            var wrapper = $(".part-payment-box"); //Fields wrapper
            var add_button = $("#partPay"); //Add button ID

            var x = 1; //initlal box count

            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment

                    $(wrapper).append(
                        '<div class="form-row customer_records"><div class="row mb-2"><div class="col-md-3"><div class="form-group"><select class="form-control select2" name="installment[]"><option value="first">First Installment</option><option value="second">Second Installment</option><option value="third">Third Installment</option><option value="fourth">Fourth Installment</option><option value="fifth">Fifth Installment</option><option value="sixth">Sixth Installment</option><option value="seventh">Seventh Installment</option><option value="eight">Eight Installment</option><option value="ninth">Ninth Installment</option><option value="tenth">Tenth Installment</option><option value="eleventh">Eleventh Installment</option><option value="twelfth">Twelfth Installment</option><option value="thirteenth">Thirteenth Installment</option><option value="fourteenth">Fourteenth Installment</option><option value="fifteenth">Fifteenth Installment</option><option value="sixteenth">Sixteenth Installment</option><option value="seventeenth">Seventeenth Installment</option><option value="eighteenth">Eighteenth Installment</option><option value="nineteenth">Nineteenth Installment</option><option value="twentieth">Twentieth Installment</option><option value="twentyone"> Twenty- one Installment</option><option value="twentytwo">Twenty- two Installment</option><option value="twentythree">Twenty- three Installment</option><option value="twentyfour">Twenty- four Installment</option><option value="twentyfive">Twenty- five Installment</option><option value="twentysix">Twenty- six Installment</option><option value="twentyseven">Twenty- seven Installment</option><option value="twentyeight">Twenty- eight Installment</option><option value="twentynine">Twenty- nine Installment</option><option value="thirty">Thirty Installment</option><option value="final">Final Installment</option></select></div></div><div class="col-sm-2"><div class="form-group"><div class="input-group mb-2 mr-sm-2 mb-sm-0"><div class="input-group-prepend currency-symbol2"></div><input type="number" class="form-control currency-amount" id="inlineFormInputGroup" placeholder="0.00" size="8" name="installment_amount[]"><div class="input-group-append currency-addon"><select class="form-control form-select" name="installment_currency[]"><option data-symbol="" data-placeholder="0.00" selected value="USD">USD</option><option data-symbol="" data-placeholder="0.00" value="EUR">EUR</option><option data-symbol="" data-placeholder="0.00" value="GBP">GBP</option><option data-symbol="" data-placeholder="0.00" value="JPY">JPY</option><option data-symbol="" data-placeholder="0.00" value="CAD">CAD</option><option data-symbol="" data-placeholder="0.00" value="AUD">AUD</option><option data-symbol="" data-placeholder="0.00" value="INR">INR</option></select></div></div></div></div><div class="col-sm-2"><div class="form-group"><select class="form-control form-select" name=payment_status[]><option value="due-now">Due Now</option><option value="due-later">Due Later</option><option value="done">Paid</option></select></div></div><div class="col-sm-2"> <div class="form-group"><div class="input-group"><input type="text" class="form-control" id="datepicker' +
                        x +
                        '" placeholder="yyyy-mm-dd" name="installment_created_date[]" value=""><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div></div></div><div class="col-sm-2"> <div class="form-group"><div class="input-group"><input type="text" autocomplete="off" name="payment_date[]" value="" class="form-control date" readonly><div class="input-group-append"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span> </div></div></div></div><div class="col-sm-1"><div class="form-group"><label></label><button class="btn btn-danger btn-sm remove"><i class="fa fa-trash"></i></button></div></div></div></div>'
                    ); //add input box
                    $(".select2").select2();
                    $('#datepicker' + x).datepicker({
                        format: 'yyyy-mm-dd',
                        // startDate: new Date(),
                        todayHighlight: true,
                        autoclose: true
                    });
                }
            });

            $(wrapper).on("click", ".remove", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parents(".form-row").remove();
                x--;
            })
        });
    </script>

    <script>
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $("#parent_entity_emp").change(function () {
            $("#formValidatedAddressEmp").submit();

        });

        $("#country_id").change(function () {
            var country_id = $("#country_id option:selected").val();

            if (country_id) {
                $.ajax({
                    url: "{{ url('/getState') }}",
                    type: "POST",
                    data: {
                        "country_id": country_id,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function () { },
                    success: function (response) {
                        $("#state_html").html(response);
                        $(".select2").select2();
                    }
                });
            } else {
                $("#state_html").empty().append('<option value="">Select state...</option>');

            }
        });

        $("#billing_country_id").change(function () {
            var country_id = $("#billing_country_id option:selected").val();

            if (country_id) {
                $.ajax({
                    url: "{{ url('/getState') }}",
                    type: "POST",
                    data: {
                        "country_id": country_id,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function () { },
                    success: function (response) {
                        $("#billing_state_html").html(response);
                        $(".select2").select2();
                    }
                });
            } else {
                $("#billing_state_html").empty().append('<option value="">Select state...</option>');

            }
        });

        $("#other_country_id").change(function () {
            var country_id = $("#other_country_id option:selected").val();

            if (country_id) {
                $.ajax({
                    url: "{{ url('/getState') }}",
                    type: "POST",
                    data: {
                        "country_id": country_id,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function () { },
                    success: function (response) {
                        $("#other_state_html").html(response);
                        $(".select2").select2();
                    }
                });
            } else {
                $("#other_state_html").empty().append('<option value="">Select state...</option>');

            }
        });

        $("#cont_country_id").change(function () {
            var country_id = $("#cont_country_id option:selected").val();

            if (country_id) {
                $.ajax({
                    url: "{{ url('/getState') }}",
                    type: "POST",
                    data: {
                        "country_id": country_id,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function () { },
                    success: function (response) {
                        $("#cont_state_html").html(response);
                        $(".select2").select2();
                    }
                });
            } else {
                $("#cont_state_html").empty().append('<option value="">Select state...</option>');

            }
        });

        $("#con_billing_country_id").change(function () {
            var country_id = $("#con_billing_country_id option:selected").val();

            if (country_id) {
                $.ajax({
                    url: "{{ url('/getState') }}",
                    type: "POST",
                    data: {
                        "country_id": country_id,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function () { },
                    success: function (response) {
                        $("#con_billing_state_html").html(response);
                        $(".select2").select2();
                    }
                });
            } else {
                $("#con_billing_state_html").empty().append('<option value="">Select state...</option>');

            }
        });

        $("#other_country_id_2").change(function () {
            var country_id = $("#other_country_id_2 option:selected").val();

            if (country_id) {
                $.ajax({
                    url: "{{ url('/getState') }}",
                    type: "POST",
                    data: {
                        "country_id": country_id,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function () { },
                    success: function (response) {
                        $("#other_state_html_2").html(response);
                        $(".select2").select2();
                    }
                });
            } else {
                $("#other_state_html_2").empty().append('<option value="">Select state...</option>');

            }
        });

        $("#state_county").change(function () {
            var state_county = $("#state_county option:selected").val();

            if (state_county) {
                $.ajax({
                    url: "{{ url('/getCity') }}",
                    type: "POST",
                    data: {
                        "state_county": state_county,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function () { },
                    success: function (response) {
                        $("#city_html").html(response);
                        $(".select2").select2();
                    }
                });
            } else {
                $("#city_html").empty().append('<option value="">Select city...</option>');

            }
        });

        $("#hts_rate_method").change(function () {
            var hts_rate_method = $("#hts_rate_method option:selected").val();

            if (hts_rate_method) {
                $.ajax({
                    url: "{{ url('/getHtsRates') }}",
                    type: "POST",
                    data: {
                        "hts_rate_method": hts_rate_method,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function () { },
                    success: function (response) {
                        $("#transportation").html(response);
                        $(".select2").select2();
                    }
                });
            } else {
                $("#transportation").empty().append('<option value="">Select...</option>');

            }
        });

        $('#AddRateId').click(function () {

            var rate_val = $("#rate_val").val();

            $.ajax({
                url: "{{ url('/getRateVal') }}",
                type: "POST",
                data: {
                    "rate_val": rate_val,
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function () { },
                success: function (responseRate) {
                    $("#rateHTMLCal").html(responseRate);
                }
            });
        });

        function getOtherState(id, dropdown) {
            var country_id = dropdown.value;

            if (country_id) {
                $.ajax({
                    url: "{{ url('/getState') }}",
                    type: "POST",
                    data: {
                        "country_id": country_id,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    beforeSend: function () { },
                    success: function (response) {
                        $('#other_state_html_' + id).html(response);
                        $(".select2").select2();
                    }
                });
            } else {
                $('#other_state_html_' + id).empty().append('<option value="">Select state...</option>');

            }
        }

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

        function getpaidproject(client) {
            var client_id = client.value;

            if (client_id) {
                $.ajax({
                    url: "{{ url('/getproject') }}",
                    type: "POST",
                    data: {
                        "client_id": client_id,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function () { },
                    success: function (response) {
                        $("#paid-project-html").html(response);
                        $("#paid-installment-html").empty().append(
                            '<option value="">Select paid installment...</option>');
                    }
                });
            } else {
                $("#paid-project-html").empty().append('<option value="">Select project...</option>');

            }
        }

        function getpaidinstallment(project) {
            var project_id = project.value;

            if (project_id) {
                $.ajax({
                    url: "{{ url('/getpaidinstallment') }}",
                    type: "POST",
                    data: {
                        "project_id": project_id,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function () { },
                    success: function (response) {
                        $("#paid-installment-html").html(response);
                    }
                });
            } else {
                $("#paid-installment-html").empty().append('<option value="">Select project...</option>');

            }
        }
    </script>

    <script>
        function getEmailAddress(email, id) {
            $('#usremail-' + id).val(email.value);
        }

        var Password = {

            _pattern: /[a-zA-Z0-9_\-\+\.]/,


            _getRandomByte: function () {
                // http://caniuse.com/#feat=getrandomvalues
                if (window.crypto && window.crypto.getRandomValues) {
                    var result = new Uint8Array(1);
                    window.crypto.getRandomValues(result);
                    return result[0];
                } else if (window.msCrypto && window.msCrypto.getRandomValues) {
                    var result = new Uint8Array(1);
                    window.msCrypto.getRandomValues(result);
                    return result[0];
                } else {
                    return Math.floor(Math.random() * 256);
                }
            },

            generate: function (length) {
                return Array.apply(null, {
                    'length': length
                })
                    .map(function () {
                        var result;
                        while (true) {
                            result = String.fromCharCode(this._getRandomByte());
                            if (this._pattern.test(result)) {
                                return result;
                            }
                        }
                    }, this)
                    .join('');
            }

        };

        function openUsrModel(id) {

            $('#usrModal-' + id).modal('show');

            $('#mailwrk-' + id).hide();
            $('#mailwrk-' + id).text("");

            $('#usremail-' + id).val("");
            $('#usrPassword-' + id).val("");
            $('#usrAllEmail-' + id).prop('selectedIndex', 0);
        }

        function submitUsrModel(id) {

            $('#usrModal-' + id).modal('show');

            $('#mailwrk-' + id).hide();
            $('#mailwrk-' + id).text("");

            var email = $('#usremail-' + id).val();
            var password = $('#usrPassword-' + id).val();
            // var cpassword = $('#usrCPassword-' + id).val();
            var userId = $('#usrId-' + id).val();

            if (email == "") {
                $('#mailwrk-' + id).show();
                $('#mailwrk-' + id).html(
                    '<div class="alert alert-danger alert-dismissible"><b>Email is not empty</b></div>'
                );
                return false;
            }

            if (IsEmail(email) == false) {
                $('#mailwrk-' + id).show();
                $('#mailwrk-' + id).html(
                    '<div class="alert alert-danger alert-dismissible"><b>Enter a valid email address</b></div>'
                );
                return false;
            }

            if (password == "") {
                $('#mailwrk-' + id).show();
                $('#mailwrk-' + id).html(
                    '<div class="alert alert-danger alert-dismissible"><b>Password is not empty</b></div>'
                );
                return false;
            }

            if (email != '' && password != '' && userId != '') {
                $.ajax({
                    url: "{{ url('/login-credentials') }}",
                    type: "POST",
                    data: {
                        "email": email,
                        "password": password,
                        "userId": userId,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function () {
                        $('#loader-' + id).css('display', 'inline-block');

                        $('#sendCredentials-' + id).prop('disabled', true);
                        $('#sendCredentials-' + id).css({
                            'cursor': 'no-drop'
                        });
                    },
                    success: function (data) {
                        $('#loader-' + id).hide();

                        $('#sendCredentials-' + id).prop('disabled', false);
                        $('#sendCredentials-' + id).css({
                            'cursor': 'pointer'
                        });

                        $('#mailwrk-' + id).show();

                        if (data == "1") {
                            $('#usremail-' + id).val("");
                            $('#usrPassword-' + id).val("");
                            $('#usrAllEmail-' + id).prop('selectedIndex', 0);
                            $('#mailwrk-' + id).html(
                                '<div class="alert alert-success alert-dismissible"><b>Login Credentials sent successfully!</b></div>'
                            );
                        } else {
                            $('#usremail-' + id).val("");
                            $('#usrPassword-' + id).val("");
                            $('#usrAllEmail-' + id).prop('selectedIndex', 0);
                            $('#mailwrk-' + id).html(
                                '<div class="alert alert-danger alert-dismissible"><b>Login Credentials Not Sent!</b></div>'
                            );
                        }
                    }
                });
            }
        }

        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script>
        $(document).ready(function () {
            $('.table-radio').on('change', function () {
                $('.table-radio').prop('checked', false);
                $(this).prop('checked', true);
            });

            $('tr').on('click', function () {
                $(this).find('.table-radio').prop('checked', true);
                $('#airline_code').val($(".clsGender:checked").val());
                $('#airline_prefix').val($(".clsGenderFL:checked").val());
            });

        });

        function oceanModalOpen() {
            $('#addOceanCode').modal('show');
            var fmc_number_src = $("#fmc_number_src").val();
            $('#fmc_number').val(fmc_number_src);
        }

        function airlineCodeModalOpen() {
            $('#airlineCodeMD').modal('show');
        }

        function airlinePrefixModalOpen() {
            $('#airlineCodeFL').modal('show');
        }


        $(document).ready(function () {
            $('#participation_type').change(function () {
                var selectedOption = $(this).val();

                if (selectedOption == 'Shipment Participation') {
                    $('#contentparticipation').show();
                    $('#chargeParticipation').hide();
                } else {
                    $('#contentparticipation').hide();
                    $('#chargeParticipation').show();
                }
            });
        });
    </script>

</body>

</html>