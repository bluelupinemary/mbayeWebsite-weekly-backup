<?php

namespace App\Http\Controllers\Frontend\User;

use Auth;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use App\Models\Game\UserContacts;

use App\Repositories\Frontend\Game\ContactRepository;
use App\Models\Access\User\Traits\Attribute\UserAttribute;

class ContactController extends Controller
{
    //
    protected $contact;

   
    public function __construct(ContactRepository $contact)
    {
        $this->contact = $contact;
    }
    public function showUserContacts()
    {
        $userId = Auth::user()->id;
        $userPhoto = Auth::user()->getProfilePicture();
        $userGender = Auth::user()->getGender();
       // dd($userGender);
        //return User::all();
        return view('frontend.pages.contact_directory',["userId"=>$userId,"photo"=>$userPhoto, "gender"=>$userGender]);
    }

    function list(){
        return User::all();
    }

    //store contacts of user
    public function storeContacts(Request $req){
        $saved_contact = $this->contact->create($req->except('_token'));



        // $data = UserContacts::where('user_id', $req->uid)->first();
        // if(!$data || $data == null) {
        //     $data = new UserContacts();
        // }
        // $saved_contacts = $this->contact->saveState($req->except('_token'));
       
        // $data->user_id = $req->uid; 
        // $data->name = $req->name;
        // $data->email = $req->email;
        // $data->mobile_number = $req->mobile;
        // $data->alias = $req->alias;
        // $data->save_path = $req->savePath;
        // $data->save();

        if($saved_contact) {
            return array('status' => 'success', 'message' => 'Game progress saved successfully!', 'data' => "");
        }else{
            return array('status' => 'failed', 'message' => 'Error in saving the game progress!', 'data' => "");
        }
    }

    
}
