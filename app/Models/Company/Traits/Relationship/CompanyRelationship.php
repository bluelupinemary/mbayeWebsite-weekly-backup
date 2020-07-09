<?php

namespace App\Models\CompanyProfile\Traits\Relationship;


use App\Models\Access\User\User;
use App\Models\CompanyProfile\Industry;

/**
 * Class BlogRelationship.
 */
trait CompanyRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }


    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}
