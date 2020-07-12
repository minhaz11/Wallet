<?php

namespace App\Http\Controllers;

use App\GeneralSetting;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class LandingController extends Controller
{
   public function index()
   {
        $setting = GeneralSetting::first(['site_name']);
        $totalTrx = Transaction::get(['amount']);
        $totalUser = User::get(['id']);
       return view('welcome',compact('setting','totalTrx','totalUser'));
   }
}
