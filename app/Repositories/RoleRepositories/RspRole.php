<?php
namespace App\Repositories\RoleRepositories;


use App\Models\Role;
use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Role as ModelsRole;

class RspRole extends BaseRepository
{
    public function getModel()
    {
        return ModelsRole::class;
    }

    public function getList($param = [])
    {
        return parent::paginate(1);
    }

    public function findFirstById($id)
    {
        return parent::getByColumn($id, 'id');
    }

    public function create(array $attributes)
    {
        return parent::create($attributes);
    }

    public function checkRolePermissionByUserID($id, $role_type)
    {
        if (empty($role_type) || empty($id) || (!empty($id) && !is_numeric($id))) return false;

        $role = ModelsRole::query()
            ->where(['name' => $role_type])
            ->with([
                'permissions' => function ($query) {
                    
                }
            ])
            ->get()
            ->toArray();
        dd($role);
    }
}
