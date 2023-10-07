<?php

namespace App\Providers;

use App\Models\Setting;
use Carbon\Carbon;
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

        // set locale indonesia
        Carbon::setLocale('id');

        // Share setting to all views
        $setting = Setting::first();
        if ($setting === null) {
            $setting = null;
        }

        $setting->logo = $setting->logo ? asset('storage/setting/' . $setting->logo) : null;
        $setting->favicon = $setting->favicon ? asset('storage/setting/' . $setting->favicon) : null;

        view()->share('setting', $setting);
    }
}
