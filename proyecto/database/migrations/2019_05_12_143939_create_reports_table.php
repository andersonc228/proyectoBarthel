<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('q1')->length(2);
            $table->mediumInteger('q2')->length(2);
            $table->mediumInteger('q3')->length(2);
            $table->mediumInteger('q4')->length(2);
            $table->mediumInteger('q5')->length(2);
            $table->mediumInteger('q6')->length(2);
            $table->mediumInteger('q7')->length(2);
            $table->mediumInteger('q8')->length(2);
            $table->mediumInteger('q9')->length(2);
            $table->mediumInteger('q10')->length(2);
            $table->mediumInteger('total')->length(3);
            $table->string('dniPacient',10);
            $table->timestamps();

            $table->foreign('dniPacient')->references( 'dni')->on( 'users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
