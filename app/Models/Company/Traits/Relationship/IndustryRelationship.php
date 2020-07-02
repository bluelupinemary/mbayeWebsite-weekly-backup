<?php

namespace App\Models\CompanyProfile\Traits\Relationship;

use App\Models\CompanyProfile\CompanyProfile;

trait IndustryRelationship
{

    public function company(){
        return $this->hasMany(CompanyProfile::class);
    }
}
