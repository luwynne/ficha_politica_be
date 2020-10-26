<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
//use Tymon\JWTAuth\JWTAuth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

    protected $user;

    public function __construct(){
        $this->user = new User();
        //$this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->toArray()
            ], 422);
        }

        $check_email = $this->user->where('email', $request->input('email'))->count();

        if($check_email > 0){
            return response()->json([
                'success' => false,
                'message' => 'This is email already exists. Please try to login'
            ], 400);
        }

        $registerComplete = $this->user::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if($registerComplete){
            return $this->login($request);
        }

    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    
    public function loggedUser()
    {
        return response()->json(auth()->user());
    }

    
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    
}
