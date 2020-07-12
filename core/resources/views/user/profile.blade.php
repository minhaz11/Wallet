@extends('layouts.user')
 @section('title')
     User Profile
 @endsection

@section('content')
    <div class="container">
        <div class="card  mt-3 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header text-uppercase">
              Profile Info
            </div>
            <div class="card-body">
            <form action="{{route('user.profile.update')}}" method="POST">
                   @csrf
              <div class="form-group">
                      <label for="exampleInputEmail1">Name</label> 
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name" value="{{Auth::user()->name ?? old('name')}}">
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                      </span>
                     @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Adress</label>
                      <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address" value="{{Auth::user()->address ?? old('address')}}">
                      @error('address')
                      <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                      </span>
                     @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Phone</label> 
                      <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Phone" value="{{Auth::user()->phone ?? old('phone')}}">
                      @error('phone')
                      <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                      </span>
                     @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Username</label>
                      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="exampleInputPassword1" placeholder="Username" value="{{Auth::user()->username ?? old('username')}}" readonly>
                      @error('username')
                      <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                      </span>
                     @enderror
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
           
            </div>
            <div class="card-footer text-muted">
             
            </div>
          </div>
       
    </div>
@endsection