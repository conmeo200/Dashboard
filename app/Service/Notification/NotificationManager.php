<?php 
namespace App\Service\Notification;

use App\Repositories\Notification\EmailService;
use App\Repositories\Notification\NotificationInterface;
use App\Repositories\Notification\SMSService;
use App\Service\RabbitmqService\RabbitMQService;


class NotificationManager 
{
    public $queue_name    = 'notication_queue';
    public $exchange_name = 'notication_exchange';

    public function sendSevice($data)
    {
        $service = app(RabbitMQService::class);
        $service->publishMessage($this->exchange_name, '', $data);
    }
}