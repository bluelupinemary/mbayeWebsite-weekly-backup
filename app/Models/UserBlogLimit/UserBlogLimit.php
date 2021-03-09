<?php

namespace App\Models\UserBlogLimit;

use Illuminate\Database\Eloquent\Model;

class UserBlogLimit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "user_blog_limit";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'limit'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
