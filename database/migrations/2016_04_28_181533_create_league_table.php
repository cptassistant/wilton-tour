<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('tagline', 150)->nullable();
            $table->string('country', 100);
            $table->string('state', 2);
            $table->string('city', 100);
			$table->integer('ownerID')->unsigned();
            $table->boolean('active');
            $table->timestamps();
            
			$table->foreign('ownerID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leagues');
    }
}
