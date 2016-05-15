<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_achievements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('achievement_id')->unsigned();
            $table->integer('match_id')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->integer('hole_id')->nullable();
            $table->timestamps();

            $table->foreign('achievement_id')->references('id')->on('achievements');
            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('player_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('match_achievements');
    }
}
