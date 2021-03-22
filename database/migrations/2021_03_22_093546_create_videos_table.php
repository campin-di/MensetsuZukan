<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('videos', function (Blueprint $table) {
          $table->id();
          $table->string('name')->nullable();
          $table->string('link')->unipue();
          $table->string('others_ids')->nullable();
          $table->integer('score')->nullable();
          $table->string('review')->nullable();
          $table->integer('views')->nullable();
          $table->integer('good')->nullable();
          $table->integer('st_id')->nullable();
          $table->integer('hr_id')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
