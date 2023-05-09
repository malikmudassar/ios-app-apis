<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class LoginAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if session is started
        if (!session()->has('id')) {
            return redirect('/');
        }

        return $next($request);
    }
}
?>