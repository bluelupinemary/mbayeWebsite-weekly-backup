<?php

namespace App\Models\CareerProfile\Traits\Relationship;


use App\Models\Access\User\User;
use App\Models\CareerProfile\CareerProfile;


/**
 * Class BlogRelationship.
 */
trait WorkExperienceRelationship
{
    /**
     * Blogs belongsTo with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function profile(){
        return $this->belongsTo(CareerProfile::class);
    }
}
