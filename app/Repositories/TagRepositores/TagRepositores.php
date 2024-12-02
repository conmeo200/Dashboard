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
            //$listModel  = parent::orderBy('created_time', 'desc')->get()->toArray();
            $listModel  = parent::get()->toArray();

           
            $redisService->list(self::KEY_LIST, $listModel);
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
        $data['updated_time'] = Carbon::now()->timestamp;
        try {
            return parent::updateById($id, $data);
        } catch (\Exception $e) {
            Log::error("Update Tag Item ID : {$id} Error Messages: {$e->getMessage()}");

            return false;
        }
    }

    public function deleteItemByID($id) 
    {
        try {
            return parent::deleteById($id);
        } catch (\Exception $e) {
            Log::error("Delete Tag Item ID : {$id} Error Messages: {$e->getMessage()}");

            return false;
        }
    }
}