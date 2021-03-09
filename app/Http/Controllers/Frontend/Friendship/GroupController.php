<?php

namespace App\Http\Controllers\Frontend\Friendship;

use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Models\Friendships\Group;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Backend\Groups\CreateGroupsRequest;
use App\Models\Friendships\FriendFriendshipGroups;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::where('created_by',Auth::id())->orderBy('name', 'asc')->get();

        return response()->json($groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.friendship.groups');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGroupsRequest $request)
    {
        $group = new Group();
        $group->name = $request->group_name;
        $group->slug = $request->group_name_slug;
        $group->created_by = $request->user_id;
        $group->save();

        return $group;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);
        $members = $group->getMembers();
        $members_id = $group->getMembers()->pluck('id');
        return array('group' => $group, 'members' => $members, 'members_id' => $members_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::find($id);
        $group->name = $request->group_name;
        $group->slug = $request->group_name_slug;
        $group->save();

        return $group;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeGroupFriends(Request $request)
    {
        // dd($request->group_id);
        if($request->group_id!='')
        {
            $group = Group::find($request->group_id);
            // dd($group);
            if($group)
            {
                $friends = explode(',', $request->friends);
                
                if(count($friends) > 1)
                {
                    FriendFriendshipGroups::where('group_id', $group->id)->delete();
                    for($i = 0; $i < count($friends); $i++) {
                        $friend = User::where('id',$friends[$i])->first();
                        // dd($group_name,$friend);
                        Auth::user()->groupFriend($friend, $group->id);
                    }
                    return array(
                        'status'=>'success',
                        'title'=>'Group Update!',
                        'message' => 'Members of the group '.$group->name.' succussfully updated '
                    );
                }
                else
                {
                    return array(
                        'status'=>'error',
                        'title'=>'No Member Selected!',
                        'message' => 'Select the member you want to Delete!'
                    );
                }
                
            }
            else
            {
                return array(
                    'status'=>'error',
                    'title'=>'Group is not Selected!',
                    'message' => 'Select the group to perform this operation.'
                );
            }
        }
        else
            {
                return array(
                    'status'=>'error',
                    'title'=>'Group is not Selected!',
                    'message' => 'Select the group to perform this operation.'
                );
            }
        
    }

    public function deleteGroups(Request $request)
    {
        Group::whereIn('id', $request->group_id)->delete();
        return array('message' => 'Group(s) successfully deleted!');
    }
}
