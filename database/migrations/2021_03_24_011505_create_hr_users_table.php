<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('hr_users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('name')->nullable();
        $table->string('kana_name')->nullable();
        $table->string('nickname')->nullable();
        $table->tinyInteger('gender')->unsigned()->nullable()->comment('1 : 男性, 2 : 女性');
        $table->string('plan')->nullable();
        $table->string('company')->nullable();
        $table->string('company_type')->nullable();
        $table->string('industry')->nullable();
        $table->string('stock_type')->nullable();
        $table->string('image_path')->default('public/img/icon/hr-unset.png');
        $table->string('location')->default('設定されていません。');
        $table->string('selection_phase')->default('設定されていません。');
        $table->string('workplace')->default('設定されていません。');
        $table->string('summary')->default('設定されていません。');
        $table->string('recruitment')->default('設定されていません。');
        $table->string('site')->default('設定されていません。');
        $table->string('introduction', 1000)->default('設定されていません。');
        $table->string('pr', 1000)->default('設定されていません。');

        $table->integer('status')->comment('0:仮登録, 1:本登録, 2:メール認証済, 10:視聴不可, 11:視聴可, 99:退会済, 100:管理者');
        //$table->string('schedule_ids')->nullable();
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
    public function down()
    {
        Schema::dropIfExists('hr_profiles');
        Schema::dropIfExists('hr_users');
    }
}
