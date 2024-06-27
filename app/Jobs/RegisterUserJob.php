<?php

namespace App\Jobs;

use App\Models\MongoDB\Students;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class RegisterUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries      = 3;
    public $retryAfter = 10;
    public $list_user  = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($list_user)
    {
        $this->list_user = $list_user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $updatedUsers = [];

        foreach ($this->list_user as $index => $value) {
            if ($value['status'] === false && $this->attempts() <= 3) {
                $this->list_user[$index]['status'] = true;
            }
        }

        foreach ($this->list_user as $value) {
            if ($value['status'] == true) {
                $updatedUsers[] = $value;
            }
        }

        Students::insert($updatedUsers);
    }

    public function failed(\Exception $exception)
    {
        Log::info('Attempts: ' . $this->attempts());
    }
}
