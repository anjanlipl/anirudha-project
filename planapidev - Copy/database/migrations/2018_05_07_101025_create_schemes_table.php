<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schemes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->double('budget')->nullable();;
            $table->string('latitude')->nullable();;
            $table->string('longitude')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('code')->unique()->nullable();
            $table->string('account_head')->nullable();
            $table->string('demand_no')->nullable();
            $table->text('remarks')->nullable();
            $table->text('scheme_monitoring_type_ids')->nullable();
            $table->text('tag_ids')->nullable();
            $table->boolean('is_capital')->default(0);
            $table->integer('assigned_to')->nullable();
            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
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
        Schema::dropIfExists('schemes');
    }
}
