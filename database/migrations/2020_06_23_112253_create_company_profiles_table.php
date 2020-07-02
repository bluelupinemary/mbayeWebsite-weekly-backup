<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name', 191)->nullable();
            $table->string('company_email', 191)->unique()->nullable();
            $table->string('company_phone_number', 50)->nullable();
            $table->string('featured_image', 191)->nullable();
            $table->bigInteger('industry_id')->unsigned()->index('industry_company_id_foreign');
            $table->foreign('industry_id')->references('id')->on('industries');
            $table->integer('owner_id')->unsigned()->index('company_owner_id_foreign');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('company_profiles');
    }
}
