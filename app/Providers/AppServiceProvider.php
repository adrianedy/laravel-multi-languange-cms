<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App\Models\Equipment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $tes = null;
        Schema::defaultStringLength(191);
        Validator::extend('limit_brand', function ($attribute, $value, $parameters, $validator) {
            $tes = $value;
            return Equipment::whereHas('model.category.brand', function ($query) use ($value, $parameters) {
                $query->where('name', $value);
            })->count() < $parameters[0];
        });

        Validator::replacer('limit_brand', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':max', $parameters[0], $message);
        });
    }
}
