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
            $table->id();
            $table->integer('hr_id')->unsigned();
            $table->date('date');
            $table->boolean('eight');
            $table->boolean('nine');
            $table->boolean('ten');
            $table->boolean('eleven');
            $table->boolean('twelve');
            $table->boolean('thirteen');
            $table->boolean('fourteen');
            $table->boolean('fifteen');
            $table->boolean('sixteen');
            $table->boolean('seventeen');
            $table->boolean('eighteen');
            $table->boolean('nineteen');
            $table->boolean('twenty');
            $table->boolean('twentyone');
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
