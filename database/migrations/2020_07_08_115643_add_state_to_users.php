<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('state', 100)->after('country')->nullable();
            $table->string('city', 50)->after('state')->nullable();
            $table->dropColumn(['sponser_id']);
            $table->string('sponser_email', 191)->after('sponser_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['state']);
            $table->dropColumn(['city']);
            $table->string('sponser_id', 50)->after('sponser_email')->nullable()->nullable();
            $table->dropColumn(['sponser_email']);
        });
    }
}
