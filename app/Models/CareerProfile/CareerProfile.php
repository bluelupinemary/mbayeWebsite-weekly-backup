<?php

namespace App\Models\CareerProfile;

use App\Models\BaseModel;
use App\Models\CareerProfile\Traits\Attribute\ProfileAttribute;
use App\Models\CareerProfile\Traits\Relationship\ProfileRelationship;
use App\Models\ModelTrait;

class CareerProfile extends BaseModel
{
    use ModelTrait,
        ProfileAttribute,
        ProfileRelationship {
            // BlogAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    protected $fillable = [
        'secondary_email',
        'secondary_mobile_number',
        'featured_image',
        'objective',
        'skills',
        'user_id',
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
    protected $table = 'user_career_profiles';

}
