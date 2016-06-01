<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchHolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_holes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('match_id')->unsigned();
            $table->integer('hole_id')->unsigned();
            $table->integer('match_hole_number');
            $table->timestamps();

            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('hole_id')->references('id')->on('holes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('match_holes');
    }
}
