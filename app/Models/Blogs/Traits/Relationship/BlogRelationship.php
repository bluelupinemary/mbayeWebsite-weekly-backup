<?php

namespace App\Models\Blogs\Traits\Relationship;

use App\Models\Like\Like;
use App\Models\Comment\Comment;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Models\BlogVideos\BlogVideo;
use App\Models\BlogDesignPanels\BlogDesignPanel;
use App\Models\BlogPrivacy\BlogPrivacy;
use App\Models\BlogShares\BlogShare;
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

    public function share(){
        return $this->hasMany(BlogShare::class, 'blog_id')->where('blog_type', 'App\Models\Blogs\Blog');
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
            $data['featured_image'] = 'blog-default-featured-image.png';
        }

        if($this->featured_image == null) {
            $data['thumb'] = 'blog/blog-default-featured-image.png';
        } else {
            $data['thumb'] = 'blog/'.$this->featured_image;
        }

        if($this->tags) {
            $data['all_tags'] = implode(', ', $this->tags->pluck('name')->toArray());
            $data['tags'] = $this->tags;
            $data['firstTwoTags'] = $this->getFirstTwoTags();
            $data['remainingTagCount'] = $this->remainingTagCount();
        }

        $data['owner'] = $this->owner;

        $data['hotcount']      = $this->likes->where('emotion',0)->count();
        $data['coolcount']     = $this->likes->where('emotion',1)->count();
        $data['naffcount']     = $this->likes->where('emotion',2)->count();
        $data['commentcount']  = $this->comments->count();
        $data['sharecount']  = $this->share->count();
        $data['most_reaction'] = $this->mostReaction();
        if($this->isDesignsBlog()) {
            $data['editurl'] = url('/communicator?action=edit_design_blog&blog_id='.$this->id.'&section=designs_blog');
        } else if ($this->isCareerBlog()) {
            $data['editurl'] = url('/communicator?action=edit_career_blog&blog_id='.$this->id.'&section=career_blog');
        } else {
            $data['editurl'] = url('/communicator?action=edit_blog&blog_id='.$this->id.'&section=blog');
        }

        return $data;
    }
}
