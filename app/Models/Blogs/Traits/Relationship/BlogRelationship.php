<?php

namespace App\Models\Blogs\Traits\Relationship;

use App\Models\Like\Like;
use App\Models\Comment\Comment;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Models\BlogVideos\BlogVideo;
use App\Models\BlogDesignPanels\BlogDesignPanel;
use App\Models\BlogPrivacy\BlogPrivacy;
use Illuminate\Support\Str;

/**
 * Class BlogRelationship.
 */
trait BlogRelationship
{

    /**
     * Blogs has many relationship with tags.
     */
    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_map_tags', 'blog_id', 'tag_id');
    }

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
        return $this->hasMany(BlogVideo::class, 'blog_id');
    }

    // public function likes(){
    //   return $this->belongsTo('App\Like');
    // }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes() {
        return $this->hasMany(Like::class, 'blog_id');
    }

    public function blog_panel_design()
    {
        return $this->hasOne(BlogDesignPanel::class, 'blog_id');
    }

    public function privacy()
    {
        return $this->hasMany(BlogPrivacy::class, 'blog_id')->where('blog_type', 'regular');
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
        
        if($this->tags) {
            $data['all_tags'] = implode(', ', $this->tags->pluck('name')->toArray());
        }

        return $data;
    }
}
