<?php

namespace App\Providers;

use App\Employee;
use App\Models\City;
use App\Models\Functions;
use App\Models\Industry;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::extend('greater_than', function ($attribute, $value, $parameters, $validator) {
            $min_field = $parameters[0];
            $data = $validator->getData();
            $min_value = $data[$min_field];
            return $value > $min_value;
        });

        Validator::replacer('greater_than', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':field', $parameters[0], $message);
        });

        Validator::extend('smaller_than', function ($attribute, $value, $parameters, $validator) {
            $min_field = $parameters[0];
            $data = $validator->getData();
            $min_value = $data[$min_field];
            return $value < $min_value;
        });

        Validator::replacer('smaller_than', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':field', $parameters[0], $message);
        });

        view()->share('cities', City::where('status', 1)->orderBy('created_at', 'ASC')->pluck('name', 'id'));
        view()->share('feature_cities', City::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get());
        view()->share('feature_functions', Functions::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get());
        view()->share('feature_industries', Industry::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get());
        view()->share('feature_companies', Employee::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
