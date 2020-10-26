<?php

namespace App\Http\Controllers\Frontend\Message;

use App\Events\MessageSent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Models\Messages\Message;
use App\Events\PrivateMessageSent;
use App\Models\Messages\ChatGroup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Messages\Conversation;
use App\Models\Messages\GroupMessage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Models\Messages\ChatGroupMembers;

class MessagesController extends Controller
{
    protected $storage;
    protected $upload_path;
    public function __construct()
    {
        $this->middleware('auth');
        $this->upload_path = 'chat'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }


    public function index()
    {
        return view('frontend.chat.chats');
    }

    public function private()
    {
        return view('frontend.chat.privatechat');
    }

    public function fetchMessages($id)
    {

        return GroupMessage::where('group_id',$id)->get();
    }

    public function fetchprivateMessages(User $user)
    {
        // return $user;
        $con = Conversation::where(['user1_id' => auth::id(),'user2_id' => $user->id])->orWhere(['user2_id'=>auth::id(),'user1_id'=>$user->id])->first();
        $privateCommunication = Message::where('conversation_id', $con->id)->get();
        return $privateCommunication;
    }

    public function fetchconversations()
    {
        // $con = [];
        // $i = 0;
        $conversations = Conversation::where('user1_id',auth::id())->orWhere('user2_id',auth::id())->get();
        $user1_ids = $conversations->pluck('user1_id');
        $user2_ids = $conversations->pluck('user2_id');
        $users = $user1_ids->merge($user2_ids);
        $users = $users->unique();
        $users = User::whereIn('id',$users)->where('id','!=',auth::id())->get();
        return $users;
        // foreach($conversations as $con[$i]){
        // if($con[$i]->user1_id == Auth::id())
        // $con[$i]->friend = User::find($con[$i]->user2_id);
        // else
        // $con[$i]->friend = User::find($con[$i]->user1_id);
        // $i++;
        // }
        // return $con;
    }

    public function fetchgroups()
    {
        $ids = DB::table('user_chat_groups')->where('user_id',auth::id())->pluck('group_id');
        $groups= DB::table('chat_groups')->whereIn('id',$ids)->get();
        return $groups;
    }

    public function sendMessage(Request $request,$id)
    {
        // dd($id);
        $message = auth()->user()->messages()->create([
            'message' => $request->message,
            'group_id'=> $id,
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return ['status' => 'success'];
    }

    public function sendPrivateMessage(Request $request,$user)
    {
        $con = Conversation::where(['user1_id' => auth::id(),'user2_id' => $user])->orWhere(['user2_id'=>auth::id(),'user1_id'=>$user])->first();
            $input=request()->all();
            // dd($input);
            if(request()->has('file')){
                $extension = $input['file']->extension();
                $filename = $this->uploadImage($input['file']);
                // dd($filename);
                $message=auth()->user()->messages()->create([
                    // 'message' => $input['message'],
                    'conversation_id' => $con->id,
                ]);
                $message->chatmedia()->create([
                    'filename' => $filename,
                    'filetype' => $extension,
                    'message_type' => Message::class,
                ]);
            }
            else{
                // dd('not');
            $message=auth()->user()->messages()->create([
                // 'user_id' => request()->user()->id,
                'message' => $input['message'],
                'conversation_id' => $con->id,
            ]);
        }
        broadcast(new PrivateMessageSent($message->load('user')))->toOthers();

        return response(['status'=>'Message private sent successfully','message'=>$message]);

    }
    public function uploadImage($featured_image)
    {
        $avatar = $featured_image;

        if (isset($featured_image) && !empty($featured_image)) {
            $exploaded_name = explode('.', $avatar->getClientOriginalName());

            $fileName = Str::random().'.'.$exploaded_name[1];
            while (Storage::exists('public/chat/'.$fileName)) {
                $fileName = Str::random().'.'.$exploaded_name[1];
            }

            $source=$featured_image;
            //compressing
            $quality=60;//0-9
            $dest="storage/".$this->upload_path.$fileName;
            $this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));
            // $path= $this->compress($source,$dest, $quality);// compressing images
            return $fileName;
        }
    }

    public function savegroup(Request $request)
    {
        // dd($request->selected);
        // foreach($request->selected as $selected){
        //     dd($selected);
        // }
        // $group = DB::table('chat_groups')->insert([
        //     'name' => $request->name,
        //     'created_by' => Auth::id(),
        // ]);
        $group = new ChatGroup;
        $group->name = $request->name;
        $group->created_by = Auth::id();
        $group->save();
        // $users = User::whereIn('id',$request->selected)->get();
        // dd($users);
        // $users->chatgroups()->sync($group);
        $group_member = new ChatGroupMembers;
        $group_member->user_id = Auth::id();
        $group_member->group_id = $group->id;
        $group_member->save();
        foreach($request->selected as $selected){
        $group_members = new ChatGroupMembers;
        $group_members->user_id = $selected;
        $group_members->group_id = $group->id;
        $group_members->save();
    }
    return response("successfull");
    }

    public function liveStatus($user_id)
    {
        // get user data
        $user = User::find($user_id);

        // check online status
        if (Cache::has('user-is-online-' . $user->id))
            $status = 'Online';
        else
            $status = 'Offline';

        // // check last seen
        // if ($user->last_seen != null)
        //     $last_seen = "Active " . Carbon::parse($user->last_seen)->diffForHumans();
        // else
        //     $last_seen = "No data";

        // response
        return response()->json(
             $status,
            
        );
    }
    public function searchusers(Request $request){
        // dd($request);
        $q = $request['q'];
        // dd($q);
    $user = User::where('username','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    // dd($user);
    if(count($user) > 0)
        return $user;
    else return 'No Details found. Try to search again !';
    }
}
