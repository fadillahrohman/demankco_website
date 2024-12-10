<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateTable extends Command
{
    protected $signature = 'truncate:table {table}';

    protected $description = 'Truncate a specified table';

    public function handle()
    {

        $table = $this->argument('table');

        // Cek apakah tabel ada sebelum melakukan truncate
        if (DB::getSchemaBuilder()->hasTable($table)) {
            // Nonaktifkan pemeriksaan foreign key sementara
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Truncate tabel
            DB::table($table)->truncate();

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->info("Tabel {$table} telah ditruncate.");
        } else {

            $this->error("Tabel {$table} tidak ditemukan.");
        }
    }
}
