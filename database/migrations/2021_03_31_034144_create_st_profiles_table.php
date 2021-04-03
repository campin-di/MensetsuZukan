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
            $table->string('pr', 1000)->nullable();
            $table->string('gakuchika', 1000)->nullable();
            $table->string('frustration', 1000)->nullable();
            $table->timestamps();

            $table->foreign('st_id')->references('id')->on('users')->onDelete('no action');
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
