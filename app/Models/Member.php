<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];

    
    public function user() {
        return $this->belongsTo(User::class);
    }


    public function school() {
        return $this->belongsTo(School::class);
    }


    public function role() {
        return $this->belongsTo(MemberRole::class);
    }
}
