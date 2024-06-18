<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuModel;
use Illuminate\Http\Request;

class MenuController extends BaseApiController
{
    public function listMenu(Request $request)
    {
        $model = MenuModel::query()->where(['active' => 'Y'])->get();

        return $this->sendResponse($model);
    }
}
