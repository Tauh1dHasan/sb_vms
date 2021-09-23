<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->integer('meeting_id', true);
            $table->integer('visitor_id');
            $table->integer('employee_id');
            $table->integer('meeting_purpose_id');
            $table->text('purpose_describe')->nullable();
            $table->dateTime('meeting_datetime');
            $table->string('checkin_time', 100)->nullable();
            $table->string('checkout_time', 100)->nullable();
            $table->integer('entry_user_id')->nullable();
            $table->string('entry_datetime')->nullable();
            $table->integer('modified_user_id')->nullable();
            $table->string('modified_datetime')->nullable();
            $table->integer('meeting_status')->default(0)->comment('0=pending, 1=approved, 2=declined, 3=rescheduled, 11=on going, 12=end meeting');
            $table->tinyInteger('checkin_status')->default(0)->comment('0=checkout, 1=checkin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
