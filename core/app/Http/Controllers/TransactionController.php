<?php

namespace App\Http\Controllers;

use App\GeneralSetting;
use App\Referral_bonus;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:web,admin');
    }

    //tarnsaction operation
    public function transaction(Request $request)
    {
        //validating inputs
        $this->validate($request, [
            'username' => 'required',
            'amount' => 'required|min:10|numeric'
        ]);
        $setting = GeneralSetting::first();
        $sender = Auth::user(); //sender 
        $receiver = User::where('username', $request->username)->first(); //receiver

        if (!$receiver || $receiver->username == $sender->username) {
            return back()->with('error','Invalid Username');

        }

            $charge = $request->amount * ($setting->percentage_cahrge / 100) + $setting->fixed_charge;
            $totalAmount = $request->amount + $charge;

            if($totalAmount > $sender->Balance){
                return back()->with('error','In sufficient balance');
            }
            
                $trx_number = Str::random(12);

                //adding balance to reciever
                $receiver->Balance += $request->amount;
                $receiver->save();
                //creating transaction for reciever
                Transaction::create([
                    'user_id' => $receiver->id,
                    'trx_number' => $trx_number,
                    'amount' => $request->amount,
                    'trx_type' => $request->amount,
                    'post_balance' => $receiver->Balance + $request->amount,
                    'details' => 'Recieved from' . ' ' . $sender->name,
                    'charge' => $charge
                ]);
                

                $sender_post_balance =  $sender->Balance - $totalAmount;
                //creating transaction for sender
                Transaction::create([
                    'user_id' => $sender->id,
                    'trx_number' => $trx_number,
                    'amount' => $request->amount,
                    'trx_type' => '-' . $request->amount,
                    'post_balance' => $sender_post_balance,
                    'details' => 'Sent to' . ' ' . $receiver->name,
                    'charge' => $charge
                ]);

                //subtract balance from sender
                $sender->Balance -= $totalAmount;
                $sender->save();

                //if signed up user who is from a referral link,the referrar will get money to every transaction
                if ($sender->referrer_id !== null) {
                    $user = User::where('id', $sender->referrer_id)->first();
                    $user->Balance += $request->amount * ($setting->ref_trx_bonus / 100);
                    $user->save();
                    
                    Referral_bonus::create([
                        'user_id'=>$user->id,
                        'amount'=> $request->amount * ($setting->ref_trx_bonus / 100),
                        'details'=>'From'.' '.$sender->name.' '.'for transaction'
                    ]);
                }

        return back()->with('success', 'Balance Transfered');
    }


    //All transaction Logs
    public function allTransaction()
    {
        $trxs = Transaction::with('user')->paginate(15);
        // $user = User::where('id',$trxs->user_id)->get();
        return view('admin.allTransactionLog', compact('trxs'));
    }

    //specific user transaction
    public function userTransaction($id)
    {
        $transactions = Transaction::where('user_id', $id)->with('user')->paginate(10);
        return view('admin.userTransaction', compact('transactions'));
    }

    //search
    public function search(Request $request)

    {
        $this->validate($request,[
            'search'=>'required'
        ]);
       
        $trxs= Transaction::where('trx_number', $request->search)->get();
        if($trxs->isEmpty()){
            return back()->with('error','Transaction does not exist');
        }
        return view('admin.trxSearchResult',compact('trxs'));
    }
}
