<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorException as Error;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\{School, User};
use App\Traits\Api\RequestValidator;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    use RequestValidator;

    public function store(Request $request) {
        try{
            $this->validate($request, [
                'school_code'   => 'required|exists:schools,code',
                'description'   => 'nullable|max:255',
            ]);

            $code   = $request->school_code;
            $school = School::findCode($code);
            $user   = User::find(auth()->id());

            $user->merchant()->firstOrCreate([
                'school_id'     => $school->id,
                'description'   => $request->description,
            ]);

            $user->load(['merchant.school']);

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
}
