<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];


    public function user() {
        return $this->belongsTo(User::class);
    }


    public function school() {
        return $this->belongsTo(School::class);
    }


    public function products() {
        return $this->hasMany(MerchantProduct::class);
    }


    public function getStatusNameAttribute() {
        $status = $this->status;
        $name   = null;

        switch($status) {
            case 1: $name = 'Pending'; break;
            case 2: $name = 'Rejected'; break;
            case 5: $name = 'Suspended'; break;
            case 3: $name = 'Closed'; break;
            case 4: $name = 'Open'; break;
            default: $name = 'Unknown'; break;
        }

        return $name;
    }
}
