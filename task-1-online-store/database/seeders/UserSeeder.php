<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Muhammad Mujahid',
            'email' => 'mamat1411@gmail.com',
            'password' => Hash::make('mamat1411'),
            'role' => UserRole::Admin
        ]);
    }
}
