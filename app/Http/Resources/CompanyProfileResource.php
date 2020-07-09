<?php

namespace App\Http\Resources;

use App\Models\Like\Like;
use Illuminate\Http\Resources\Json\Resource;

class CompanyProfileResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {  
        return [
            'id'                        => $this->id,
            'company_name'              => $this->company_name,
            'company_email '            => $this->company_email,
            'featured_image'            => $this->featured_image,
            'company_phone_number'      => $this->company_phone_number,
            'industry_id'               => $this->industry_id,
            'user_id'                   => $this->user_id ,
            'owner_id'                  => $this->owner_id ,
            'created_at'                => optional($this->created_at)->toDateString(),
            'updated_at'                => optional($this->created_at)->toDateString(),
            'thumb'                     => ($this->featured_image=='') ? '/storage/img/ComapnyProfile/default.png' : '/storage/img/JobSeekerProfile/'.$this->featured_image,
            

        ];
    }
}
