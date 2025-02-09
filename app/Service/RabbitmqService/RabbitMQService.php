<?php 

namespace App\Service\RabbitmqService;

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
                env('RABBITMQ_HOST', '127.0.0.1'),
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

    public function bindQueueToExchange(string $queueName, string $exchangeName, string $routingKey): void
    {
        if (empty($queueName) || empty($exchangeName) || empty($routingKey)) {
            throw new Exception("Queue, Exchange, and Routing Key cannot be empty");
        }

        $this->channel->queue_bind($queueName, $exchangeName, $routingKey);

        Log::info("Queue '$queueName' bound to Exchange '$exchangeName' with Routing Key '$routingKey'");
    }

    public function publishMessage(string $exchange, string $routingKey, array $data): void
    {
        if (empty($exchange) || empty($routingKey)) {
            throw new Exception("Exchange and Routing Key cannot be empty");
        }

        $message = new AMQPMessage(json_encode($data), [
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT, // Durable message
        ]);

        $this->channel->basic_publish($message, $exchange, $routingKey);

        Log::info("Message sent to Exchange: $exchange - RoutingKey: $routingKey");
    }

    public function listen(string $queueName): void
    {
        if (empty($queueName)) {
            throw new Exception("Queue name cannot be empty");
        }

        $this->channel->queue_declare($queueName, false, true, false, false);

        Log::info("Waiting for messages in $queueName...");

        $callback = function ($msg) {
            Log::info("Received: " . $msg->body);
            
            // Xử lý message tại đây
            try {
                // TODO: Viết logic xử lý message
                $msg->ack();
            } catch (Exception $exception) {
                Log::error("Failed to process message: " . $exception->getMessage());
                $msg->nack(); // Reject message, có thể gửi lại queue
            }
        };

        $this->channel->basic_consume($queueName, '', false, false, false, false, $callback);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }
}
