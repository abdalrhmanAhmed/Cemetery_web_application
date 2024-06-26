<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Services\VerificationService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * @var VerificationService
     */
    protected $verificationService;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','sendOTP','verifyOTP','updateUser']]);
        // $this->verificationService = $verificationService;
    }

    /**
     * Login function that validates credentials and returns token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse("error", $validator->errors(), 400);
        }

        if (!$token = auth('api')->attempt($validator->validated())) {
            return $this->apiResponse("error", __('Unauthorized'), 401);
        }

        $token = $this->createNewToken($token);

        $user = User::where('phone', $request->phone)
            ->select('id', 'name', 'email', 'phone', 'status')
            ->first();

        $userData = [
            'token' => $token,
            'user' => $user,
        ];

        return $this->apiResponse($userData, 'success', 200);
    }

    /**
     * Function to handle sending OTP to phone number.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse("error", $validator->errors(), 400);
        }

        // Call sendOTP method from verficationServices
        try {
            $response = sendOTP($request->phone);
            
            // Handle API response and return appropriate response
            if ($response['success']) {
                $user = User::where('phone', $request->phone)->get();
                if ($user->count() > 0) {
                    return $this->apiResponse("success", "OTP sent successfully", 200);
                }else {
                    $user = new User();
                    $user->phone = $request->phone;
                    $user->password = '$2y$10$z9/54/1BX0rKyhLnRFXDP.DmNQJy2MSsm.s5CkO3ueMRow5mHMkR6';
                    $user->name = ['en'=>'UnKnown','ar'=>'غير معروف'];
                    $user->email = $request->phone . '@Clinet.com';
                    $user->status = 0;
                    $user->save();
                    return $this->apiResponse("success", "OTP sent successfully", 200);
                }
            } else {
                return $this->apiResponse("error", "Failed to send OTP", 500);
            }
        } catch (\Exception $e) {
            return $this->apiResponse("error", $e->getMessage(), 500);
        }
    }

    // Function to verify OTP
    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse("error", $validator->errors(), 400);
        }

        // Assume you have a method in verficationServices to verify OTP
        try {
            $verificationResult = verifyOTP($request->phone, $request->otp);
            
            // Handle API response and return appropriate response
            if ($verificationResult['success']) {
                return $this->apiResponse("success", "OTP verified successfully", 200);
            } else {
                return $this->apiResponse("error", "Invalid OTP or OTP expired", 400);
            }
        } catch (\Exception $e) {
            return $this->apiResponse("error", $e->getMessage(), 500);
        }
    }

    /**
     * Function to update user model with name and age.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return $this->apiResponse(null, 'User not found', 404);
        }

        // Update user model with name and age
        $user->name = ['ar' => $request->ar, 'en' => $request->en];
        $user->save();
        $request['password'] = 'secret';
        return $this->login($request);
    }

    /**
     * Helper function to create new token response.
     *
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Helper function to generate API responses consistently.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function apiResponse($data, $message, $status)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
