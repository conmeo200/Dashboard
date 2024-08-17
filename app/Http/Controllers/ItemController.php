<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return Item::query()->orderBy('create_at', 'DESC')->get();
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        return Item::query()->create($request->get('name'));
    }

    public function show($id)
    {
        return Item::query()->where(['id' => $id])->first();
    }

    public function edit($id)
    {
        return Item::query()->where(['id' => $id])->first();
    }

    public function update(Request $request, $id)
    {
        return Item::query()->updateOrInsert(['id' => $id], $request->get('name'));
    }

    public function destroy($id)
    {
        return Item::query()->where(['id' => $id])->delete();
    }
}
