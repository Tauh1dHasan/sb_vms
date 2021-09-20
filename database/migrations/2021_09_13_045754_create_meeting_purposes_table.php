<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingPurposesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_purposes', function (Blueprint $table) {
            $table->integer('purpose_id', true);
            $table->string('purpose_name');
            $table->text('purpose_description')->nullable();
            $table->integer('entry_user_id')->nullable();
            $table->string('entry_datetime')->nullable();
            $table->integer('modified_user_id')->nullable();
            $table->string('modified_datetime')->nullable();
            $table->tinyInteger('purpose_status')->default(1)->comment('0=deactivated, 1=active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_purposes');
    }
}
