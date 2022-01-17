<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $guarded  = ['id'];

    protected $hidden   = [
        'password',
        'remember_token',
    ];

    protected $casts    = [
        'email_verified_at' => 'datetime',
    ];


    public function school() {
        return $this->hasOne(School::class);
    }


    public function member() {
        return $this->hasOne(Member::class);
    }


    public function merchant() {
        return $this->hasOne(Merchant::class);
    }


    public function sendTransactions() {
        return $this->hasMany(Transaction::class, 'sender_id');
    }
    
    
    public function receiveTransactions() {
        return $this->hasMany(Transaction::class, 'receiver_id');
    }
}
