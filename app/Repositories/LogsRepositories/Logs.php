<?php 

namespace App\Repositories\LogsRepositories;

use App\Models\MongoDB\LogActivity;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;

class Logs extends BaseRepository {
    public function getModel()
    {
        $collectionLog = LogActivity::getInstance();
    
        return $collectionLog::class;
    }

    public function insert($item) 
    {
        try {
            return parent::insert($item);
        } catch (\Exception $e) {
            Log::error("Store Logs Error Messages: {$e->getMessage()}");

            return false;
        }
    }

    public function getAllLogs($params = []) 
    {
        return parent::paginate();
    }
}
