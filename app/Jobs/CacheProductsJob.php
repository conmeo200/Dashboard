<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class CacheProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            // Lấy dữ liệu từ database
            $data = Product::all();

            // Lưu dữ liệu vào Redis
            Redis::set('your_data_key', json_encode($data));

            // Thiết lập thời gian hết hạn cho cache (ví dụ: 1 giờ)
            Redis::expire('your_data_key', 3600);
        } catch (\Exception $e) {
            // Xử lý lỗi (ví dụ: ghi log hoặc thông báo)
            \Log::error('Failed to cache data: ' . $e->getMessage());
        }
    }
}
