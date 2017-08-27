<?php
namespace App\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
        // Redirect any HTTP requests to HTTPS
        if (!$request->secure())
            return redirect()->secure($request->getRequestUri());
        return $next($request); 
    }
}