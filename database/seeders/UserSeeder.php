<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create default admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@yopmail.com',
            'password' => 'admin@123',
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Create test users
        User::factory(20)->create();

        // Create specific test user
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
        ]);
    }
}
