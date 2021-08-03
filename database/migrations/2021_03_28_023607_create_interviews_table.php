<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TODO:Modelでの親子記述を行う

        Schema::create('interviews', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('st_id')->unsigned();
          $table->integer('hr_id')->unsigned();
          $table->string('date')->nullable();
          $table->string('time')->nullable();
          $table->string('password')->default('p@ssw0rd');
          $table->string('available')->nullable(); //0:質問リスト作成前、1:質問リスト作成後、2:面接終了後
          $table->string('zoomUrl')->nullable();
          $table->string('zoomId')->nullable();
          $table->string('zoomPass')->nullable();
          $table->integer('question_1_id')->nullable();
          $table->integer('question_2_id')->nullable();
          $table->integer('question_3_id')->nullable();
          $table->integer('score_1')->nullable();
          $table->integer('score_2')->nullable();
          $table->integer('score_3')->nullable();
          $table->integer('score_4')->nullable();
          $table->integer('score_5')->nullable();
          $table->integer('score_6')->nullable();
          $table->integer('score_7')->nullable();
          $table->integer('score_8')->nullable();
          $table->integer('score_9')->nullable();
          $table->integer('score_10')->nullable();
          $table->string('review_good', 1000)->nullable();
          $table->string('review_more', 1000)->nullable();
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
        Schema::dropIfExists('interviews');
    }
}
