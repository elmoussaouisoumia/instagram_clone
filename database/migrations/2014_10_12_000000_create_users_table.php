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
            $table->bigIncrements('id');
            $table->string('nom_com');
            $table->string('nom_ut');
            $table->integer('num')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('pdp')->nullable();
            $table->string('genre')->nullable();
            $table->string('bio')->nullable();
            $table->string('role')->nullable();
            $table->integer('nb_pub')->nullable();
            $table->integer('nb_abonnes')->nullable();
            $table->integer('nb_abonnement')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
