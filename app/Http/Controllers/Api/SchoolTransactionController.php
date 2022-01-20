<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\{Transaction, User};
use Illuminate\Http\Request;

class SchoolTransactionController extends Controller
{
    public function index(Request $request) {
        $perPage        = (int) $request->per_page;
        $user           = User::with(['school'])->find(auth()->id());
        $transactions   = Transaction::where('school_id', $user->school->id)
            ->paginate($perPage);

        return ResponseHelper::paginate(
            TransactionResource::collection($transactions)
        );
    }
}
