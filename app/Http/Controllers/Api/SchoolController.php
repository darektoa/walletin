<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorException as Error;
use App\Helpers\{ResponseHelper, RandomCodeHelper};
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function store(Request $request) {
        try{
            $user  = User::find(auth()->id());

            $user->school->firstOrCreate([], [
                'code'  => RandomCodeHelper::make()
            ]);

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
