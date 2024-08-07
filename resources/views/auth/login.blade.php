@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="section section-md" id="features">
    <div class="container">
        <h2 class="text-center">Log In</h2>
        <p class="text-center">Sign in to continue to SearchUP.</p>
        
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

              @if(\Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show font-size-12">{{ \Session::get('message') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                {{ \Session::forget('message') }}
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
              
                <form class="rd-mailform" method="post" action="{{ route('login') }}" autocomplete="off" id="loginForm">
                  @csrf  
                    <div class="form-group">
                      <input class="form-control " type="email" name="email" placeholder="Email">
                    </div>

                    <div class="form-group position-relative">
                      <input class="form-control " type="password" placeholder="Password " name="password" id="password">
                      <div class="eyepanel"><i class="fas fa-eye-slash" id="eye"></i></div>
                    </div>
                    <div class="row mt-0">
                      <div class="col-6">
                        <div class="form-check mt-3 form-group">
                          <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember" {{ old('remember') ? 'checked' : '' }}>
                              <label class="form-check-label" for="remember">
                                  {{ __('Remember Me') }}
                              </label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check mt-3 form-group text-end">
                          {{-- <a href="#">Forgot Password?</a> --}}
                          <a href="{{ route('forget.password.get') }}" class="text-muted"><i class="mdi mdi-lock me-0"></i> Reset Password?</a>
                        </div>
                      </div>
                    </div>
                    

                    <div class="offset-xxs group-40 d-flex flex-wrap flex-xs-nowrap align-items-center">
                      <button class="btn btn-block" type="submit" name="submit" value="registration">Log in</button>
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
