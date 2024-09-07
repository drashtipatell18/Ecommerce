<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Import the User model

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com ',
            'password' => bcrypt('password'), // Use bcrypt for password hashing
            'image' => 'images/admin.jpg',
        ]);

        // Add more users as needed
    }
}