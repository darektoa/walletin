<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorException as Error;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\{Member, School, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberControler extends Controller
{
    public function store(Request $request) {
        try{
            $validator = Validator::make($request->all(), [
                'school_code'   => 'required|exists:schools,code',
            ]);

            if($validator->fails()) {
                $errors = $validator->errors()->all();
                throw new Error('Unprocessable', 422, $errors);
            }

            $code   = $request->school_code;
            $school = School::findCode($code);
            $user   = User::find(auth()->id());

            Member::joinSchool($user, $school);
            
            $user->load([
                'member.school'
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
