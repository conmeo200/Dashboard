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
    protected $signature = 'rabbitmq:consume {queue=order_queue}';

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
            // $queueName = config('enqueue.transport.queue');
            // $queue     = $context->createQueue($queueName);
            // $consumer  = $context->createConsumer($queue);
            // while (true) {
            //     // $message = $consumer->receive();
            //     // dd($queueName, $queue, $message->getBody());


            //     if ($message = $consumer->receive()) {
            //         $this->info("Received: " . $message->getBody());
                    
            //         $consumer->acknowledge($message);
            //     } else {
            //         echo "Data Invalid!";
            //     }
            // }
            $queue    = $this->argument('queue');
            $consumer = new RabbitMQService();

            $consumer->listen($queue);
        } catch (\Exception $exception){
            Log::error("Error ConsumeRabbitMQ : {$exception->getMessage()}");
        }
    }
}
