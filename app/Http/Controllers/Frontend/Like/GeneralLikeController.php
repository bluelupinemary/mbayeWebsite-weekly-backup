<?php

namespace App\Http\Controllers\Frontend\Like;

use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Models\Like\GeneralLike;
use App\Events\NewGeneralEmotion;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\GeneralBlogs\GeneralBlog;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Frontend\GeneralReactionNotification;

class GeneralLikeController extends Controller
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
          $blog = GeneralBlog::find($blog_id);
          $author = User::find($blog->created_by);
          $validatedData = $request->validate([
            'blog_id' => "required|exists:general_blogs,id",
            'emotion' => "required|numeric"
          ]);

          $blog = GeneralBlog::find($blog_id);
          $like = GeneralLike::where('user_id', $user_id)->where('blog_id', $blog_id)->first();
          if ($like) {
              $already_like = $like->emotion;
              if ($already_like == $emotion) {
                broadcast(new NewGeneralEmotion($like))->toOthers();
                  $like->delete();
                  return array('status'=>'unlike', 'data'=>null);
              } else {
                  $like->emotion = $validatedData['emotion'];
                  $like->save();
              }
          } else {
              $like = GeneralLike::create([
                "user_id" => $user_id,
                "blog_id" => $validatedData['blog_id'],
                "emotion" => $validatedData['emotion'],
              ]);
              // return $like;
          }
          broadcast(new NewGeneralEmotion($like))->toOthers();
          
          Notification::send($author, new GeneralReactionNotification($like));
          return array('status'=>'like', 'data'=>$like, 'naff_fart_status' => $blog->getNaffFartStatus());
      }
      public function getUserReaction(Request $request)
    {
        $user_id = $request['user_id'];
        $blog_id = $request['blog_id'];
        $like = GeneralLike::where('user_id', $user_id)->where('blog_id', $blog_id)->first();
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
        $hot = GeneralLike::where('blog_id',$blog_id)->where('emotion',0)->count();
        $cool = GeneralLike::where('blog_id',$blog_id)->where('emotion',1)->count();
        $naff = GeneralLike::where('blog_id',$blog_id)->where('emotion',2)->count();

        $blog = GeneralBlog::find($blog_id);
        $most_reaction = $blog->mostReaction();

        return array('hot'=> $hot, 'cool'=>$cool, 'naff'=>$naff, 'most_reaction' => $most_reaction);
    }
}
