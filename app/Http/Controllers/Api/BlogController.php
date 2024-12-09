<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\BlogsRepositores\BlogsRepositores;
use Illuminate\Http\Request;

class BlogController extends BaseApiController
{
    public $blogsRsp;

    public function __construct(BlogsRepositores $blogsRsp)
    {
        $this->blogsRsp = $blogsRsp;
    }

    public function index(Request $request) 
    {
        return $this->sendPaginationArrayResponse($this->blogsRsp->getAllBlogs($request->all()));    
    }

    public function create(Request $request) {
        
    }

    public function detail($id) 
    {
        if (empty($id) || (!empty($id) && !is_numeric($id))) return $this->sendError('Data Invalid');  
        
        $model = $this->blogsRsp->findFirstByID($id);

        if (empty($model)) return $this->sendError("Blog Id {$id} Not Found");

        return $this->sendResponse($model);
    }

    public function update(Request $request, $id) {
        
    }

    public function delete($id) {
        
    }
}
