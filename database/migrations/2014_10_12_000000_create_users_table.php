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
            $table->string('name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verify_token')->nullable();
            $table->integer('graduate_year')->nullable();            
            $table->string('password');
            $table->integer('status');
            $table->unsignedInteger('university_id')->default(0);
            $table->unsignedInteger('faculty_id')->default(0);
            $table->unsignedInteger('department_id')->default(0);
            $table->string('plan')->default('unselected');

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
