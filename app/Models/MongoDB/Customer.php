<?php

namespace App\Models\MongoDB;
use Jenssegers\Mongodb\Eloquent\Model;

class Customer extends Model
{
    protected $collection = 'customers'; // Tên collection
    protected $primaryKey = '_id';       // Khóa chính của MongoDB    

    protected $fillable = [
        'name',
        'id_user',
        'phone',
        'active',
        'roles',
        'profile',
        'settings',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'active'   => 'boolean',   // Chuyển đổi kiểu boolean
        'roles'    => 'array',     // Lưu trữ mảng vai trò
        'profile'  => 'array',     // Lưu thông tin profile dưới dạng object
        'settings' => 'array',     // Lưu các cài đặt người dùng
    ];

    protected $appends = [
        'is_admin', // Thêm thuộc tính ảo
    ];

    // Thuộc tính ảo (Không lưu trong DB nhưng có thể lấy khi gọi model)
    public function getIsAdminAttribute()
    {
        return in_array('admin', $this->roles ?? []);
    }

    // Mutator: Mã hóa mật khẩu trước khi lưu vào DB
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    // // Relationship: Một User có nhiều bài viết (posts)
    // public function posts()
    // {
    //     return $this->hasMany(Post::class, 'user_id');
    // }

    // // Relationship: Một User có một Profile
    // public function profile()
    // {
    //     return $this->hasOne(Profile::class, 'user_id');
    // }
}
