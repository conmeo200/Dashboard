<?php 
namespace App\Repositories\Notification;

interface NotificationInterface {
    public function sendNotice($recipient, $message);
}
