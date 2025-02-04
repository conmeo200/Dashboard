<?php 
namespace App\Service\Notification;

use App\Repositories\Notification\EmailService;
use App\Repositories\Notification\NotificationInterface;
use App\Repositories\Notification\SMSService;
use Exception;

class NotificationManager 
{
    public static function factory($serviceType)
    {
        if ($serviceType == 'email') {
            return EmailService::getInstance();
        } elseif ($serviceType == 'sms') {
            return SMSService::getInstance();
        }

        throw new Exception("Invalid service type");
    }
}