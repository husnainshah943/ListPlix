<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()){
            if (Auth::user()->role == 'admin'){
                return $next($request);
            }else{
                return response()->json(['error' => 'Acess Denied as you are not an admin.'], 401);
            }

        }else{
            return response()->json(['error' => 'Acess Denied as you are not an admin.'], 401);
        }
        return $next($request);
    }
}
