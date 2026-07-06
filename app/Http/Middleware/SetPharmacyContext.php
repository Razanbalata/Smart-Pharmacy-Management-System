<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetPharmacyContext
{
    public function handle(Request $request, Closure $next)
    {
        //dd('SetPharmacyContext middleware is being executed.' . auth()->check() ? 'User is authenticated.' : 'User is not authenticated.');
        if (auth()->check()) {
            app()->instance('pharmacy_id', auth()->user()->pharmacy_id);
        }

        return $next($request);
    }
}