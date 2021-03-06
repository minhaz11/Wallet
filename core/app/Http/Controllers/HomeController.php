<?php

namespace App\Http\Controllers;

use App\GeneralSetting;
use App\Referral_bonus;
use App\User;
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
        $trxs = Transaction::where('user_id',$user->id)->with('user')->paginate(15);
        $logs = User::with('referrer')->where('referrer_id',$user->id)->get('referrer_id');
        $bonuses = Referral_bonus::where('user_id',$user->id)->get('amount');
        return view('user.home', compact('trxs','logs','bonuses'));
    }
 public function trxLogs()
    {
        $user = Auth::user();
        $trxs = Transaction::where('user_id',$user->id)->with('user')->paginate(15);
        return view('user.transactionLog',compact('trxs'));
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
           
            'img'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
           
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->address = $request->address;
       
        if($request->file('img')){
            $name = time().'.'.$request->img->extension();
            $path = 'assets/img';
            if($user->photo !== null){
                unlink( $path.'/'.$user->photo);
            }
            $request->img->move($path,$name);
            $user->photo =  $name;
        }
        $user->save();
        return back()->with('success','Profile Updated');
    }

    public function referralLog()
    {
        $user = Auth::user();
        $logs = User::with('referrer')->where('referrer_id',$user->id)->paginate(10);
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
        $this->validate($request,[
            'email' => 'required|email'
        ]);
       
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
