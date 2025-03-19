<?php 

namespace App\Repositories\Customes;

use App\Repositories\MongoDBService;

class CustomersRepository extends MongoDBService
{
    private $collection = 'customers';

    public function list($filter = [], $option = [])
    {
        return parent::find($this->collection, $filter, $option);
    }
}
