<?php

namespace App\Models\JobSeekerProfile;

use App\Models\BaseModel;
use App\Models\JobSeekerProfile\Traits\Attribute\ProfileAttribute;
use App\Models\JobSeekerProfile\Traits\Relationship\ProfileRelationship;
use App\Models\ModelTrait;

class JobSeekerProfile extends BaseModel
{
    use ModelTrait,
        ProfileAttribute,
        ProfileRelationship {
        }

    protected $fillable = [
        'secondary_email',
        'secondary_mobile_number',
        'featured_image',
        'objective',
        'skills',
        'present_address',
        'present_city',
        'state',
        'present_country',
        'user_id',
        'profession_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_seeker_profiles';

}
