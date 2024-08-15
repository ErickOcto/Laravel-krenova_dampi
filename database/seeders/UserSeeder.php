<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'name' => "Beddu",
            'email' => "beddu@gmail.com",
            'password' => \bcrypt('password'),
            'status' => 1,
            'role' => 0,
        ]);
    }
}
