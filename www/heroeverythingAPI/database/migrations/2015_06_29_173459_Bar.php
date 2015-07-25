<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Bar', function(Blueprint $table)
        {
            $table->increments('barid');
            $table->integer('userid');
            $table->string('unit');
            $table->double('exrate');
            $table->string('type');
            $table->string('name');
            $table->string('title');
            $table->integer('vol_max');
            $table->integer('vol_current');
            $table->integer('cashflow');
            $table->string('read_privacy')->default('public');
            $table->string('write_privacy')->default('public');
            $table->string('cron')->nullable();
            $table->string('alertdefine')->nullable();
            $table->string('eventqueue')->nullable();
            $table->timestamp('lastupdate');
            $table->softDeletes();
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
        Schema::dropIfExists('Bar');
    }
}
