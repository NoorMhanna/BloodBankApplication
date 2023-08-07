<?php

namespace App\Providers;

use App\Http\Controllers\FeedbackForSiteController;
use App\Models\FeedbackForSite;
use Illuminate\Support\ServiceProvider;

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
        // //
        // $feedbacks = FeedbackForSite::all();
        // view('feedback.feedbackSite')->share($feedbacks);

    }
}
