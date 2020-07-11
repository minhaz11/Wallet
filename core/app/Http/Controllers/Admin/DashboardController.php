<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\GeneralSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $latestUsers = User::latest()->get()->take(7);
        $latestTrx = Transaction::latest()->get()->take(7);
        $latestRefUsers = User::whereNotNull('referrer_id')->latest()->get()->take(7);
        $settings =GeneralSetting::first();
        return view('admin.dashboard',compact('latestUsers','latestTrx','latestRefUsers','settings'));
    }

    public function settings()
    {
       $setting =  GeneralSetting::first();
        return view('admin.sitesetting', compact('setting'));
    }
    public function settingsUpdate(Request $request)
    {
        $this->validate($request,[
            'sitename'=>'required',
            'fixed' => 'required|min:10|numeric',
            'percentage'=>'required|min:10|numeric',
            'refJoinBonus'=>'required|min:10|numeric',
            'interest'=>'required|min:10|numeric',
            'nrmJoinBonus'=>'required|min:10|numeric',
            'trxBonus'=>'required|min:1|numeric',
            'regBonus'=>'required|min:1|numeric',
            
        ]);
        $setting =  GeneralSetting::first();
        $setting->site_name = $request->sitename;
        $setting->fixed_charge = $request->fixed;
        $setting->percentage_charge = $request->percentage;
        $setting->ref_join_bonus = $request->refJoinBonus;
        $setting->nrm_join_bonus = $request->nrmJoinBonus;
        $setting->ref_trx_bonus = $request->trxBonus;
        $setting->ref_reg_bonus = $request->regBonus;
        $setting->interest = $request->interest;
        $setting->update();

        return back()->with('success','Setting Updated');

    }

    public function giveInterest(Request $request)
    {
        $this->validate($request,[
            'interest'=>'required|min:5|numeric'
        ]);
       
        $users = User::all();
        foreach($users as $user){
           $user->Balance+= $user->Balance*($request->interest/100);
           $user->save();
        }
        return back()->with('success','Interest added to user balance');
    }
}
