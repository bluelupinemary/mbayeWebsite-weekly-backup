<?php

namespace App\Http\Resources;

use App\Models\Like\Like;
use Illuminate\Http\Resources\Json\Resource;

class JobSeekerProfileResource extends Resource
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
            'secondary_email'           => $this->secondary_email,
            'secondary_mobile_number'   => $this->secondary_mobile_number,
            'featured_image'            => $this->featured_image,
            'objective'                 => $this->objective,
            'skills'                    => $this->skills,
            'user_id'                   => $this->user_id ,
            'created_at'                => optional($this->created_at)->toDateString(),
            'updated_at'                => optional($this->created_at)->toDateString(),
            'thumb'                     => ($this->featured_image=='') ? '/storage/img/JobSeekerProfile/default.png' : '/storage/img/JobSeekerProfile/'.$this->featured_image,
            'first_name'                => $this->user_name,
            'last_name'                 => $this->last_name,
            'profession_name'                => $this->profession,
            'address'                   => $this->address,

        ];
    }
}
