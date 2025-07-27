<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'role_id'=>'required|integer|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => "Validation error",
                "errors" => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);
        
        return response()->json([
            'message' => 'Registeration is successful.',
            "data"=>[
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]
        ], 201);
    }
     
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(auth()->attempt($credentials)){
            $user = User::where('email', $credentials['email'])
                        ->first();

            if ($user && Hash::check($credentials['password'], $user->password)) {
                $token = $user->createToken("MyApp")->accessToken;
                return response()->json([
                    "message"=>"Login was successful.",
                    "data"=>[
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                    ]
                    
                ]);
            } else {
            return response()->json([
                    'message' => 'Password is incorrect.'
                ], 404);
            }

        }

        return response()->json(['error' => 'Invalid credentials'], 401);


        $credentials = $request->only('email', 'password');
        
        // Try to create token
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        $user = User::where('email', $credentials['email'])
                        ->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                "message"=>"Login was successful.",
                "data"=>[
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role_id' => $user->role->id,
                    'role' => $user->role->name ?? null,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]
                
            ]);
        } else {
           return response()->json([
                'message' => 'Password is incorrect.'
            ], 404);
        }
        
    }
}
