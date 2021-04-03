<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('hr_profiles', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('hr_id')->unsigned();
          $table->string('introduction', 1000)->nullable();
          $table->string('pr', 1000)->nullable();
          $table->timestamps();

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
        Schema::dropIfExists('hr_profiles');
    }
}
