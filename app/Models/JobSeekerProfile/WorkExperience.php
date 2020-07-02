<?php

namespace App\Models\JobSeekerProfile;

use App\Models\BaseModel;
use App\Models\JobSeekerProfile\Traits\Attribute\WorkExperienceAttribute;
use App\Models\JobSeekerProfile\Traits\Relationship\WorkExperienceRelationship;
use App\Models\ModelTrait;

class WorkExperience extends BaseModel
{
    use ModelTrait,
        WorkExperienceAttribute,
        WorkExperienceRelationship {
        }

    protected $fillable = [
        'designation',
        'company_name',
        'address',
        'role',
        'contact_no',
        'jobseeker_profile_id',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'work_experiences';
}
