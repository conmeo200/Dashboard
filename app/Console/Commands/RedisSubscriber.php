<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RedisSubscriber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature   = 'redis:subscribe';
    protected $description = 'Subscribe to Redis notifications channel';

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
        $redis   = app('redis'); // Kết nối Redis
        $channel = 'notifications'; // Tên kênh

        // Lắng nghe thông báo từ kênh
        $redis->subscribe([$channel], function ($message) {
            $data = json_decode($message, true); // Parse JSON message
            
            $this->info('New Notification Received:');
            $this->info("Title: {$data['title']}");
            $this->info("Body: {$data['body']}");
            $this->info("Timestamp: {$data['timestamp']}");
        });
    }
}
