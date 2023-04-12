<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->foreign('profile_category')->references('category_name')->on('profile_categories')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('category__questions')->onDelete('cascade');
        });
        Schema::table('availabilities', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('spot_id')->references('id')->on('spots')->onDelete('cascade');
            
        });
        Schema::table('slots', function (Blueprint $table) {
            $table->foreign('spot_id')->references('id')->on('spots')->onDelete('cascade');
            
        });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
