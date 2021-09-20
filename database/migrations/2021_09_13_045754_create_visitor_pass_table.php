<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorPassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_pass', function (Blueprint $table) {
            $table->integer('visitor_pass_id', true);
            $table->integer('visitor_id');
            $table->integer('meeting_id');
            $table->tinyInteger('has_vehicle')->nullable()->default(0)->comment('0=no, 1=yes');
            $table->tinyInteger('visitor_pass_status')->default(1)->comment('1=active, 0=expired');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitor_pass');
    }
}
