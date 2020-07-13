<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Admin;
use App\Transaction;
use App\GeneralSetting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\Interest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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
        $settings = GeneralSetting::first();
        return view('admin.dashboard', compact('latestUsers', 'latestTrx', 'latestRefUsers', 'settings'));
    }

    public function settings()
    {
        $setting =  GeneralSetting::first();
        return view('admin.sitesetting', compact('setting'));
    }
    public function settingsUpdate(Request $request)
    {
        $this->validate($request, [
            'sitename' => 'required',
            'fixed' => 'required|min:0|numeric',
            'percentage' => 'required|min:0|numeric',
            'refJoinBonus' => 'required|min:10|numeric',
            'interest' => 'required|min:5|numeric',
            'nrmJoinBonus' => 'required|min:5|numeric',
            'trxBonus' => 'required|min:1|numeric',
            'regBonus' => 'required|min:1|numeric',

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

        return back()->with('success', 'Setting Updated');
    }

    public function giveInterest(Request $request)
    {
        $this->validate($request, [
            'interest' => 'required|min:5|numeric'
        ]);

        $users = User::all();
        foreach ($users as $user) {
            $totalAmount = $user->Balance * ($request->interest / 100);
            $user->Balance +=  $totalAmount;

            Transaction::create([
                'user_id' => $user->id,
                'trx_number' => Str::random(12),
                'amount' => $totalAmount,
                'trx_type' => '+' . $totalAmount,
                'post_balance' =>  $user->Balance,
                'details' => 'Recieved monthly interest from Admin',
                'isInterest'=>true,
                'charge' => 0
            ]);
            $user->save();
        }
        return back()->with('success', 'Interest added to user balance');
    }

    public function interestLogs()
    {
       
        $interests = Transaction::where('isInterest', true)->paginate(15);

        return view('admin.interestLog', compact('interests'));
    }


    //admin adding balance to user
    public function balanceOperation(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'amount' => 'required|min:10|numeric'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->with('error', 'User does not exist');
        }

        if ($request->op == 'add') {
            $user->Balance += $request->amount;
            $message = 'Balance added to' . ' ' . $user->username;
        } else {
            if ($request->amount > $user->Balance) {
                return back()->with("error", "Insuffiecient balance!!!");
            } else {
                $user->Balance -= $request->amount;
                $message = 'Balance subtract from' . ' ' . $user->username;
            }
        }

        Transaction::create([
            'user_id' => $user->id,
            'trx_number' => Str::random(12),
            'amount' => $request->amount,
            'trx_type' => $request->op == 'add' ? '+' . $request->amount : '-' . $request->amount,
            'post_balance' => $user->Balance,
            'details' => $request->op == 'add' ? 'Recieved from Admin' : 'Subtract by Admin',
            'charge' => 0
        ]);

        //sending mail to user
        $sitename = GeneralSetting::first();
        $admin = Auth::guard('admin')->user();
      
        $subject = 'Money Transaction';
        $msg = 'Money recieved from' . ' ' . $admin->name . ' ' . 'BDT' . ' ' . $request->amount . ' ' . 'Taka';

        //sending mail
        sendMail($sitename->site_name,$admin->email,$user->email,$subject, $msg);

        $user->save();
        return back()->with('success', $message);
    }

   
}
