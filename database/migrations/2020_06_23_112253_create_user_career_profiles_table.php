<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCareerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_career_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('secondary_email', 191)->unique()->nullable();
            $table->string('secondary_mobile_number', 50)->nullable();
            $table->string('featured_image', 191)->nullable();
            $table->text('objective', 65535)->nullable();
            $table->text('skills', 65535)->nullable();
            $table->integer('user_id')->unsigned()->index('profile_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('user_career_profiles');
    }
}
