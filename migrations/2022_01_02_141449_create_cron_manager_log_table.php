<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronManagerLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cron_manager_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_event')->unsigned();
            $table->longText('message');
            $table->foreign('id_event')->references('id')->on('cron_manager_event');
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
        Schema::dropIfExists('cron_manager_log');
    }
}
