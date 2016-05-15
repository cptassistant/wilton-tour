<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('address', 150);
            $table->string('city', 150);
            $table->string('state', 2)->nullable();
            $table->string('country', 50);
            $table->string('postalCode', 20);
            $table->string('phone', 20)->nullable();
            $table->string('website', 100)->nullable();
            $table->double('lattitude', 15, 8)->nullable();
            $table->double('longitude', 15, 8);
            $table->integer('numHoles');
            $table->integer('coursePar');
            $table->string('courseType', 30)->nullable();
            $table->decimal('weekdayPrice')->nullable();
            $table->decimal('weekendPrice')->nullable();
            $table->integer('slope')->nullable();
            $table->string('banner', 150)->nullable();
            $table->string('image', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('courses');
    }
}
