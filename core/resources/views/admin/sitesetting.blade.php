@extends('layouts.admin.master')

@section('title')
    Site setting
@endsection

@section('content')
<div class="row tm-mt-big mx-auto">
    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">
        <div class="bg-white tm-block mx-auto">
            <div class="row">
                <div class="col-12">
                    <h2 class="tm-block-title d-inline-block">Site Setting </h2>
                </div>
            </div>
            <div class="row mt-4 tm-edit-product-row">
                <div class="col-md-12" style="width: 100rem">
                <form action="{{route('admin.settings.update')}}" method="POST" class="tm-edit-product-form">
                        @csrf
                        <div class="input-group mb-3">
                            <label for="name" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Site Name
                            </label>
                        <input id="sitename" name="sitename" value="{{$setting->site_name}}" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7">
                        </div>
                       
                        <div class="input-group mb-3">
                            <label for="expire_date" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Expire
                               Fixed Charge(transaction)
                            </label>
                            <input id="expire_date" name="fixed" type="number" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7"
                         data-large-mode="true" value="{{$setting->fixed_charge}}"> 
                        </div>
                        <div class="input-group mb-3">
                            <label for="stock" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label"> Percentage Charge(transaction)%
                            </label>
                        <input id="stock" name="percentage" type="number" value="{{$setting->percentage_charge}}" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7">
                        </div>
                        <div class="input-group mb-3">
                            <label for="stock" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Referral Join Bonus(BDT)
                            </label>
                        <input id="stock" name="refJoinBonus" type="number" value="{{$setting->ref_join_bonus}}" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7">
                        </div>
                        <div class="input-group mb-3">
                            <label for="stock" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Normal Join Bonus(BDT)
                            </label>
                        <input id="stock" name="nrmJoinBonus" type="number" value="{{$setting->nrm_join_bonus}}" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7">
                        </div>
                        <div class="input-group mb-3">
                            <label for="stock" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Interest(%)
                            </label>
                        <input id="stock" name="interest" type="number" value="{{$setting->interest}}" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7">
                        </div>
                        <div class="input-group mb-3">
                            <label for="stock" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Referral Transaction Bonus for referrer(%)
                            </label>
                        <input id="stock" name="trxBonus" type="number" value="{{$setting->ref_trx_bonus}}" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7">
                        </div>
                        <div class="input-group mb-3">
                            <label for="stock" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Referral SignUp Bonus for referrer
                            </label>
                        <input id="stock" name="regBonus" type="number" value="{{$setting->ref_reg_bonus}}" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7">
                        </div>
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