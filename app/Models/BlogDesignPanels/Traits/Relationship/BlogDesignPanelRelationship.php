<?php

namespace App\Models\BlogDesignPanels\Traits\Relationship;

use App\Models\Like\Like;
use App\Models\Comment\Comment;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Models\BlogVideos\BlogVideo;
use App\Models\Blogs\Blog;
use App\Models\Game\UserPanelFlowers;

/**
 * Class GeneralBlogRelationship.
 */
trait BlogDesignPanelRelationship
{

    /**
     * Blogs has many relationship with tags.
     */
   /* public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_map_tags', 'blog_id', 'tag_id');
    }*/

    /**
     * Blogs belongsTo with User.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function panel()
    {
        return $this->belongsTo(UserPanelFlowers::class, 'panel_id');
    }
}
