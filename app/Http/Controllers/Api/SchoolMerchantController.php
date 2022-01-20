<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\MerchantResource;
use App\Models\{Merchant, User};
use Illuminate\Http\Request;

class SchoolMerchantController extends Controller
{
    public function index(Request $request) {
        $perPage    = (int) $request->per_page;
        $user       = User::with(['school'])->find(auth()->id());
        $members    = Merchant::with(['user'])
            ->where('school_id', $user->school->id)
            ->paginate($perPage);

        return ResponseHelper::paginate(
            MerchantResource::collection($members)
        );
    }
}
