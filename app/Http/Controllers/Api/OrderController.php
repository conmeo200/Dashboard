<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrderController extends BaseApiController
{
    public function index(Request $request) 
    {
        
    }

    public function detail($id) 
    {
        
    }

    public function update(Request $request, $id) {
        
    }

    public function delete($id) {
        
    }
    
    public function create(Request $request) 
    {
        $validator = Validator::make(
            $request->all(), 
            [
                'user_id'    =>  ['required', 'numberic', Rule::exit(User::query()->select('id')->get()->toArray())],
                'product_id' =>  ['required', 'numberic', Rule::exit(Product::query()->select('id')->get()->toArray())],
            ]
        );
    }
}
