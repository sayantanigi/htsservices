<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>SearchUP | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/fonts.css') }}">
    <link rel="stylesheet"
        href="{{ $theme == 'dark' ? asset('/assets/css/style.css') : asset('/assets/css/style-2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <!-- Preloader-->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-dot"></div>
            <div class="preloader-dot"></div>
            <div class="preloader-dot"></div>
            <div class="preloader-dot"></div>
        </div>
    </div>
    <div class="page">
        <!--RD Navbar-->
        <header class="section rd-navbar-wrap">
            <nav class="rd-navbar">
                <div class="navbar-container">
                    <div class="navbar-cell">
                        <div class="navbar-panel">
                            <button class="navbar-switch"
                                data-multi-switch='{"targets":".rd-navbar","scope":".rd-navbar","isolate":"[data-multi-switch]"}'></button>
                            <div class="navbar-logo"><a class="navbar-logo-link" href="{{ url('/') }}">
                                    <img class="navbar-logo-default" src="{{ asset('/assets/images/logo.png') }}"
                                        alt="SearchUP" width="200" height="60" loading="lazy" />
                                    <img class="navbar-logo-inverse" src="{{ asset('/assets/images/logo.png') }}"
                                        alt="SearchUP" width="200" height="60" loading="lazy" /></a></div>
                        </div>
                    </div>
                    <div class="navbar-spacer"></div>
                    <div class="navbar-cell navbar-sidebar">
                        <ul class="navbar-navigation rd-navbar-nav fullpage-navigation">
                            <li
                                class="navbar-navigation-root-item {{ \Request::route()->getName() == '' ? 'active' : '' }}">
                                <a class="navbar-navigation-root-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li
                                class="navbar-navigation-root-item {{ \Request::route()->getName() == 'about' ? 'active' : '' }}">
                                <a class="navbar-navigation-root-link" href="{{ route('about') }}">About</a>
                                {{-- <li class="navbar-navigation-root-item {{ (\Request::route()->getName() == 'benefits') ? 'active' : '' }}"><a class="navbar-navigation-root-link"
                                    href="{{ route('benefits') }}">Benefits</a></li>
                                <li class="navbar-navigation-root-item {{ (\Request::route()->getName() == 'referral') ? 'active' : '' }}"><a class="navbar-navigation-root-link"
                                    href="javascript:void(0);">Referral</a></li>
                                <li class="navbar-navigation-root-item {{ (\Request::route()->getName() == 'map') ? 'active' : '' }}"><a class="navbar-navigation-root-link" href="javascript:void(0);">MAP</a>
                                </li> --}}
                            <li
                                class="navbar-navigation-root-item {{ \Request::route()->getName() == 'help' ? 'active' : '' }}">
                                <a class="navbar-navigation-root-link" href="{{ route('help') }}">Help</a>
                            </li>
                            @guest
                                <li class="navbar-navigation-root-item px-1">
                                    <a class="btn btn-sm" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="navbar-navigation-root-item px-1">
                                    <a class="btn btn-sm" href="{{ route('register') }}">Register</a>
                                </li>
                            @else
                                <!-- <li class="navbar-navigation-root-item px-1">
                                    <a class="navbar-navigation-root-link" href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="navbar-navigation-root-item px-1">
                                    <a class="btn btn-sm" href="{{ route('profile') }}">Profile</a>
                                </li>

                                <li class="navbar-navigation-root-item px-1">
                                    <a class="btn btn-sm" href="{{ route('logout') }}">Logout</a>
                                </li> -->

                                 <li class="navbar-navigation-root-item px-1 dropdown navprofile">
                                    <button class="btn btn-sm dropdown-toggle px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if(@Auth::user()->profile_image && file_exists( 'public/uploads/users/'.Auth::user()->profile_image))
                                            <img src="{{ asset('/uploads/users/'.Auth::user()->profile_image) }}" class="navprofileimg" alt="" />
                                        @else
                                            <img src="{{ asset('/assets/images/about-vector.png') }}" class="navprofileimg" alt="" />
                                        @endif
                                     Hi, {{ Auth::user()->fname }}
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-power-off"></i>  Logout</a></li>
                                  </ul>
                                 </li>

                            @endguest

                        </ul>
                    </div>
                    {{-- <div class="navbar-cell">
                        <div class="navbar-subpanel">
                            <div class="navbar-subpanel-item">
                                <button class="navbar-button navbar-info-button mdi-dots-vertical"
                                    data-multi-switch='{"targets":".rd-navbar","scope":".rd-navbar","class":"navbar-info-active","isolate":"[data-multi-switch]"}'></button>
                                <div class="navbar-info">
                                    @guest
                                        <button class="btn btn-sm" data-modal-trigger='{"target":"#modal-login"}'>Login/Signup</button>
                                    @else
                                        <a class="btn btn-sm" href="{{ url('dashboard') }}">Dashboard</a>
                                        <a class="btn btn-sm mt-0" href="{{ route('logout') }}">Logout</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </nav>
        </header>
        <!-- Intro-->

        @yield('content')

        <!-- Get in touch-->

    </div>
    <!-- Start Footer Area -->
    <div class="rn-footer-area rn-section-gap section-separator">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-area text-center">

                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('/assets/images/logo.png') }}" alt="logo">
                            </a>
                        </div>

                        <p class="description mt--30">SearchUP © 2022. All rights reserved. <a
                                href="{{ route('privacy-policy') }}">Privacy Policy</a>
                            and <a href="{{ route('terms-conditions') }}">Terms and Conditions</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Area -->
    <!-- Modal-->
    <div class="modal fade" id="modal-login" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3>Log In</h3>
                    <div id="email-error-html"></div>
                    <div id="show_error" style="color: red"> </div>
                    <form class="rd-mailform" action="{{ route('login') }}" method="POST" id="loginForm">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" id="usr_email"
                                placeholder="Emaill Address *">
                            <span class="text-danger error-text email_error" style="color: red"></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="password" id="usr_password"
                                placeholder="******">
                            <span class="text-danger error-text password_error" style="color: red"></span>
                        </div>
                        <div class="offset-xxs group-40 d-flex flex-wrap flex-xs-nowrap align-items-center">
                            <button class="btn btn-block" type="submit">Log in</button>
                        </div>
                        <div class="text-center">
                            <p class="mt-3"><a href="">Forgot Password?</a></p>
                            <p class="mt-0">Don't have an Account? <a href="{{ route('register') }}">Register
                                    Now</a></p>
                        </div>
                    </form>
                </div>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="termBackdrop" tabindex="-1" keyboard="false" backdrop="static" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3 style="text-align: left;">Terms & Conditions</h3>
                    <p style="text-align: left;">It is a long established fact that a reader will be distracted by the
                        readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it
                        has a more-or-less normal distribution of letters, as opposed to using 'Content here, content
                        here', making it look like readable English. Many desktop publishing packages and web page
                        editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will
                        uncover many web sites still in their infancy. Various versions have evolved over the years,
                        sometimes by accident, sometimes on purpose (injected humour and the like).

                    </p>
                    <p style="text-align: left;">It is a long established fact that a reader will be distracted by the
                        readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it
                        has a more-or-less normal distribution of letters, as opposed to using 'Content here, content
                        here', making it look like readable English. Many desktop publishing packages and web page
                        editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will
                        uncover many web sites still in their infancy. Various versions have evolved over the years,
                        sometimes by accident, sometimes on purpose (injected humour and the like).

                    </p>
                    <p>
                        <label class="btn btn-success"><input type="checkbox" name="termaccept" id="termaccept"
                                value="1" style="margin-right: 3px;"> Accept</label>
                    </p>

                </div>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
        </div>
    </div>


    <div class="mode-opt">
        <div class="btn-group btn-group-toggle">
            {{-- 1St Set the below code:
      App\providers/appserviceproviders.php under boot Functions

      view()->composer('layouts.app', function ($view) {
          $theme = \Cookie::get('theme');
          if ($theme != 'dark' && $theme != 'light') {
              $theme = 'light';
          }
      
          $view->with('theme', $theme);
      });

      2nd Step go to App\HTTP\Middleware\EncryptCookie.php and add 'theme' under protected $except = [ --}}

            @if (\Request::route()->getName() == '')
                <button type="button" id="css_toggle" class="btn pr-4 pl-4 b-0"
                    title="{{ $theme == 'dark' ? 'Light Mode' : 'Dark Mode' }}"
                    value="{{ $theme == 'dark' ? 'Light mode' : 'Dark mode' }}">{{ $theme == 'dark' ? 'Light Mode' : 'Dark Mode' }}</button>
            @else
            @endif
        </div>
    </div>
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

        .truncate {
            width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .clearsearch{
            position: absolute;
            right: 10px;
            top: 13px;
            font-size: 18px;
        }

        /* .sweet-alert {
            border-radius: 5px;
        } */
    </style>

    <script src="{{ asset('/assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('/assets/js/core.min.js') }}"></script>
    <script src="{{ asset('/assets/js/script.js') }}"></script>
    <script src="{{ asset('/admin-assets/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#dt_table').DataTable();
        });
    </script> --}}

    <script>
        function alert_func(data) {
            swal({
                title: data[0],
                type: data[1],
                confirmButtonColor: data[2]
            });
        }

        function swal_msg(message) {
            swal({
                title: message,
                type: 'success',
                confirmButtonColor: '#A5DC86'
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

    @if (\Session::has('success'))
        <script>
            swal_msg('{{ \Session::get('success') }}');
        </script>
        {{ \Session::forget('success') }}
    @endif

    @if (\Session::has('error'))
        <script>
            alert_func(["Some error occured, Please try again!", "error", "#DD6B55"]);
        </script>
        {{ \Session::forget('error') }}
    @endif

    <script>
        // DOM Elements
        const tabs = document.querySelectorAll('.tab')
        const tabContents = document.querySelectorAll('.tabcontent')
        const darkModeSwitch = document.querySelector('#dark-mode-switch')

        // Functions
        const activateTab = tabnum => {

            tabs.forEach(tab => {
                tab.classList.remove('active')
            })

            tabContents.forEach(tabContent => {
                tabContent.classList.remove('active')
            })

            document.querySelector('#tab' + tabnum).classList.add('active')
            document.querySelector('#tabcontent' + tabnum).classList.add('active')
            localStorage.setItem('jstabs-opentab', JSON.stringify(tabnum))

        }

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                activateTab(tab.dataset.tab)
            })
        })

        darkModeSwitch.addEventListener('change', () => {
            document.querySelector('body').classList.toggle('darkmode')
            localStorage.setItem('jstabs-darkmode', JSON.stringify(!darkmode))
        })

        let darkmode = JSON.parse(localStorage.getItem('jstabs-darkmode'))
        const opentab = JSON.parse(localStorage.getItem('jstabs-opentab')) || '3'

        if (darkmode === null) {
            darkmode = window.matchMedia("(prefers-color-scheme: dark)").matches
        }
        if (darkmode) {
            document.querySelector('body').classList.add('darkmode')
            document.querySelector('#dark-mode-switch').checked = 'checked'
        }
        activateTab(opentab)
    </script>
    <script>
        var path = "{{ asset('/assets/css') }}";

        $('#css_toggle').on('click', function() {
            if ($(this).val() === "Dark mode") {
                $('link[href*="style-2.css"]').attr('href', path + '/style.css');
                $("#css_toggle").text('Light mode');
                $("#css_toggle").val('Light mode');

                setCookie('theme', 'dark');
            } else {

                $('link[href*="style.css"]').attr('href', path + '/style-2.css');
                $("#css_toggle").text('Dark mode');
                $("#css_toggle").val('Dark mode');

                setCookie('theme', 'light');
            }
        });
    </script>

    <script>
        function setCookie(name, value) {
            var d = new Date();
            d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/";
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#termaccept').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#terms_accept').prop('checked', true);
                    $('#termBackdrop').modal('hide');
                } else if ($(this).prop("checked") == false) {
                    $('#terms_accept').prop('checked', false);
                    $('#termBackdrop').modal('hide');
                }
            });

            $('#terms_accept').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#termaccept').prop('checked', true);
                } else if ($(this).prop("checked") == false) {
                    $('#termaccept').prop('checked', false);
                }
            });
        });

        $(document).ready(function() {
            $('#termacceptads').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#terms_accept_ads').prop('checked', true);
                    $('#termBackdropAds').modal('hide');
                } else if ($(this).prop("checked") == false) {
                    $('#terms_accept_ads').prop('checked', false);
                    $('#termBackdropAds').modal('hide');
                }
            });

            $('#terms_accept_ads').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#termacceptads').prop('checked', true);
                } else if ($(this).prop("checked") == false) {
                    $('#termacceptads').prop('checked', false);
                }
            });
        });

        $(document).ready(function() {
            $('#termaccepttags').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#terms_accept_tags').prop('checked', true);
                    $('#termBackdropTags').modal('hide');
                } else if ($(this).prop("checked") == false) {
                    $('#terms_accept_tags').prop('checked', false);
                    $('#termBackdropTags').modal('hide');
                }
            });

            $('#terms_accept_tags').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#termaccepttags').prop('checked', true);
                } else if ($(this).prop("checked") == false) {
                    $('#termaccepttags').prop('checked', false);
                }
            });
        });
    </script>

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

            $('#registrationForm').validate({
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
                    fname: {
                        required: true
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        // number: true
                    },
                    terms_accept: {
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
                    fname: {
                        required: "Please enter first name"
                    },
                    terms_accept: {
                        required: "Please accept the terms & conditions"
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
    </script>

    <script>
        $("#profileForm").validate({
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
                fname: {
                    required: true
                },
                phone: {
                    required: true,
                    minlength: 10,
                    // number: true
                },
                terms_accept: {
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
                fname: {
                    required: "Please enter first name"
                },
                terms_accept: {
                    required: "Please accept the terms & conditions"
                },
            },
            submitHandler: function() {

                return true;
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
    </script>

    <script>
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
            },
            messages: {
                email: {
                    required: "Please enter a email",
                    email: "Please enter valid email"
                },
                password: {
                    required: "Please enter a password",
                },
                password_confirmation: {
                    required: "Please provide a Confirm password",
                    minlength: "Your password must be at least 6 characters long"
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
            submitHandler: function() {

                return true;
            }

        });
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

    <script>
        $("#formValidation").validate({
            rules: {
                ads_name: {
                    required: true,
                },
                ads_url: {
                    required: true,
                    url: true,
                },
                ads_descriptions: {
                    required: true,
                },
                amount: {
                    required: true,
                    number: true
                },
            },
            messages: {
                ads_name: {
                    required: "Please enter a ads name"
                },
                ads_url: {
                    required: "Please enter a valid URL in the following format: https://www.searchup.com",
                },
                ads_descriptions: {
                    required: "Please enter a ads descriptions",
                },
                amount: {
                    required: "Please enter a amount",
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
            submitHandler: function() {

                return true;
            }

        });
    </script>

    <script>
        $("#formTagsValidation").validate({
            rules: {
                posting_type: {
                    required: true,
                },
            },
            messages: {
                posting_type: {
                    required: "Please choose Cost of posting",
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
                var keyword = $("#keyword").val().trim();

                $.ajax({
                    url: "{{ url('/save-tags') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: $("#formTagsValidation").serialize(),
                    // data: {
                    //     "formData": $("#formTagsValidation").serialize(),
                    //     _token: '{{ csrf_token() }}'
                    // },
                    beforeSend: function() {
                        $.blockUI({
                            message: "<img src='{{ asset('/assets/images/loader.gif') }}' />",
                            css: {
                                backgroundColor: 'rgb(255 0 0 / 0%)',
                                border: '0'
                            }
                        });
                    },
                    success: function(response) {
                        // $("#tag-list-html").html(response);
                        $.unblockUI();
                        taglist();
                        $("#exampleModal").modal('hide');
                        myArr = JSON.parse(response);
                        toastr.success(myArr[0], '', {
                            timeOut: 5000,
                            // progressBar: true,
                            closeButton: true
                        });
                        // alert_func(myArr);
                        // location.reload();
                    }
                });
            }

        });

        $("#formTagsEditValidation").validate({
            rules: {
                posting_type: {
                    required: true,
                },
            },
            messages: {
                posting_type: {
                    required: "Please choose Cost of posting",
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
                var keyword = $("#keyword").val().trim();

                $.ajax({
                    url: "{{ url('/save-edit-tags') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: $("#formTagsEditValidation").serialize(),
                    // data: {
                    //     "formData": $("#formTagsValidation").serialize(),
                    //     _token: '{{ csrf_token() }}'
                    // },
                    beforeSend: function() {
                        $.blockUI({
                            message: "<img src='{{ asset('/assets/images/loader.gif') }}' />",
                            css: {
                                backgroundColor: 'rgb(255 0 0 / 0%)',
                                border: '0'
                            }
                        });
                    },
                    success: function(response) {
                        // $("#tag-list-html").html(response);
                        $.unblockUI();
                        taglist();
                        $("#exampleEditModal").modal('hide');
                        myArr = JSON.parse(response);

                        toastr.success(myArr[0], '', {
                            timeOut: 5000,
                            // progressBar: true,
                            closeButton: true
                        });
                        // alert_func(myArr);
                        // location.reload();
                    }
                });
            }

        });
    </script>

    <script>
        $("#loginAjaxForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
            },
            messages: {
                email: {
                    required: "Please enter a email",
                    email: "Please enter valid email"
                },
                password: {
                    required: "Please enter a password",
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
                var email = $("#usr_email").val();
                var password = $("#usr_password").val();

                $.ajax({
                    url: "{{ route('login') }}",
                    type: "POST",
                    data: {
                        "email": email,
                        "password": password,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        if (response == "1") {
                            $('#email-error-html').show();
                            var message = "You are Logged In!";
                            $('#email-error-html').html(
                                '<div class="alert alert-success alert-dismissible mt-3" role="alert">' +
                                message +
                                '<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                            );

                            // window.location.href = "{{ route('dashboard') }}";
                            window.location.replace(
                                '{{ route('dashboard') }}'
                            );
                        } else {
                            $("#email-error-html").show();

                            var message = "Email/Password is invalid!";
                            $('#email-error-html').html(
                                '<div class="alert alert-danger alert-dismissible mt-3" role="alert">' +
                                message +
                                '<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                            );
                        }
                    }
                });
            }

        });
    </script>

    <script>
        $(function() {
            $('#eye').click(function() {

                if ($(this).hasClass('fa-eye-slash')) {
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                    $('#password').attr('type', 'text');

                } else {
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                    $('#password').attr('type', 'password');
                }
            });

            $('#eye2').click(function() {

                if ($(this).hasClass('fa-eye-slash')) {
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                    $('#confirm_password').attr('type', 'text');

                } else {
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                    $('#confirm_password').attr('type', 'password');
                }
            });
        });
    </script>

    <script>
        function isJSON(object) {
            if (typeof object != 'string')
                object = JSON.stringify(object);

            try {
                JSON.parse(object);
                return true;
            } catch (e) {
                return false;
            }
        }

        function isJsonString(str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }

        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        $('#add-tags').click(function() {

            var keyword = $("#keyword").val().trim();
            $("#jx-keyword-error").hide();
            $("#keyword").removeClass("is-invalid");
            $('#tagsHTML').empty();

            if (keyword == "") {
                $("#jx-keyword-error").show();
                $("#jx-keyword-error").text("Please enter a keyword");
                $("#keyword").addClass("is-invalid");
            }

            if (keyword) {
                $.ajax({
                    url: "{{ url('/add-tags') }}",
                    type: "POST",
                    data: {
                        "keyword": keyword,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $.blockUI({
                            // message: "<h4>Just a moment...<h4>",
                            message: "<img src='{{ asset('/assets/images/loader.gif') }}' />",
                            css: {
                                backgroundColor: 'rgb(255 0 0 / 0%)',
                                border: '0'
                            }
                            // css: {
                            //     color: '#048700',
                            //     borderColor: '#048700',
                            //     // backgroundColor: '#f00'
                            // }
                        });
                    },
                    success: function(response) {
                        // var myArr = JSON.parse(response);

                        if (isJSON(response)) {
                            var myArr = JSON.parse(response);
                            // alert_func(myArr);
                            toastr.success(myArr[0], '', {
                            timeOut: 5000,
                            // progressBar: true,
                            closeButton: true
                        });
                            $("#jx-keyword-error").show();
                            $("#jx-keyword-error").text(myArr[0]);
                            $("#keyword").addClass("is-invalid");
                            $.unblockUI();
                        } else {
                            $('#tagsHTML').show();
                            $("#tagsHTML").html(response);
                            $.unblockUI();
                        }
                        // location.reload();
                    }
                });
            }
        });

        $('#add-tags-edit').click(function() {
        //$("#keyword-edt").keyup(function(){

            var keyword = $("#keyword-edt").val().trim();
            $("#jx-keyword-error2").hide();
            $("#keyword-edt").removeClass("is-invalid");
            $('#editTagsHTML').empty();

            if (keyword == "") {
                $("#jx-keyword-error2").show();
                $("#jx-keyword-error2").text("Please enter a keyword");
                $("#keyword-edt").addClass("is-invalid");
            }

            if (keyword) {
                $.ajax({
                    url: "{{ url('/add-edit-tags') }}",
                    type: "POST",
                    data: {
                        "keyword": keyword,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $.blockUI({
                            message: "<img src='{{ asset('/assets/images/loader.gif') }}' />",
                            css: {
                                backgroundColor: 'rgb(255 0 0 / 0%)',
                                border: '0'
                            }
                        });
                    },
                    success: function(response) {

                        if (isJSON(response)) {
                            var myArr = JSON.parse(response);
                            // alert_func(myArr);
                            toastr.success(myArr[0], '', {
                                timeOut: 5000,
                                // progressBar: true,
                                closeButton: true
                            });
                            $("#jx-keyword-error2").show();
                            $("#jx-keyword-error2").text(myArr[0]);
                            $("#keyword-edt").addClass("is-invalid");
                            $.unblockUI();
                        } else {
                            $('#editTagsHTML').show();
                            $("#editTagsHTML").html(response);
                            $.unblockUI();
                        }
                    }
                });
            }
        });

        $("#keyword-edt").keyup(function(){
            $('#editTagsHTML').empty();
        });
            

        $('#tagModal').click(function() {
            $("#exampleModal").modal('show');
            $("#keyword").val('');
            $("#keyword").focus();
            $(".radioClass").prop('checked', false);
            $("#terms_accept_tags").prop('checked', false);
            $('#tagsHTML').hide();
        });

        function taglist() {
            $.ajax({
                url: "{{ url('/tag-list') }}",
                type: "GET",
                beforeSend: function() {},
                success: function(resp) {
                    $("#tag-list-html").html(resp);
                    $("#ads-submit-HTML").show();
                }
            });
        }

        $('.clearsearch').click(function() {
            $(".clrTxt").val('');
        });

        function deleteTag(id) {
            swal({
                title: 'Are You sure want to delete this tag?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = 'delete-tags/' + id
                    // deleteSingleTag(id);
                }
            });
        }

        function editTag(id, keyword) {

            $("#exampleEditModal").modal('show');
            $("#keyword-edt").val(keyword);
            
            if (id!='' && keyword!='') {
                $.ajax({
                    url: "{{ url('/edit-tags') }}",
                    type: "POST",
                    data: {
                        "keyword": keyword,
                        "id": id,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $.blockUI({
                            message: "<img src='{{ asset('/assets/images/loader.gif') }}' />",
                            css: {
                                backgroundColor: 'rgb(255 0 0 / 0%)',
                                border: '0'
                            }
                        });
                    },
                    success: function(response) {
                        $('#editTagsHTML').show();
                        $("#editTagsHTML").html(response);
                        $.unblockUI();
                    }
                });
            }
        }

        function deleteAds(id) {
            swal({
                title: 'Are You sure want to delete this ads and all tags?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A5DC86',
                cancelButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location.href = 'delete-ads/' + id
                    // deleteSingleTag(id);
                }
            });
        }

        function deleteSingleTag(id) {
            if (id) {
                $.ajax({
                    url: "{{ url('/delete-tags') }}",
                    type: "POST",
                    data: {
                        "id": id,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $.blockUI({
                            // message: "<h4>Just a moment...<h4>",
                            message: "<img src='{{ asset('/assets/images/loader.gif') }}' />",
                            css: {
                                backgroundColor: 'rgb(255 0 0 / 0%)',
                                border: '0'
                            }
                        });
                    },
                    success: function(data) {
                        taglist();
                        $.unblockUI();
                        myArr = JSON.parse(data);
                        console.log(myArr);
                        toastr.success(myArr[0], '', {
                            timeOut: 5000,
                            // progressBar: true,
                            closeButton: true
                        });
                        // alert_func(myArr);
                    }
                });
            }
        }

        $(".alert").delay(7000).fadeOut(1500);
    </script>
</body>

</html>
