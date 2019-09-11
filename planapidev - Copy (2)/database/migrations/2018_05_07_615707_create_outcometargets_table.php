<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutcometargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcometargets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('value');
            $table->text('remark')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
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
        Schema::dropIfExists('outcometargets');
    }
}
