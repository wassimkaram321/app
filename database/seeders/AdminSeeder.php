<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234567890'), // Hash the password
            'address' => '123 Admin St',
            'phone' => '1234567890',
            'email_verified_at' => now(),
            'last_login_at' => now(),
            'gender' => 'male',
            'status' => true,
            'role_id' => 1, // Replace with the actual role ID
            'remember_token' => \Str::random(10), // Use \Str::random() to generate a random string
        ]);



    }
}
