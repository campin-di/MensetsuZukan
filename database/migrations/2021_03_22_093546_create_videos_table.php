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
          $table->increments('id');
          $table->string('title')->nullable();
          $table->string('url')->unipue();
          $table->string('common_url')->nullable();
          $table->string('question')->nullable();
          $table->integer('st_id')->unsigned();
          $table->integer('hr_id')->unsigned();
          $table->integer('score')->nullable();
          $table->string('review')->nullable();
          $table->integer('views')->nullable();
          $table->integer('good')->nullable();
          $table->timestamps();

          $table->foreign('st_id')->references('id')->on('users')->onDelete('no action');
          //$table->foreign('hr_id')->references('id')->on('hr_users')->onDelete('no action');
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
