<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Blogs\Blog;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Repositories\Frontend\Access\User\UserRepository;
use App\Models\GeneralBlogs\GeneralBlog;

/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function editprofile(){
        $user = Auth::user();
        return view('frontend.auth.update',compact('user'));
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request)
    {
        $output = $this->user->updateProfile(access()->id(), $request->all());

        // E-mail address was updated, user has to reconfirm
        if (is_array($output) && $output['email_changed']) {
            access()->logout();

            return redirect()->route('frontend.auth.login')->withFlashInfo(trans('strings.frontend.user.email_changed_notice'));
        }

        return redirect()->route('frontend.user.account')->withFlashSuccess(trans('strings.frontend.user.profile_updated'));
    }

    public function editPhotoPage()
    {
        return view('frontend.user.edit_photo');
    }

    public function saveCroppedPhoto(Request $request)
    {
        try {
            $user = User::find($request->int_User_Id);
            $base64 = str_replace('data:image/png;base64,', '', $request->str_cropped_img);
            $base64 = str_replace(' ', '+', $base64);
            $image = base64_decode($base64);
    
            $user_photo = explode('.', $user->photo);
            $filename = $filename = str_replace('-cropped', '', $user_photo[0]).'-cropped.'.$user_photo[1];
            Storage::disk('local')->put('public/profilepicture/crop/'.$filename, $image);
    
            $user->photo = $filename;
            $user->save();

            return array(
                'status' => 'success',
                'message' => 'Profile picture Updated Successfully !',
                'data' => json_encode($user)
            );
        } catch(Exception $e) {
            return array(
                'status' => 'failed',
                'message' => 'Something went wrong!',
                'data' => $e->getMessage()
            );
        }
    }

    public function communicatorPage(Request $request)
    {
        $blog = '';
        if($request->has('action') && ($request->action == 'edit_blog' || $request->action == 'edit_design_blog') || $request->action == 'edit_career_blog') {
            $blog = Blog::where('id', $request->blog_id)
                ->with(['tags', 'videos', 'blog_panel_design', 'privacy'])
                ->first();

            // dd($blog->privacy);
        } else if ($request->has('action') && $request->action == 'edit_general_blog') {
            $blog = GeneralBlog::where('id', $request->blog_id)
                ->with(['videos', 'privacy'])
                ->first();
        }
        
        return view('frontend.user.communicator', compact('blog'));
    }
}
