<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Goigi Customer Panel | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.png') }}" type="image/x-icon" />

    <link href="" rel="stylesheet">

    <link href="{{ asset('/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

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
                        <a href="" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('/assets/images/goigi-logo.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('/assets/images/goigi-logo.png') }}" alt="" height="20" style="height: 32px;">
                            </span>
                        </a>
                        <a href="" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('/assets/images/logo-white.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('/assets/images/logo-white.png') }}" alt="" height="20" style="height: 32px;">
                            </span>
                        </a>
                    </div>
                    <button type="button"
                        class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="ri-search-line"></span>
                        </div>
                    </form>
                </div>
                <div class="d-flex">
                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-search-line"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">
                            <form class="p-3">
                                <div class="mb-3 m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="ri-search-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            data-bs-toggle="fullscreen">
                            <i class="ri-fullscreen-line"></i>
                        </button>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-notification-3-line"></i>
                            <span class="noti-dot"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#!" class="small"> View All</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">

                                <a href="#" class="text-reset notification-item">
                                    <div class="d-flex align-items-center m-0">
                                        <div class="avatar-xs me-3 mt-1">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="ri-checkbox-circle-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 text-truncate">
                                            <h6 class="mt-0 mb-1">Project Assigned <span
                                                    class="mb-1 text-muted fw-normal">Your project Assigned to
                                                    Developer</span>
                                            </h6>
                                            <p class="mb-0 font-size-12"><i class="mdi mdi-clock-outline"></i> 3 min
                                                ago</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="text-reset notification-item">
                                    <div class="d-flex align-items-center m-0">
                                        <div class="avatar-xs me-3 mt-1">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="ri-checkbox-circle-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 text-truncate">
                                            <h6 class="mt-0 mb-1">Project Completed <span
                                                    class="mb-1 text-muted fw-normal">Your project Assigned to
                                                    Developer</span>
                                            </h6>
                                            <p class="mb-0 font-size-12"><i class="mdi mdi-clock-outline"></i> 3 min
                                                ago</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block user-dropdown">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{ asset('/assets/images/users/avatar-2.jpg') }}"
                                alt="Header Avatar">
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0">Hi, {{Session::get('userName')}}(CI14545)</h6>
                                        <p class="mb-0"><a href="#" class="text-secondary font-size-12"
                                                data-bs-toggle="modal" data-bs-target="#lastloginModal">Last Login:
                                                10-08-2022, 10:50am</a></p>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                <!-- item-->
                                <a href="{{route('profile')}}" class="text-reset notification-item">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-3 mt-1">
                                            <span class="avatar-title bg-soft-primary rounded-circle font-size-16">
                                                <i class="ri-user-line text-primary font-size-16"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 text-truncate">
                                            <h6 class="mb-1">Profile</h6>
                                            <p class="mb-0 font-size-12">View personal profile details.</p>
                                        </div>
                                    </div>
                                </a>
                                <!-- item-->
                                <a href="index.php" class="text-reset notification-item">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-3 mt-1">
                                            <span class="avatar-title bg-soft-primary rounded-circle font-size-16">
                                                <i class="ri-wallet-2-line text-primary font-size-16"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 text-truncate">
                                            <h6 class="mb-1">My Projects</h6>
                                            <p class="mb-0 font-size-12">Check Project details.</p>
                                        </div>
                                    </div>
                                </a>
                                <!-- item-->
                                <a href="#" class="text-reset notification-item">
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
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ route('logout') }}">
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
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('/assets/images/goigi-logo.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/assets/images/goigi-logo.png') }}" alt="" height="22" style="height: 32px;">
                    </span>
                </a>
                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('/assets/images/logo-white.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/assets/images/logo-white.png') }}" alt="" height="22" style="height: 32px;">
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
                        <li><a href="{{ route('home') }}" class="waves-effect"><i class="fas fa-home"></i> Dashboard</a></li>
                        
                        @foreach ($type as $v)

                        <li><a href="<?php echo url('/'); ?>/dashboard/{{$v->name}}" class="waves-effect"><i class="fas fa-{{$v->icon}}"></i> {{$v->name}}</a></li>

                        @endforeach
                        <!-- <li><a href="web-development.php" class="waves-effect"><i class="fas fa-code"></i> Web
                                Development</a></li>
                        <li><a href="#" class="waves-effect"><i class="fas fa-mobile-alt"></i> Mobile
                                Development</a></li>
                        <li><a href="#" class="waves-effect"><i class="fas fa-laptop-code"></i> Software
                                Development</a></li>
                        <li><a href="#" class="waves-effect"><i class="fas fa-hashtag"></i> Digital
                                Marketing</a></li>
                        <li><a href="#" class="waves-effect"><i class="far fa-smile"></i> Hire Resources</a>
                        </li> -->
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
                            &copy; 2022 Goigi. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <!-- END layout-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="lastloginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="lastloginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-0 border-primary">
                <div class="modal-header py-2 bg-primary rounded-0">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Last Login Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Device IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>12-08-2022</td>
                                <td>10:55 am</td>
                                <td>121.125.125.522</td>
                            </tr>
                            <tr>
                                <td>12-08-2022</td>
                                <td>10:55 am</td>
                                <td>121.125.125.522</td>
                            </tr>
                            <tr>
                                <td>12-08-2022</td>
                                <td>10:55 am</td>
                                <td>121.125.125.522</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
    <script src="{{ asset('/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
    </script>
    <script src="{{ asset('/assets/js/pages/dashboard.init.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('assets/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js" type="text/javascript"></script>
    <script src="{{ asset('/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
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
        $(document).ready(function() {
            // $('#example').DataTable();
            $('#example').DataTable({
                aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 100
                // responsive: {
                //     details: false
                // }
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
            }, function(isConfirm) {
                if (isConfirm) {
                    return true;
                } else {
                    return false
                }
            });
        }
    </script>

    <?php if (!empty(Session::get('msg'))) : ?>
    <?php if (Session::get('msg') == 'error') { ?>
    <script>
        alert_func(["Some error occured, Please try again!", "error", "#DD6B55"]);
    </script>
    <?php } else { ?>
    <script>
        alert_func(<?= Session::get('msg') ?>);
    </script>
    <?php } ?>
    <?php endif ?>

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
        $(document).ready(function() {
            // alert("kkk");
        });
        $(function() {
            $.validator.setDefaults({
                submitHandler: function() {
                    return true;
                }
            });

            $.validator.addMethod("ssn_validate", function(value, element) {
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
                    phoneNumber: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
                    ssn_number: {
                        required: true,
                        ssn_validate: true
                    },
                    phone: {
                        required: true,
                        number: true
                    },
                    sender_subject: {
                        required: true
                    },
                    sender_descriptions: {
                        required: true
                    },
                    sender_files: {
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
                    phoneNumber: {
                        required: "Please enter an valid phone number"
                    },
                    first_name: {
                        required: "Please enter first name"
                    },
                    last_name: {
                        required: "Please enter last name"
                    },
                    ssn_number: {
                        required: "Please enter ssn number"
                    },
                    phone: {
                        required: "Please provide a password"
                    },
                    sender_subject: {
                        required: "Please enter a subject"
                    },
                    sender_descriptions: {
                        required: "Please enter a message"
                    },
                    sender_files: {
                        required: "Please upload a document"
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        function getNotificationId(id) {
            $('#notification_id').val(id);
        }

        $('#ssn_number').mask('000-00-0000');
    </script>
    <script>
        $(function() {
            $('.notifi-btn').click(function() {
                $('.notification-menu').toggle();
            });
        });

        $(".alert").delay(7000).fadeOut(1500);
    </script>


<script type="text/javascript">
   function readprofile(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $('#profileIMG')
                   .attr('src', e.target.result);
           };

           reader.readAsDataURL(input.files[0]);
       }
   }
</script>


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
                first_name: {
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
                first_name: {
                    required: "Please enter first name"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                // console.log(form.action);
                return true;

            }

        });
    </script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script>
    //getPDF();
    function getPDF(){//alert("vbnvbv");

var HTML_Width = $(".canvas_div_pdf").width();
var HTML_Height = $(".canvas_div_pdf").height();
var top_left_margin = 15;
var PDF_Width = HTML_Width+(top_left_margin*2);
var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
var canvas_image_width = HTML_Width;
var canvas_image_height = HTML_Height;

var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;


html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
    canvas.getContext('2d');
    
    console.log(canvas.height+"  "+canvas.width);
    
    
    var imgData = canvas.toDataURL("image/jpeg", 1.0);
    var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
    
    
    for (var i = 1; i <= totalPDFPages; i++) { 
        pdf.addPage(PDF_Width, PDF_Height);
        pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
    }
    
    pdf.save("ivoice-detail.pdf");
});
};
</script>


</body>

</html>
