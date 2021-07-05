<?php

namespace App\Providers;

use App\Model\Role;
use App\Model\DetailRole;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('roles', function ($expression) {
            $login_id = auth()->guard()->user()->id;
            $role_id = Role::whereIn('nama_role', $expression)->select('id')->get();
            $check_role = DetailRole::whereIn('id_role', $role_id->toArray())->where('id_login', $login_id)->get();

            # Role checking
            if ($check_role != NULL) {
                if (count($check_role) > 0) {
                    return true;
                }
            }
        });
    }
}
