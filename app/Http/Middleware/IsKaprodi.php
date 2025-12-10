<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsKaprodi
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'kaprodi') {
            return $next($request);
        }

        abort(403, 'Anda tidak memiliki akses.');
    }
}
