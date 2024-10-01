<?php


namespace App\Repositories\RoleRepositories;


use App\Models\Role;
use App\Repositories\BaseRepository;

class RspRole extends BaseRepository
{
    public function getModel()
    {
        return Role::class;
    }

    public function getList($param = [])
    {
        return parent::paginate(10);
    }

    public function findFirstById($id)
    {
        return parent::getByColumn($id, 'id');
    }

    public function create(array $attributes)
    {
        return parent::create($attributes);
    }
}
