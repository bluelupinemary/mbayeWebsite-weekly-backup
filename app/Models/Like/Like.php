<?php

namespace App\Models\Like;

use App\Models\Blogs\Blog;
use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'emotion', 'blog_id','user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
      public function blog(){
        return $this->belongsTo(Blog::class);
      }
}
