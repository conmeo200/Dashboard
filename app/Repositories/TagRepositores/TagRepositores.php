<?php
namespace App\Repositories\TagRepositores;

use App\Models\Tag;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TagRepositores extends BaseRepository
{
    public function getModel()
    {
        $model = Tag::getInstance();
    
        return $model::class;
    }

    public function getAllTags($params = []) 
    {
        return parent::orderBy('created_time', 'desc')->paginate();
    }

    public function insertItem($item) 
    {
        $item['created_time'] = Carbon::now()->timestamp;
        $item['updated_time'] = Carbon::now()->timestamp;

        try {
            return parent::insert($item);
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