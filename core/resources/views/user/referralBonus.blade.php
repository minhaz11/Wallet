@extends('layouts.user')
@section('title')
    Referral Bonus
@endsection
 
@section('content')
<div class="card bg-light mb-3 mt-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 90rem;">
<div class="card-header text-uppercase font-weight-bold">Referral Bonus Log   <span class="ml-5 text-danger">Total Bonus amount: {{$bonuses->sum('amount')}} BDT</span></div> 
    <div class="card-body">
      <!-- <h5 class="card-title">Light card title</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
      <table class="table table-bordered table-hover shadow p-3 mb-5 bg-white rounded">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            
            <th scope="col">Amount</th>
            
            <th scope="col">Details</th>
            
            <th scope="col">Time & Date</th>
          </tr>
        </thead>
        <tbody>
          {{-- @dd($user->transactions) --}}
          @foreach ($bonuses as $key => $bonus)
          <tr>
          <th scope="row">{{$bonuses->firstItem()+$key}}</th>
            <td>{{$bonus->amount}}</td>
            <td>{{$bonus->details}}</td>
            <td>{{$bonus->created_at->diffForHumans()}}</td>
            
          </tr>
          @endforeach
          
          
        </tbody>
      </table>
      {{-- {{ $bo->links() }} --}}
    </div>
  </div>
</div>
@endsection
