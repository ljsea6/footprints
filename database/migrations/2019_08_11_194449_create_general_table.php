<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('local')->create('general', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('document')->unsigned();
            $table->string('application');
            $table->string('action');
            $table->timestamp('event_date');
            $table->string('metadata', 2000);
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
        Schema::connection('local')->dropIfExists('general');
    }
}
