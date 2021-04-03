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
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->integer('status');
            $table->unsignedInteger('university_id');
            $table->unsignedInteger('faculty_id');
            $table->unsignedInteger('department_id');
            $table->string('plan');

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
        Schema::dropIfExists('videos');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('interviews');
        Schema::dropIfExists('users');
    }
}
