@extends('layouts.admin.master')

@section('title')
   User Transaction Logs
@endsection

@section('content')
<div class="row tm-content-row tm-mt-big mx-auto">
    <div class="col-xl-12 col-lg-12 tm-md-12 tm-sm-12 tm-col">
        <div class="bg-white tm-block h-100">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                <h2 class="tm-block-title d-inline-block"> User Transaction Logs</h2>

                </div>
                {{-- <div class="col-md-4 col-sm-12 text-right">
                <a href="{{route('admin.user.deleted')}}" class="btn btn-small btn-primary">Trashed Users</a>
                </div> --}}
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
                      
                        @foreach ($transactions as $key => $trx)
                       
                        <tr>
                        <td>{{$transactions->firstItem()+$key}}</td>
                        <td class="tm-product-name">
                            @if ($trx->user)
                         {{$trx->user->name}}
                            @else
                        <span class="text-danger">{{ __("No data found!!!") }}</span>
                            @endif
                        </td>
                        <td class="text-center">{{$trx->trx_number}}</td>
                        <td class="text-center">{{$trx->amount}}</td>
                            <td>{{$trx->trx_type}}</td>
                            <td>{{$trx->post_balance}}</td>
                            <td><span class="text-primary">{{$trx->details}}</span></td>
                            <td>{{$trx->charge}}</td>
                            <td>{{$trx->created_at->diffForHumans()}}</td>
                            
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
                            {{$transactions->links()}}
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

   
</div>
@endsection