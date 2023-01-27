<?php

namespace App\Http\Middleware;

use Closure;

class autoCheckPermission
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
        $route = $request->route()->getName();
        $permission = \Spatie\Permission\Models\Permission::whereRaw("FIND_IN_SET('$route',routes)")->where('guard_name','admin')->first();

        if($permission)
        {
            if(!auth('admin')->user()->can($permission->name))
            {
                abort(503);
            }
        }
        return $next($request);
    }
}
