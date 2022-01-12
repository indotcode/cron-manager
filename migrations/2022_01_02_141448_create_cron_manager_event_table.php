<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronManagerEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cron_manager_event', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('methods');
            $table->boolean('active')->default(false);
            $table->string('periodicity');
            $table->longText('periodicity_value')->nullable();
            $table->string('restrictions_days')->nullable();
            $table->string('timezone', 250)->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('cron_manager_event');
    }
}
