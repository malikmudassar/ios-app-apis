<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('email')->nullable();
            $table->string('apple_id')->nullable();
            $table->integer('age')->nullable();
            $table->string('birth_month')->nullable();
            $table->integer('birth_day')->nullable();
            $table->string('occupation')->nullable();
            $table->string('purpose')->nullable();
            $table->string('source')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
