<?php

namespace Database\Seeders\Frontend;

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
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => '12345678'
        ]);
        User::create([
            'name' => 'author',
            'email' => 'author@gmail.com',
            'user_type' => 'author',
            'kyc_status' => 1,
            'password' => '12345678'
        ]);
    }
}
