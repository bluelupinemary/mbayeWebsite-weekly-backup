<?php

namespace App\Http\Controllers\Frontend\Like;
use App\Models\Like\Like;

use App\Events\NewEmotion;
use App\Models\Blogs\Blog;
use Illuminate\Http\Request;
use App\Models\Comment\Comment;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\BlogShares\BlogShare;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Models\GeneralBlogShares\GeneralBlogShare;
use App\Notifications\Frontend\ReactionNotification;

class LikeController extends Controller
{
      public function setemotion(Request $request)
      {
        // echo "some data";
        $user_id = $request['user_id'];
        if(!$user_id){
            return abort(401);
        }
          $blog_id = $request['blog_id'];
          $emotion = $request['emotion'];
          $blog = Blog::find($blog_id);
          $author = User::find($blog->created_by);
          $validatedData = $request->validate([
            'blog_id' => "required|exists:blogs,id",
            'emotion' => "required|numeric"
          ]);

          $blog = Blog::find($blog_id);
          $like = Like::where('user_id', $user_id)->where('blog_id', $blog_id)->first();
          if ($like) {
              $already_like = $like->emotion;
              if ($already_like == $emotion) {
                  $like->delete();
                  return array('status'=>'unlike', 'data'=>null);
              } else {
                  $like->emotion = $validatedData['emotion'];
                  $like->save();
              }
          } else {
              $like = Like::create([
                "user_id" => $user_id,
                "blog_id" => $validatedData['blog_id'],
                "emotion" => $validatedData['emotion'],
              ]);
              // return $like;
          }
          broadcast(new NewEmotion($like));
          
          Notification::send($author, new ReactionNotification($like));
          return array('status'=>'like', 'data'=>$like, 'naff_fart_status' => $blog->getNaffFartStatus());
      }
      public function getUserReaction(Request $request)
    {
        $user_id = $request['user_id'];
        $blog_id = $request['blog_id'];
        $like = Like::where('user_id', $user_id)->where('blog_id', $blog_id)->first();
        $reaction = '';
        if($like) {
            $reaction = $this->getReaction($like->emotion);
        }
        return $reaction;
    }

    public function getReaction($emotion_id)
    {
        if($emotion_id == 0) {
            return 'hot';
        } else if($emotion_id == 1) {
            return 'cool';
        } else if($emotion_id == 2) {
            return 'naff';
        }
    }

    public function countemotions(Request $request){
        $blog_id = $request['blog_id'];
        $hot = Like::where('blog_id',$blog_id)->where('emotion',0)->count();
        $cool = Like::where('blog_id',$blog_id)->where('emotion',1)->count();
        $naff = Like::where('blog_id',$blog_id)->where('emotion',2)->count();
        return array('hot'=> $hot, 'cool'=>$cool, 'naff'=>$naff);
    }

    public function countblogshare($id){
        // dd("reached");
        $sharecount = BlogShare::where('blog_id',$id)->where('blog_type','App\Models\Blogs\Blog')->count();
        return $sharecount;
    }

    public function countgeneralblogshare($id){
        // dd($id);
        $generalsharecount = GeneralBlogShare::where('general_blog_id',$id)->count();
        $regularsharecount = Blogshare::where('blog_id',$id)->where('blog_type','App\Models\GeneralBlogs\GeneralBlog')->count();
        return $sharecount = $generalsharecount+$regularsharecount;
    }
}
