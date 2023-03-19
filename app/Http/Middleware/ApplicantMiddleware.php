<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleEnum;
use Closure;
use Illuminate\Http\Request;


class ApplicantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!isApplicant()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
