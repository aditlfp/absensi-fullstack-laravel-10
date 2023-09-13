<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

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
        Paginator::defaultView('vendor.pagination.custom-cuy');
        
        $startTime = Cache::get('app_start_time');

        if (!$startTime) {
            Cache::put('app_start_time', now(), now()->addHours(24)); // Store the start time for 24 hours
            $startTime = now();
        }

        $uptime = now()->diffInSeconds($startTime);

        $hours = intdiv($uptime, 3600);
        $minutes = intdiv(($uptime % 3600), 60);
        $seconds = $uptime % 60;

        $formattedUptime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        view()->share('uptime', $formattedUptime);
    }
}
