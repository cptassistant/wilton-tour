<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlurbsToLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leagues', function (Blueprint $table) {
            $table->string('standings_blurb');
            $table->string('matches_blurb');
            $table->string('achievements_blurb');
            $table->string('courses_blurb');
            $table->string('rules_blurb');
            $table->boolean('disable_last_outting');
            $table->boolean('disable_courses');
            $table->boolean('disable_rules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leagues', function (Blueprint $table) {
            $table->dropColumn('standings_blurb');
            $table->dropColumn('matches_blurb');
            $table->dropColumn('achievements_blurb');
            $table->dropColumn('courses_blurb');
            $table->dropColumn('rules_blurb');
            $table->dropColumn('disable_last_outting');
            $table->dropColumn('disable_courses');
            $table->dropColumn('disable_rules');
        });
    }
}
