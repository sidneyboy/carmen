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
        Schema::table('Residents', function (Blueprint $table) {
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Residents', function (Blueprint $table) {
            $table->dropColumn('father')->nullable();
            $table->dropColumn('mother')->nullable();
        });
    }
};
