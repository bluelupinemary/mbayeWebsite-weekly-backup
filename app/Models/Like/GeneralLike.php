<?php

namespace App\Models\Like;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\GeneralBlogs\GeneralBlog;

class GeneralLike extends Model
{
  protected $table = 'general_likes';
    protected $fillable = [
        'emotion', 'blog_id','user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
      public function blog(){
        return $this->belongsTo(GeneralBlog::class);
      }
}
