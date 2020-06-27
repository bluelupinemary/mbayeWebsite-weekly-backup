<?php

namespace App\Http\Controllers\Frontend\User;

use Auth;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Models\Game\UserContacts;
use App\Http\Controllers\Controller;

use App\Models\Game\UsersContactsDetails;
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
      
        $user_contacts_data = UserContacts::where('user_id', $userId)->first();


        $has_contacts = false;
        if(!$user_contacts_data|| $user_contacts_data === null){
            $filename = null;
            $contact_list = null;
        }else{
            $contactId = UserContacts::where('user_id', $userId)->first()->id;
            $filename = $user_contacts_data->save_path;
            $has_contacts = $this->contact->loadState($filename);
            $contact_list = UsersContactsDetails::where('contact_id', $contactId)->get(['name','email','mobile_number','alias','planet']);
        }
        return view('frontend.pages.contact_directory',["userId"=>$userId,"photo"=>$userPhoto, "gender"=>$userGender, "filename"=>$filename, "has_contacts"=>$has_contacts,"contact_list"=>$contact_list])->with(compact($contact_list));
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
