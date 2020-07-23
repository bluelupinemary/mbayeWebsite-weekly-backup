<?php

namespace App\Http\Controllers\Frontend\Comment;

use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Events\NewGeneralComment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment\GeneralComment;
use App\Models\GeneralBlogs\GeneralBlog;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Frontend\GeneralCommentNotification;

class GeneralCommentController extends Controller
{

  public function index(GeneralBlog $blog)
  {
    // return response()->json($blog);

    return response()->json($blog->comments()->with('user')->latest()->get());
  }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,GeneralBlog $blog)
    {
        $comment = $blog->comments()->create([
            'body' => $request->body,
            'user_id' =>  $request->user_id,
          ]);
      $author = User::find($blog->created_by);
      //  echo $comment;exit();
       broadcast(new NewGeneralComment($comment))->toOthers();
       Notification::send($author, new GeneralCommentNotification($comment));
        return $comment;
    }

    public function countcomment(Request $request)
    {
      $blog_id = $request['blog_id'];
      $comment = GeneralComment::where('blog_id',$blog_id)->count();
      return $comment;
    }

    public function blogpost(GeneralBlog $blog){
      // echo $blog;
      return $blog;
    }
}
