<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale('tr');

    }
    protected $listen = [
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\UpdateLastLogin::class,
        ],
    ];
    
}
