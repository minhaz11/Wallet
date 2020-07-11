@extends('layouts.user')
@section('title')
    User Dashboard
@endsection
 
@section('content')
<div class="card bg-light mb-3 mt-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 90rem;">
<div class="card-header text-uppercase font-weight-bold">Transaction Log   <span class="ml-5">Total Transaction: {{$trxs->count()}}</span></div> 
    <div class="card-body">
      <!-- <h5 class="card-title">Light card title</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
      <table class="table table-bordered table-hover shadow p-3 mb-5 bg-white rounded">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">TRX</th>
            {{-- <th scope="col">Reciever</th> --}}
            <th scope="col">Amount</th>
            <th scope="col">Remaining Balance</th>
            <th scope="col">Details</th>
            <th scope="col">Charge</th>
            <th scope="col">Time & Date</th>
          </tr>
        </thead>
        <tbody>
          {{-- @dd($user->transactions) --}}
          @foreach ($trxs as $key =>$trx)
          <tr>
          <th scope="row">{{$trxs->firstItem() + $key }}</th>
            <td>{{$trx->trx_number}}</td>
            <td>{{$trx->amount}}</td>
            <td>{{$trx->post_balance}}</td>
            <td>{{$trx->details}}</td>
            <td>{{$trx->charge}}</td>
            <td>{{$trx->created_at->diffForHumans()}}</td>
          </tr>
          @endforeach
          
          
        </tbody>
      </table>
      {{ $trxs->links() }}
    </div>
  </div>
</div>
@endsection
