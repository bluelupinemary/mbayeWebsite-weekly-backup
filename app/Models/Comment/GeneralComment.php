<?php

namespace App\Models\Comment;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\GeneralBlogs\GeneralBlog;


class GeneralComment extends Model
{
    // protected $table = 'general_comments';
    protected $guarded = [];

    /**
     * The belongs to Relationship
     *
     * @var array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blog()
    {
        return $this->belongsTo(GeneralBlog::class);
    }

    /**
     * The has Many Relationship
     *
     * @var array
     */
    // public function replies()
    // {
    //     return $this->hasMany(Comment::class, 'parent_id');
    // }
}
