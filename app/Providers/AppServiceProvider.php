<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Transaction;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Hanya Admin
        Gate::define('admin-only', function (User $user) {
            return $user->role === 'admin';
        });

        // Admin & Kasir
        Gate::define('admin-kasir', function (User $user) {
            return in_array($user->role, ['admin', 'kasir']);
        });

        // Customer saja
        Gate::define('customer-only', function (User $user) {
            return $user->role === 'customer';
        });

        view()->composer('*', function ($view) {
        if (auth()->check() && in_array(auth()->user()->role, ['admin', 'kasir'])) {
            $pendingCount = Transaction::where('status', 'pending')
                                       ->where('sumber', 'customer')
                                       ->count();
            $view->with('pendingMenuCount', $pendingCount);
        }
    });
    }
}