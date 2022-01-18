<?php

namespace App\Models;

use App\Helpers\RandomCodeHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];


    static protected function boot() {
        parent::boot();

        parent::creating(function($model) {
            $code = RandomCodeHelper::make(10);
            $code = "WLT$code";
            $code = strtoupper($code);

            $model->code = $code;
        });
    }


    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }


    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }


    public function getStatusName() {
        $status = $this->status;
        $name   = null;

        switch($status) {
            case 1: $name = 'Pending'; break;
            case 2: $name = 'Paid'; break;
            case 3: $name = 'Expired'; break;
            case 4: $name = 'Success'; break;
            case 5: $name = 'Failed'; break;
            default: $name = 'Unknown';
        }

        return $name;
    }


    public function getTypeName() {
        $type   = $this->type;
        $name   = null;

        switch($type) {
            case 1: $name = 'Topup'; break;
            case 2: $name = 'Buy'; break;
            case 3: $name = 'Transfer'; break;
        }

        return $name;
    }
}
