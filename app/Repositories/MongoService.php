<?php

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
    public function update($collection, array $filter, array $update, array $options = [])
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
}
