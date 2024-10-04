<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UseSystemUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Find the system user by email (or another identifier)
        if (auth()->user() === null) {
            $systemUser = User::where('email', 'system@example.com')->first();
            Auth::login($systemUser);
           
        }

        return $next($request);
    }
}
