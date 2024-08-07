@extends('layouts.admin-login')
@section('title', 'Login Area')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <a href="javascript:void(0);" class="d-block auth-logo navbar-logo-inverse">
                    <img src="{{ asset('/admin-assets/images/logo-dark.png') }}" alt="" class="logo logo-dark mx-auto">
                    <img src="{{ asset('/admin-assets/images/logo-dark.png') }}" alt="" class="logo logo-light mx-auto">
                </a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="p-4">
            <div class="card overflow-hidden mt-2">
                <div class="auth-logo text-center bg-primary position-relative">
                    <div class="img-overlay"></div>
                    <div class="position-relative pt-4 py-5 mb-1">
                        <h5 class="text-white">Welcome Back !</h5>
                    <p class="text-white-50 mb-0">Sign in to continue to HTS Services, Inc.</p>
                    </div>
                </div>
                <div class="card-body position-relative">
                    <div class="p-4 mt-n5 card rounded">
                        @if(\Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show font-size-12">{{ \Session::get('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                            {{ \Session::forget('error') }}
                        @endif

                        @if(\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show font-size-12">{{ \Session::get('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                            {{ \Session::forget('success') }}
                        @endif

                        <form class="form-horizontal" action="{{ route('adminlogin') }}" id="loginForm" method="POST">
                        @csrf

                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Enter email"  autofocus>
                            </div>

                            <div class="form-group mb-3">
                                <label for="userpassword">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">        
                            </div>

                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit" name="submit" value="Login">Log IN</button>
                            </div>

                            {{-- <div class="mt-4 text-center">
                                <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-5 text-center">
                <p>&copy; HTS Services, Inc. <script>document.write(new Date().getFullYear())</script>. All rights reserved. </p>
            </div>
        </div>
        </div>
    </div>

</div>

<style>
    .navbar-logo img {
        box-shadow: inset 3px 3px 5px #31456a, inset -3px -3px 5px #081c40;
        background: #31456A;
        padding: 5px 8px;
        border-radius: 5px;
    }

    .logo {
        height: 37px;
    }
    .bg-primary {
        background-color: #060939!important;
    }
    .btn-primary {
        color: #fff;
        background-color: #F13223;
        border-color: #F13223;
    }
    .btn-primary:hover {
        color: #fff;
        background-color: #060939;
        border-color: #060939;
    }
    .text-muted {
        color: #8ca3bd!important;
    }
    a:hover {
        color: #F13223;
    }
</style>

@endsection
