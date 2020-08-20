<?php

namespace App\Models\BlogShares;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blogs\Blog;
use App\Models\BlogTags\BlogTag;
use App\Models\GeneralBlogs\GeneralBlog;
use App\Models\Access\User\User;

class BlogShare extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_shares';

    protected $fillable = [
        'blog_id',
        'blog_type',
        'caption',
        'created_by'
    ];

    protected $dates = [
        'publish_datetime',
        'created_at',
        'updated_at'
    ];

    /**
     * Blogs belongsTo with User.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function blog()
    {
        return $this->belongsTo('App\Models\Blogs\Blog', 'blog_id');
    }

    public function general_blog()
    {
        return $this->belongsTo('App\Models\GeneralBlogs\GeneralBlog', 'blog_id');
    }

    /**
     * Blogs has many relationship with tags.
     */
    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'shared_general_blog_map_tags', 'shared_id', 'tag_id');
    }

    public function getFirstTwoTags()
    {
        $tags = $this->tags->take(2);
        return $tags;
    }

    public function remainingTagCount()
    {
        $tag_count = $this->tags->count();
        $remaining_tag_count = $tag_count - 2;

        return $remaining_tag_count;
    }
}
