<?php

namespace App\Providers;

use App\User;
use App\Transaction;
use App\GeneralSetting;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('admin.allTransactionLog',  function ($view){
            $view->with('totalTrx', Transaction::get('amount'));
        } );
        view()->composer('admin.manage_users',  function ($view){
            $view->with('totalUser', User::get('id'));
        } );
        // view()->composer('layouts.user',  function ($view){
        //     $view->with('ref_by', User::get(Auth::user()->id)->referrer());
        // } );

    }

}
