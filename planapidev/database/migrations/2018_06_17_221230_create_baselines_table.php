<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaselinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baselines', function (Blueprint $table) {
            $table->increments('id');
             $table->string('name');
             $table->string('value');
             $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable(); 
             $table->integer('outputindicator_id')->unsigned();
            $table->foreign('outputindicator_id')->references('id')->on('outputindicators')->onDelete('cascade');
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
        Schema::dropIfExists('baselines');
    }
}
