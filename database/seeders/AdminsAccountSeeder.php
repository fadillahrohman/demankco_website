<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminsAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // DB::table('admins_account')->insert([
        //     'name' => 'radengunawan',
        //     'email' => 'radengunawan@admin.id',
        //     'password' => Hash::make('singduepabean'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
