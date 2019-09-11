<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actionpoints', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->integer('status_id')->default(0);
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();            
            $table->integer('review_id')->unsigned();
            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
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
        Schema::dropIfExists('actionpoints');
    }
}
