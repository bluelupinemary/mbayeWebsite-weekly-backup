<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\DashboardViewRequest;
use App\Models\Access\User\User;
use App\Models\UserCollage\UserCollage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(DashboardViewRequest $request)
    {
        return view('frontend.user.dashboard');
    }

    public function viewUserDashboard($user_id)
    {
        $user = User::find($user_id);

        if($user) {
            return view('frontend.user.public_dashboard', compact('user'));
        }
    }

    public function collageEditor(Request $request)
    {
        return view('frontend.user.collage_editor');
    }

    public function saveCollage(Request $request)
    {
        $user = User::find($request->user_id);
        $tag = $request->tag;
        $file = $request->file;
        $contents = file_get_contents($file);
        $filename = $user->username.'-'.$user->id.'-'.$tag.'.png';
        Storage::disk('local')->put('public/dashboard_collage/'.$filename, $contents);

        $check_user_collage = UserCollage::where('user_id', $user->id)
                ->where('tag', $tag)
                ->first();

        if(!$check_user_collage) {
            $user_collage = new UserCollage();
            $user_collage->user_id = $user->id;
            $user_collage->tag = $tag;
            $user_collage->filename = $filename;
            $user_collage->save();
        } else {
            $check_user_collage->filename = $filename;
            $check_user_collage->save();
        }

        return array('filename' => $filename);
    }
}
