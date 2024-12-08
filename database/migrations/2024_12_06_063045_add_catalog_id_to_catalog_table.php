<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('catalogs', function (Blueprint $table) {
            $table->string('catalog_id')->unique()->nullable(false)->after('id'); 
        });
        
        \Illuminate\Support\Facades\DB::statement("
            UPDATE catalogs 
            SET catalog_id = CONCAT('CAT-', id) 
            WHERE catalog_id IS NULL OR catalog_id = '';
        ");
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catalogs', function (Blueprint $table) {
            $table->dropColumn('catalog_id');
        });
    }
};

