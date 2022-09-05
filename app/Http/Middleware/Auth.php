<?php

namespace App\Http\Middleware;

use App\Models\Product;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class Auth
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
        if ($request->header('Authorization')) {
            $user = User::query()->where('api_token', '=', explode(' ', $request->header('Authorization'))[1])->get()->all()[0];
            if ($user) {
                $request->setUserResolver(function () use ($user) {
                   return $user;
                });
                return $next($request);
            }
        }
        abort(403);
        return response();
    }
}
