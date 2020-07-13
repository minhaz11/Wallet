@extends('layouts.admin.master')

@section('title')
    Interest Logs
@endsection

@section('content')
<div class="row tm-content-row tm-mt-big mx-auto">
    <div class="col-xl-12 col-lg-12 tm-md-12 tm-sm-12 tm-col">
        <div class="bg-white tm-block h-100">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                <h2 class="tm-block-title d-inline-block">Interest Logs  <span class="ml-5 text-danger"></span></h2>
                <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('admin.trx.search')}}">
                    @csrf
                        <input class="form-control mr-sm-2 mt-4" type="text" placeholder="Search By Trx no." aria-label="Search" name="search">
                        <button class="btn btn-outline-success my-2 my-sm-0 " type="submit">Search</button>
                </form>
                </div>
                
            </div>
            <div class="table-responsive " style="width: 90rem">
                <table class="table table-hover table-striped tm-table-striped-even mt-3">
                    <thead>
                        <tr class="tm-bg-gray">
                            <th scope="col">Sl</th>
                            <th scope="col">User Name</th>
                            <th scope="col" class="text-center">TRX</th>
                            <th scope="col" class="text-center">Amount</th>
                            <th scope="col">TRX Type</th>
                            <th scope="col">Post Balance</th>
                            <th scope="col">Details</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Date</th>
                            {{-- <th scope="col">Action</th> --}}
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($interests as $key => $interest)
                        
                        <tr>
                        <td>{{$interests->firstItem()+$key}}</td>
                        <td class="tm-product-name">
                            @if ($interest->user)
                        <a href="{{route('user.transaction',[$interest->user->id])}}">{{$interest->user->name}}</a>
                            @else
                        <span class="text-danger">{{ __("No data found!!!") }}</span>
                            @endif
                        </td>
                        <td class="text-center">{{$interest->trx_number}}</td>
                        <td class="text-center">{{$interest->amount}}</td>
                            <td>{{$interest->trx_type}}</td>
                            <td>{{$interest->post_balance}}</td>
                            <td><span class="text-primary">{{$interest->details}}</span></td>
                            <td>{{$interest->charge}}</td>
                            <td>{{$interest->created_at->diffForHumans()}}</td>
                       
                        </tr>
                        @endforeach
                       
                        
                    </tbody>
                   
                </table>
               
            </div>

            <div class="tm-table-mt tm-table-actions-row">
                
                
                <div class="tm-table-actions-col-right">
                    <span class="tm-pagination-label"></span>
                    <nav aria-label="Page navigation" class="d-inline-block">
                        <ul class="pagination tm-pagination">

                            {{$interests->links()}}
                           
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

   
</div>
@endsection