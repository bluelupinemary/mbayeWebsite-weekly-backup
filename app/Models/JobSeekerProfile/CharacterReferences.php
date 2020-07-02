<?php

namespace App\Models\JobSeekerProfile;

use App\Models\BaseModel;
use App\Models\JobSeekerProfile\Traits\Attribute\CharacterReferenceAttribute;
use App\Models\JobSeekerProfile\Traits\Relationship\CharacterReferenceRelationship;
use App\Models\ModelTrait;

class CharacterReferences extends BaseModel
{
    use ModelTrait,
        CharacterReferenceAttribute,
        CharacterReferenceRelationship {
        }

    protected $fillable = [
        'name',
        'email',
        'company_name',
        'designation',
        'jobseeker_profile_id',
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
    protected $table = 'character_references';
}
