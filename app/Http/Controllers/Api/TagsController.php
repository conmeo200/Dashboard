<?php

namespace App\Http\Controllers\Api;

use App\Repositories\TagRepositores\TagRepositores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TagsController extends BaseApiController
{
    public $tagRsp;

    public function __construct(TagRepositores $tagRsp)
    {
        $this->tagRsp = $tagRsp;
    }

    public function index(Request $request) 
    {        
        return $this->sendPaginationArrayResponse($this->tagRsp->getAllTags($request->all()));
    }

    public function create(Request $request) 
    {
        try {
            $validator = Validator::make($request->all(), [
                'tag_name'  => ['required', 'string', 'min:1', 'max:255'],
                'is_active' => ['required', Rule::in('Y', 'N')]
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }
    
            $dataRequest = $validator->validate();
            $dataPost    = [
                'name'     => $dataRequest['tag_name'],
                'isActive' => $dataRequest['is_active']
            ];
            $insertItem = $this->tagRsp->insertItem($dataPost);

            if (!$insertItem) return $this->sendError('Insert Item Fail !');

            return $this->sendPaginationArrayResponse($insertItem, 'Insert Item Success');
        } catch (\Exception $e) {
            Log::error("Api Create Item Error Messages: {$e->getMessage()}");

            return $this->sendError('System Error!', 500);
        }
    }

    public function detail($id) 
    {
        try {
            if (empty($id)) return $this->sendError('Data Invalid');

            $item = $this->tagRsp->findFirstByID($id);

            if (empty($item)) return $this->sendError("Item ID {$id} Not Found In Tag"); 

            return $this->sendResponse($item, 'Success!');
        } catch (\Exception $e) {
            Log::error("Api Create Item Error Messages: {$e->getMessage()}");

            return $this->sendError('System Error!', 500);
        }    
    }

    public function update(Request $request, $id) 
    {
        try {
            if (empty($id)) return $this->sendError('Data Invalid');

            $item = $this->tagRsp->findFirstByID($id);

            if (empty($item)) return $this->sendError("Item ID {$id} Not Found In Tag"); 

            $validator = Validator::make($request->all(), [
                'tag_name'  => ['required', 'string', 'min:1', 'max:255'],
                'is_active' => ['required', Rule::in('Y', 'N')]
            ]);    
    
            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }
    
            $dataRequest = $validator->validate();
            $dataPost    = [
                'name'     => $dataRequest['tag_name'],
                'isActive' => $dataRequest['is_active']
            ];
            $updateItem = $this->tagRsp->updateItemByID($id, $dataPost);

            if (!$updateItem) return $this->sendError('Update Item Fail !');

            return $this->sendResponse($updateItem, 'Update Item Success!');
        } catch (\Exception $e) {
            Log::error("Api Update Item Error Messages: {$e->getMessage()}");

            return $this->sendError('System Error!', 500);
        }     
    }

    public function delete($id)
    {
        try {
            if (empty($id)) return $this->sendError('Data Invalid');

            $item = $this->tagRsp->findFirstByID($id);

            if (empty($item)) return $this->sendError("Item ID {$id} Not Found In Tag"); 

            $deleteItem = $this->tagRsp->deleteItemByID($id);

            if (!$deleteItem) return $this->sendError('Delete Item Fail !');

            return $this->sendResponse([], 'Delete Item Success!');
        } catch (\Exception $e) {
            Log::error("Api Delete Item Error Messages: {$e->getMessage()}");

            return $this->sendError('System Error!', 500);
        }      
    }
}
