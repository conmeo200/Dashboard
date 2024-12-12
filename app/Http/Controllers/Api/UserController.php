<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UsersRepositores\UsersRepositores;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    protected $userRsp;

    public function __construct(UsersRepositores $userRsp)
    {
        $this->userRsp = $userRsp;
    }

    public function index(Request $request) 
    {
        return $this->sendPaginationArrayResponse($this->userRsp->getAllUsers($request->all()));    
    }

    public function create(Request $request) {
        
    }

    public function detail($id) 
    {
        
    }

    public function update(Request $request, $id) {
        
    }

    public function delete($id) {
        
    }
}
