<?php

namespace App\Jobs;

use App\Models\MongoDB\Students;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RegisterUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//    public $tries      = 3;
//    public $retryAfter = 60;
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
        foreach ($this->list_user as $value) {
            if ($value['status'] == true) {
                Students::query()->create($value);
            } else {
                throw new \Exception('Test Error');
            }

        }
    }

    public function failed(\Exception $exception)
    {
        dd(1231231);
    }
}
