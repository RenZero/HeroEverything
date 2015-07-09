<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserLog', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('userid');
            $table->string('action');
            $table->string('vol');
            $table->string('referer');
            $table->string('ip');
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
        Schema::dropIfExists('UserLog');
    }
}
