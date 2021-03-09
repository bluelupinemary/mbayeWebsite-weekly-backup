<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobseekersCvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobseekers_cv', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('jobseeker_profile_id')->unsigned()->index('jobseeker_profile_cv_id_foreign');
            $table->foreign('jobseeker_profile_id')->references('id')->on('job_seeker_profiles');
            $table->string('filename', 191)->nullable();
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
        Schema::dropIfExists('jobseekers_cv');
    }
}
