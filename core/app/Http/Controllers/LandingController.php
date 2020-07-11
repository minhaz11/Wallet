<?php

namespace App\Http\Controllers;

use App\GeneralSetting;
use Illuminate\Http\Request;

class LandingController extends Controller
{
   public function index()
   {
       $setting = GeneralSetting::first();
       return view('welcome',compact('setting'));
   }
}
