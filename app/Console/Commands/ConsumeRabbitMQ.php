<?php

namespace App\Console\Commands;

use App\Service\RabbitmqService\RabbitMQService;
use Illuminate\Console\Command;
use Enqueue\AmqpBunny\AmqpContext;
use Illuminate\Support\Facades\Log;

class ConsumeRabbitMQ extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:order_queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume messages from RabbitMQ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {        
        try { 
            $rabbitmqService = new RabbitMQService();
            $rabbitmqService->consumerOrder('order_queue');
            $rabbitmqService->close();

            $this->info("Queue Order Success");
        } catch (\Exception $exception){
            Log::error("Queue Order Error ConsumeRabbitMQ : {$exception->getMessage()}");
        }
    }
}
