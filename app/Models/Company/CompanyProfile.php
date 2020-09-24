<?php

namespace App\Models\Company;

use App\Models\BaseModel;
use App\Models\Company\Traits\Attribute\CompanyAttribute;
use App\Models\Company\Traits\Relationship\CompanyRelationship;
use App\Models\ModelTrait;
use App\Models\Access\User\User;



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
        'company_phone_number',
        'featured_image',
        'industry_id',
        'owner_id',
        'address',
        'country',
        'state',
        'city',
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
