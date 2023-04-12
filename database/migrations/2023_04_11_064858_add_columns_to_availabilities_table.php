<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('availabilites', function (Blueprint $table) {
        $table->integer('user_id');
        $table->integer('spot_id');
        $table->date('date');
        $table->string('time_slot');
    });
}

public function down()
{
    Schema::table('availabilites', function (Blueprint $table) {
        $table->dropColumn(['user_id', 'spot_id', 'date', 'time_slot']);
    });
}
}
