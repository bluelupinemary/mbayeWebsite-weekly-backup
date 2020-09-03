<?php

namespace App\Models\CompanyProfile;

use App\Models\BaseModel;
use App\Models\Company\Traits\Attribute\IndustryAttribute;
use App\Models\Company\Traits\Relationship\IndustryRelationship;
use App\Models\ModelTrait;

class Industry extends BaseModel
{
    use ModelTrait,
        IndustryAttribute,
        IndustryRelationship {
        
        }

    protected $fillable = [
        'id',
        'industry_name',
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
    protected $table = 'industries';
}
