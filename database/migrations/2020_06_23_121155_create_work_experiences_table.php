<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('designation', 191)->nullable();
            $table->string('company_name', 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('role', 191)->nullable();
            $table->string('contact_no', 191)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->bigInteger('jobseeker_profile_id')->unsigned()->index('education_jobseeker_profile_id_foreign');
            $table->foreign('jobseeker_profile_id')->references('id')->on('job_seeker_profiles')->onDelete('CASCADE');
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
        Schema::dropIfExists('work_experiences');
    }
}
