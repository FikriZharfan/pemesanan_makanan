<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CaptureBangku
{
    /**
     * Handle an incoming request.
     * If there's a `bangku` query parameter, store it in session as `selected_bangku`.
     */
    public function handle(Request $request, Closure $next)
    {
        $bangku = $request->query('bangku');
        if ($bangku) {
            $request->session()->put('selected_bangku', $bangku);
        }
        return $next($request);
    }
}
