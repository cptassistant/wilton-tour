<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hole_id')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->integer('score');
            $table->integer('match_id')->unsigned();
            $table->timestamps();

            $table->foreign('hole_id')->references('id')->on('holes');
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('match_id')->references('id')->on('matches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('match_scores');
    }
}
