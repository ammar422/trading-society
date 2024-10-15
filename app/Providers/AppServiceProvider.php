<?php

namespace App\Providers;

use App\Models\Course;
use App\Observers\CourseObserver;
use Illuminate\Http\Request;
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
        //
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
