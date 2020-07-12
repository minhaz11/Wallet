@extends('layouts.user')
@section('title')
  Send referral
@endsection
 
@section('content')
<div class="container">
    <div class="card bg-light mb-3 mt-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 90rem;">
        <div class="card-header text-uppercase font-weight-bold">Send referral</div>
        <div class="card-body">
          <!-- <h5 class="card-title">Light card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
          <form action="{{route('user.send.referral')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Your referral link</label>
              <input type="text" name="link" class="form-control text-primary mb-3"  value="{{ Auth::user()->referral_link }}" readonly>
              <label for="exampleInputEmail1">Email Address</label>
              <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email address">
            
            </div>
           
            <button type="submit" class="btn btn-primary">Send</button>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
