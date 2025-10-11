<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'rayhan01',
            'email' => 'rayhanramadhanyy@gmail.com',
            'is_activated' => true,
            'email_verified_at' => now(),
            'phone_number' => '6281234567890',
            'password' => Hash::make('rayhan321'),
            'verification_token' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
