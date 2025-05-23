<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Halaman default setelah login
     */
    public const HOME = '/dashboard'; // Ganti '/dashboard' sesuai halaman tujuanmu
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
