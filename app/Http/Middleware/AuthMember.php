<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('member')->check()) {
            return to_route('guest.member.login');
        } else {
            if (auth()->guard('member')->user()->status != 'diterima') {
                Auth::guard('member')->logout();
            }
        }
        return $next($request);
    }
}
