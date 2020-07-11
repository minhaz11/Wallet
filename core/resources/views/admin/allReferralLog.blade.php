@extends('layouts.admin.master')

@section('title')
    All Referral Logs
@endsection

@section('content')
<div class="row tm-content-row tm-mt-big mx-auto">
    <div class="col-xl-12 col-lg-12 tm-md-12 tm-sm-12 tm-col">
        <div class="bg-white tm-block h-100">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <h2 class="tm-block-title d-inline-block">All Referral Logs</h2>

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
                            <th scope="col">Referred By</th>
                            <th scope="col" class="text-center">Referred To</th>
                            <th scope="col">Date & Time</th>
                           
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($users as $key => $user)
                       
                        <tr>
                        <td>{{$users->firstItem()+$key}}</td>
                        <td class="tm-product-name">
                        <a href="{{route('admin.user.referral',['id'=>$user->referrer_id])}}">{{$user->referrer->name}}</a>
                        </td>
                        <td class="text-center">{{$user->name}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                       
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
                            {{$users->links()}}
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

   
</div>
@endsection