<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Follow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows',function(Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('user_following');
            $table->integer('user_followed');
            $table->foreign('user_following')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_followed')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
