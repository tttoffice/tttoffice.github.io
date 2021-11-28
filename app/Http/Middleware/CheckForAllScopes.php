<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class CheckForAllScopes
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$scopes
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\AuthenticationException|\Laravel\Passport\Exceptions\MissingScopeException
     */
    public function handle($request, Closure $next, ...$scopes)
    {
        // dd( auth('client')->user()->token() );
        // dd(auth()->user());

        if (!auth()->user() || !auth()->user()->token()) {
            throw new AuthenticationException;
        }

        foreach ($scopes as $scope) {
            if (auth()->user()->tokenCan($scope)) {
                return $next($request);
            }
        }

        return response()->json([
            'status' => false,
            'data' => [],
            'code' => 403,
            'message' => __('msg.Unauthenticated')
        ], 200);
    }
}
