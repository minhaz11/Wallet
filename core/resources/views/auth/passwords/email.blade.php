{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
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

@extends('layouts.auth')

@section('title')
    Reset Password
@endsection
@section('content')
<div class="container  p-5">
    <div class="card mb-3 shadow-lg p-3 mb-5 bg-white rounded mt-5  border border-primary">
    <img class="card-img-top w-50 mx-auto" src="{{asset('assets/user_login/auth.svg')}}" alt="Card image cap">
      <div class="card-body">

        <div class="container w-50">
 
          <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="form-group ">
                <label for="email" class="">{{ __('Email') }}</label>

                <div class="">
                    <input id="email" type="text" class="form-control shadow-sm p-2 mb-1 bg-white rounded @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="username" autofocus placeholder="Enter email"> 

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection