<?php

namespace App\Models\JobSeekerProfile\Traits\Relationship;


// use App\Models\Access\User\User;
use App\Models\JobSeekerProfile\JobSeekerProfile;

trait ProfessionRelationship
{

    public function profile(){
        return $this->hasMany(JobSeekerProfile::class,'profession_id');
    }
}
