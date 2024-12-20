<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Repositories\RoleRepositories\RspRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends BaseApiController
{
    public function index()
    {
        return $this->sendResponse(Role::all()->toArray());
    }

    public function detail($id)
    {
        if (empty($id) || (!empty($id) && !is_numeric($id))) return $this->sendError('ID invalid');

        $model = Role::query()->where(['id' => $id])->first();

        if (!$model) return $this->sendError('Role Not Found');

        return $this->sendResponse($model);
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'name'       => ['required', 'unique:Roles,name', 'string', 'min:6', 'max:255'],
                'guard_name' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }

            $dataPost = $validator->validated();

            $insert = Role::query()->create($dataPost);
            
            if (!$insert) {
                DB::rollBack();

                return $this->sendError('Insert Role Fail');
            }

            DB::commit();
            return $this->sendResponse($insert, 'Insert Role Success');
        } catch (\Exception $ex) {
            Log::error("Api create Role error : {$ex->getMessage()}");

            return $this->sendError("Systerm Error!");
        }        
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'name'       => ['required', "unique:Roles,name,{$id}", 'string', 'min:6', 'max:255'],
                'guard_name' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }

            $dataPost = $validator->validated();
            $update   = Role::query()->where(['id' => $id])->update($dataPost);
            if (!$update) {
                DB::rollBack();

                return $this->sendError('Update ID ' . $id . ' Role Fail');
            }

            DB::commit();
            return $this->sendResponse($update, 'Update ID ' . $id . ' Role Success');
        } catch (\Exception $ex) {
            Log::error("Api update Role error : {$ex->getMessage()}");

            return $this->sendError("Systerm Error!");
        }        
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {        
            if (empty($id) || (!empty($id) && !is_numeric($id))) return $this->sendError('ID invalid');


            $getID  = $id;
            $delete = Role::query()->where(['id' => $id])->delete();

            if (!$delete) {
                DB::rollBack();

                return $this->sendError('Delete ID ' . $id . ' Role Fail');
            }

            DB::commit();
            return $this->sendResponse($delete, 'Delete ID ' . $getID . ' Role Success');
        } catch (\Exception $ex) {
            Log::error("Api delete Role error : {$ex->getMessage()}");

            return $this->sendError("Systerm Error!");
        }        
    }
}
