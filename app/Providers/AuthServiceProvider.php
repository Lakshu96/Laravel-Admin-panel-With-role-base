<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Truck;
use App\Models\User;
use App\Policies\ProductPolicy;
use App\Policies\TruckPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
        Truck::class => TruckPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $_ability) {
            if ($user && method_exists($user, 'hasRole') && $user->hasRole(config('authorization.super_admin_role', 'Super Admin'))) {
                return true;
            }

            return null;
        });
    }
}
