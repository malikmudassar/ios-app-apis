<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FkTo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('category__questions', function (Blueprint $table) {
        //     $table->foreign('category_id')->references('id')->on('profile_categories')->onDelete('cascade');
            
        // });
        // Schema::table('category_answers', function (Blueprint $table) {
        //     $table->foreign('category_id')->references('id')->on('profile_categories')->onDelete('cascade');
        //     $table->foreign('question_id')->references('id')->on('category__questions')->onDelete('cascade');
            
        // });
       
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
