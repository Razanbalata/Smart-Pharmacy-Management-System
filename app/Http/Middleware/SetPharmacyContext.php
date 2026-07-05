<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetPharmacyContext
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            app()->instance('pharmacy_id', auth()->user()->pharmacy_id);
        }

        return $next($request);
    }
}