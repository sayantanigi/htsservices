@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<section class="section section-md" id="features">
    <div class="container">
        <h2 class="text-center">Reset Password</h2>
        
        <div class="row justify-content-center">
            <div class="col-lg-5">
              @if(\Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show font-size-12">{{ \Session::get('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                {{ \Session::forget('error') }}
              @endif

              @if(\Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show font-size-12">{{ \Session::get('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                {{ \Session::forget('success') }}
              @endif

              @if (Session::has('message'))
                  <div class="alert alert-success alert-dismissible fade show font-size-12">
                      {{ Session::get('message') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endif

              <!-- Way 1: Display All Error Messages -->
              @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show font-size-12">
                      <strong>Whoops!</strong> There were some problems with your input.<br><br>
                      <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </ul>
                </div>
              @endif
              
                <form class="rd-mailform" method="post" action="{{ route('forget.password.post') }}" autocomplete="off" id="loginForm">
                  @csrf  
                    <div class="form-group">
                      <input class="form-control " type="email" name="email" placeholder="Email" autofocus>
                      @if ($errors->has('email'))
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                    

                    <div class="offset-xxs group-40 d-flex flex-wrap flex-xs-nowrap align-items-center">
                      <button class="btn btn-block" type="submit" name="submit" value="reset password">Send Password Reset Link</button>
                    </div>
                    <div class="text-center">
                      <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<style type="text/css">
  .eyepanel{
    position: absolute;
    top: 12px;
    font-size: 20px;
    right: 12px;
    z-index: 1;
    cursor: pointer;
  }
</style>
@endsection
