@extends('layouts.admin.master')

@section('title')
   Searched user
@endsection

@section('content')
<div class="row tm-content-row tm-mt-big mx-auto">
    <div class="col-xl-12 col-lg-12 tm-md-12 tm-sm-12 tm-col">
        <div class="bg-white tm-block h-100">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <h2 class="tm-block-title d-inline-block text-primary">User <span class="ml-5 text-danger"></span></h2>
                    

                </div>
                {{-- <div class="col-md-4 col-sm-12 text-right">
                <a href="{{route('admin.user.deleted')}}" class="btn btn-small btn-primary">Trashed Users</a>
                </div> --}}
            </div>
            <div class="table-responsive " style="width: 90rem">
                <table class="table table-hover table-striped tm-table-striped-even mt-3">
                    <thead>
                        <tr class="tm-bg-gray">
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-center">Username</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($users) --}}
                        {{-- @foreach ($user as $key => $item) --}}
                        <tr>
                        <td>1</td>
                        <td class="tm-product-name">{{$user->name}}</td>
                        <td class="text-center">{{$user->username}}</td>
                        <td class="text-center">{{$user->email}}</td>
                            <td>{{number_format($user->Balance,2)}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->address}}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="">
                                <a href="{{route('admin.user.delete',['id'=>$user->id])}}" class="btn btn-primary text-danger font-weight-bold"><span class="">Delete</span></a>
                                <a href="{{route('admin.user.edit',['id'=>$user->id])}}" class="btn btn-primary text-primary font-weight-bold"><span class="">Edit user</span></i></a>
                                <form action="{{route('admin.userLogin')}}" method="POST">
                                    @csrf
                                   <input type="hidden" name="id" value="{{$user->id}}">
                                   <button type="submit"  class="btn btn-primary text-success">Login as user</button>
                                </form>
                               
                            </div>
                            </td>
                        </tr>
                       
                       
                        
                    </tbody>
                   
                </table>
               
            </div>

            <div class="tm-table-mt tm-table-actions-row">
               
                
                <div class="tm-table-actions-col-right">
                    <span class="tm-pagination-label"></span>
                    <nav aria-label="Page navigation" class="d-inline-block">
                        <ul class="pagination tm-pagination">
                            {{-- {{$user->links()}} --}}
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

   
</div>
@endsection