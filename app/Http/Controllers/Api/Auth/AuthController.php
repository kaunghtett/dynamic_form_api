<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Services\User as UserService;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    //
    protected $user;
    use ApiResponser;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user =  $this->user->store($request->all());

            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()
                ->json(['user' => $user, 'access_token' => $token, 'token_type' => 'Bearer']);
        }
        catch (Exception $e) {

            return $this->apiExceptionResponse($e);
        } 
    }


    public function login(LoginRequest $request)
    {
        try {
            
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                $user = Auth::user(); 
                $token =  $user->createToken('api Token')->plainTextToken; 
                return response()->json(['user' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
            }

            return $this->errorResponse("Invalid Crendentials check your password",400);
          
        } catch (Exception $e) {
            return $this->apiExceptionResponse($e);
        }
      
    }
 
    // this method signs out users by removing tokens
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->successResponse(null,"Token Revoked",200);
    }
}
