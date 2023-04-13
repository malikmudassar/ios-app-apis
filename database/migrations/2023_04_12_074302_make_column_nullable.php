<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeColumnNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('pref_profile_view',['yes','no'])->nullable()->change();
            $table->enum('pref_Zodic_sign',['yes','no'])->nullable()->change();
            $table->enum('subsc_package',['0','1'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('pref_profile_view')->change();
            $table->enum('Zodic_sign',['yes','no'])->change();
            $table->enum('subsc_package',['0','1'])->change();
        });
    }
}
