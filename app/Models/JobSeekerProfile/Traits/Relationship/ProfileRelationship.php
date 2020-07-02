<?php

namespace App\Models\JobSeekerProfile\Traits\Relationship;


use App\Models\Access\User\User;
use App\Models\JobSeekerProfile\Education;
use App\Models\JobSeekerProfile\Profession;
use App\Models\JobSeekerProfile\WorkExperience;
use App\Models\JobSeekerProfile\CharacterReferences;

/**
 * Class BlogRelationship.
 */
trait ProfileRelationship
{
    /**
     * Blogs belongsTo with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * profile hasMany Educations.
     */
    public function education()
    {
        return $this->hasMany(Education::class, 'jobseeker_profile_id');
    }

    public function charref(){
      return $this->hasMany(CharacterReferences::class, 'jobseeker_profile_id');
    }

    public function workexp()
    {
        return $this->hasMany(WorkExperience::class, 'jobseeker_profile_id');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'jobseeker_profile_id');
    }
}
