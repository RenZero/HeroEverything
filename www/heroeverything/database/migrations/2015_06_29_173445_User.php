<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('User', function(Blueprint $table)
        {
            $table->increments('userid');
            $table->string('email')->unique();
            $table->string('nickname');
            $table->string('passwd');
            $table->string('desc');
            $table->string('orgname');
            $table->string('bar_list')->nullable();
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
        Schema::dropIfExists('User');
    }
}
