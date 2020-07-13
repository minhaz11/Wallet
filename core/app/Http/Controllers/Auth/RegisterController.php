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
            'phone' => ['required', 'string', 'max:255'],
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
            Transaction::create([
                'user_id' => $referredBy->id,
                'trx_number' => Str::random(12),
                'amount' => $setting->ref_reg_bonus,
                'trx_type' => '+' . $setting->ref_reg_bonus,
                'post_balance' => $referredBy->Balance,
                'details' => 'From' . ' ' . $data['name'] . ' ' . 'for sign up',
                'charge' => 0
            ]);

            Referral_bonus::create([
                'user_id' => $referredBy->id,
                'amount' => $setting->ref_reg_bonus,
                'details' => 'From' . ' ' . $data['name'] . ' ' . 'for sign up'
            ]);
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
        Transaction::create([
            'user_id' => $user->id,
            'trx_number' => Str::random(12),
            'amount' => $user->Balance,
            'trx_type' => '+' . $user->Balance,
            'post_balance' => $user->Balance,
            'details' => $referrer ? 'For referral sign up bonus' : 'For sign up bonus',
            'charge' => 0
        ]);

        return $user;
    }

    protected function registered(Request $request, $user)
    {
    }
}
