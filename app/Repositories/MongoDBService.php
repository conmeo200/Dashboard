<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class MongoDBService
{
    private $database;

    /**
     * Constructor để sử dụng cấu hình MongoDB từ Laravel.
     */
    public function __construct()
    {
        // Sử dụng kết nối MongoDB từ cấu hình Laravel
        $this->database = DB::connection('mongodb');
    }

    /**
     * Lấy một collection từ database.
     *
     * @param string $collection Tên collection
     * @return MongoDB\Collection
     */
    public function getCollection($collection)
    {
        return $this->database->selectCollection($collection);
    }

    /**
     * Thêm một tài liệu (document) vào collection.
     *
     * @param string $collection Tên collection
     * @param array $data Dữ liệu để thêm
     * @return MongoDB\InsertOneResult
     */
    public function insert($collection, array $data)
    {
        return $this->getCollection($collection)->insertOne($data);
    }

    /**
     * Lấy tất cả tài liệu từ collection với điều kiện (nếu có).
     *
     * @param string $collection Tên collection
     * @param array $filter Bộ lọc (mặc định là rỗng)
     * @param array $options Tùy chọn truy vấn
     * @return MongoDB\Driver\Cursor
     */
    public function find($collection, array $filter = [], array $options = [])
    {
        return $this->getCollection($collection)->find($filter, $options);
    }

    /**
     * Lấy một tài liệu duy nhất từ collection.
     *
     * @param string $collection Tên collection
     * @param array $filter Bộ lọc
     * @return array|null
     */
    public function findOne($collection, array $filter)
    {
        return $this->getCollection($collection)->findOne($filter);
    }

    /**
     * Cập nhật tài liệu trong collection.
     *
     * @param string $collection Tên collection
     * @param array $filter Bộ lọc để tìm tài liệu cần cập nhật
     * @param array $update Dữ liệu để cập nhật
     * @param array $options Tùy chọn cập nhật
     * @return MongoDB\UpdateResult
     */
    public function updateSet($collection, array $filter, array $update, array $options = [])
    {
        return $this->getCollection($collection)->updateMany($filter, ['$set' => $update], $options);
    }

    /**
     * Xóa tài liệu trong collection.
     *
     * @param string $collection Tên collection
     * @param array $filter Bộ lọc để tìm tài liệu cần xóa
     * @return MongoDB\DeleteResult
     */
    public function delete($collection, array $filter)
    {
        return $this->getCollection($collection)->deleteMany($filter);
    }

    public function updateOrCreateMultiData($collection, array $filter, array $data, array $options = [])
    {
        if (empty($data) || empty($filter)) return false;

        $pushData = ['$push' => []];

        foreach ($data as $field => $value) {
            $pushData['$push'][$field] = $value;
        }

        return $this->getCollection($collection)->updatePush($filter, $pushData, $options);
    }

    public function pullMultiData($collection, array $filter, array $data, array $options = [])
    {
        if (empty($data) || empty($filter) || empty($collection)) return false;

        $pullData = ['$pull' => []];

        foreach ($data as $field => $value) {
            $pullData['$pull'][$field] = $value;
        }

        return $this->getCollection($collection)->updateOne($filter, $pullData, $options);
    }

    public function setAggregate($collection, array $aggregate) 
    {
        if (empty($collection) || empty($aggregate)) return false; 

        return $this->getCollection($collection)->aggregate($aggregate); 
    }

    public function matchMultiFilter($collection, array $filter) 
    {
        if (empty($filter) || empty($collection)) return false;

        $matchData = ['$match' => []];

        foreach ($filter as $field => $value) {
            $matchData['$match'][$field] = $value;
        }

        return $this->setAggregate($collection, $matchData);
    }

    public function groupData($collection, $groupField, $columnName, $sumField) 
    {
        if (empty($groupField) || empty($collection) || empty($sumField)) return false;

        $groupData = [
            [
                '$group' => 
                    [
                        '_id'       => '$' . $groupField,  
                        $columnName => ['$sum' => '$' . $sumField]
                    ]
            ]
        ];

        return $this->setAggregate($collection, $groupData);
    }

    public function lookUpData($collection, $from, $local_field, $foreign_field, $as) 
    {
        if (empty($from) || empty($collection) || empty($local_field) || empty($as) || empty($foreign_field)) return false;

        $lookUpData = [
            [
                '$lookup' => 
                    [
                        "from"         => $from,
                        "localField"   => $local_field,
                        "foreignField" => $foreign_field,
                        "as"           => $as
                    ]
            ]
        ];

        return $this->setAggregate($collection, $lookUpData);
    }

    public function unWindData($collection, $column) 
    {
        if (empty($column) || empty($collection)) return false;

        $data = [
            [
                '$unwind' => '$' . $column
            ]
        ];

        return $this->setAggregate($collection, $data);
    }
}
