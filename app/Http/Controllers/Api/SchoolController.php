<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorException as Error;
use App\Helpers\{ResponseHelper, RandomCodeHelper};
use App\Http\Resources\{TransactionResource, UserResource};
use App\Models\{Transaction, User};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function store(Request $request) {
        try{
            $user  = User::find(auth()->id());

            $user->school()->firstOrCreate();
            $user->load(['school']);

            return ResponseHelper::make(
                UserResource::make($user)
            );
        }catch(Error $err) {
            return ResponseHelper::error(
                $err->getErrors(),
                $err->getMessage(),
                $err->getCode(),
            );
        }
    }
    
    
    public function indexTransaction(Request $request) {
        $perPage        = (int) $request->per_page;
        $user           = User::with(['school'])->find(auth()->id());
        $transactions   = Transaction::where('school_id', $user->school->id)
            ->paginate($perPage);

        return ResponseHelper::paginate(
            TransactionResource::collection($transactions)
        );
    }
}
