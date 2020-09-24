<?php

namespace App\Models\JobSeekerProfile;

use App\Models\BaseModel;
use App\Models\JobSeekerProfile\Traits\Attribute\ProfessionAttribute;
use App\Models\JobSeekerProfile\Traits\Relationship\ProfessionRelationship;
use App\Models\ModelTrait;
use App\Models\Access\User\User;

class Profession extends BaseModel
{
    use ModelTrait,
        ProfessionAttribute,
        ProfessionRelationship {
        
        }

    protected $fillable = [
        'id',
        'profession_name',
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
    protected $table = 'professions';
}
