<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectionStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selection_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('hr_id')->unsigned();
            $table->integer('st_id')->unsigned();
            $table->integer('status')->unsigned()->comment('0:オファー検討, 1:オファー返信待ち, 2:1次選考, 3:2次選考, 4:最終選考, 5:内定, 6:選考辞退or見送り');
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
        Schema::dropIfExists('selection_statuses');
    }
}
