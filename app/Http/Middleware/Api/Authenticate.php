<?php

namespace App\Http\Middleware\Api;

use App\Helpers\ResponseHelper;
use App\Models\PersonalAccessToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $authorization  = $request->header('Authorization');
        $authorization  = explode(' ', $authorization, 2);
        $type           = $authorization[0];
        $token          = $authorization[1] ?? null;
        $token          = $token ? PersonalAccessToken::findToken($token) : null;
        $user           = $token ? $token->tokenable : null;

        // TOKEN & HEADER VALIDATION
        if(!$request->hasHeader('Authorization'))
            return ResponseHelper::error(['Missing "Authorization" header request'], 'Unauthorized', 401);
        if($type !== 'Bearer')
            return ResponseHelper::error(['Invalid authorization type'], 'Unauthorized', 401);
        if(!$user)
            return ResponseHelper::error(['Invalid authorization token'], 'Unauthorized', 401);

        Auth::login($user);
        return $next($request);
    }
}
