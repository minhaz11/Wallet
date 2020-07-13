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
            <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
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
                      <label for="exampleInputEmail1">Choose Image</label>
                      <input type="file" name="img" class="form-control-file @error('img') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Address" value="{{Auth::user()->address ?? old('img')}}">
                      @error('img')
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