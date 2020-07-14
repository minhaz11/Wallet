{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('username') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
    User Registration
@endsection
@section('content')
<div class="container  p-5">
    <div class="card mb-3 shadow-lg p-3 mb-5 bg-white rounded mt-5  border border-primary">
    <img class="card-img-top w-50 mx-auto" src="{{asset('assets/user_login/auth.svg')}}" alt="Card image cap">
      <div class="card-body">

        <div class="container w-50">
           
            @if(Session::has('referrer'))
            <div class="form-group ">
                <label class="">{{ __('Referrence by') }} :  <span class="text-primary">{{ session()->get('referrer')}}</span></label>
            </div>
            @endif
          <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group ">
                <label for="email" class="">{{ __('Name') }}</label>

                <div class="">
                    <input id="name" type="text" class="form-control shadow-sm p-2 mb-1 bg-white rounded @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="username" autofocus placeholder="Enter name"> 

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group ">
                <label for="email" class="">{{ __('Username') }}</label>

                <div class="">
                    <input id="username" type="text" class="form-control shadow-sm p-2 mb-1 bg-white rounded @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Enter username"> 

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
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

            <div class="form-group ">
                <label for="password" class="">{{ __('Password') }}</label>

                <div class="">
                    <input id="password" type="password" class="form-control shadow-sm p-2 mb-1 bg-white rounded @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group ">
                <label for="password" class="">{{ __('Confirm Password') }}</label>

                <div class="">
                    <input id="password_confirmation" type="password" class="form-control shadow-sm p-2 mb-1 bg-white rounded @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" placeholder="Password">

                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group ">
                <label for="phone" class="">{{ __('Phone') }}</label>

                <div class="">
                    <input id="phone" type="number" class="form-control shadow-sm p-2 mb-1 bg-white rounded @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="username" autofocus placeholder="Enter phone no"> 

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group ">
                <label for="phone" class="">{{ __('Address') }}</label>

                <div class="">
                    <input id="address" type="text" class="form-control shadow-sm p-2 mb-1 bg-white rounded @error('phone') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="username" autofocus placeholder="Enter address"> 

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
           
         
            <div class="form-group row mb-3">
                <div class="col-md-12 ">
                    <button type="submit" class="btn btn-primary  w-100">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection