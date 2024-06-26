<?php

namespace App\Http\Controllers\Api;

use App\Jobs\RegisterUserJob;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    public function register(Request $request)
    {
        $listUser = [
           ['name' => 'test 1', 'email' => 'test1@yomail.com', 'password' => '123123', 'status' => true],
           ['name' => 'test 2', 'email' => 'test2@yomail.com', 'password' => '123123', 'status' => true],
           ['name' => 'test 3', 'email' => 'test3@yomail.com', 'password' => '123123', 'status' => false],
           ['name' => 'test 4', 'email' => 'test4@yomail.com', 'password' => '123123', 'status' => true],
           ['name' => 'test 5', 'email' => 'test5@yomail.com', 'password' => '123123', 'status' => true]
        ];

        RegisterUserJob::dispatch($listUser);
    }
}
