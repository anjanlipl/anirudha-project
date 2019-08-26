<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaisedRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raised_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('edit_scheme')->default(0);
            $table->boolean('delete_scheme')->default(0);
            $table->boolean('access_scheme')->default(0);
            $table->boolean('is_active')->default(1);
            $table->integer('scheme_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('raised_requests');
    }
}
