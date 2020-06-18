<?php

namespace App\Http\Controllers\Frontend\Friendship;

use Illuminate\Http\Request;
use App\Events\FriendRequest;
use App\Models\Access\User\User;
use App\Models\Friendships\Status;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Friendships\Friendship;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Frontend\AcceptRequestNotification;
use App\Notifications\Frontend\FriendRequestNotification;

class FriendshipController extends Controller
{
  public function listusers(){
    $users = User::all();
    // return response()->json($users);
    // dd(compact('users'));
    return view('frontend.friendship.users', compact('users'));
}

public function requests(Request $request){
  if(Auth::user()){
    $requests = Auth::user()->getReq($perPage = 2);
    // dd($requests);
    // foreach ($requests as $request) {
    //     $users[] = User::find($request->sender_id);
    // }
    // $userslist = collect($users);
    // // dd(compact('requests','userslist'));
    return view('frontend.friendship.requests');
    // return response()->json($requests,$users);
  }
  else{
    return response()->json("User is not logedin");
  }
}

public function fetchrequests(){
    if(Auth::user()){
      $requests = Auth::user()->getReq($perPage = 15);
    //   foreach ($requests as $request) {
    //       $users[] = User::find($request->sender_id);
    //   }
    //   $userslist = collect($users);
      // dd(compact('requests','userslist'));
    //   return view('frontend.friendship.requests', compact('requests','userslist'));
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

public function sendrequest(User $user){
    $sender = Auth::user();
    if ($sender->hasSentFriendRequestTo($user)) {
        $sender->unfriend($user);
        return response()->json("Request Deleted successfully");
    }else{
        $friendship = $sender->befriend($user);
        $recipient = User::find($friendship->recipient_id);
        broadcast(new FriendRequest($friendship))->toOthers();
        Notification::send($recipient, new FriendRequestNotification($friendship));
        return response()->json("Requested successfully");
    }
}

public function unfriend(User $user){
    $recipient = Auth::user();
        $recipient->unfriend($user);
        return response()->json("Request Deleted successfully");
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
    Notification::send($user, new AcceptRequestNotification($friendship));
    // echo $friendship;
    

    // $friendship->status = 1;
    // $friendship->save();
    return response()->json("Now you are friends");
}

public function denyrequest(User $user){
    $recipient = Auth::user();
    $friendship = Friendship::where('sender_id',$user->id)->where('recipient_id',$recipient->id)->update([
        'status' => Status::DENIED,
    ]);
    return response()->json("Request Rejected");
}

public function searchuser(Request $request){
  $q = $request['q'];
  $users = User::where('username','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
  return  response()->json($users);
//   if(count($users) > 0)
//   return view('frontend.friendship.users', compact('users'))->withQuery ( $q );
//   else return view ('frontend.friendship.users')->withMessage('No Details found. Try to search again !');
}

public function listfriends(){
    $u = Auth::user();
    $friendships = $u->getFriends($perPage = 2);;
    // dd($friendships);
    if(count($friendships)>0){
        // foreach ($friendships as $friendship) {
        //     $users[] = User::find($friendship->sender_id);
        // }
        // dd( compact('users'));
        return view('frontend.friendship.friends');
        }else{
            // dd("no friend");
            // $users = NUll;
            return view ('frontend.friendship.friends')->withMessage('No Details found. Try to search again !');
        }
}

public function fetchfriends(){
    $u = Auth::user();
    $friendships = $u->getFriends($perPage = 15);;
    // dd($friendships);
    if(count($friendships)>0){
        // foreach ($friendships as $friendship) {
        //     $users[] = User::find($friendship->sender_id);
        // }
        // dd( compact('users'));
        return response()->json($friendships);
        }else{
            // dd("no friend");
            return response()->json("no friends");
        }
}

public function block(User $user){
    $me = Auth::user();
    $me->blockFriend($user);
    return response()->json("User Blocked");

}

}
