<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    public function __construct(
        private User $user
    ){}

    public function register(array $request) {
        $user = $this->user->create($request);

        return $user;
    }
}
