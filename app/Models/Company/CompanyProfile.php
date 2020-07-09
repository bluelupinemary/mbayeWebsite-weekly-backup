<?php

namespace App\Models\CompanyProfile;

use App\Models\BaseModel;
use App\Models\CompanyProfile\Traits\Attribute\CompanyAttribute;
use App\Models\CompanyProfile\Traits\Relationship\CompanyRelationship;
use App\Models\ModelTrait;

class CompanyProfile extends BaseModel
{
    use ModelTrait,
        CompanyAttribute,
        CompanyRelationship {
        }

    protected $fillable = [
        'id',
        'company_name',
        'company_email',
        'address',
        'country',
        'company_phone_number',
        'featured_image',
        'industry_id',
        'owner_id',
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
    protected $table = 'company_profiles';

}
