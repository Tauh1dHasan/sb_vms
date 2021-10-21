<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Permission;

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
        view()->share('permission', Permission::where('permission_id', 1)->first());
        view()->share('permission2', Permission::where('permission_id', 2)->first());
        view()->share('permission3', Permission::where('permission_id', 3)->first());
        view()->share('permission4', Permission::where('permission_id', 4)->first());
        view()->share('permission5', Permission::where('permission_id', 5)->first());
        view()->share('permission6', Permission::where('permission_id', 6)->first());
        view()->share('permission7', Permission::where('permission_id', 7)->first());
        view()->share('permission8', Permission::where('permission_id', 8)->first());
        view()->share('permission9', Permission::where('permission_id', 9)->first());
        view()->share('permission10', Permission::where('permission_id', 10)->first());
        view()->share('permission11', Permission::where('permission_id', 11)->first());
        view()->share('permission12', Permission::where('permission_id', 12)->first());
        view()->share('permission13', Permission::where('permission_id', 13)->first());
        view()->share('permission14', Permission::where('permission_id', 14)->first());
        view()->share('permission15', Permission::where('permission_id', 15)->first());
        view()->share('permission16', Permission::where('permission_id', 16)->first());
        view()->share('permission17', Permission::where('permission_id', 17)->first());
        view()->share('permission18', Permission::where('permission_id', 18)->first());
        view()->share('permission19', Permission::where('permission_id', 19)->first());
        view()->share('permission20', Permission::where('permission_id',20)->first());
        view()->share('permission21', Permission::where('permission_id', 21)->first());
        view()->share('permission22', Permission::where('permission_id', 22)->first());
        view()->share('permission23', Permission::where('permission_id', 23)->first());
        view()->share('permission24', Permission::where('permission_id', 24)->first());
    }
}
