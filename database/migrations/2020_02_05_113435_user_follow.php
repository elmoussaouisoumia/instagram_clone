<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserFollow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('user_follow', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('followed');
            $table->unsignedBigInteger('follower');
            $table->foreign('followed')->references('id')->on('users');
            $table->foreign('follower')->references('id')->on('users');
            $table->timestamps();
        });
    }

    
   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_follow');
    }
}
