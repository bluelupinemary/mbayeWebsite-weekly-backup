<?php

namespace App\Http\Controllers\Frontend\Notify;
use App\Http\Controllers\Controller;
use App\Models\Blogs\Blog;
use Illuminate\Http\Request;
use App\Models\Comment\Comment;
use App\Models\Access\User\User;
use App\Models\Notify\Notify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Frontend\CommentNotification;

class NotifyController extends Controller
{

	public function getnotifications(Request $request){
		$user = User::find($request['user_id']);
		$notifications = $user->unreadNotifications->whereNotIn('type', ['App\Notifications\Frontend\BlogActivityNotification', 'App\Notifications\Frontend\GeneralBlogActivityNotification']);
		// $notification = $notifications->where($notifications->type == 'App\Notifications\Frontend\ReactionNotification');
		// dd($notification);
		return response()->json($notifications);
		
	}

	public function readnotification(Request $request){
		Notify::find($request['notification_id'])->delete();
		return response()->json("successfully Deleted");
	}

	public function getBlogActivities(Request $request) {
		$user = User::find($request['user_id']);
		$notifications = $user->unreadNotifications->whereIn('type', ['App\Notifications\Frontend\BlogActivityNotification', 'App\Notifications\Frontend\GeneralBlogActivityNotification'])->paginate(8);
		// $notification = $notifications->where($notifications->type == 'App\Notifications\Frontend\ReactionNotification');
		// dd($notification);
		return response()->json($notifications);
	}

}
