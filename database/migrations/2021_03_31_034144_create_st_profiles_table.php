<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('st_id')->unsigned();
            $table->string('company_type');
            $table->integer('industry_id')->unsigned();
            $table->string('jobtype');
            $table->string('workplace')->default("設定されていません。");
            $table->string('start_time')->default("設定されていません。");
            $table->string('introduction', 1000)->default('設定されていません。');
            $table->string('strengths', 1000)->default('設定されていません。');
            $table->string('gakuchika', 1000)->default('設定されていません。');
            $table->string('personality', 1000)->default('設定されていません。');
            $table->integer('toeic')->unsigned()->default(0);
            $table->integer('english')->unsigned()->default(0);
            $table->string('other_language')->default('設定されていません。');
            $table->string('qualification')->default('設定されていません。');
            $table->timestamps();

            //$table->foreign('st_id')->references('id')->on('users')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('st_profiles');
    }
}
