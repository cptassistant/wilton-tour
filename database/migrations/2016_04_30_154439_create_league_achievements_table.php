<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_achievements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('achievement_id')->unsigned();
            $table->integer('league_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('achievement_id')->references('id')->on('achievements');
            $table->foreign('league_id')->references('id')->on('leagues');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('league_achievements');
    }
}
