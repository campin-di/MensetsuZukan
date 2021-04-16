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
          $table->string('url')->nullable();
          $table->integer('question_1_id')->nullable();
          $table->integer('question_1_score')->nullable();
          $table->string('question_1_review')->nullable();
          $table->integer('question_2_id')->nullable();
          $table->integer('question_2_score')->nullable();
          $table->string('question_2_review')->nullable();
          $table->integer('question_3_id')->nullable();
          $table->integer('question_3_score')->nullable();
          $table->string('question_3_review')->nullable();
          $table->integer('question_4_id')->nullable();
          $table->integer('question_4_score')->nullable();
          $table->string('question_4_review')->nullable();
          $table->integer('question_5_id')->nullable();
          $table->integer('question_5_score')->nullable();
          $table->string('question_5_review')->nullable();
          $table->integer('question_6_id')->nullable();
          $table->integer('question_6_score')->nullable();
          $table->string('question_6_review')->nullable();
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
