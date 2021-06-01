<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class verifyUserAdminOrModerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->user()->isModerator() && !auth()->user()->isAdmin()){
            return redirect()->back();
        }
        return $next($request);
    }
}
/*
 * mod add  false
 *
 * !mod add  false
 *
 * mod !add  false
 *
 * !mod !add true
 */
