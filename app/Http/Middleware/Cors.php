<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class Cors
{
    public function handle(Request $request, Closure $next) : mixed
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Request-With');
    }
}