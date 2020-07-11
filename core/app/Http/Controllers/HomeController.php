<?php

namespace App\Http\Controllers;

use App\GeneralSetting;
use App\Referral_bonus;
use App\User;
use App\User_info;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $trxs = $user->transactions()->paginate(15);
        return view('user.home', compact('trxs'));
    }
    public function showProfile()
    {
        
       
        return view('user.profile');
    }
    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'address' => 'required',
            'phone'=>'required',
            'username'=>'required'
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->save();

         return back()->with('success','Profile Updated');
    }

    public function referralLog()
    {
        $user = Auth::user();
        $logs = User::where('referrer_id',$user->id)->with('referrer')->paginate(10);
        return view('user.referralLog',compact('logs'));
    }

    public function referralBonus()
    {
        $user = Auth::user();
        $bonuses = Referral_bonus::where('user_id',$user->id)->paginate(15);
        return view('user.referralBonus',compact('bonuses'));
    }

    public function updatePassword(Request $request)
    {
       
        $this->validate($request,[
            'oldPassword'=>'required',
            'password'=>'required|confirmed|min:6',
        ]);

        $hashed = Auth::user()->password;
        if(Hash::check($request->oldPassword, $hashed)){
            if(Hash::check($request->password, $hashed)){
                $user = User::find(Auth::user()->id);
                $user->password = bcrypt($request->password);
                $user->save();
            }

        }

        return back()->with('success','Password Updated');

    }

    public function sendReferral(Request $request)
    {
        $sitename = GeneralSetting::first();
        $sender = Auth::user();

       
        $subject ='Referral to join E-Wallet';
        $message = $request->link;
       
        $headers = "From: $sitename->site_name <$sender->email> \r\n";
        $headers .= "Reply-To:  <$request->email> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        mail($request->email, $subject, $message, $headers);

        return back()->with('success','Referral has been sent');
    }
}
