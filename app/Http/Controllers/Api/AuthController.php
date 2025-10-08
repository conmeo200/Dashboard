<?php

namespace App\Http\Controllers\Api;

use App\Repositories\User\UserResponse;
use App\Service\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseApiController
{
    protected $userResponse;
    protected $x_client_type;
    const Client_Type_WEB = 'web';
    const Client_Type_APP = 'app';

    public function __construct(UserResponse $userResponse)
    {
        $this->userResponse  = $userResponse;
        $this->x_client_type = request()->header('X-Client-Type');
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
                return $this->sendError('Invalid credentials', 422);
            }

            $user = $this->userResponse->findFirstUserByEmail($data['email']);

            if (!$user) {
                return $this->sendError('Invalid credentials', 422);
            }

            $token = $user->createToken('authToken')->plainTextToken;

            if ($this->x_client_type == self::Client_Type_APP) {
                $result = [                    
                    'access_token' => $token,
                    'token_type'   => 'Bearer',
                    'data'         => $user,
                ];

                return $this->sendResponse($result, 'Login Success !'); 
            } elseif ($this->x_client_type == self::Client_Type_WEB) {
                return response()
                                ->json([
                                    'success' => true,
                                    'data'    => $user,
                                    'message' => 'Login Success'
                                ])
                                ->cookie('auth_token', $token, 60 * 24, '/', null, true, true);
            }                   
        } catch (\Exception $error) {
            LogError('Login', $error->getMessage(), $error->getLine(), $error->getFile());

            return $this->sendError('An error occurred during login');
        }
    }

    public function handleForgotPassword(Request $request)
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
            $user = $this->userResponse->updateUser($data);

            if (!$user) {
                return $this->sendError('Invalid credentials', 422);
            }

            return $this->sendResponse([], 'Update User Success !');
        } catch (\Exception $error) {
            LogError('Update', $error->getMessage(), $error->getLine(), $error->getFile());

            return $this->sendError('An error occurred during login');
        }
    }

    public function handCheckEmail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email']
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }

            $data = $validator->validated();
            $user = $this->userResponse->findFirstUserByEmail($data['email']);

            if (!$user) {
                return $this->sendError('Invalid credentials', 422);
            }
            
            return $this->sendResponse([], 'Check Email Success !');
        } catch (\Exception $error) {
            LogError('Check Email ', $error->getMessage(), $error->getLine(), $error->getFile());

            return $this->sendError('An error occurred during login');
        }
    }

    public function handleLogout(Request $request)
    {
        try {        
            if (!Auth::check()) 
                return $this->sendError('Fail');
            
            $request->user()->tokens->each(function ($token) {
                $token->delete();
            });
            
            $cookie = Cookie::forget('auth_token');
            
            return response()->json(['status' => true, 'message' => 'Logged out successfully'])->withCookie($cookie);
        } catch (\Exception $exection) {
            LogError('Logout', $exection->getMessage(), $exection->getLine(), $exection->getFile());

            return $this->sendError('An error occurred during logout');
        }   
    }
}
