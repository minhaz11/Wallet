<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'LandingController@index')->name('land');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//----------Admin----------//


Route::group(['prefix'=>'admin', 'namespace'=>'Admin\Auth', 'as'=>'admin.'], function(){
   //--------Admin login-----//
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
    
    //----register---//
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register')->name('registered');

    //Forgot Password Routes
     Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
     Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
 
     //Reset Password Routes
     Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
     Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
  
});

//----------Admin dashboard------//

//manage users
Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'as'=>'admin.'], function(){
    Route::get('manage/users', 'ManageUserController@index')->name('user.list');
    Route::get('delete/user/{id}', 'ManageUserController@destroy')->name('user.delete');
    Route::get('deleted/users', 'ManageUserController@trashedUser')->name('user.deleted');
    Route::get('permanent/delete/user/{id}', 'ManageUserController@permanentDelete')->name('user.permanent.delete');
    Route::get('restore/user/{id}', 'ManageUserController@restoreUser')->name('user.restore');
    Route::get('user/edit/{id}', 'ManageUserController@editUser')->name('user.edit');
    Route::post('user/update/{id}', 'ManageUserController@updateUser')->name('user.update');
    Route::get('all/referral/logs', 'ManageUserController@referralLog')->name('all.referral');
    Route::get('user/referral/logs/{id}', 'ManageUserController@userReferralLog')->name('user.referral');
    Route::post('user/login','ManageUserController@userLogin')->name('userLogin');
    Route::post('user/search','ManageUserController@search')->name('user.search');
    
   
});

//site settings
Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'as'=>'admin.'], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('settings', 'DashboardController@settings')->name('settings');
    Route::post('settings', 'DashboardController@settingsUpdate')->name('settings.update'); 
    Route::post('interest/given', 'DashboardController@giveInterest')->name('interest'); 
});




//------user dashboard-----//
Route::group(['prefix'=>'user',  'as'=>'user.'], function(){
    Route::get('profile', 'HomeController@showProfile')->name('profile');
    Route::post('profile', 'HomeController@updateProfile')->name('profile.update');
    Route::get('referral/log', 'HomeController@referralLog')->name('referral.log');
    Route::get('referral/bonuses', 'HomeController@referralBonus')->name('referral.bonuses');
    Route::get('send/referral', function(){
        return view('user.sendReferral');
    })->name('referral.form');
    
    Route::post('send/referral', 'HomeController@sendReferral')->name('send.referral');
    
    Route::get('update/password', function(){
        return view('user.updatePassword');
    })->name('edit.password');
    Route::post('update/password','HomeController@updatePassword')->name('update.password');
    Route::get('transaction/logs','HomeController@trxLogs')->name('trx.logs');

    
});

//---------transaction--------//
Route::post('transfered','TransactionController@transaction')->name('transaction');
Route::post('admin/add/balance/user', 'Admin\DashboardController@balanceOperation')->name('add.balance');
Route::get('admin/all/transactions', 'TransactionController@allTransaction')->name('all.transaction');
Route::get('admin/user/transactions/{id}', 'TransactionController@userTransaction')->name('user.transaction');
Route::post('admin/transactions/search', 'TransactionController@search')->name('admin.trx.search');




Route::get('/{any}', 'LandingController@index')->where('any', '.*');