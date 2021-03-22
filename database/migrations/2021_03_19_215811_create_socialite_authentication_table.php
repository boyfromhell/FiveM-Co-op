<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialiteAuthenticationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialite_authentication', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->enum('service', array('discord', 'steam'));
            $table->string('service_id');
            $table->string('service_nickname');
            $table->string('service_name');
            $table->string('service_avatar');
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
        Schema::dropIfExists('socialite_authentication');
    }
}
