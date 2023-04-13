<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class TokenAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if token is valid
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized token'], 401);
        }

        return $next($request);
    }
}
?>