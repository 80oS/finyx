<?php

namespace App\Providers;

use App\Repositories\RolRepository;
use App\Services\RolService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Desarrollador') ? true : null;
        });
        
        Schema::defaultStringLength(191);
    }
}
