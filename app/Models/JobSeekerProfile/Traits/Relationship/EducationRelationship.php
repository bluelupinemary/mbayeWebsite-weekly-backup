<?php

namespace App\Models\JobSeekerProfile\Traits\Relationship;


// use App\Models\Access\User\User;
use App\Models\JobSeekerProfile\JobSeekerProfile;


trait EducationRelationship
{


    public function profile(){
        return $this->belongsTo(JobSeekerProfile::class);
    }
}