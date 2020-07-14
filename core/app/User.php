<?php

namespace App;

use App\User_info;
use App\Transaction;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];
 use SoftDeletes;
 protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

/**
 * A user has many referrals.
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }


    protected $appends = ['referral_link'];
  
    public function getReferralLinkAttribute()
    {
        return $this->referral_link = route('register', ['ref' => $this->username]);
    }
}
