<?php

namespace App\Models\CareerProfile\Traits\Relationship;


use App\Models\Access\User\User;
use App\Models\CareerProfile\CharacterReferences;
use App\Models\CareerProfile\Education;
use App\Models\CareerProfile\WorkExperience;

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
        return $this->hasMany(Education::class, 'user_profile_id');
    }

    public function charref(){
      return $this->hasMany(CharacterReferences::class, 'user_profile_id');
    }

    public function workexp()
    {
        return $this->hasMany(WorkExperience::class, 'user_profile_id');
    }
}
