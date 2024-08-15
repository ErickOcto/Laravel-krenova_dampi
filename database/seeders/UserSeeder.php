<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'name' => 'erick',
            'email' => 'erick@gmail.com',
            'password' => bcrypt('password'),
            'ktp' => 'apalah',
            'status' => 1,
            'role' => 1,
            'address' => '123 Main',
        ]);
    }
}
