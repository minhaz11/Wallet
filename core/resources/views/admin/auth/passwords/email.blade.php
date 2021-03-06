{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.admin.auth')
@section('title')
    Reset Password
@endsection

@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url({{asset('assets/admin_login')}}/images/bg-01.jpg);">
                <span class="login100-form-title-1">
                Admin  Reset Password
                </span>
            </div>

            <form class="login100-form validate-form" method="POST" action="{{ route('admin.password.email') }}">
                @csrf
                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                    <span class="label-input100"></span>
                    <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Enter email">
                    @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                    <span class="focus-input100"></span>
                </div>

               

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Send Passeord Reset Link
                    </button>
                </div>
                
            </form>
            {{-- @if (session('status'))
            <div class="alert alert-success " role="alert">
                {{ session('status') }}
            </div>
        @endif --}}
        </div>
    </div>
</div> 
@endsection
