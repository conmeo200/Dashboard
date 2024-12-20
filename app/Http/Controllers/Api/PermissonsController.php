<?php

namespace App\Http\Controllers\Api;

use App\Repositories\RoleRepositories\RspRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissonsController extends BaseApiController
{
    public function index()
    {
        $rspRole = new RspRole();
        dd($rspRole->checkRolePermissionByUserID(1, 'admin'));
        return $this->sendResponse(Permission::all()->toArray());
    }

    public function detail($id)
    {
        if (empty($id) || (!empty($id) && !is_numeric($id))) return $this->sendError('ID invalid');

        $model = Permission::query()->where(['id' => $id])->first();

        if (!$model) return $this->sendError('Permission Not Found');

        return $this->sendResponse($model);
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'name'       => ['required', 'unique:permissions,name', 'string', 'min:6', 'max:255'],
                'guard_name' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }

            $dataPost = $validator->validated();

            $insert = Permission::query()->create($dataPost);
            
            if (!$insert) {
                DB::rollBack();

                return $this->sendError('Insert Permission Fail');
            }

            DB::commit();
            return $this->sendResponse($insert, 'Insert Permission Success');
        } catch (\Exception $ex) {
            Log::error("Api create permission error : {$ex->getMessage()}");

            return $this->sendError("Systerm Error!");
        }        
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'name'       => ['required', "unique:permissions,name,{$id}", 'string', 'min:6', 'max:255'],
                'guard_name' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }

            $dataPost = $validator->validated();
            $update   = Permission::query()->where(['id' => $id])->update($dataPost);
            if (!$update) {
                DB::rollBack();

                return $this->sendError('Update ID ' . $id . ' Permission Fail');
            }

            DB::commit();
            return $this->sendResponse($update, 'Update ID ' . $id . ' Permission Success');
        } catch (\Exception $ex) {
            Log::error("Api update permission error : {$ex->getMessage()}");

            return $this->sendError("Systerm Error!");
        }        
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {        
            if (empty($id) || (!empty($id) && !is_numeric($id))) return $this->sendError('ID invalid');


            $getID  = $id;
            $delete = Permission::query()->where(['id' => $id])->delete();

            if (!$delete) {
                DB::rollBack();

                return $this->sendError('Delete ID ' . $id . ' Permission Fail');
            }

            DB::commit();
            return $this->sendResponse($delete, 'Delete ID ' . $getID . ' Permission Success');
        } catch (\Exception $ex) {
            Log::error("Api delete permission error : {$ex->getMessage()}");

            return $this->sendError("Systerm Error!");
        }        
    }
}
