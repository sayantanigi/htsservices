<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HTS Services, Inc. | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('/admin-assets/images/favicon.png') }}" type="image/x-icon" />

    <link href="" rel="stylesheet">

    <link href="{{ asset('/admin-assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/admin-assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/admin-assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/admin-assets/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin-assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg d-flex align-items-center min-vh-100 py-5">

    @yield('content')

    <!-- JAVASCRIPT -->
    <script src="{{ asset('/admin-assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
    </script>
    <script src="{{ asset('/admin-assets/js/pages/dashboard.init.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('/admin-assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('/admin-assets/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('/admin-assets/js/app.js') }}"></script>


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
                    company: {
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
                    // phone: {
                    //     required: "Please provide a password"
                    // },
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

</body>

</html>
