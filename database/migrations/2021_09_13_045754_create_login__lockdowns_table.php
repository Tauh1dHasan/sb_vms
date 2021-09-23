<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginLockdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login _lockdowns', function (Blueprint $table) {
            $table->integer('login_lockdown_id', true);
            $table->integer('user_id');
            $table->integer('user_login_id');
            $table->integer('locked_ip');
            $table->string('lockdown_datetime', 100);
            $table->string('release_datetime', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login _lockdowns');
    }
}
