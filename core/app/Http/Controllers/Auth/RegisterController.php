<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Transaction;
use App\GeneralSetting;
use App\Referral_bonus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            $ref = session(['referrer' => $request->query('ref')]);
        }

        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {


        $referrer = User::whereUsername(session()->pull('referrer'))->first();
        // dd($referrer);

        $setting = GeneralSetting::first();
        //Referrer bonus adding
        if ($referrer) {
            $referredBy = User::where('id', $referrer->id)->first();
            $referredBy->Balance = $referredBy->Balance + $setting->ref_reg_bonus;
            $referredBy->save();

            //referrer.....
            $referrerTrx = new Transaction();
            $referrerTrx->user_id = $referredBy->id;
            $referrerTrx->trx_number = Str::random(12);
            $referrerTrx->amount = $setting->ref_reg_bonus;
            $referrerTrx->trx_type = '+' . $setting->ref_reg_bonus;
            $referrerTrx->post_balance = $referredBy->Balance;
            $referrerTrx->details = 'From' . ' ' . $data['name'] . ' ' . 'for sign up';
            $referrerTrx->charge = 0;
            $referrerTrx->save();
            

            $bonus = new Referral_bonus();
            $bonus->user_id = $referredBy->id;
            $bonus->amount = $setting->ref_reg_bonus;
            $bonus->details = 'From' . ' ' . $data['name'] . ' ' . 'for sign up';
            $bonus->save();
            
        }


        //create user
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'referrer_id' => $referrer ? $referrer->id : null,
            'Balance' => $referrer ? $setting->ref_join_bonus : $setting->nrm_join_bonus,
            'phone' => $data['phone'],
            'address' => $data['address']
        ]);

        //signup bonus transaction with or without referral
            $trx = new Transaction();
            $trx->user_id = $user->id;
            $trx->trx_number = Str::random(12);
            $trx->amount = $user->Balance;
            $trx->trx_type = '+' . $user->Balance;
            $trx->post_balance = $user->Balance;
            $trx->details = $referrer ? 'For referral sign up bonus' : 'For sign up bonus';
            $trx->charge = 0;
            $trx->save();
        

        return $user;
    }

}
