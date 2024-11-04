<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\User\UserResponse;
use App\Service\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseApiController
{
    protected $twilioService;
    protected $userResponse;

    public function __construct(TwilioService $twilioService, UserResponse $userResponse)
    {
        $this->twilioService = $twilioService;
        $this->userResponse  = $userResponse;
    }

    public function handleRegister(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'     => ['required', 'min:6', 'max:255'],
                'email'    => ['required', 'email', 'max:255'],
                'password' => ['required', 'min:6', 'max:255']
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }

              // Insert User

            $insertUser = $this->userResponse->create($validator->validated());

            if ($insertUser) {
                 $token = $insertUser->createToken('authToken')->plainTextToken;

                 return response()->json([
                    'status_code'  => 200,
                    'access_token' => $token,
                    'token_type'   => 'Bearer',
                    'data'         => $insertUser,
                ]);
            } else {
                return response()->json([
                    'status_code' => 500,
                    'message'     => 'Error in Login',
                ]);
            }
        } catch (\Exception $error) {
            LogError('Register', $error->getMessage(), $error->getLine(), $error->getFile());

            return response()->json([
                'status_code' => 500,
                'message'     => 'Error in Register',
                'error'       => $$error->getMessage(),
            ]);
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

            return response()->json([
               'status_code'  => 200,
               'access_token' => $token,
               'token_type'   => 'Bearer',
               'data'         => $user,
           ]);

        } catch (\Exception $error) {
            LogError('Login', $error->getMessage(), $error->getLine(), $error->getFile());

            return response()->json([
                'status_code' => 500,
                'message'     => 'Error in Login',
                'error'       => $error,
            ]);
        }
    }

    public function handleLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->sendResponse(['message' => 'Logged out successfully']);
    }
}
