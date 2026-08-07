<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\TaskCreated;
use App\Listeners\LogTaskCreated;
use Illuminate\Support\Facades\Event;

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
    Event::listen(TaskCreated::class, LogTaskCreated::class);
}
}
