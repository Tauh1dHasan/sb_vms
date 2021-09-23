<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginActivitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_activitys', function (Blueprint $table) {
            $table->integer('activity_id', true);
            $table->integer('user_id');
            $table->string('login_datetime', 100);
            $table->string('logout_datetime', 100);
            $table->string('login_ip', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_activitys');
    }
}
