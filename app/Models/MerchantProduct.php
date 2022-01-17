<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded  = ['id'];


    public function merchant() {
        return $this->belongsTo(Merchant::class);
    }
}
