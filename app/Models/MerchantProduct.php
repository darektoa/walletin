<?php

namespace App\Models;

use App\Helpers\RandomCodeHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded  = ['id'];


    static protected function boot() {
        parent::boot();

        parent::creating(function($model) {
            if(!$model->code)
                $model->code = RandomCodeHelper::make(20);
        });
    }


    public function merchant() {
        return $this->belongsTo(Merchant::class);
    }
}
