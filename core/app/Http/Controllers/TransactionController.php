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
            'amount' => 'required|numeric|min:10'
        ]);
        $setting = GeneralSetting::first();
        $sender = Auth::user(); //sender 
        $receiver = User::where('username', $request->username)->first(); //receiver

        if (!$receiver || $receiver->username == $sender->username) {
            return back()->with('error', 'Invalid Username');
        }

        $charge = $request->amount * ($setting->percentage_cahrge / 100) + $setting->fixed_charge;
        $totalAmount = $request->amount + $charge;

        if ($totalAmount > $sender->Balance) {
            return back()->with('error', 'Insufficient balance');
        }

        $trx_number = Str::random(12);

        //adding balance to reciever
        $receiver->Balance += $request->amount;
        $receiver->save();
       
        //creating transaction for reciever
        $recieverTrx =  new Transaction();
        $recieverTrx->user_id = $receiver->id;
        $recieverTrx->trx_number = $trx_number;
        $recieverTrx->amount = $request->amount;
        $recieverTrx->trx_type = $request->amount;
        $recieverTrx->post_balance = $receiver->Balance + $request->amount;
        $recieverTrx->details = 'Recieved from' . ' ' . $sender->name;
        $recieverTrx->charge = $charge;
        $recieverTrx->save();
        

        //sending mail to reciecer
        $sitename = GeneralSetting::first();
        $subject = 'Money Transaction';
        $message = 'Money recieved from' . ' ' . $sender->name . ' ' . 'BDT' . ' ' . $request->amount . ' ' . 'Taka';
        sendMail($sitename->site_name,$sender->email,$receiver->email, $subject, $message);


        $sender_post_balance =  $sender->Balance - $totalAmount;
        //creating transaction for sender
        $senderTrx =  new Transaction ();
        $senderTrx->user_id = $sender->id;
        $senderTrx->trx_number = $trx_number;
        $senderTrx->amount = $request->amount;
        $senderTrx->trx_type = '-' . $request->amount;
        $senderTrx->post_balance = $sender_post_balance;
        $senderTrx->details = 'Sent to' . ' ' . $receiver->name;
        $senderTrx->charge = $charge;
        $senderTrx->save();

        //subtract balance from sender
        $sender->Balance -= $totalAmount;
        $sender->save();

        //if signed up user who is from a referral link,the referrar will get money to every transaction
        if ($sender->referrer_id !== null) {
            $referer = User::where('id', $sender->referrer_id)->first();
            $bonusAmount = $request->amount * ($setting->ref_trx_bonus / 100);
            $referer->Balance = $referer->Balance + $bonusAmount;

            //referrer Transaction
            $referrerTrx = new Transaction();
            $referrerTrx->user_id = $referer->id;
            $referrerTrx->trx_number = Str::random(12);
            $referrerTrx->amount = $bonusAmount;
            $referrerTrx->trx_type = '+' . $bonusAmount;
            $referrerTrx->post_balance =  $referer->Balance;
            $referrerTrx->details = 'Recieved for referral trx bonus from' . ' ' . $sender->name . ' ';
            $referrerTrx->charge = 0;
            $referrerTrx->save();
           

            $referer->save();

            
            $bonus = new Referral_bonus ();
            $bonus->user_id = $referer->id;
            $bonus->amount = $request->amount * ($setting->ref_trx_bonus / 100);
            $bonus->details = 'From' . ' ' . $sender->name . ' ' . 'for transaction';
            $bonus->save();
          
        }

        return back()->with('success', 'Balance Transfered');
    }

    //All transaction Logs
        public function allTransaction()
        {
            $trxs = Transaction::with('user')->paginate(15);
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
            $this->validate($request, [
                'search' => 'required'
            ]);

            $trxs = Transaction::where('trx_number', $request->search)->get();
            if ($trxs->isEmpty()) {
                return back()->with('error', 'Transaction does not exist');
            }
            return view('admin.trxSearchResult', compact('trxs'));
        }
}
