<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Repositories\RoleRepositories\RspRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleController extends BaseApiController
{
    public $rspRole;

    public function __construct()
    {
        $this->rspRole = new RspRole();
    }

    public function getList(Request $request)
    {
        $params = [
            'page'     => !empty($request->get('page')) && $request->get('page') > 1 ? $request->get('page') : 1,
            'per_page' => !empty($request->get('per_page'))  ? $request->get('per_page') : 10
        ];

        return $this->sendPaginationResponse($this->rspRole->getList($params));
    }

    public function detail(Request $request, $id)
    {
        if (empty($id) || !is_numeric($id)) return $this->sendError('Data Invalid');

        $role = $this->rspRole->findFirstById($id);

        if (!$role) return $this->sendError([]);

        return $this->sendResponse($this->rspRole->findFirstById($id));
    }

    public function handleCreate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            'name'       => ['required', 'unique', 'max:255', 'min:1'],
            'guard_name' => ['required', 'unique', 'max:255', 'min:1']
        ]);

        if (!$validator->fails()) return $this->sendError($validator->errors()->toArray());

        $dataPost = $validator->validated();
        $insert   = $this->rspRole->create($dataPost);

        if (!$insert) {
            DB::rollBack();

            return $this->sendError(__('curd.create_fail'));
        }

        DB::commit();
        return $this->sendResponse($dataPost);
    }
}
