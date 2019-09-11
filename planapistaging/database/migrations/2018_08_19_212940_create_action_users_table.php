<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('action_type');
            $table->integer('actionpoint_id')->unsigned()->nullable();
            $table->integer('outcome_actionpoint_id')->nullable();

           
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
        Schema::dropIfExists('action_users');
    }
}
