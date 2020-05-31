<?php

namespace App\Models\Comment;

use App\Models\Blogs\Blog;
use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
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
        return $this->belongsTo(Blog::class);
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
