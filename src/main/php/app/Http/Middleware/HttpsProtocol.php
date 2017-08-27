<?php
namespace App\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
        // Redirect any HTTP requests to HTTPS
        if (!($request->secure()) )//&& env('APP_ENV') === 'production')
            return redirect()->secure($request->getRequestUri());
        return $next($request); 
    }
}