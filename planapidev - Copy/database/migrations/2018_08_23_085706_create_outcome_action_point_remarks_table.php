<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutcomeActionPointRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcome_action_point_remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('user_id');
            $table->integer('outcome_actionpoints_id');
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
        Schema::dropIfExists('outcome_action_point_remarks');
    }
}
