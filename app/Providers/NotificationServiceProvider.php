<?php

namespace App\Providers;

use App\Repositories\Notification\EmailService;
use App\Repositories\Notification\SMSService;
use App\Service\Notification\NotificationManager;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(NotificationManager::class, function ($app) {
        //     $manager = new NotificationManager();

        //     // Thêm cả hai service
        //     $manager->addService(EmailService::getInstance());
        //     $manager->addService(SMSService::getInstance());

        //     return $manager;
        // });    
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
