<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorException as Error;
use App\Helpers\{ResponseHelper, UsernameHelper};
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Traits\Api\RequestValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, Validator};

class AuthController extends Controller
{
    use RequestValidator;

    public function register(Request $request) {
        try{
            $this->validate($request, [
                'name'      => 'required|min:3|max:40',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required|min:8|max:20'
            ]);

            $user = User::create([
                'name'      => $request->name,
                'username'  => UsernameHelper::email($request->email),
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ]);

            $token       = $user->createToken('user');
            $user->token = $token->plainTextToken;

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


    public function login(Request $request) {
        try{
            $email      = $request->email;
            $password   = $request->password;
            $account    = User::where('email', '=', $email)
                ->orWhere('username', '=', $email)
                ->first();

            if(!$account) throw new Error('Not found', 404, [
                "Account doesn't exist"
            ]);

            if(!(
                Auth::attempt(['email' => $email, 'password' => $password]) ||
                Auth::attempt(['username' => $email, 'password' => $password])
            )) throw new Error('Unauthorized', 401, ["Account doesn't match"]);

            $user           = User::find(auth()->id());
            $token          = $user->createToken('user');
            $user->token    = $token->plainTextToken;

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
