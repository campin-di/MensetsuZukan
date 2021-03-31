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
            $table->id();
            $table->integer('st_id')->unsigned();
            $table->string('pr')->nullable();
            $table->string('gakuchika')->nullable();
            $table->string('frustration')->nullable();
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
        Schema::dropIfExists('st_profiles');
    }
}
