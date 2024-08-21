<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseApiController;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends BaseApiController
{
    public function index()
    {
        return $this->sendResponse(Item::query()->get());
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $data['name'] = $request->get('name');
        return $this->sendResponse(Item::query()->create($data));
    }

    public function show($id)
    {
        return $this->sendResponse(Item::query()->where(['id' => $id])->first());
    }

    public function edit($id)
    {
        return Item::query()->where(['id' => $id])->first();
    }

    public function update(Request $request, $id)
    {
        $data['name'] = $request->get('name');
        Item::query()->updateOrInsert(['id' => $id], $data);

        return $this->sendResponse(Item::query()->where(['id' => $id])->first());
    }

    public function destroy($id)
    {
        return $this->sendResponse(Item::query()->where(['id' => $id])->delete());
    }
}
