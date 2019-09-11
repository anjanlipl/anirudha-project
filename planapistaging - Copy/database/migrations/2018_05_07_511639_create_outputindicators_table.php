<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutputindicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outputindicators', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('status')->default(1); 
            $table->integer('respond_to_criteria')->default(1); 
            $table->integer('unit_id')->nullable(); 
            $table->boolean('is_critical')->default(0); 
            $table->text('remark')->nullable();
            $table->integer('output_id')->unsigned();
            $table->foreign('output_id')->references('id')->on('outputs')->onDelete('cascade');
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
        Schema::dropIfExists('outputindicators');
    }
}
