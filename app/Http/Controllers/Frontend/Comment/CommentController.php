<?php

namespace App\Http\Controllers\Frontend\Comment;

use App\Events\NewComment;
// use Notification;
use App\Models\Blogs\Blog;
use Illuminate\Http\Request;
use App\Models\Comment\Comment;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Frontend\CommentNotification;

class CommentController extends Controller
{

  public function index(Blog $blog)
  {
    
    return response()->json($blog->comments()->with('user')->latest()->get());
  }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Blog $blog)
    {
        $comment = $blog->comments()->create([
            'body' => $request->body,
            'user_id' =>  $request->user_id,
          ]);
      $author = User::find($blog->created_by);
      //  echo $comment;exit();
       broadcast(new NewComment($comment))->toOthers();
       Notification::send($author, new CommentNotification($comment));
        return $comment;
    }

    public function countcomment(Request $request)
    {
      $blog_id = $request['blog_id'];
      $comment = Comment::where('blog_id',$blog_id)->count();
      return $comment;
    }

    public function blogpost(Blog $blog){
      // echo $blog;
      return $blog;
    }
}
