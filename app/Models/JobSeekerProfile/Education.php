<?php

namespace App\Models\JobSeekerProfile;

use App\Models\BaseModel;
use App\Models\JobSeekerProfile\Traits\Attribute\EducationAttribute;
use App\Models\JobSeekerProfile\Traits\Relationship\EducationRelationship;
use App\Models\ModelTrait;

class Education extends BaseModel
{
    use ModelTrait,
        EducationAttribute,
        EducationRelationship {
        
        }

    protected $fillable = [
        'school_name',
        'field_of_study',
        'description',
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
    protected $table = 'educations';
}
