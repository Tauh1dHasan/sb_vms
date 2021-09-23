<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('title');
            $table->string('meta_title', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('logo');
            $table->string('primary_mbl', 100);
            $table->string('alt_mbl', 100)->nullable();
            $table->string('primary_email');
            $table->string('alt_email')->nullable();
            $table->text('office_address');
            $table->text('factory_address')->nullable();
            $table->string('fb_link', 100)->nullable();
            $table->string('linkedin_link', 100)->nullable();
            $table->string('twitter_link', 100)->nullable();
            $table->string('youtube_link', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
