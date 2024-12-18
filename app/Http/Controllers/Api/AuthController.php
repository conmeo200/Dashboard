<?php

namespace App\Http\Controllers\Api;

use App\Repositories\User\UserResponse;
use App\Service\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseApiController
{
    protected $userResponse;

    public function __construct(UserResponse $userResponse)
    {
        $this->userResponse  = $userResponse;
    }

    public function handleRegister(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'name'     => ['required', 'min:6', 'max:255'],
                'email'    => ['required', 'email', 'max:255'],
                'password' => ['required', 'min:6', 'max:255'],
                'token'    => ['required'],
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }

            // Insert User
            $dataPost       = $validator->validated();
            $checkRecaptcha = verifyReCaptcha($dataPost['token']);

            if (!$checkRecaptcha) return $this->sendError($checkRecaptcha);

            unset($dataPost['token']);
            $insertUser = $this->userResponse->create($dataPost);

            if ($insertUser) {
                DB::commit();

                $token  = $insertUser->createToken('authToken')->plainTextToken;
                $result = [                    
                    'access_token' => $token,
                    'token_type'   => 'Bearer',
                    'data'         => $insertUser,
                ];                

                return $this->sendResponse($result, 'Login Success !');
            } else {
                DB::rollBack();

                $result = [
                    'status_code' => 500,
                    'message'     => 'Error in Login',
                ];

                return $this->sendError('Login Fail!');
            }
        } catch (\Exception $error) {
            LogError('Register', $error->getMessage(), $error->getLine(), $error->getFile());

            return $this->sendError('Error in Register');
        }
    }

    public function handleLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'    => ['required', 'email'],
                'password' => ['required', 'min:6', 'max:255'],
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }

            $data = $validator->validated();

            $login = Auth::attempt([
                'email'    => $data['email'],
                'password' => $data['password'],
            ]);

            if (!$login) {
                return $this->sendError('Login Fail!', 422);
            }

            $user = $this->userResponse->findFirstUserByEmail($data['email']);

            if (!$user) {
                return $this->sendError('User Not Found', 422);
            }

            $token = $user->createToken('authToken')->plainTextToken;

            $result = [                    
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'data'         => $user,
            ];   
            
            return $this->sendResponse($result, 'Login Success !');
        } catch (\Exception $error) {
            LogError('Login', $error->getMessage(), $error->getLine(), $error->getFile());

            return $this->sendError('Error in Register');
        }
    }

    public function handleLogout(Request $request)
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });
        
        return $this->sendResponse(['message' => 'Logged out successfully']);
    }
}
