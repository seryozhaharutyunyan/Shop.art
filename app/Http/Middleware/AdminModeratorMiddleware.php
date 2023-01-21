<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class AdminModeratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $roles=Role::all();
        foreach ($roles as $role){
            if($role->name==='admin'){
                $roleA=$role->id;
            }elseif ($role->name==='moderator'){
                $roleM=$role->id;
            }
        }

        if(\auth()->user()->role_id==$roleA){
            return $next($request);
        }elseif (\auth()->user()->role_id==$roleM){
            return $next($request);
        }

        return \abort(404);
    }
}
