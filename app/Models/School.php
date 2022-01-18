<?php

namespace App\Models;

use App\Helpers\RandomCodeHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];


    static protected function boot() {
        parent::boot();

        parent::creating(function($model) {
            if(!$model->code)
                $model->code = RandomCodeHelper::make();
        });
    }


    public function user() {
        return $this->belongsTo(User::class);
    }


    public function members() {
        return $this->hasMany(Member::class);
    }


    public function merchants() {
        return $this->hasMany(Merchant::class);
    }


    public function scopeFindCode($query, $code) {
        return $query->whereCode($code)->first();
    }
}
