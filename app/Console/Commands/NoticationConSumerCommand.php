<?php

namespace App\Console\Commands;

use App\Service\RabbitmqService\RabbitMQService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NoticationConSumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:notification-consumer';

    protected $queue_name = "notification_queue";
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
            $consumer = new RabbitMQService();
            
            $consumer->consumerNotification();
            $consumer->close();
        } catch (\Exception $exception){
            Log::error("Error ConsumeRabbitMQ : {$exception->getMessage()}");
        }
    }
}
