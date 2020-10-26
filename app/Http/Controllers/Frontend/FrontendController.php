<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Mail\ContactAdminEmail;
use App\Models\Access\User\User;
use App\Models\BlogTags\BlogTag;
use App\Models\Settings\Setting;
use App\Http\Controllers\Controller;
use App\Models\Game\UserDesignPanel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Game\UserPanelFlowers;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Frontend\Pages\PagesRepository;
use ImageResize;


/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $settingData = Setting::first();
        $google_analytics = $settingData->google_analytics;

        return view('frontend.index', compact('google_analytics', $google_analytics));
    }

    /**
     * show page by $page_slug.
     */
    public function showPage($slug, PagesRepository $pages)
    {
        $result = $pages->findBySlug($slug);

        return view('frontend.pages.index')
            ->withpage($result);
    }

    public function initial_agreement()
    {
        return view('frontend.pages.profile');
    }
    public function terms_and_agreement()
    {
        return view('frontend.pages.terms_and_agreement');
    }
    public function copyright_claims(){
        return view('frontend.pages.copyright_claims');
    }
    public function privacy_policy(){
        return view('frontend.pages.privacy_policy');
    }
    public function special_rightholders_accounts(){
        return view('frontend.pages.special_rightholders_accounts');
    }
    public function sra_terms_and_conditions(){
        return view('frontend.pages.sra_terms_and_conditions');
    }
    public function blogview(){
        $user = Auth::user();
        if($user)         return view('frontend.blog.index');
        return view('frontend.auth.login');
    }


    public function blog_tagwise_all(Request $request)
    {
        if($request->has('tag') && $request->tag != '') {
            $tag = $request['tag'];
        } else {
            $tag = '';
        }
        
        if(Auth::user()) {
            return view('frontend.blog.blogview.tagwise.blog_tagwise',compact('tag'));
        } else {
            return view('frontend.auth.login');
        }
    }
    /**
     * Blogs of  friends tag wise
     */
    public function blog_tagwise_friend(Request $request){

        $tag = $request['tag'];
        $type = 'friend';

        if($request->has('id')) {
            $id = $request->id;
        } else {
            $id = 0;
        }

        $user = Auth::user();
        if($user)         return view('frontend.blog.blogview.tagwise.blog_of_friend_tagwise',compact('tag','id','type'));
        return view('frontend.auth.login');
    }
    public function blog_tagwise_friend_post(Request $request){
     
        $id = $request['id'];
        $user = Auth::user();
    
        if($user) return array('status' => 'success', 'message' => 'Successful!', 'data' => $id);
        return view('frontend.auth.login');
       
      
    }
    /**
     * Blogs of logged user tag wise
     */
    public function blog_tagwise_my(Request $request){

        $tag = $request['tag'];
        $user = Auth::user();
        $type = '';

        if($user) {
            $id = $user->id;
            return view('frontend.blog.blogview.tagwise.blog_of_friend_tagwise',compact('tag','id','type'));
        } else {
            return view('frontend.auth.login');
        }
    }
    public function blog_tagwise_my_post(Request $request){
     
        $id = $request['id'];
        $user = Auth::user();
    
        if($user) return array('status' => 'success', 'message' => 'Successful!', 'data' => $id);
        return view('frontend.auth.login');
       
      
    }
    /**
     * All blogs of all users  tag wise
     */
    public function all_blogs_tagwise(Request $request){

        $tag = $request['tag'];
        $id = $request['id'];
        $user = Auth::user();
        if($user)         return view('frontend.blog.blogview.tagwise.all_blogs_tagwise',compact('tag','id'));
        return view('frontend.auth.login');
    }
    public function blog(){
        $user = Auth::user();
        if($user)  return view('frontend.blog.blog');
        return view('frontend.auth.login');
        
    }
    public function page_under_development(){
        return view('frontend.pages.page_under_dev');
    }

    public function terms(){
        return view('frontend.pages.terms');
    }

    public function sendContactAdminEmail(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'content' => 'required',
            'subject' => 'required',
        ]);

        $user_email = Auth::user()->email;
        $content = $this->replaceContentFileLocation($request->content);
        $subject = $request->subject;
        // dd($subject);

        $formatted_attachments = str_replace( array( '\'', '"', ';', '[', ']' ), '', $request->attachments);
        $formatted_attachments = explode(',', $formatted_attachments);
        $this->backupEmailContentAttachments($formatted_attachments);

        $mail = Mail::to(env('MAIL_TO_ADDRESS', 'admin@mbaye.com'))
            ->queue(new ContactAdminEmail($content, $user_email, $subject));

        return array('message' => 'Your email have been sent!');
    }

    public function backupEmailContentAttachments($attachments)
    {
        $quality = 10;//0-9
        for($i = 0; $i < count($attachments); $i++) {
            if (!Storage::exists('public/img/email-attachments/'.$attachments[$i])) {
                Storage::copy('public/trix-attachments/'.$attachments[$i], 'public/img/email-attachments/'.$attachments[$i]);
                
                $source= 'storage/img/email-attachments/'.$attachments[$i];
                // dd(getimagesize(asset('storage/img/blog-attachments/'.$attachments[$i])));
                $dest= 'storage/img/email-attachments/'.$attachments[$i];
                $path= $this->compress($source,$dest, $quality);// compressing images
            }
        }
    }

    /**
     * This function is used for reducing file size.
     *
     * @param string location of souce image
     * @param string location of destination image
     * @param int quality percentage
     *
     * @return $this
     */
    public function compress($source, $destination, $quality)
    {
        // ini_set('max_execution_time', 0);
        $info = getimagesize($source);
        $filesize = filesize($source);
        $limit_size = 512000;
        if($filesize >= $limit_size) {
            if ($info['mime'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($source);
                imagejpeg($image, $destination, $quality);
            } elseif ($info['mime'] == 'image/gif') {
                $image = imagecreatefromgif($source);
                imagegif($image, $destination, $quality);
            } elseif ($info['mime'] == 'image/png') {
                $image = imagecreatefrompng($source);
                imagepng($image, $destination, 9);
            } else {
                $image = imagecreatefromjpeg($source);
                imagejpeg($image, $destination, $quality);
            }

            $imgWidth=$info[0];
            $img  =   ImageResize::make($destination);

            $img->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destination,10);
        }
        
        //we resize the image to 860px, save it to the large_photos folder
        //with a quality of 85%.Keep the resized images under 85% to pass //the google lighthouse efficiently compress images requirement.
        //there will be no changes in image quality

        // prevent possible upsizing 
         /*   $img->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destination);*/

        return $destination;
    }

    public function replaceContentFileLocation($content)
    {
        $new_content = str_replace("/storage/trix-attachments", "/storage/img/email-attachments", $content);

        return $new_content;
    }
    
    /* 3d pages */
    public function dummy_page($id){
        $userId = $id;
        // $design_id = UserDesignPanel::where('user_id', $userId)->first()->id;
        $design_id = UserDesignPanel::where('user_id', $userId)->firstOrFail()->id;
        
        $panels_from_db = UserPanelFlowers::where('design_id', $design_id)->get(['panel_number','flowers_used'])->toArray();
        
        return view('frontend.game.dummy_page')->with('user_panels',json_encode($panels_from_db))->with('user_id',$userId);
    }

    public function captain_mbaye(){
        return view('frontend.pages.captain_mbaye');
    }

    public function flowers_mbaye(){
        return view('frontend.pages.flowers_mbaye');
    }

    public function visiting_mbaye(){
        return view('frontend.pages.visiting_mbaye');
    }

    public function participate_mbaye(){
        $user = Auth::user();
      

        if($user){
            $userPhoto = Auth::user()->getProfilePicture();
            $userGender = Auth::user()->getGender();
            return view('frontend.game.participate_mbaye',["photo"=>$userPhoto, "gender"=>$userGender]);
        }
        return view('frontend.pages.welcome_mbaye');
    }

    public function participate_store_gender(Request $req){
        $user = Auth::user();
        dd($req);
            // $saved_contact = $this->contact->create($req->except('_token'));

    
            // if($saved_contact) {
            //     return array('status' => 'success', 'message' => 'Game progress saved successfully!', 'data' => "");
            // }else{
            //     return array('status' => 'failed', 'message' => 'Error in saving the game progress!', 'data' => "");
            // }
        
    
    }




    public function feet_mbaye(){
        return view('frontend.game.feet_mbaye');
    }

    public function head_mbaye(){
        return view('frontend.game.head_mbaye');
    }

    public function story_mbaye(Request $request){
        $chapter_no = $request['cNo'];
        if($chapter_no) return view('frontend.game.story_mbaye')->with('chapter_no',$chapter_no);;
        return view('frontend.index');
    }





    public function search_friends()
    {
        return view('frontend.pages.search_friends');
    }
    /* For general blogs ,displays all blogs */
    public function blog_general_all(){
        $user = Auth::user();
        if($user)         return view('frontend.blog.blogview.general.blog_general');
        return view('frontend.auth.login');
    }
    public function blog_general_all_old(){
        $user = Auth::user();
        if($user)         return view('frontend.blog.blogview.general.blog_general_old');
        return view('frontend.auth.login');
    }
   /* For general blogs userwise */

    public function blog_general_my_post(Request $request){
     
        $id = $request['id'];
        $user = Auth::user();
    
        if($user) return array('status' => 'success', 'message' => 'Successful!', 'data' => $id);
        return view('frontend.auth.login');
       
      
    }

    public function blog_general_my(Request $request){
        // dd($request);
        $id = Auth::user()->id;
        $user = Auth::user();
        $type = '';
        // if($user)         return view('frontend.blog.blogview.general.blog_general_userwise',compact('id'));
        if($user) return  view('frontend.blog.blogview.general.blog_general_userwise',compact('id','type'));
        return view('frontend.auth.login');
       
      
    }

 /* For general blogs userwise */
 public function blog_general_friend(Request $request)
 {   
    $user = Auth::user();
    $type = 'friend';

    if($request->has('id')) {
        $id = $request->id;
    } else {
        $id = 0;
    }

    if($user) {
        return view('frontend.blog.blogview.general.blog_general_userwise',compact('id','type'));
    } else {
        return view('frontend.auth.login');
    }
}
public function blog_general_friend_post(Request $request){
    $id = $request['id'];
    $user = Auth::user();

    if($user) return array('status' => 'success', 'message' => 'Successful!', 'data' => $id);
    return view('frontend.auth.login');
   
  
}
     /* For all designed panel blogs */
     public function designed_panels_all(){ 
        return view('frontend.blog.blogview.designed-panel.all_designed_panels');
    }

     /**
     * All the designed panel Blogs of logged in user 
     */
    public function designed_panels_my(Request $request)
    {
        // $tag=$request['tag'];
        $user = Auth::user();
        $type = '';

        if($user ) {
            $id = Auth::user()->id;
            return view('frontend.blog.blogview.designed-panel.designed_panel_userwise',compact('id','type'));
        } else {
            return view('frontend.auth.login');
        }
    }

    public function designed_panels_my_post(Request $request){
        $id = $request['id'];
        $user = Auth::user();
    
        if($user) return array('status' => 'success', 'message' => 'Successful!', 'data' => $id);
        return view('frontend.auth.login');
       
      
    }
   /**
     * All designed panel blogs of friends
     */
    public function designed_panels_friend(Request $request)
    {
        $user = Auth::user();
        $type = 'friend';

        if($request->has('id')) {
            $id = $request->id;
        } else {
            $id = 0;
        }

        if($user) {
            return view('frontend.blog.blogview.designed-panel.designed_panel_userwise',compact('id','type'));
        } else {
            return view('frontend.auth.login');
        }
    }
    /**
     * All designed panel blogs without astronaut
     */
    public function designed_panels_home(Request $request){

            $id = $request['id'];
            return view('frontend.blog.blogview.designed-panel.designed_panels',compact('id'));
       
    }
    

     /* For all users jobseeker */
     public function jobseeker_profiles(Request $request){
        $user = Auth::user();
        if($user) {
            $country = $user->country;
            return view('frontend.blog.blogview.jobseekers.profiles',compact('country'));
        } else {
            $country = "";
            return view('frontend.blog.blogview.jobseekers.profiles',compact('country'));
        }
    }
    /* For career blogs my */
    public function blog_career_my_post(Request $request){
        $id = $request['id'];
        $user = Auth::user();
        if($user) return array('status' => 'success', 'message' => 'Successful!', 'data' => $id);
        return view('frontend.auth.login');
    }

    public function blog_career_my(Request $request)
    { 
        $user = Auth::user();
    
        if($user) {
            $id = $user->id;
            return  view('frontend.blog.blogview.career.my_career_blogs',compact('id'));
        } else {
            return view('frontend.auth.login');
        }
    }
    public function blog_career_friend_post(Request $request){
        $id = $request['id'];
        $user = Auth::user();
        if($user) return array('status' => 'success', 'message' => 'Successful!', 'data' => $id);
        return view('frontend.auth.login');
    }

    public function blog_career_friend(Request $request) {
        $user = Auth::user();
        $type = 'friend';

        if($request->has('id')) {
            $id = $request->id;
        } else {
            $id = 0;
        }
    
        if($user) {
            return  view('frontend.blog.blogview.career.friend_career_blogs',compact('id', 'type'));
        } else {
            return view('frontend.auth.login');
        }
    }


    //dummy pages
    public function blogviewMembers(){
        $gender = 'trevor';
        return view('frontend.blog.blogview.dummy_blogview',compact('gender'));
    }

    public function userConfirmation(){
        return view('emails.reset-password');
    }

    public function getTags()
    {
        $tags = BlogTag::all();
        
        return $tags;
    }
}
