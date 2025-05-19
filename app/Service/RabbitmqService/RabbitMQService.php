<?php 

namespace App\Service\RabbitmqService;

use App\Service\Notification\NotificationManager;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;
use Exception;

class RabbitMQService
{
    protected AMQPStreamConnection $connection;
    protected AMQPChannel $channel;

    public function __construct()
    {
        try {
            $this->connection = new AMQPStreamConnection(
                env('RABBITMQ_HOST', 'rabbitmq'),
                env('RABBITMQ_PORT', 5672),
                env('RABBITMQ_USER', 'guest'),
                env('RABBITMQ_PASSWORD', 'guest')
            );
            $this->channel = $this->connection->channel();
        } catch (Exception $exception) {
            Log::error("RabbitMQ Connection Failed: " . $exception->getMessage());
            throw new Exception("RabbitMQ Connection Failed", 500);
        }
    }

    public function createExchange(string $exchangeName, string $type = 'direct'): void
    {
        if (empty($exchangeName)) {
            throw new Exception("Exchange name cannot be empty");
        }

        // Chỉ tạo nếu chưa tồn tại
        $this->channel->exchange_declare($exchangeName, $type, false, true, false);

        Log::info("Exchange '$exchangeName' created successfully");
    }

    public function createQueue(string $queueName): void
    {
        if (empty($queueName)) {
            throw new Exception("Queue name cannot be empty");
        }

        $this->channel->queue_declare($queueName, false, true, false, false);

        Log::info("Queue '$queueName' created successfully");
    }

    public function bindQueueToExchange(string $queueName, string $exchangeName, string $routingKey = ''): void
    {
        if (empty($queueName) || empty($exchangeName)) {
            throw new Exception("Queue, Exchange, and Routing Key cannot be empty");
        }

        $this->channel->queue_bind($queueName, $exchangeName, $routingKey);

        Log::info("Queue '$queueName' bound to Exchange '$exchangeName' with Routing Key '$routingKey'");
    }

    public function publishMessage(string $exchange, string $routingKey = '', array $data): void
    {
        try {
            if (empty($exchange)) {
                throw new Exception("Exchange cannot be empty");
            }
    
            $message = new AMQPMessage(json_encode($data), [
                'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT, // Durable message
            ]);
    
            $this->channel->basic_publish($message, $exchange, $routingKey);
    
            Log::info("Message sent to Exchange: $exchange - RoutingKey: $routingKey");
    
            //echo "Message sent to Exchange: $exchange - RoutingKey: $routingKey";
        } catch (\Throwable $th) {
            throw new Exception("RabbitMQ Connection Failed", 500);
        }
    }

    public function listen(string $queueName): void
    {
        //dd($queueName);
        if (empty($queueName)) {
            throw new Exception("Queue name cannot be empty");
        }

        $this->channel->queue_declare($queueName, false, true, false, false);

        Log::info("Waiting for messages in $queueName...");
    }

    public function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    public function consumerNotification()
    {
        $queue = 'notification_queue';
        $this->listen($queue);

        $callback = function ($msg) use($queue){
            Log::info("Consumer Notification Received: " . $msg->body . "Time :" . now()->timestamp );
            
            try {
                NotificationManager::sendService(json_decode($msg->body, true));
                
                $msg->ack();
            } catch (Exception $exception) {
                Log::error("Failed to process message: " . $exception->getMessage() . ", by queue {$queue}");
                $msg->nack();
            }
        };

        $this->channel->basic_consume($queue, '', false, false, false, false, $callback);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function consumerOrder($queueName)
    {
        $this->listen($queueName);

        $callback = function ($msg) use($queueName){
            Log::info("Consumer Order Received: " . $msg->body . "Time :" . now()->timestamp);
            
            try {
                echo "Consumer Order: " . $msg->body . "\n" . "Time :" . now()->timestamp;
                
                $msg->ack();
            } catch (Exception $exception) {
                Log::error("Failed to process message: " . $exception->getMessage() . ", by queue {$queueName}");
                $msg->nack(); // Reject message, có thể gửi lại queue
            }
        };

        $this->channel->basic_consume($queueName, '', false, false, false, false, $callback);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function managerConsumer($queueName)
    {
        switch ($queueName) {
            case 'notification_queue':
                $this->consumerNotification($queueName);
                break;
            case 'order_queue':
                $this->consumerOrder($queueName);
                break;
        }    
    }
}
