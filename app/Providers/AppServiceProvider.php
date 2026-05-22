<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Courses;
use App\Models\Schools;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    View::composer('partials.navbar', function ($view) {
    $school = Auth::check() ? Auth::user()->school : null;

    $view->with([
        'schoolName' => $school?->schoolname ?? 'Default School',
        'schoolBadge' => $school?->badge_path ?? 'default-badge.png',
    ]);
});

    }
}
