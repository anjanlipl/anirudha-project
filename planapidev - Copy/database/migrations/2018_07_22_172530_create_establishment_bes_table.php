<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstablishmentBesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishment_bes', function (Blueprint $table) {
            $table->increments('id');
            $table->double('sal');
            $table->double('benefits');
            $table->double('wages');
            $table->double('machinery');
            $table->double('office_exp');
             $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('establishment_id')->unsigned();
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');
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
        Schema::dropIfExists('establishment_bes');
    }
}
