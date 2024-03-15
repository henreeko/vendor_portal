<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'admin',
        ]);

        // Procurement Officer User
        User::create([
            'name' => 'Procurement Officer',
            'email' => 'procurement_officer@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'procurement_officer',
        ]);

        // Procurement Head User
        User::create([
            'name' => 'Procurement Head',
            'email' => 'procurement_head@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'procurement_head',
        ]);
    }
}
