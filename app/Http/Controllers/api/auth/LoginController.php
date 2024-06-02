<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\api\apiResponseTrait;
use App\Http\Services\verficationServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


use App\Helpers\Helper;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    use apiResponseTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public $smsservices;
    public function __construct(verficationServices $smsservices) {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'consoleRegister', 'image','verficationCode', 'checkOTP', 'changePassword']]);
        $this->smsservices = $smsservices;
    }


    public function login(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);
                
        if ($validator->fails())
        {
            return $this->apiResponse("empty",$validator->errors(),400);
        }
        if (! $token = auth('api')->attempt($validator->validated()))
        {
            return $this->apiResponse("empty",__('Unauthorized'),401);
        }
        $token =  $this->createNewToken($token);
        $token = $token->original['access_token'];
        $user = User::where('phone', $request->phone)->select('id','name','email','phone','status')->first();
        $userData = array('token' => $token,'user'=>$user);
        return $this->apiResponse($userData,'success',200);
    }





    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
    
}
