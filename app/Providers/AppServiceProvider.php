<?php

namespace App\Providers;

use Exception;
use Carbon\Carbon;
use App\Models\Setting;
use App\Models\Visitor;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\SpecialOffer;
use App\Models\ShippingMethod;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
        // Set default values
        View::share('setting', null);
        View::share('shippingmethods', null);
        View::share('categories', null);
        View::share('online', null);
        View::share('special_offer', null);
        View::share('getOnlineVisitorCount', null);
        View::share('getTodayVisitorCount', null);

        try {
            // Check for table existence and set actual values
            if (Schema::hasTable('settings')) {
                View::share('setting', Setting::first());
            }

            if (Schema::hasTable('categories')) {
                View::share('categories', Category::active()->get());
            }

            if (Schema::hasTable('special_offers')) {
                View::share('special_offer', SpecialOffer::active()->latest()->first());
            }
            if (Schema::hasTable('shipping_methods')) {
                View::share('shippingmethods', ShippingMethod::active()->get(),);
            }

        } catch (Exception $e) {
            // Log the exception if needed
        }
        // Set the default timezone for Carbon
        Carbon::setLocale('en'); // Optional: Set the locale to English (can be changed if needed)
        date_default_timezone_set('Asia/Dhaka'); // Set PHP default timezone

        Paginator::useBootstrap();
    }
}
