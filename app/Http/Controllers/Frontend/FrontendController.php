<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Settings\Setting;
use App\Models\Access\User\User;
use App\Repositories\Frontend\Pages\PagesRepository;
use Illuminate\Http\Request;
use App\Mail\ContactAdminEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Auth;


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

    public function profile()
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
    public function blog(){
        $user = Auth::user();
        if($user)  return view('frontend.blog.blog');
        return view('frontend.auth.login');
        
    }
    public function page_under_development(){
        return view('frontend.pages.page_under_dev');
    }
    public function view_blogs(){
        return view('frontend.blog.view_blogs');
       
      
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
                $dest="storage/img/blog-attachments/".$attachments[$i];
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
        
        if($user) return view('frontend.game.participate_mbaye');
        return view('frontend.pages.welcome_mbaye');
    }


   
}
