<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('dni',10)->unique();
            $table->string('name',20);
            $table->string('surname',20);
            $table->dateTime('bornDate');
            $table->string('email',30)->unique();
            $table->string('password');
            $table->string('profesion')->nullable();
          //  $table->increments('rol');
            $table->rememberToken();
            $table->timestamps();

//            $table->foreign('rol')->references('id')->on('roles');
            
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
