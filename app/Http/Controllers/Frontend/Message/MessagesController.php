<?php

namespace App\Http\Controllers\Frontend\Message;

use App\Events\MessageSent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Messages\Message;
use App\Models\Access\User\User;
use App\Models\Messages\ChatGroup;
use App\Events\PrivateMessageSent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Messages\ChatGroupMembers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        return Message::with('user')->where('group_id',$id)->get();
    }

    public function fetchprivateMessages(User $user)
    {
        $privateCommunication= Message::with('user')
        ->where(['user_id'=> auth()->id(), 'receiver_id'=> $user->id])
        ->orWhere(function($query) use($user){
            $query->where(['user_id' => $user->id, 'receiver_id' => auth()->id()]);
        })
        ->get();
        return $privateCommunication;
    }

    public function fetchUsers()
    {
        return User::where('id','!=',auth::id())->get();
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

            $input=request()->all();
            // dd($input);
            if(request()->has('file')){
                // dd('have');
                $filename = $this->uploadImage($input['file']);
                // dd($filename);
                $message=auth()->user()->messages()->create([
                    // 'user_id' => request()->user()->id,
                    'file' => $filename,
                    'receiver_id' => $user,
                ]);
            }
            else{
                // dd('not');
            $message=auth()->user()->messages()->create([
                // 'user_id' => request()->user()->id,
                'message' => $input['message'],
                'receiver_id' => $user,
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
}
