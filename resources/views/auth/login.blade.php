@extends('layouts.app')

@section('content')

<div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span>Billing</span><strong class="text-primary">Dashboard</strong></div>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p> -->
            <form method="POST" acttion="{{ route('login') }}" class="text-left">
            @csrf
              <div class="form-group-material">
                <input id="login-email address" type="text" name="email" required data-msg="Please enter your email address" class="input-material">
                <label for="login-email address" class="label-material">Email Address</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group-material">
                <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                <label for="login-password" class="label-material">Password</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group-material">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="login-password" class="label-material">Remember me</label>
                
              </div>
              <div class="form-group text-center"><button id="login"  class="btn btn-primary">Login</button>
                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
              </div>
            </form>
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password?</a>
            @endif 
            <small>Do not have an account? </small><a href="{{ route('register') }}" class="signup">Signup</a>
          </div>
          <div class="copyrights text-center">
            <p>Design by <a href="https://bootstrapious.com/p/bootstrap-4-dashboard" class="external">Billing System</a></p>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
          </div>
        </div>
      </div>
@endsection
