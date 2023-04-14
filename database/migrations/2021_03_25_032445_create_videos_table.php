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
          $table->string('thumbnail_name')->default('none');
          $table->string('thumbnail_path')->default('none');
          $table->string('vimeo_src')->unipue();
          $table->string('vimeo_id')->unipue();
          $table->integer('st_id')->unsigned();
          $table->integer('hr_id')->unsigned();
          $table->integer('interview_id')->unsigned();
          $table->integer('question_1_id');
          $table->integer('question_2_id');
          $table->integer('question_3_id');
          $table->double('basic_score', 5, 3);
          $table->double('expression_score', 5, 3);
          $table->double('logical_score', 5, 3);
          $table->double('vitality_score', 5, 3);
          $table->double('creative_score', 5, 3);
          $table->string('review_good',1000);
          $table->string('review_more',1000);
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
