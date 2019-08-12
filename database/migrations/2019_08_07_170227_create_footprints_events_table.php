<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFootprintsEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('local')->create('footprints_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('footprints_user_id')->unsigned();
            $table->bigInteger('footprints_device_id')->unsigned();
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
        Schema::connection('local')->dropIfExists('footprints_events');
    }
}
