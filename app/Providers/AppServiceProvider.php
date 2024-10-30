<?php

namespace App\Providers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Observers\CourseObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ImageService::class, function ($app) {
            return new ImageService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        RateLimiter::for('api', function (Request $request) {
            return $request->user()
                ? Limit::perMinute(60)->by($request->user()->id)
                : Limit::perMinute(60)->by($request->ip());
        });
        Course::observe(CourseObserver::class);
    }
}
