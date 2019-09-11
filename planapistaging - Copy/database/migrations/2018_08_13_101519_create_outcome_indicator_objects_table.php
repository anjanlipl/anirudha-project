<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutcomeIndicatorObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcome_indicator_objects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('ward')->nullable();
            $table->string('district')->nullable();
            $table->string('vidhanshabha')->nullable();
            $table->text('remark')->nullable();
            $table->integer('outcomeindicator_id')->unsigned();
            $table->foreign('outcomeindicator_id')->references('id')->on('outcomeindicators')->onDelete('cascade');
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
        Schema::dropIfExists('outcome_indicator_objects');
    }
}
