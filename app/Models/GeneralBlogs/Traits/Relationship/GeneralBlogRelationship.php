<?php

namespace App\Models\GeneralBlogs\Traits\Relationship;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Models\GeneralBlogVideos\GeneralBlogVideo;
use App\Models\Like\GeneralLike;
use App\Models\Comment\GeneralComment;
use App\Models\BlogPrivacy\BlogPrivacy;
use Illuminate\Support\Str;

/**
 * Class GeneralBlogRelationship.
 */
trait GeneralBlogRelationship
{
    /**
     * Blogs belongsTo with User.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Blogs hasMany Videos.
     */
    public function videos()
    {
        return $this->hasMany(GeneralBlogVideo::class, 'blog_id');
    }

    // public function likes(){
    //   return $this->belongsTo('App\Like');
    // }

    public function comments()
    {
        return $this->hasMany(GeneralComment::class, 'blog_id');
    }

    public function likes() {
        return $this->hasMany(GeneralLike::class, 'blog_id');
    }

    public function naffLikes() {
        return $this->hasMany(GeneralLike::class, 'blog_id')->where('emotion', 2);
    }

    public function privacy()
    {
        return $this->hasMany(BlogPrivacy::class, 'blog_id')->where('blog_type', 'general');
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
        }

        if($this->featured_image == null) {
            $data['featured_image'] = 'blog-default-featured-image.png';
        }
        
        
        $data['tags'] = [];
        

        $data['owner'] = $this->owner;

        return $data;
    }
}
