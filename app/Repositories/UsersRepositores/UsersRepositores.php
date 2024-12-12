<?php
namespace App\Repositories\UsersRepositores;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\RedisService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsersRepositores extends BaseRepository 
{
    const MODEL       = "user"; 
    const KEY_LIST_ID = "user_id_list";
    
    public function getModel()
    {
        $model = User::getInstance();
    
        return $model::class;
    }

    public function getAllUsers($params = []) 
    {
        try {
            $redisService = new RedisService();
            $member       = 'id';
            $key          = self::MODEL;
            $orderBy      = 'id';
            
            // Store Data To Redis
            $existsCache = $redisService->exists(self::KEY_LIST_ID);

            if ($existsCache) $users = $redisService->listSorted($key, [], $orderBy);
            else {
                //$user  = parent::with(['categories', 'tag', 'user']);
                $users = parent::orderBy($orderBy, 'DESC')->get()->toArray();

                $redisService->listSorted($key, $users, $orderBy, $member);
            }

            return $users;
        } catch (\Exception $ex) {
            Log::error("Get data list users error: {$ex->getMessage()}");

            return [];
        }
    }

    public function insertItem($item) 
    {
        $redisService = new RedisService();

        $item['created_time'] = Carbon::now()->timestamp;
        $item['updated_time'] = Carbon::now()->timestamp;
        $item['password']     = Hash::make($item['password']);

        try {
             $insert = parent::insertGetRecord($item);
             
             if (empty($insert)) {
                return false;
             }

             $insertCache = $redisService->create(self::MODEL, $insert);

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
                $blog = parent::where('id', $id)->first();

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