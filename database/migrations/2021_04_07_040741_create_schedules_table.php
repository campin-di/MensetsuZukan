<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('st_id')->unsigned();
            $table->integer('hr_id')->unsigned();
            $table->date('date');
            $table->integer('seven');
            $table->integer('eight');
            $table->integer('nine');
            $table->integer('ten');
            $table->integer('eleven');
            $table->integer('twelve');
            $table->integer('thirteen');
            $table->integer('fourteen');
            $table->integer('fifteen');
            $table->integer('sixteen');
            $table->integer('seventeen');
            $table->integer('eighteen');
            $table->integer('nineteen');
            $table->integer('twenty');
            $table->integer('twentyone');
            $table->integer('twentytwo');
            $table->integer('twentythree');
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
        Schema::dropIfExists('schedules');
    }
}
