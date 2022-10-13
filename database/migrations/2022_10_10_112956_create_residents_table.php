<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('nickname');
            $table->string('dob');
            $table->string('place_of_birth');
            $table->string('sex');
            $table->string('nationality');
            $table->string('civil_status');
            $table->string('pwd');
            $table->string('pwd_description')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('resident_image');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('residents');
    }
};
