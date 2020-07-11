@extends('layouts.user')
@section('title')
    Referral Log
@endsection
 
@section('content')
<div class="card bg-light mb-3 mt-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 90rem;">
    <div class="card-header text-uppercase font-weight-bold">Referral Log</div>
    <div class="card-body">
      <!-- <h5 class="card-title">Light card title</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
      <table class="table table-bordered table-hover shadow p-3 mb-5 bg-white rounded">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Referred to</th>
            {{-- <th scope="col">Reciever</th> --}}
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Contact</th>
            <th scope="col">Join Date & Time</th>
          </tr>
        </thead>
        <tbody>
          {{-- @dd($user->transactions) --}}
          @foreach ($logs as $key =>$log)
          <tr>
          <th scope="row">{{$logs->firstItem() + $key }}</th>
            <td>{{$log->name}}</td>
            <td>{{$log->username}}</td>
            <td>{{$log->email}}</td>
            <td>{{$log->phone}}</td>
            <td>{{$log->created_at->diffForHumans()}}</td>
          </tr>
          @endforeach
          
          
        </tbody>
      </table>
      {{ $logs->links() }}
    </div>
  </div>
</div>
@endsection
