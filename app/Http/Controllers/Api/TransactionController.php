<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorException as Error;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function topup(Request $request) {
        try{
            $validator = Validator::make($request->all(), [
                'amount'    => 'required|numeric',
            ]);

            if($validator->fails()) {
                $errors = $validator->errors()->all();
                throw new Error('Unprocessable', 422, $errors);
            }

            $transaction = Transaction::create([
                'receiver_id'   => auth()->id(),
                'amount'        => $request->amount,
                'status'        => 1, // Pending
                'type'          => 1, // Topup
            ]);

            return ResponseHelper::make($transaction);
        }catch(Error $err) {
            return ResponseHelper::error(
                $err->getErrors(),
                $err->getMessage(),
                $err->getCode(),
            );
        }
    }
}
