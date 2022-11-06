<?php

namespace App\Http\Middleware;

use App\ModulePermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionChecker
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
        $role = Session::get('role');
        if(Session::has('user_id'))
        {  
            
            $users = ModulePermission::where('role_id',$role)->get();
            
            return $next($request);

        }
    }
}
