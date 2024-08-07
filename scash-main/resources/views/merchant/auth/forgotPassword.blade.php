@extends('layout/blank')

@section('title', 'Merchant changePassword')

@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="row align-items-center vh-100">
      <div class="col-md-6 text-center">
        <img src="{{ asset('assets/img/white-logo.png') }}">
      </div>
      <div class="col-md-6">
      <div class="authentication-inner py-4">

        <!-- changePassword -->
        <div class="card p-2">
          <!-- Logo -->
          <div class="app-brand justify-content-center mt-5">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])</span>
            </a>
          </div>
          <!-- /Logo -->

          <div class="card-body mt-2">
            <h4 class="mb-2">Welcome to {{config('variables.templateName')}}!</h4>
            <p class="mb-4">Please enter your email to change password</p>

            <form id="changePassword-form" class="mb-3" action="{{route('merchant.auth.sendForgotPassword')}}" method="POST">
            @csrf
              <div class="form-floating form-floating-outline mb-3">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus>
                <strong class="text-danger is-invalid" id="name"></strong>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary nextBtn d-grid w-100" type="submit">Send</button>
              </div>
            </form>

            <p class="text-center">
              <span>New on our platform?</span>
              <a href="{{route('merchant.auth.register')}}">
                <span>Create an account</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /changePassword -->
      </div>
      </div>
    </div>
  </div>
</div>
<x-loader-ajax-component></x-loader-ajax-component>

@endsection

@push('style')
<style>
  #wrapper #content-wrapper #content {
  background:url(../assets/img/login-bg.png)no-repeat;
  background-size:cover;
  height:100vh;

}
</style>
@endpush

@push('js')

<script src="{{ asset('assets') }}/js/auth/forgotPassword.js"></script>

@endpush
