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
          $table->string('title', 512);
          $table->string('thumbnail_name')->default('none');
          $table->string('thumbnail_path')->default('none');
          $table->string('vimeo_src')->unipue();
          $table->string('vimeo_id')->unipue();
          $table->integer('question_id');
          $table->integer('st_id')->unsigned();
          $table->integer('hr_id')->unsigned();
          $table->integer('score');
          $table->string('review');
          $table->integer('views');
          $table->integer('good');
          $table->boolean('type')->comment('0:学生, 1:人事');
          $table->timestamps();

          $table->foreign('st_id')->references('id')->on('users')->onDelete('no action');
          $table->foreign('hr_id')->references('id')->on('hr_users')->onDelete('no action');
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
