<?php
namespace App\Repositories\BlogsRepositores;

use App\Models\Blog;
use App\Repositories\BaseRepository;
use App\Repositories\RedisService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlogsRepositores extends BaseRepository 
{
    const MODEL            = "blog"; 
    const KEY_LIST_CREATED = "blog_created_list";
    const KEY_LIST_VIEWS   = "blog_views_list";
    
    public function getModel()
    {
        $model = Blog::getInstance();
    
        return $model::class;
    }

    public function getAllBlogs($params = []) 
    {
        try {
            $redisService = new RedisService();
            $member       = 'id';
            $key          = self::KEY_LIST_CREATED;
            $orderBy      = 'created_time';

            if (!empty($params['sort']) && $params['sort'] == self::KEY_LIST_VIEWS) {
                $key     = self::KEY_LIST_VIEWS;
                $orderBy = 'views';
            }
            
            // Store Data To Redis 
            $existsCache = $redisService->exists($key);

            if ($existsCache) $blogs = $redisService->listSorted($key);
            else {
                $blog  = parent::with(['categories', 'tag', 'user']);
                $blogs = $blog->orderBy($orderBy, 'DESC')->get()->toArray();

                $redisService->listSorted($key, $blogs, $orderBy, $member);
            }

            return $blogs;
        } catch (\Exception $ex) {
            Log::error("Get data list blogs error: {$ex->getMessage()}");

            return [];
        }
    }

    public function insertItem($item) 
    {
        $redisService = new RedisService();

        $item['created_time'] = Carbon::now()->timestamp;
        $item['updated_time'] = Carbon::now()->timestamp;

        try {
             $insert = parent::insertGetRecord($item);
             
             if (empty($insert)) {
                return false;
             }

             $insertCache = $redisService->create(self::KEY_LIST, $insert);

             if (empty($insertCache)) {

                return false;
             }

             return $this->getAllTags();
        } catch (\Exception $e) {
            Log::error("Store Tags Error Messages: {$e->getMessage()}");

            return false;
        }

    }

    public function findFirstByID($id) 
    {
        try {
            $key          = self::MODEL . ":{$id}";
            $redisService = new RedisService();
            $existsCache  = $redisService->exists($key);

            if (!$existsCache) {
                $blog = parent::with(['categories', 'tag', 'user'])
                ->where('id', $id)
                ->first();

                // Store blog to redis
                $redisService->detailOrCreate($key, $blog->toArray());

                return $blog;
            }
           
            $blog = $redisService->hgetall($key);

            return !empty($blog) && !empty($blog['data'])  ? json_decode($blog['data'], true) : [];                
        } catch (\Exception $e) {
            Log::error("Find First Blog Item ID : {$id} Error Messages: {$e->getMessage()}");

            return false;
        }
    }

    public function updateItemByID($id, $data) 
    {
        DB::beginTransaction();
        $redisService = new RedisService();

        $data['updated_time'] = Carbon::now()->timestamp;

        try {
            $update = parent::updateById($id, $data);

            if (!$update) {
                Log::error("Update Fail Tag Item ID : {$id}");

                DB::rollBack();
                return false;        
            }

            $updateCache = $redisService->update(self::KEY_LIST, $id, $data);

            if (empty($updateCache)) {
                Log::error("Update Fail Tag Item ID : {$id} In Cache");

                DB::rollBack();
                
                return false;
            }
        
            DB::commit();
            return $updateCache;
        } catch (\Exception $e) {
            Log::error("Update Tag Item ID : {$id} Error Messages: {$e->getMessage()}");

            return false;
        }
    }

    public function deleteItemByID($id) 
    {
        DB::beginTransaction();
        $redisService = new RedisService();

        try {
            $delete = parent::deleteById($id);

            if (!$delete) {
                Log::error("Delete Fail Tag Item ID : {$id}");

                DB::rollBack();
                return false;        
            }

            $deleteCache = $redisService->delete(self::KEY_LIST, $id);

            if (empty($deleteCache)) {
                Log::error("Delete Fail Tag Item ID : {$id} In Cache");

                DB::rollBack();
                
                return false;
            }

            DB::commit();
            return $deleteCache;
        } catch (\Exception $e) {
            Log::error("Delete Tag Item ID : {$id} Error Messages: {$e->getMessage()}");

            return false;
        }
    }
}