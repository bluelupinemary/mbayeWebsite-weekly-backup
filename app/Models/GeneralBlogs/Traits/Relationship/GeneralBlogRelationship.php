<?php

namespace App\Models\GeneralBlogs\Traits\Relationship;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Models\GeneralBlogVideos\GeneralBlogVideo;
use App\Models\Like\GeneralLike;
use App\Models\Comment\GeneralComment;
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
}
