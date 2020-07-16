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
}
