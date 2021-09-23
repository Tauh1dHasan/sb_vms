<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_types', function (Blueprint $table) {
            $table->integer('visitor_type_id', true);
            $table->integer('visitor_type');
            $table->integer('visitor_type_status')->default(1)->comment('1=active, 0=deactivate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitor_types');
    }
}
