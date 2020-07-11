<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\GeneralSetting;
use App\Referral_bonus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
                session(['referrer' => $request->query('ref')]);
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
            'username' => ['required', 'string', 'max:255'],
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
       
        $setting = GeneralSetting::first();
        //Referrer bonus adding
        if($referrer){
            $referredBy = User::where('id',$referrer->id)->first();
            $referredBy->Balance = $referredBy->Balance+$setting->ref_reg_bonus;
            $referredBy->save();
            
            Referral_bonus::create([
                'user_id'=>$referredBy->id,
                'amount'=> $setting->ref_reg_bonus,
                'details'=>'From'.' '.$data['name'].' '.'for sign up'
            ]);
        }
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'referrer_id' => $referrer ? $referrer->id : null,
            'Balance' =>$referrer ? $setting->ref_join_bonus:$setting->nrm_join_bonus,
            'phone'=>$data['phone'],
            'address'=>$data['address']
        ]);

        

    }

    protected function registered(Request $request, $user)
    {
        
        
    }

    
}
