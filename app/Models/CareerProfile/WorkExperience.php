<?php

namespace App\Models\CareerProfile;

use App\Models\BaseModel;
use App\Models\CareerProfile\Traits\Attribute\WorkExperienceAttribute;
use App\Models\CareerProfile\Traits\Relationship\WorkExperienceRelationship;
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
        'user_profile_id',
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
