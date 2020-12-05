<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Model\Preference;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->runningInConsole()) {
            $preference = Preference::all()->pluck('value', 'field')->toArray();
            $option = [
                'company_name'        => $preference['name'],
                'company_email'       => $preference['email'],
                'company_phone'       => $preference['phone'],
                'company_address_1'   => $preference['address_1'],
                'company_address_2'   => $preference['address_2'],
                'company_description' => $preference['content']
            ];

            View::share($option);
        }
    }
}
