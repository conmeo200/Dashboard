<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $order;
    public $priority;

    public function __construct($orders, $priority = 5)
    {
        $this->order    = $orders;
        $this->priority = $priority;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        $data = $this->order;
        
        Log::info("Send Email Orders ID : " . $data['order_id'] . ", Info order " . json_encode($data));
    }

    public function viaQueue()
    {
        return [
            'queue'   => 'emails',
            'options' => [
                'priority' => $this->priority,
            ],
        ];
    }
}
