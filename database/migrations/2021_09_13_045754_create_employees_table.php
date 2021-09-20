<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('employee_id', true);
            $table->integer('user_type_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug');
            $table->integer('gender');
            $table->string('date_of_birth', 100);
            $table->integer('eid_no');
            $table->string('department', 100);
            $table->string('designation', 100);
            $table->string('mobile_no', 100);
            $table->string('email');
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->string('working_hour', 100);
            $table->integer('entry_user_id')->nullable();
            $table->string('entry_datetime')->nullable();
            $table->integer('modified_user_id')->nullable();
            $table->string('modified_datetime')->nullable();
            $table->integer('availability')->default(1)->comment('1=available, 0=absent ');
            $table->integer('is_approved')->default(1)->comment('1=approved, 0=declined');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
