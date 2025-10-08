<?php
namespace App\Repositories\NailsRepositores;

use App\Models\Blog;
use App\Models\Nails;
use App\Repositories\BaseRepository;
use App\Repositories\RedisService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NailsRepositores 
{
    public function listNails($params = []) {}

    public function create($param) 
    {
        $validator = Validator::make($param, [
            'name'        => ['required', 'string', 'max:255', 'min:1'],
            'description' => ['nullable', 'string'],
            'image_url'   => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/']
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors'  => $validator->errors()
            ];
        }

        DB::beginTransaction();

        try {
            $insert = Nails::create($param);

            DB::commit();
            return [
                'success' => true,
                'data'    => $insert
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'errors'  => $e->getMessage()
            ];
        }
    }


    public function findFirstByID($id) 
    {
        if (empty($id) || !is_numeric($id)) return [];

        $model = Nails::query()->where('id', $id)->toArray();

        if (empty($model)) return [];

        return $model;
    }

    public function detail($id) 
    {
        return $this->findFirstByID($id);
    }

    public function update($param, $id) 
    {
        $model = Nails::query()->where('id', $id);

        if (empty($model)) return [];

        $validator = Validator::make($param, [
            'name'        => ['required', 'string', 'max:255', 'min:1'],
            'description' => ['nullable', 'string'],
            'image_url'   => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/']
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors'  => $validator->errors()
            ];
        }

        DB::beginTransaction();

        try {
            $model->update($param);

            DB::commit();
            return [
                'success' => true,
                'data'    => $model
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'errors'  => $e->getMessage()
            ];
        }
    }

    public function delete($id) 
    {
        if (empty($id) || !is_numeric($id)) return false;

        return Nails::query()->where('id', $id)->delete();
    }
}