<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => ['The provided credentials are incorrect.'],
            ]);
        }

        $data['token'] = $user->createToken('auth_token')->plainTextToken;
        $data['user']  =  new UserResource($user);
        return response($data, Response::HTTP_OK);
    }

    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255', 
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|confirmed|min:6'
        ]);

        if ($validator->fails()) { 
            $errors = $validator->errors(); 
            return response()->json(['error' => $errors], 400);    
        } 

        if ($validator->passes()) {
              
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email, 
                'password' => Hash::make($request->password)
            ]); 

            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);    
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=> 'User logged out successfully.'], Response::HTTP_OK);
    }
}