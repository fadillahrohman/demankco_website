<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tambah akun Admin
        $this->call([
            AdminsAccountSeeder::class,
        ]);

        // Menghapus semua data dari tabel
        DB::table('orders')->truncate();


        // User::factory(10)->create();

        // User::truncate();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(LocationsSeeder::class);
    }
}
