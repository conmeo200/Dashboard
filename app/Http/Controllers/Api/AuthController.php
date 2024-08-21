<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TwilioService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    public function register(Request $request)
    {
        $request->validate([
            'email'        => 'required|email',
            'phone'        => 'required',
            'country_code' => 'required',
        ]);

        $user = $this->twilioService->registerUser($request->email, $request->phone, $request->country_code);

        if ($user['success']) {
            // Lưu Authy ID của người dùng vào cơ sở dữ liệu
            // $request->user()->update(['authy_id' => $user['user']['id']]);
            return response()->json(['message' => 'User registered with Authy', 'authy_id' => $user['user']['id']]);
        } else {
            return response()->json(['error' => $user['message']], 400);
        }
    }

    public function sendOtp(Request $request)
    {
        $authyId  = $request->input('authy_id');
        $response = $this->twilioService->sendToken($authyId);

        if ($response['success']) return response()->json(['message' => 'OTP sent']);
        else return response()->json(['error' => $response['message']], 400);
    }

    public function verifyOtp(Request $request)
    {
        $authyId  = $request->input('authy_id');
        $token    = $request->input('token');
        $response = $this->twilioService->verifyToken($authyId, $token);

        if ($response['success'])  return response()->json(['message' => 'OTP verified']);
        else return response()->json(['error' => $response['message']], 400);
    }
}
