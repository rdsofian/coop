<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // return redirect(RouteServiceProvider::HOME);
            $roles = Auth::user()->roles;
            $name = null;
            foreach ($roles as $key => $role) {
                $name = $role['name'];
            }
            switch ($name) {
                case 'Admin':
                  return redirect('/');
                  break;
                case 'student':
                  return redirect('/check');
                  break;
              }
        }
          return $next($request);
    }
}
