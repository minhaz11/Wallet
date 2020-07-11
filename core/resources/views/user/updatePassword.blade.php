@extends('layouts.user')
@section('title')
   Update Password
@endsection
 
@section('content')
<div class="container">
    <div class="card bg-light mb-3 mt-3 shadow p-3 mb-5 bg-white rounded" style="max-width: 90rem;">
        <div class="card-header text-uppercase font-weight-bold">Update password</div>
        <div class="card-body">
          <!-- <h5 class="card-title">Light card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
          <form action="{{route('user.update.password')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Old Password</label>
              <input type="password" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Old Password">
              @error('oldPassword')
              <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
              </span>
             @enderror
            
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">New Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="New Password">
              @error('password')
              <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
              </span>
             @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="exampleInputPassword1" placeholder=" Confirm Password">
              @error('password_confirmation')
              <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
              </span>
             @enderror
            </div>
           
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
