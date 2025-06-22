<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'super admin',
            'email' => 'superAdmin@gmail.com',
            'password' => Hash::make('superAdmin'),
            'role' => 'super_admin',
            'email_verified_at' => now(), 
            'remember_token' => $this->generateRandomToken(), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(), // Ajout de email_verified_at
            'remember_token' => $this->generateRandomToken(), // Ajout du remember_token
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Generate a random token.
     *
     * @return string
     */
    protected function generateRandomToken()
    {
        return bin2hex(random_bytes(32));
    }
}
