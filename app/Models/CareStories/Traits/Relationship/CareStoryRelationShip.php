<?php

namespace App\Models\CareStories\Traits\Relationship;

use App\Models\CareStoryVideos\CareStoryVideo;
use App\Models\CareStoryImages\CareStoryImage;
use App\Models\Access\User\User;
use Illuminate\Support\Str;

trait CareStoryRelationShip
{
    /**
     * CareStory hasMany Videos.
     */
    public function videos()
    {
        return $this->hasMany(CareStoryVideo::class, 'care_story_id');
    }

    /**
     * CareStory hasMany Images.
     */
    public function images()
    {
        return $this->hasMany(CareStoryImage::class, 'care_story_id');
    }

    /**
     * CareStory belongsTo with User.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // override the toArray function (called by toJson)
    public function toArray() {
        // get the original array to be displayed
        $data = parent::toArray();

        // change the value of the 'mime' key
        if ($this->content) {
            $data['summary'] = Str::limit(strip_tags(preg_replace('#(<figure[^>]*>).*?(</figure>)#', '$1$2', $this->content)), 100, '...');
        } else {
            $data['summary'] = null;
        }

        if($this->publish_datetime) {
            $data['formatted_date'] = \Carbon\Carbon::parse($this->publish_datetime)->format('F d, Y h:i A');
            $data['formatted_time'] = \Carbon\Carbon::parse($this->publish_datetime)->format('F d, Y');
        }

        if($this->featured_image == null) {
            $data['thumb'] = 'story_of_care/blog-default-featured-image.png';
        } else {
            $data['thumb'] = 'story_of_care/'.$this->featured_image;
        }

        $data['owner'] = $this->owner;

        return $data;
    }
}
