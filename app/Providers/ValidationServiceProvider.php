<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use DateTime;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('olderThan', function($attribute, $value, $parameters)
        {
            $minAge = !empty($parameters) ? (int) $parameters[0] : 13;
            return (new DateTime())->diff(new DateTime($value))->y >= $minAge;
        });
    }
}
