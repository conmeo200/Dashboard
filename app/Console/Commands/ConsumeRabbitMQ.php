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
    protected $signature = 'rabbitmq:consume-all';

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
            $listQueue = ['order_queue', 'notication_queue'];

            $consumer = new RabbitMQService();

            foreach($listQueue as $queue) {
                $consumer->managerConsumer($queue);
            }

            $this->info("All consumers started in background.");
        } catch (\Exception $exception){
            Log::error("Error ConsumeRabbitMQ : {$exception->getMessage()}");
        }
    }
}
