<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('scorecard_id')->unsigned();
            $table->integer('number');
            $table->integer('par');
            $table->integer('yards');
            $table->timestamps();

            $table->foreign('scorecard_id')->references('id')->on('scorecards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('holes');
    }
}
