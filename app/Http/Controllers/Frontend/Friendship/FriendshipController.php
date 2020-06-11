<?php

namespace App\Http\Controllers\Frontend\Friendship;

use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Models\Friendships\Status;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Friendships\Friendship;

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
    $requests = Auth::user()->getFriendRequests();
    foreach ($requests as $request) {
        $users[] = User::find($request->sender_id);
    }
    // dd(compact('requests','users'));
    // return view('requests', compact('requests','users'));
    return response()->json($requests,$users);
  }
  else{
    return response()->json("User is not logedin");
  }
}

public function sendrequest(User $user){
    $sender = Auth::user();
    if ($sender->hasSentFriendRequestTo($user)) {
        $sender->unfriend($user);
        return response()->json("Request Deleted successfully");
    }else{
        $sender->befriend($user);
        return response()->json("Requested successfully");
    }
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
    // $friendship = $user->acceptFriendRequest($recipient);
    $friendship = Friendship::where('sender_id',$user->id)->where('recipient_id',$recipient->id)->update([
        'status' => Status::ACCEPTED,
    ]);
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


}
