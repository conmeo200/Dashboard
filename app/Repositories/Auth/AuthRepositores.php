<?php 

namespace App\Repositories\Auth;

use App\Repositories\BaseApiRepository;
use App\Repositories\User\UserResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthRepositores extends BaseApiRepository
{
    public $user_response;

    public function __construct(UserResponse $user_response)
    {
        $this->user_response = $user_response;
    }

    public function handleLogin($param) 
    {
        try {
            $validator = Validator::make($param, [
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

            $user = $this->user_response->findFirstUserByEmail($data['email']);

            if (!$user) {
                return $this->sendError('Invalid credentials', 422);
            }

            $token = $user->createToken('authToken')->plainTextToken;

            return [                    
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'data'         => $user,
            ];                 
        } catch (\Exception $error) {
            LogError('Login', $error->getMessage(), $error->getLine(), $error->getFile());

            return $this->sendError('An error occurred during login');
        }
    }
    public function handleLogout($param) 
    {
        try {        
            if (!Auth::check()) 
                return $this->sendError('Fail');
            
            
        } catch (\Exception $exection) {
            LogError('Logout', $exection->getMessage(), $exection->getLine(), $exection->getFile());

            return $this->sendError('An error occurred during logout');
        }
    }    
    public function handleRegister($param) 
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($param, [
                'name'     => ['required', 'min:6', 'max:255'],
                'email'    => ['required', 'email', 'max:255'],
                'password' => ['required', 'min:6', 'max:255'],
                // 'token'    => ['required'],
            ]);

            if ($validator->fails()) return $validator->errors()->toArray();

            // Insert User
            $dataPost       = $validator->validated();
            // Check Recapcha
            // $checkRecaptcha = verifyReCaptcha($dataPost['token']);

            // if (!$checkRecaptcha) $checkRecaptcha;

            // unset($dataPost['token']);
            $insertUser = $this->user_response->create($dataPost);

            if (!$insertUser) {
                DB::rollBack();

                $result = [
                    'status_code' => 500,
                    'message'     => 'Error in Login',
                ];

                return ['Login Fail!'];
            }
            
            DB::commit();

            $token  = $insertUser->createToken('authToken')->plainTextToken;
            $result = [                    
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'data'         => $insertUser,
            ];                

            return [$result, 'Login Success !'];
        } catch (\Exception $error) {
            LogError('Register', $error->getMessage(), $error->getLine(), $error->getFile());

            return ['Error in Register'];
        }
    }    

    public function handCheckEmail($param)
    {
        try {
            $validator = Validator::make($param, [
                'email' => ['required', 'email']
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }

            $data = $validator->validated();
            $user = $this->user_response->findFirstUserByEmail($data['email']);

            if (!$user) {
                return $this->sendError('Invalid credentials', 422);
            }
            
            return $this->sendResponse([], 'Check Email Success !');
        } catch (\Exception $error) {
            LogError('Check Email ', $error->getMessage(), $error->getLine(), $error->getFile());

            return $this->sendError('An error occurred during login');
        }
    }


    public function handleForgotpassword($param) 
    {
        try {
            $validator = Validator::make($param, [
                'email'    => ['required', 'email'],
                'password' => ['required', 'min:6', 'max:255'],
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }

            $data = $validator->validated();
            $user = $this->user_response->updateUser($data);

            if (!$user) {
                return $this->sendError('Invalid credentials', 422);
            }

            return $this->sendResponse([], 'Update User Success !');
        } catch (\Exception $error) {
            LogError('Update', $error->getMessage(), $error->getLine(), $error->getFile());

            return $this->sendError('An error occurred during login');
        }
    }
}