<?php

namespace App\Http\Middleware;

use Closure;
use Validation;
use App\Models\EmailAdmin;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check() || $this->isNotAdmin(auth()->user()->email)){
            abort(403, 'Anda bukan admin');
        }
        return $next($request);
    }

    // Return true if not admin
    private function isNotAdmin($email): bool{
        foreach(EmailAdmin::all() as $emailAdmin){
            if ($email == $emailAdmin->email_admin){
                return false;
            }
        }
        return true;
    }
}
