<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NailsController extends BaseApiController
{
    public function index(Request $request) 
    {
        return view('nails.products.index');
    }

    public function getData(Request $request) 
    {
        $data = [
            [
                'id'    => 1,
                'name'  => 'A',
                'price' => 12
            ],
            [
                'id'    => 2,
                'name'  => 'A2',
                'price' => 13
            ],
            [
                'id'    => 3,
                'name'  => 'A3',
                'price' => 124
            ],
            [
                'id'    => 4,
                'name'  => 'A4',
                'price' => 15
            ],
            [
                'id'    => 5,
                'name'  => 'A5',
                'price' => 15
            ],
            [
                'id'    => 6,
                'name'  => 'A6',
                'price' => 126
            ],
        ];

        return $this->sendPaginationArrayResponse($data);
    }
    public function create(Request $request) 
    {
        return view('nails.products.index');
    }

    public function view(Request $request, $id) 
    {
        return view('nails.products.index');
    }

    public function update(Request $request, $id) 
    {
        return view('nails.products.index');
    }
    
    public function delete($id) 
    {
        return view('nails.products.index');
    }
}
