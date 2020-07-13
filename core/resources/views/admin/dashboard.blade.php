@extends('layouts.admin.master')
@section('title')
Dashboard - admin
@endsection
@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Hello admin!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="tm-col tm-col-big ">
    <div class="bg-white tm-block h-100">
        <h2 class="tm-block-title text-uppercase" >Add or Subtract Balance From User</h2>
        <h2 class="tm-block-title">Enter the username & amount</h2>
       
    <form action="{{route('add.balance')}}" method="POST" class="tm-edit-product-form">
        @csrf
            <div class="input-group mb-3">
                
                <input id="username" placeholder="username" name="username" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7 @error('username') is-invalid @enderror">
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
               @enderror
            </div>
            <div class="input-group mb-3">
                
                <input id="amount" placeholder="amount" name="amount" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7 @error('amount') is-invalid @enderror">
                @error('amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
               @enderror
            </div>
            <div class="input-group mb-3">
                <button type="submit" class="btn btn-primary" name="op" value="add">Add balance
                <button type="submit" class="btn btn-primary ml-1" name="op" value="sub">Subtract balance
                </button>
            </div>
        </form>
    </div>
</div>
<div class="tm-col tm-col-big">
    <div class="bg-white tm-block h-100">
        <h2 class="tm-block-title text-uppercase">Give Interest</h2>
        <h2 class="tm-block-title">Set the amount </h2>
    <form action="{{route('admin.interest')}}" method="POST" class="tm-edit-product-form">
            @csrf
            <div class="input-group mb-3">
                {{-- <label for="name" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Set Join Bonus
                </label> --}}
            <input id="interest" placeholder="Set the amount" name="interest" type="number" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7 @error('interest') is-invalid @enderror" value="{{$settings->interest}}" readonly>
                @error('interest')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
               @enderror
            </div>
            <div class="input-group mb-3">
                <button type="submit" class="btn btn-primary">Give
                </button>
            </div>
        </form>
    </div>
</div>
<div class="tm-col tm-col-small">
    <div class="bg-white tm-block h-100">
        <h6 class=" text-uppercase">Current Settings</h6>
      
           <strong class="text-primary">Site name: </strong><span>{{$settings->site_name}}</span><br>
           <strong class="text-primary">Interest: </strong><span>{{$settings->interest}}%</span><br>
           <strong class="text-primary">Join Bonus: </strong><span>{{$settings->ref_join_bonus}}</span>(BDT)<br>
           <strong class="text-primary">Fixed Charge: </strong><span>{{$settings->fixed_charge}}(BDT)</span><br>
           <strong class="text-primary">Percentage Charge: </strong><span>{{$settings->percentage_charge}}%</span>
           

          
         <form action="{{route('admin.userLogin')}}" method="POST">
               @csrf
            <label for="name" class="mt-3">Login As User
            </label>
                <input type="number" name="id" value="" class="form-control @error('interest') is-invalid @enderror"" placeholder="Put user id">
            <button type="submit" class="btn btn-primary">Login To User</button>
           </form>
           

    </div>
</div>

<div class="tm-col tm-col-big">
    <div class="bg-white tm-block h-100">
        <div class="row">
            <div class="col-8">
            <h2 class="tm-block-title d-inline-block">Latest User List </h2>

            </div>
            <div class="col-4 text-right">
                <a href="{{route('admin.user.list')}}" class="tm-link-black">View All</a>
            </div>
        </div>
        <ol class="tm-list-group tm-list-group-alternate-color tm-list-group-pad-big">
          @foreach ($latestUsers as $user)
        
          <li class="tm-list-group-item">
            {{$user->name}}
           </li>
          @endforeach
            
            
        </ol>
    </div>
</div>
<div class="tm-col tm-col-big">
    <div class="bg-white tm-block h-100">
        <div class="row">
            <div class="col-8">
                <h2 class="tm-block-title d-inline-block">Latest Transaction List</h2>

            </div>
            <div class="col-4 text-right">
                <a href="{{route('all.transaction')}}" class="tm-link-black">View All</a>
            </div>
        </div>
        <ol class="tm-list-group tm-list-group-alternate-color tm-list-group-pad-big">
          @foreach ($latestTrx as $trx)
        
          <li class="tm-list-group-item">
            {{$trx->details}} <span class="text-primary">({{$trx->amount}})</span>
           </li>
          @endforeach
            
            
        </ol>
    </div>
</div>
<div class="tm-col tm-col-small">
    <div class="bg-white tm-block h-100">
        <h2 class="tm-block-title">Latest Referred Users</h2>
        <ol class="tm-list-group">
            @foreach ($latestRefUsers as $user)
            <li class="tm-list-group-item">{{$user->name}}</li>
           @endforeach
        </ol>
    </div>
</div>

@endsection
