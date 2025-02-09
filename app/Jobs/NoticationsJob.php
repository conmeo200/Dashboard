<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NoticationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct($orders)
    {
        $this->order = $orders;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        $data = $this->order;
        
        Log::info("Notication Orders ID : " . $data['order_id'] . ", Info order : " . json_encode($data));
    }
}
