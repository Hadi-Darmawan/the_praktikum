<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Role;
use App\Model\DetailRole;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $expression)
    {
        $login_id = auth()->guard()->user()->id;
        $roles = explode('|', $expression);
        $role_id = Role::whereIn('nama_role', $roles)->select('id')->get();
        $check_role = DetailRole::whereIn('id_role', $role_id->toArray())->where('id_login', $login_id)->get();

        # Role checking
        if (count($check_role) > 0) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
