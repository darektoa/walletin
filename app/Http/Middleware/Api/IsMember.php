<?php

namespace App\Http\Middleware\Api;

use App\Helpers\ResponseHelper;
use Closure;
use Illuminate\Http\Request;

class IsMember
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
        if(isset(auth()->user()->member))
            return $next($request);

        return ResponseHelper::make([], 'Forbidden', 403);
    }
}
