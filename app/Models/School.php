<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];


    public function user() {
        return $this->belongsTo(User::class);
    }


    public function members() {
        return $this->hasMany(Member::class);
    }


    public function merchants() {
        return $this->hasMany(Merchant::class);
    }
}
