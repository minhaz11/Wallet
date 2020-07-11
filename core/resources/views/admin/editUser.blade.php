@extends('layouts.admin.master')

@section('title')
   Edit user
@endsection

@section('content')
<div class="row tm-mt-big mx-auto">
    <div class="col-xl-12 col-lg-10 col-md-12 col-sm-12">
        <div class="bg-white tm-block mx-auto">
            <div class="row">
                <div class="col-12">
                    <h2 class="tm-block-title d-inline-block">Edit User </h2>
                </div>
            </div>
            <div class="row mt-4 tm-edit-product-row">
                <div class="col-md-12" style="width: 100rem">
                <form action="{{route('admin.user.update',['id'=>$user->id])}}" method="POST" class="tm-edit-product-form">
                        @csrf
                        <div class="input-group mb-3">
                            <label for="name" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Name
                            </label>
                        <input id="name" name="name" value="{{$user->name}}" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7">
                        </div>
                       
                        <div class="input-group mb-3">
                            <label for="expire_date" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Username
                            </label>
                            <input id="expire_date" name="username" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7"
                         data-large-mode="true" value="{{$user->username}}"> 
                        </div>
                        <div class="input-group mb-3">
                            <label for="stock" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label"> Email
                            </label>
                        <input id="stock" name="email" type="text" value="{{$user->email}}" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7">
                        </div>
                        {{-- <div class="input-group mb-3">
                            <label for="stock" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Old Password
                            </label>
                        <input id="stock" name="password" type="text" value="" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7">
                        </div> --}}
                        <div class="input-group mb-3">
                            <label for="stock" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">New Password
                            </label>
                        <input id="stock" name="password" type="password"  class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7">
                        </div>
                        {{-- <div class="input-group mb-3">
                            <label for="stock" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Confirm Password
                            </label>
                        <input id="stock" name="password_confirmation" type="password" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7">
                        </div> --}}
                        
                        <div class="input-group mb-3">
                            <div class="ml-auto col-xl-8 col-lg-8 col-md-8 col-sm-7 pl-0">
                                <button type="submit" class="btn btn-primary">Update
                                </button>
                            </div>
                        </div>
                    </form>
                   
                </div>
                
            </div>
            

        </div>
    </div>
</div>
@endsection