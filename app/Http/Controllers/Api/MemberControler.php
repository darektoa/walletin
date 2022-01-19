<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorException as Error;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\{Member, School, User};
use App\Traits\Api\RequestValidator;
use Illuminate\Http\Request;

class MemberControler extends Controller
{
    use RequestValidator;

    public function store(Request $request) {
        try{
            $this->validate($request, [
                'school_code'   => 'required|exists:schools,code',
            ]);

            $code   = $request->school_code;
            $school = School::findCode($code);
            $user   = User::find(auth()->id());

            Member::joinSchool($user, $school);            
            $user->load(['member.school']);

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
