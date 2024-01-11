<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsVerifiyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->is_email_verified) {
            auth()->logout();
            return redirect()->route('login')
                ->with('message', 'You need to confirm your account. The author will does not verified your account, please wait untill verification.');
        }
        return $next($request);
    }
}
