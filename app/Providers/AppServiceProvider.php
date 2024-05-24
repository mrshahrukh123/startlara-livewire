<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Implicitly grant "Super-Admin" role all permission checks using can()
         Gate::before(function ($user, $ability) {
                 if ($user->hasRole(User::DEV_ADMIN_ROLE)) {
                     return true;
                 }
             });
    }
}
