<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClmnsAdditon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('users', function (Blueprint $table) {
        //     $table->string('fname')->nullable()->change();
        //     $table->decimal('height')->nullable();
        //     $table->enum('gender',['male','female'])->nullable();
        //     $table->string('profile_path')->nullable();
        //     $table->string('password')->nullable();
        //     $table->integer('state')->nullable();

        // });
        Schema::table('userimages', function (Blueprint $table) {
            $table->string('path')->nullable()->change();

        });
        Schema::table('category__questions', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->change();
            $table->string('question')->nullable()->change();
        });
        Schema::table('category_answers', function (Blueprint $table) {
            $table->string('answer_statement')->nullable()->change();
        });

        Schema::table('profile_categories', function (Blueprint $table) {
            $table->string('category_name')->nullable()->change();
        });
        Schema::table('slots', function (Blueprint $table) {
            $table->date('date')->nullable()->change();
            $table->integer('morning_slot_count')->nullable()->change();
            $table->integer('evening_slot_count')->nullable()->change();
            $table->integer('night_slot_count')->nullable()->change();
        });
        Schema::table('availabilites', function (Blueprint $table) {
            $table->date('date')->nullable()->change();
            $table->string('time_slot')->nullable()->change();
        });
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('profile_category')->nullable()->change();
            $table->integer('Question_id')->nullable()->change();
            $table->string('answer_selected')->nullable()->change();
        });
        Schema::table('user_invites', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->change();
            $table->integer('invited_id')->nullable()->change();
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->string('name')->nullable()->change();;
            $table->double('price')->nullable()->change();;
        });
        Schema::table('spots', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->decimal('latitude')->nullable()->change();
            $table->decimal('longitude')->nullable()->change();
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
            $table->dropColumn(['height','gender','profile_path','password','state']);
        });
    }
}
