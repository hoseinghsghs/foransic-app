<?php

namespace App\Providers;

use App\Models\Action;
use App\Models\Setting;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\View;

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
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        // authorization for update action
        Gate::define('update-action', function (User $user, Action $action) {
            return $user->id == $action->user_id;
        });
        // check if user in same laboratory with model
        Gate::define('is-same-laboratory', function (User $user, $laboratory_id) {
            return $user->laboratory_id == $laboratory_id;
        });
        // share settings between views
        if (Schema::hasTable('settings'))
            View::share('setting', Setting::firstOrNew());
    }
}
