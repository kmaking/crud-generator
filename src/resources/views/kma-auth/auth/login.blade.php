@extends('admin.layout.auth')

@section('content')

@if (session('status'))
    @alert(['type' => 'success'])
        {{ session('status') }}
    @endalert
@endif

<img src="{{ asset('vendors/images/login.png') }}" alt="login" class="login-img">
<h2 class="text-center mb-30">Login</h2>
<form method="POST" action="{{ route('admin.login') }}" aria-label="{{ __('Login') }}">
    @csrf
    <div class="input-group custom input-group-lg">
        <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Username" value="{{ old('email') }}">
        <div class="input-group-append custom">
            <span class="input-group-text{{ $errors->has('email') ? ' text-danger' : '' }}">
                <i class="fa fa-user" aria-hidden="true"></i>
            </span>
        </div>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="input-group custom input-group-lg">
        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="**********">
        <div class="input-group-append custom">
            <span class="input-group-text{{ $errors->has('password') ? ' text-danger' : '' }}">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="input-group">
                <button class="btn btn-outline-primary btn-lg btn-block">
                    Sign In
                </button>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="forgot-password padding-top-10">
                <a href="{{ route('admin.password.request') }}">Forgot Password</a>
            </div>
        </div>
    </div>
</form>
@endsection
