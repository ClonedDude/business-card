<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TeamsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()) {
            if(Auth::user()->companies()->first()) {
            if (empty(session("company_id"))) {
                $company = Auth::user()->companies()->first();
                $request->session()->put('company_id', $company->id);
    
                setPermissionsTeamId($company->id);
            }
        
            setPermissionsTeamId(session('company_id'));
            }
        }

        return $next($request);
    }
}