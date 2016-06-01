<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMatchScoresForeignReference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('match_scores', function (Blueprint $table) {
            $table->integer('match_holes_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('match_scores', function (Blueprint $table) {
            $table->dropColumn('match_holes_id');
        });
    }
}
