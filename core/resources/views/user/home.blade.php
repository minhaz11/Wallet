@extends('layouts.user')
@section('title')
    User Dashboard
@endsection
 
@section('content')

<div class="card bg-light mb-3 mt-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 90rem;">
<div class="card-header text-uppercase font-weight-bold"><span class="ml-5">Dashboard</span></div> 
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <div class="card text-white bg-success mb-3" style="max-width: 25rem;">
            <div class="card-header text-center">Total Money Transaction</div>
            <div class="card-body text-center">
              <p class="card-text">Your total transaction</p>
              <h1 class="card-title text-center">{{number_format($trxs->sum('amount'))}} BDT</h1>
              
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-white bg-primary mb-3" style="max-width: 25rem;">
            <div class="card-header text-center">Total referral</div>
            <div class="card-body text-center">
             
              <p class="card-text">You have referred</p>
              <h1 class="card-title text-center">{{$logs->count('referrer_id')}} Peoples</h1>
            </div>
          </div>
          <div class="card text-white bg-secondary mb-3 mt-5" style="max-width: 25rem;">
            <div class="card-header text-center">Current Balance</div>
            <div class="card-body text-center">
             
              <p class="card-text">Your current balance is</p>
              <h1 class="card-title text-center">{{number_format(Auth::user()->Balance)}} BDT</h1>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-white bg-info mb-3" style="max-width: 25rem;">
            <div class="card-header text-center">Total Bonus from referrals</div>
            <div class="card-body text-center">
              <p class="card-text">You got total Bonus</p>
              <h1 class="card-title">{{number_format($bonuses->sum('amount'))}} BDT</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
