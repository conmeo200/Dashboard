<?php 
namespace App\Repositories;

class Singleton
{
    // Biến tĩnh để giữ instance
    private static $instance = null;

    // Phương thức khởi tạo private để ngăn chặn việc tạo mới instance
    protected function __construct() {}

    // Phương thức clone cũng cần phải bị cấm
    private function __clone() {}

    // Phương thức lấy instance duy nhất
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static(); // Khởi tạo đối tượng của lớp con (dynamic class)
        }
        return self::$instance;
    }
}
