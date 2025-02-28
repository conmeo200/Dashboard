<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Models\MenuModel;
use App\Models\Role as ModelsRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class MenuController extends BaseApiController
{
    public function initMenu()
    {
        $user     = Auth::guard('api')->user();
        $listMenu = [];

        if (!$user) {
            $listMenu = MenuModel::query()->where(['type' => 'public', 'active' => 'Y']);                        ;
        } else {
            $roleName = $user->getRoleNames()->first();
            
            if (empty($roleName)) {
                return $this->sendResponse($listMenu);
            }

            $listMenu = ModelsRole::query()                
                ->where(['name' => $roleName])
                ->with('menus', function ($menus) {
                    $menus->select(['id', 'parent_id', 'name', 'keyword', 'icon', 'order', 'active']);
                    $menus->where(['active' => 'Y']);
                })
                ->select(['id', 'name']);
        }

        return $this->sendResponse($listMenu->get()->toArray());
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'name'       => ['required', 'unique:Roles,name', 'string', 'min:6', 'max:255'],
                'key_word' => ['required', 'string'],
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
