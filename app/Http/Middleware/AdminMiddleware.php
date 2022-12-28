<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleEnum;
use Closure;
use Illuminate\Http\Request;


class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!isAdmin()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
