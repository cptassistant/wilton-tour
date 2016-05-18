<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('match_id')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->integer('total_score');
            $table->integer('match_points_earned');
            $table->integer('achievement_points_earned');
            $table->integer('total_putts')->nullable();
            $table->integer('longest_drive')->nullable();
            $table->integer('num_gir')->nullable();
            $table->integer('fairways_hit')->nullable();
            $table->timestamps();

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
        Schema::drop('match_stats');
    }
}
