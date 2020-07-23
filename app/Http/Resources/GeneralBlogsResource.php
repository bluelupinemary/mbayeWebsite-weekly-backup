<?php

namespace App\Http\Resources;

use App\Models\BlogTags\BlogTag;
use App\Models\Like\GeneralLike;
use App\Models\BlogMapTags\BlogMapTag;
use App\Models\Comment\GeneralComment;
use Illuminate\Http\Resources\Json\Resource;

class GeneralBlogsResource extends Resource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'featured_image'    => $this->featured_image,
            'publish_datetime'  => is_null($this->publish_datetime)?$this->publish_datetime:$this->publish_datetime->format('d/m/Y h:i A'),
            'status'            => $this->status,
            'created_at'        => optional($this->created_at)->toDateString(),
            'created_by'        => (is_null($this->user_name)) ? optional($this->owner)->first_name : $this->user_name,
            'thumb'             => ($this->featured_image=='') ? '/storage/img/general_blogs/default.png' : '/storage/img/general_blogs/'.$this->featured_image,            'hotcount'          => GeneralLike::where('blog_id',$this->id)->where('emotion',0)->count(),
            'coolcount'          => GeneralLike::where('blog_id',$this->id)->where('emotion',1)->count(),
            'naffcount'          => GeneralLike::where('blog_id',$this->id)->where('emotion',2)->count(),
            'commentcount'       => GeneralComment::where('blog_id',$this->id)->count(),

          //  'blog_tag'           => $this->btags(),
        ];
    }
}
