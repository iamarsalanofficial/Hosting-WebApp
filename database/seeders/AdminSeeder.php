<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Ensure no duplicate entries
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'), // Replace with a secure password
                'is_admin' => true, // Set admin flag
            ]
        );
    }
}
