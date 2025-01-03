<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permissions): Response
    {
        $reqPermission = explode('|',$permissions);

        if(in_array(auth()->user()->permission, $reqPermission)){
            return $next($request);
        }

        return response()->json(['error' => 'Forbidden'], Response::HTTP_FORBIDDEN);
    }
}
