<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->integer('visitor_id', true);
            $table->integer('visitor_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug');
            $table->integer('gender')->nullable();
            $table->string('date_of_birth', 100)->nullable();
            $table->integer('mobile_no');
            $table->string('email')->nullable();
            $table->text('address');
            $table->string('profile_photo')->nullable();
            $table->integer('nid_no')->nullable();
            $table->integer('passport_no')->nullable();
            $table->integer('driving_license_no')->nullable();
            $table->integer('entry_user_id')->nullable();
            $table->string('entry_date_time', 100)->nullable();
            $table->integer('modified_user_id')->nullable();
            $table->string('modified_date_time', 100)->nullable();
            $table->integer('visitor_status')->default(1)->comment('0=deactivated, 1=active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
