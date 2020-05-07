<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use DB;
class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            foreach ($user->roles as $role) {
                if($role->id != 1)
                {
                    return $next($request);
                }
                else
                {
                    return redirect('admin/login');
                }
            }
        }
        else
        {
            return redirect('admin/login');
        }
    }
}
