<?php

namespace App\Http\Controllers\Frontend\CareStories;

use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Events\NewCareStoryEvent;
use App\Http\Controllers\Controller;
use App\Models\CareStories\CareStory;
use App\Repositories\Frontend\CareStories\CareStoriesRepository;
use App\Http\Requests\Backend\CareStories\StoreCareStoriesRequest;
use App\Models\CareStoryImages\CareStoryImage;
use Illuminate\Support\Facades\Storage;
use Auth;

class CareStoriesController extends Controller
{
    /**
     * @var CareStoriesRepository
     */
    protected $care_story;

    /**
     * @param \App\Repositories\Backend\Blogs\BlogsRepository $blog
     */
    public function __construct(CareStoriesRepository $care_story)
    {
        $this->care_story = $care_story;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCareStoriesRequest $request)
    {   
        // Check if user has existing story of care
        $care_story = CareStory::where('created_by', $request->user_id)->first();
        
        if($care_story) {
            $saved_care_story = $this->care_story->update($care_story, $request->except('_token'));
        } else {
            $saved_care_story = $this->care_story->create($request->except('_token'));
            // broadcast(new NewCareStoryEvent($saved_care_story))->toOthers();
            // get blog privacy group_id
            // $group_ids = $saved_blog->privacy->pluck('group_id')->toArray();

            // if($group_ids) {
            //     $user_ids = FriendFriendshipGroups::whereIn('group_id', $group_ids)->pluck('friend_id')->toArray();

            //     $friends = User::whereIn('id', $user_ids)->get();
            // } else {
            //     $friends = Auth::user()->getFriends();
            // }
            
            // Notification::send($friends, new BlogActivityNotification($saved_blog));
        }
        // dd(compact('saved_blog'));
        
        $user = User::find($request->user_id);

        if($user->roles[0]->name == 'User') {
            return array('status' => 'success', 'message' => 'Story of Care published successfully!', 'data' => $saved_care_story);
            
        } else {
            return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => trans('alerts.backend.blogs.created')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->has('id')){
            $user_story = $this->getUserStoryOfCare($request->id);
            $user_id = $request->id;
            $fname = User::find($request->id)->first_name;
            $lname = User::find($request->id)->last_name;
            $user_name = $fname." ".$lname;
            $has_story = 'false';
            if($user_story != null){
                $has_story = 'true';
            }
            return view('frontend.game.story_care',compact('user_story', 'has_story', 'user_name','user_id'));
        }else{
            return redirect('blogview_storyofcare');
        }
        

       
       
       
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
        //
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

    public function getUserStoryOfCare($user_id)
    {
        $story_of_care = CareStory::where('created_by', $user_id)
            ->where('deleted_at', null)
            ->with(['videos', 'images'])
            ->first();

        return $story_of_care; 
    }

    public function getStoryOfCare()
    {
        $story_of_care = CareStory::where('created_by', Auth::user()->id)
            ->where('deleted_at', null)
            ->with(['videos', 'images'])
            ->first();

        $story_of_care->number_of_panels = Auth::user()->getPanels()->count();

        return $story_of_care; 
    }

    public function fetchAllStoryOfCare(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 5;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'DESC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';
        $sort = 'desc_name';
            
        // public general blogs
        $care_stories = CareStory::where('status', 'Published')
            ->with('owner')
            ->orderBy('publish_datetime', 'desc')
            ->paginate($limit);
     
        return response()->json($care_stories);
    }

    public function deleteImage($image_id)
    {
        $image = CareStoryImage::find($image_id);

        Storage::disk('public')->delete('img/storyofcare_attachments/'.$image->imageurl);
        
        $image->delete();

        return array('status' => 'success', 'message' => 'Story of Care image successfully deleted!');
    }
}
