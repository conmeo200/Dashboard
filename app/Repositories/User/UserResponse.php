<?php
namespace App\Repositories\User;

use App\Models\Product;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserResponse extends BaseRepository
{
    public function getModel() {
        return User::class;
    }

    public function create(array $data) {
        return DB::transaction(function () use ($data) {
            $user = parent::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            return $user;
        });
    }

    public function findFirstUserByEmail($email)
    {
        return parent::getByColumn($email, 'email');
    }
}

