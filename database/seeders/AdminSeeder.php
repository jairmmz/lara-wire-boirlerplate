<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador General',
            'email' => 'admin@example.com',
            'password' => '123456789',
            'phone' => '987654321',
            'is_active' => true,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
