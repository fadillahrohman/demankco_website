<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneNumberColumnToUsers extends Migration  // Nama class berbeda
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number', 15)->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_number');
        });
    }
}