<?php 
namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class RedisService 
{
    public $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    // Use data type list for Redis
    public function list($key, $data = [])
    {
        if (empty($data) && empty($key)) return false;

        $cachedData = $this->redis->lrange($key, 0, -1);
        
        if (!empty($cachedData)) {
            return array_map(function ($item) {
                return json_decode($item, true);
            }, $cachedData);
        }

        foreach ($data as $item) {
            $this->redis->lpush($key, json_encode($item));
        }

        return array_map(function ($item) {
            return json_decode($item, true);
        }, $this->redis->lrange($key, 0, -1));
    }

    public function create($key, $item) 
    {
        try {
            if (empty($key) || empty($item)) return false;

            $cachedData = $this->redis->lrange($key, 0, -1);

            if (empty($cachedData)) return [];

            $result = $this->redis->lpush($key, json_encode($item));

            if (!$result) {
                Log::error("Error when pushing data {$item} to KEY {$key}");

                return [];
            }

            return $this->redis->lrange($key, 0, -1);
        } catch (\Exception $e) {
            Log::error('Error when pushing data to Redis: ' . $e->getMessage());

            return false;
        }
    }

    public function update($key, $id, $item) 
    {
        try {
            if (empty($key) || empty($item)) return false;

            $cachedData = $this->redis->lrange($key, 0, -1);

            if (empty($cachedData)) return false;

            $dataFormat = array_map(function ($item) {
                return json_decode($item, true);
            }, $cachedData);

            // $getItemCache = findFirstValueArray($dataFormat, 'id', $id);

            if (empty($dataFormat)) {
                return false;
            }

            foreach($dataFormat as $key => $value) {
                if ($value['id'] == $id) {
                    $value['name']         = $item['name'];
                    $value['isActive']     = $item['isActive'];
                    $value['updated_time'] = $item['updated_time'];

                    $dataFormat[$key] = $value;
                    break;
                }
            }

            $this->redis->del($key);

            foreach ($dataFormat as $item) {
                $this->redis->lpush($key, json_encode($item));
            }

            return $dataFormat;
        } catch (\Exception $e) {
            Log::error('Error when pushing data to Redis: ' . $e->getMessage());

            return false;
        }
    }

    public function delete($key, $id) 
    {
        try {
            if (empty($key) || empty($id)) return false;

            $cachedData = $this->redis->lrange($key, 0, -1);

            if (empty($cachedData)) return false;

            $dataFormat = array_map(function ($item) {
                return json_decode($item, true);
            }, $cachedData);            

            if (empty($dataFormat)) {
                return false;
            }

            foreach($dataFormat as $key => $value) {
                if ($value['id'] == $id) {
                    unset($dataFormat[$key]);
                    break;
                }
            }

            $this->redis->del($key);

            foreach ($dataFormat as $item) {
                $this->redis->lpush($key, json_encode($item));
            }

            return $dataFormat;
        } catch (\Exception $e) {
            Log::error('Error when pushing data to Redis: ' . $e->getMessage());

            return false;
        }
    }
    // End use data type list for Redis

    // Use data type sorted set for Redis
    public function listSorted($key, $data = [], $score = '', $member = '', $start = 0, $end = -1, $sort ='WITHSCORES')
    {
        if (empty($data) && empty($key)) return [];
        
        $keyRedis = $key . '_' . $score . '_list'; 

        try {        
            $cachedData = $this->redis->zrevrange($keyRedis, $start, $end, $sort);

            if (!empty($cachedData)) {
                $listData = [];

                foreach($cachedData as $value) {
                    $item = $this->redis->hgetall("{$key}:{$value}");

                    if (empty($item) || (!empty($item) && empty($item['data']))) continue;

                    $listData[] = json_decode($item['data'], true);    
                }

                return $listData;
            }

            if (!empty($score) && !empty($member) && !empty($data)) {
                foreach($data as $value) 
                {
                    $this->redis->zadd($keyRedis, $value[$score], $value[$member]);
    
                    if (!$this->redis->exists("{$key}:{$value['id']}")) {
                        $this->redis->hset("{$key}:{$value['id']}", "data", json_encode($value));
                    }
                }
            }

            return $data;
        } catch (\Exception $ex) {
            Log::error("Error push data to key {$key} for Sorted Redis");

            return false;
        }
    }

    public function detailOrCreate($key, $data = [])
    {
        try {
            if (empty($key)) return [];

            $cachedData = $this->redis->hgetall($key);

            // Set data to Redis
            if (empty($cachedData) && !empty($data)) {
                 $this->redis->hset($key, $data);

                 return $data;
            }
            
            return $cachedData;

        } catch (\Exception $ex) {
            Log::error("Error push detail data to key {$key} for Redis");

            return false;
        }
    }
    // End use data type sorted set for Redis
    /**
     * Set giá trị cho key với thời gian hết hạn (tùy chọn).
     */
    public function set($key, $value, $ttl = null)
    {
        if ($ttl) {
            return $this->redis->setex($key, $ttl, $value);
        }
        return $this->redis->set($key, $value);
    }

    /**
     * Get giá trị của key.
     */
    public function get($key)
    {
        return $this->redis->get($key);
    }

    /**
     * Xóa một key.
     */
    public function del($key)
    {
        return $this->redis->del($key);
    }

    /**
     * Kiểm tra xem key có tồn tại không.
     */
    public function exists($key)
    {
        return $this->redis->exists($key);
    }

    /**
     * Tăng giá trị của key (sử dụng cho các trường hợp đếm).
     */
    public function incr($key)
    {
        return $this->redis->incr($key);
    }

    /**
     * Giảm giá trị của key.
     */
    public function decr($key)
    {
        return $this->redis->decr($key);
    }

    /**
     * Lấy tất cả các phần tử của danh sách.
     */
    public function lrange($key, $start = 0, $end = -1)
    {
        return $this->redis->lrange($key, $start, $end);
    }

    /**
     * Thêm một phần tử vào đầu danh sách.
     */
    public function lpush($key, $value)
    {
        return $this->redis->lpush($key, $value);
    }

    /**
     * Thêm một phần tử vào cuối danh sách.
     */
    public function rpush($key, $value)
    {
        return $this->redis->rpush($key, $value);
    }

    /**
     * Xóa và trả về phần tử đầu tiên của danh sách.
     */
    public function lpop($key)
    {
        return $this->redis->lpop($key);
    }

    /**
     * Xóa và trả về phần tử cuối cùng của danh sách.
     */
    public function rpop($key)
    {
        return $this->redis->rpop($key);
    }

    /**
     * Thêm giá trị vào Hash (HSET).
     */
    public function hset($key, $field, $value)
    {
        return $this->redis->hset($key, $field, $value);
    }

    /**
     * Lấy giá trị từ Hash (HGET).
     */
    public function hget($key, $field)
    {
        return $this->redis->hget($key, $field);
    }

    /**
     * Lấy tất cả các giá trị trong Hash.
     */
    public function hgetall($key)
    {
        return $this->redis->hgetall($key);
    }

    /**
     * Xóa một trường trong Hash.
     */
    public function hdel($key, $field)
    {
        return $this->redis->hdel($key, $field);
    }

    /**
     * Xóa tất cả các dữ liệu trong Redis (Cẩn thận với lệnh này!).
     */
    public function flushAll()
    {
        return $this->redis->flushAll();
    }
}