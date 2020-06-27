<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_references', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('company_name', 191)->nullable();
            $table->string('designation', 191)->nullable();
            $table->bigInteger('user_profile_id')->unsigned()->index('char_ref_user_profile_id_foreign');
            $table->foreign('user_profile_id')->references('id')->on('user_career_profiles')->onDelete('CASCADE');
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
        Schema::dropIfExists('character_references');
    }
}
