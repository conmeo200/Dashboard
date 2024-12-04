<?php
namespace App\Repositories\TagRepositores;

use App\Models\Tag;
use App\Repositories\BaseRepository;
use App\Repositories\RedisService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class TagRepositores extends BaseRepository 
{
    const KEY_LIST = "tags:list";
    
    public function getModel()
    {
        $model = Tag::getInstance();
    
        return $model::class;
    }

    public function getAllTags($params = []) 
    {
        $redisService = new RedisService();

        if ($redisService->exists(self::KEY_LIST)) {
            $listModel = $redisService->list(self::KEY_LIST);

        } else {        
            $listModel = $redisService->list(self::KEY_LIST, parent::get()->toArray());
        }

        return $listModel;
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
            return parent::find($id);
        } catch (\Exception $e) {
            Log::error("Find First Tag Item ID : {$id} Error Messages: {$e->getMessage()}");

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