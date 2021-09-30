<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('st_id')->unsigned();
            $table->integer('hr_id')->unsigned();
            $table->string('remarks')->nullable();
            $table->string('schedule_candidate')->nullable();
            $table->integer('status')->comment('0:未読, 1:承諾');
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
        Schema::dropIfExists('interview_requests');
    }
}
