<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'candidate') {
            abort(403, 'Unauthorized. Candidate access only.');
        }

        return $next($request);
    }
}
