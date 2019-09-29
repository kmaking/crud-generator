@extends('admin.layout.auth')

@section('content')

@if (session('status'))
    @alert(['type' => 'success'])
        {{ session('status') }}
    @endalert
@endif

<img src="{{ asset('vendors/images/forgot-password.png') }}" alt="login" class="login-img">
<h2 class="text-center mb-30">Forgot Password</h2>
<form method="POST" action="{{ route('admin.password.email') }}" aria-label="{{ __('Reset Password') }}">
@csrf
    <p>Enter your email address to reset your password</p>
    <div class="input-group custom input-group-lg">
        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email">
        <div class="input-group-append custom">
            <span class="input-group-text{{ $errors->has('email') ? ' text-danger' : '' }}">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
            </span>
        </div>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="input-group">
                <button class="btn btn-primary btn-lg btn-block">
                    Submit
                </button>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="forgot-password">
                <a href="{{ route('admin.login') }}" class="btn btn-outline-primary btn-lg btn-block">Sign In</a>
            </div>
        </div>
    </div>
</form>
@endsection