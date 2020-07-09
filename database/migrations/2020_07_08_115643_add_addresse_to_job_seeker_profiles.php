<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddresseToJobSeekerProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_seeker_profiles', function (Blueprint $table) {
            $table->string('present_address', 100)->after('skills')->nullable();
            $table->string('present_city', 50)->after('present_address')->nullable();
            $table->string('present_country', 50)->after('present_city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_profiles', function (Blueprint $table) {
            $table->dropColumn(['present_address']);
            $table->dropColumn(['present_city']);
            $table->dropColumn(['present_country']);
        });
    }
}
