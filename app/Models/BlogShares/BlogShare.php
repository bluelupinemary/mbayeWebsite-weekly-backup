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
        return $this->belongsTo(Blog::class, 'blog_id');
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

    public function tags_code()
    {
        $tags = $this->tags->pluck('code');
        return $tags;
    }

    // override the toArray function (called by toJson)
    public function toArray() {
        // get the original array to be displayed
        $data = parent::toArray();

        if($this->publish_datetime) {
            $data['formatted_date'] = \Carbon\Carbon::parse($this->publish_datetime)->format('F d, Y h:i A');
            $data['formatted_time'] = \Carbon\Carbon::parse($this->publish_datetime)->format('F d, Y');
        }

        if($this->blog_type == 'App\Models\Blogs\Blog') {
            if($this->blog) {
                $data['blog'] = $this->blog;
                if($this->blog->featured_image == null) {
                    $data['blog']['thumb'] = 'blog/blog-default-featured-image.png';
                } else {
                    $data['blog']['thumb'] = 'blog/'.$this->blog->featured_image;
                }
                $data['name'] = $this->blog->name;
                $data['blog']['hotcount']      = $this->blog->likes->where('emotion',0)->count();
                $data['blog']['coolcount']     = $this->blog->likes->where('emotion',1)->count();
                $data['blog']['naffcount']     = $this->blog->likes->where('emotion',2)->count();
                $data['blog']['commentcount']  = $this->blog->comments->count();
                $data['blog']['most_reaction'] = $this->blog->mostReaction();
            }
            
        } else if($this->blog_type == 'App\Models\GeneralBlogs\GeneralBlog') {
            if($this->general_blog) {
                $data['blog'] = $this->general_blog;
                if($this->general_blog->featured_image == null) {
                    $data['blog']['thumb'] = 'general_blogs/blog-default-featured-image.png';
                } else {
                    $data['blog']['thumb'] = 'general_blogs/'.$this->general_blog->featured_image;
                }

                $data['name'] = $this->general_blog->name;
                $data['blog']['hotcount']      = $this->general_blog->likes->where('emotion',0)->count();
                $data['blog']['coolcount']     = $this->general_blog->likes->where('emotion',1)->count();
                $data['blog']['naffcount']     = $this->general_blog->likes->where('emotion',2)->count();
                $data['blog']['commentcount']  = $this->general_blog->comments->count();
                $data['blog']['most_reaction'] = $this->general_blog->mostReaction();
            }
        }
        
        if($this->tags) {
            $data['all_tags'] = implode(', ', $this->tags->pluck('name')->toArray());
            $data['tags'] = $this->tags;
            $data['firstTwoTags'] = $this->getFirstTwoTags();
            $data['remainingTagCount'] = $this->remainingTagCount();
        }
        
        $data['owner'] = $this->owner;
        
        return $data;
    }
}
