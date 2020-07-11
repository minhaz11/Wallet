<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   protected $guarded = [];

   public function user()
   {
      return $this->belongsTo(User::class);
   }
   // public function sender()
   // {
   //    return $this->belongsTo(User::class,'sender','id');
   // }
}
