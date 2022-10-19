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
            $table->string('occupation')->nullable();
            $table->string('sub_zone')->nullable();
            $table->string('senior_citizen')->nullable();
            $table->string('relationship_to_household_head')->nullable();
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
            $table->dropColumn('occupation')->nullable();
            $table->dropColumn('sub_zone')->nullable();
            $table->dropColumn('senior_citizen')->nullable();
            $table->dropColumn('relationship_to_household_head')->nullable();
        });
    }
};
