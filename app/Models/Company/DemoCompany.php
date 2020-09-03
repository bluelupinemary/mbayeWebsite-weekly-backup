<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class DemoCompany extends Model
{
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
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $table = 'company_profiles';
}
