<?php

namespace App\Models\GeneralBlogs\Traits\Relationship;

use App\Models\Like\Like;
use App\Models\Comment\Comment;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Models\BlogVideos\BlogVideo;
use App\Models\BlogPrivacy\BlogPrivacy;

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

    public function privacy()
    {
        return $this->hasMany(BlogPrivacy::class, 'blog_id')->where('blog_type', 'general');
    }
}
