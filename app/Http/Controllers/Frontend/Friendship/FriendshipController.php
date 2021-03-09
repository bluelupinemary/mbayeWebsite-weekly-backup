<?php

namespace App\Http\Controllers\Frontend\Friendship;

use Illuminate\Http\Request;
use App\Events\FriendRequest;
use App\Events\RequestAccepted;
use App\Models\Access\User\User;
use App\Models\Friendships\Group;
use App\Models\Friendships\Status;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Friendships\Friendship;
use App\Models\Friendships\Traits\Friendable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Frontend\AcceptRequestNotification;
use App\Notifications\Frontend\FriendRequestNotification;

class FriendshipController extends Controller
{
  use Friendable;

  public function listusers(){
    $users = User::all();
    // return response()->json($users);
    // dd(compact('users'));
    return view('frontend.friendship.users', compact('users'));
}

public function requests(Request $request){
  if(Auth::user()){
    $requests = Auth::user()->getReq($perPage = 15);
    return view('frontend.friendship.requests');  
  }
  else{
    return response()->json("User is not logedin");
  }
}

public function fetchrequests(){
    if(Auth::user()){
        $requests = Auth::user()->getReq($perPage = 15);
        return response()->json($requests);
    }
    else{
        return response()->json("User is not logedin");
    }
}

  public function getuser(Request $request){
    $user = User::find($request['user']);
    return response()->json($user);
  }

public function sendrequest($user_id)
{
    $user = User::find($user_id);
    $sender = Auth::user();
    if ($sender->hasSentFriendRequestTo($user)) 
    {
        $sender->unfriend($user);
        return response()->json(['status' => $sender->hasSentFriendRequestTo($user), 'message' => "Request Cancelled!"]);
    }
    else
    {
        // dd($user);
        $friendship = $sender->befriend($user);
        // dd($user);
        // $recipient = User::where('id',$friendship->recipient_id)->get();
        broadcast(new FriendRequest($friendship))->toOthers();
        Notification::send($user, new FriendRequestNotification($friendship));
        return response()->json(['status' => $sender->hasSentFriendRequestTo($user), 'message' => "Friend Request Sent!"]);
    }
}

public function unfriend(User $user){
    $recipient = Auth::user();
    $recipient->unfriend($user);
    return response()->json("You have unfriended ".$user->first_name.' '.$user->last_name.'.');
}

public function checkfriendship(User $user){
    $status= '';
    $sender = Auth::user();
    if ($sender->hasSentFriendRequestTo($user)) {
        return $status = 1;
    }else{
        return $status = 0;
    }
}

public function acceptrequest(User $user){
    $recipient = Auth::user();
    $recipient->acceptFriendRequest($user);
    $friendship = Friendship::where('sender_id',$user->id)->where('recipient_id',$recipient->id)->first();
    broadcast(new RequestAccepted($friendship))->toOthers();
    Notification::send($user, new AcceptRequestNotification($friendship));
    // echo $friendship;
    

    // $friendship->status = 1;
    // $friendship->save();
    return response()->json("You are now friends with ".$user->first_name.' '.$user->last_name.'.');
}

public function denyrequest(User $user){
    $recipient = Auth::user();
    $friendship = Friendship::where('sender_id',$user->id)->where('recipient_id',$recipient->id)->update([
        'status' => Status::DENIED,
    ]);
    return response()->json("You have declined friend request from ".$user->first_name.' '.$user->last_name.'.');
}

public function searchuser(Request $request){
    $q = $request['q'];
    if($q != '') {
        $users = User::where(function ($query) use ($q) {
            $query->where('username','LIKE','%'.$q.'%')
            ->orWhere('email','LIKE','%'.$q.'%')
            ->orWhere('first_name','LIKE','%'.$q.'%')
            ->orWhere('last_name','LIKE','%'.$q.'%');
        })
        // ->whereNotNull('photo')
        ->where('id', '!=', Auth::user()->id)
        ->paginate(16);
    } else {
        // $users = User::whereNotNull('photo')->where('id', '!=', Auth::user()->id)->paginate(16);
        $users = User::where('id', '!=', Auth::user()->id)->paginate(16);
    }
  
    return  response()->json($users);
//   if(count($users) > 0)
//   return view('frontend.friendship.users', compact('users'))->withQuery ( $q );
//   else return view ('frontend.friendship.users')->withMessage('No Details found. Try to search again !');
}

public function listfriends(Request $request){
    $u = Auth::user();
    $friendships = $u->getFriends($perPage = 2);

    $friend = null;
    if($request->has('friend_id') && $request->friend_id != null) {
        $friend = User::find($request->friend_id);
    }
    // dd($friendships);
    if(count($friendships)>0){
        // foreach ($friendships as $friendship) {
        //     $users[] = User::find($friendship->sender_id);
        // }
        // dd( compact('users'));
        return view('frontend.friendship.friends', compact('friend'));
        }else{
            // dd("no friend");
            // $users = NUll;
            return view ('frontend.friendship.friends', compact('friend'))->withMessage('No Details found. Try to search again !');
        }
}

public function fetchfriends(Request $request){
    $u = Auth::user();
    $search = $request->search;
    if($request->has('perPage')) {
        $perPage = $request->perPage;
    } else {
        $perPage = 15;
    }

    $orderBy = 'asc-first_name';
    if($request->has('orderBy')) {
        $orderBy = $request->orderBy;
    }

    // if($search != '') {
		$friendships = $u->getFriendsSearch($perPage, $search, $orderBy);
    // } else {
	// 	$friendships = $u->getFriends($perPage);
	// }

    // dd($friendships);
    // if(count($friendships)>0){
    //     // if($sort_field == 'first_name') {
    //     //     if($sort_type == 'asc') {
    //     //         $friendships = $friendships->sortBy('first_name');
    //     //     } else {
    //     //         $friendships = $friendships->sortByDesc('first_name');
    //     //     }
    //     // } else if($sort_field == 'frienship_date') {
    //     //     if($sort_type == 'asc') {
    //     //         $friendships = $friendships->sortBy('user_friendship');
    //     //     } else {
    //     //         $friendships = $friendships->sortByDesc('user_friendship');
    //     //     }
    //     // }
        return response()->json(['pagination' => $friendships, 'data' => $friendships->values()->all()]);
    // } else{
    //     // dd("no friend");
    //     return response()->json("no friends");
    // }
}

public function block(User $user){
    $me = Auth::user();
    $me->blockFriend($user);
    return response()->json("User Blocked");
}

public function groupfriends(Request $request){
    $group = Group::where('name',$request['name'])->first();
    $friend = User::where('id',$request['id'])->first();
    // dd($group_name,$friend);
    $group = Auth::user()->groupFriend($friend, $group->id);
    return response()->json("Added to group successfully");
}

public function ungroupfriends(Request $request){
  $group = Group::where('name',$request['name'])->first();
  $friend = User::where('id',$request['id'])->first();
  // dd($group_name,$friend);
  $group = Auth::user()->ungroupFriend($friend, $group->id);
  return response()->json("Deleted from group successfully");
}

public function hasSentFriendRequest($user_id) {
    $status= '';
    $user = User::find($user_id);
    $sender = Auth::user();
    if ($sender->hasSentFriendRequestTo($user)) {
        $status = 1;
    }else{
        $status = 0;
    }

    if($sender->isFriendWith($user)) {
        $status = 2;
    }

    return response()->json($status);
}

}
