<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class AuthService
{
    public function __construct(
        private AuthRepository $authRepository
    ){}

    public function register(array $request) {
        return DB::transaction(function () use ($request) {
            $user = $this->authRepository->register($request);

            return $user;
        });
    }

    public function login(array $credentials) {
        if (!Auth::attempt($credentials)) {
            throw new InvalidArgumentException("Invalid Credentials");
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return $token;
    }
}
