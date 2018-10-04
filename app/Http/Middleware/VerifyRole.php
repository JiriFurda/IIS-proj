<?php

namespace App\Http\Middleware;

use Closure;

class VerifyRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $requiredRole)
    {
        if(!auth()->user()->isAuthorised($requiredRole))
            abort(500, 'Na zobrazení této stránky nemáte dostatečná oprávnění.');

        return $next($request);
    }
}
