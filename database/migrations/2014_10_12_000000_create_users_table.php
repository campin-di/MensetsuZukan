<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nickname')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('kana_name')->nullable();
            $table->tinyInteger('gender')->unsigned()->nullable()->comment('1 : 男性, 2 : 女性');
            $table->string('plan')->nullable();
            $table->integer('graduate_year')->nullable();
            $table->tinyInteger('major')->unsigned()->nullable()->comment('1 : 文系, 2 : 理系');
            $table->unsignedInteger('university_id')->default(0);
            $table->unsignedInteger('faculty_id')->default(0);
            $table->unsignedInteger('department_id')->default(0);
            $table->integer('status')->comment('0:仮登録, 1:本登録, 2:メール認証済, 10:視聴不可, 11:視聴可, 99:退会済, 100:管理者');

            //stProfile分
            $table->string('company_type')->nullable();
            $table->integer('industry_id')->unsigned()->nullable();;
            $table->string('jobtype')->nullable();
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

            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verify_token')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('videos');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('interviews');
        Schema::dropIfExists('users');

    }
}
