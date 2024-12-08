<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateTable extends Command
{
    // Nama signature untuk perintah
    protected $signature = 'truncate:table {table}';
    
    // Deskripsi perintah
    protected $description = 'Truncate a specified table';

    public function handle()
    {
        // Ambil nama tabel dari argument
        $table = $this->argument('table');

        // Cek apakah tabel ada sebelum melakukan truncate
        if (DB::getSchemaBuilder()->hasTable($table)) {
            // Nonaktifkan pemeriksaan foreign key sementara
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            // Truncate tabel
            DB::table($table)->truncate();
            
            // Aktifkan kembali pemeriksaan foreign key
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // Informasikan keberhasilan
            $this->info("Tabel {$table} telah ditruncate.");
        } else {
            // Informasikan jika tabel tidak ditemukan
            $this->error("Tabel {$table} tidak ditemukan.");
        }
    }
}
