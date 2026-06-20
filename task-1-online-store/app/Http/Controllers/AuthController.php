<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ){}

    public function register(RegisterRequest $request) {
        $validatedData = $request->validated();
        $hashedPassword = Hash::make($validatedData['password']);
        $validatedData['password'] = $hashedPassword;

        try {
            $user = $this->authService->register($validatedData);

            return response()->json([
                'status' => 201,
                'message' => 'Registered Successfully',
                'data' => new RegisterResource($user)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "User Registration Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function login(LoginRequest $request) {
        try {
            $token = $this->authService->login(
                $request->only([
                    'email',
                    'password'
                ])
            );

            return response()->json([
                "status" => 200,
                "message" => "Logged In Successfully",
                "token" => $token
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Login Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request) : JsonResponse {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Logged Out Successfully'
        ], 200);
    }
}
