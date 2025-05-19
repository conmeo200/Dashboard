<?php 
namespace App\Service\Notification;

use App\Repositories\Notification\EmailService;
use App\Repositories\Notification\NotificationInterface;
use App\Repositories\Notification\SMSService;
use App\Service\RabbitmqService\RabbitMQService;
use Log;

class NotificationManager 
{
    public $rabbitmqService;
    const EXCHANGE    = 'notification_exchange';
    const QUEUE_NAME  = 'notification.notification';
    const ROUTING_KEY = 'direct';

    public function __construct(RabbitMQService $rabbitmqService)
    {
        $this->rabbitmqService = $rabbitmqService;
    }

    public function publishMessage($data)
    {
        try {
            $this->rabbitmqService->publishMessage(self::EXCHANGE, self::QUEUE_NAME, $data);
            $this->rabbitmqService->close();
        } catch(\Exception $e) {
            Log::error("Messages : {$e->getMessage()}, Request : " . json_encode($data) . ", Time : " . now()->timestamp);
        }
    }

    public static function sendService($data)
    {
        $types = $data['type'] ?? [];

        if (!is_array($types)) $types = [$types];

        foreach ($types as $type) {
            switch ($type) {
                case 'sms':
                    self::sendSMS($data);
                    break;
                case 'email':
                    self::sendEmail($data);
                    break;
                case 'notification':
                    self::sendNotification($data);
                    break;
            }
        }

        if (empty($types)) {
            self::sendSMS($data);
            self::sendEmail($data);
            self::sendNotification($data);
        }
    }


    public static function sendEmail($data)
    {
        echo "--------------------------------------" ."\n";
        echo "Send Email: " . json_encode($data) . "Time :" . now()->timestamp . "\n";
        echo "--------------------------------------" ."\n";
    }
    
    public static function sendSMS($data)
    {
        echo "--------------------------------------" ."\n";
        echo "Send SMS: " . json_encode($data) . "Time :" . now()->timestamp . "\n";
        echo "--------------------------------------" ."\n";
    }

    public static function sendNotification($data)
    {
        echo "--------------------------------------" ."\n";
        echo "Notification: " . json_encode($data) . "Time :" . now()->timestamp ."\n";
        echo "--------------------------------------" ."\n";
    }
}