<?php

namespace App\Models\GeneralBlogShares;

use Illuminate\Database\Eloquent\Model;
use App\Models\GeneralBlogs\GeneralBlog;
use Carbon\Carbon;
use App\Models\Access\User\User;

class GeneralBlogShare extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'general_blog_shares';

    protected $fillable = [
        'general_blog_id',
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
        return $this->belongsTo(GeneralBlog::class, 'general_blog_id');
    }

    public function isNearlyExpired()
    {
        // dd(Carbon::now()->subDay());
        $_24hrs_ago = strtotime( Carbon::now()->subDay() );
        $blog_publish_date = strtotime( $this->publish_datetime );
        $diff = $blog_publish_date - $_24hrs_ago;
        $hours = $diff / ( 60 * 60 );
        // dd($this->publish_datetime, Carbon::now()->subDay(), $hours);
        if($hours <= 1) {
            return true;
        }
    }

    // override the toArray function (called by toJson)
    public function toArray() {
        // get the original array to be displayed
        $data = parent::toArray();

        if($this->publish_datetime) {
            $data['formatted_date'] = \Carbon\Carbon::parse($this->publish_datetime)->format('F d, Y h:i A');
            $data['formatted_time'] = \Carbon\Carbon::parse($this->publish_datetime)->format('F d, Y');
        }

        $data['blog'] = $this->blog;
        if($this->blog->featured_image == null) {
            $data['blog']['thumb'] = 'general_blogs/blog-default-featured-image.png';
        } else {
            $data['blog']['thumb'] = 'general_blogs/'.$this->blog->featured_image;
        }

        $data['name'] = $this->blog->name;
        $data['blog']['hotcount']      = $this->blog->likes->where('emotion',0)->count();
        $data['blog']['coolcount']     = $this->blog->likes->where('emotion',1)->count();
        $data['blog']['naffcount']     = $this->blog->likes->where('emotion',2)->count();
        $data['blog']['commentcount']  = $this->blog->comments->count();
        $data['blog']['most_reaction'] = $this->blog->mostReaction();
        
        $data['owner'] = $this->owner;
        
        return $data;
    }
}
