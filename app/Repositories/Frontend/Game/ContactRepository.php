<?php

namespace App\Repositories\Frontend\Game;

use DB;
use Illuminate\Support\Str;
use App\Models\Game\UserContacts;
use App\Models\Game\UsersContactsDetails;
use App\Models\Game\UserDesignPanel;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;

/**
 * Class GameRepository.
 */
class ContactRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = UserDesignPanel::class;

    protected $upload_path;

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'saveState'.DIRECTORY_SEPARATOR.'userContacts'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

    /**
     * @return mixed
     */


    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */

    public function create(array $input)
    {
   
        //check if the user has saved babylon file in the db
        $data = UserContacts::where('user_id', $input['uid'])->first();
        //if the user doesnt have data yet, create new entry
        if(!$data || $data == null) {
            $data = new UserContacts();
        }
        //insert to db
        $data->user_id = $input['uid']; 
        $data->save_path = $input['savePath'];
        $data->save();

        $contactId = $this->getContactId($input['uid']);
        //if the user has already an entry in the db, add the contact details
       
        $stars_from_page = json_decode($input['details']);
     

        // foreach ($stars_from_page as $info){
        //      //check first if the panel is already in the db
        //     $star_from_db = UsersContactsDetails::where('contact_id', $contactId)->where('email',  $info[1])->first();
        //     var_dump($star_from_db);
        //      //add as new entry if not yet in the db
        //     //  if((!$panel_from_db || $panel_from_db === null) && $flowers != 0){
        //     //      $panel_data = new UserPanelFlowers();
        //     //      $panel_data->design_id = $design_id;
        //     //      $panel_data->panel_number = $panel; 
        //     //      $panel_data->flowers_used = implode(",",$flowers); 
        //     //      $panel_data->save();
        //     //  }else{
        //     //      //if the panel dont have any flowers on it, delete it from db
        //     //      if ($flowers == 0) {
        //     //          $panel = UserPanelFlowers::where('design_id', $design_id)->where('panel_number',  $panel)->first();
        //     //          if($panel) $panel->delete();
        //     //      }else{ //update the list of flowers in db
        //     //          UserPanelFlowers::where('design_id', $design_id)->where('panel_number',  $panel)->update(['flowers_used'=>implode(",",$flowers)]);
        //     //      }
             
                 
        //     //  }
        // }

    






        //save data to storage
        if(array_key_exists('savePath', $input)) {
            $saved_contacts = $this->saveState($input['babylonFile'],$input['savePath']);
        }

        if(array_key_exists('details', $input)) {
            $this->addContactDetails($contactId, $input['details']);
        }
        

          
            return true;
        // }

        // throw new GeneralException(trans('exceptions.backend.blogs.create_error'));
    }

    public function getContactId($user_id)
    {
        $contact_id = UserContacts::where('user_id', $user_id)->first()->id;

        return $contact_id;
    }

    public function addContactDetails($contact_id, $input)
    {
        
        $stars_from_page = json_decode($input,true);
        // var_dump($data);
    
        // $data = UsersContactsDetails::where('contact_id', $contact_id)->first();
        
        // else{
        //     UsersContactsDetails::where('contact_id', $contact_id)->delete();
        // }

        foreach ( $stars_from_page as $info ){  
            $data = UsersContactsDetails::where('contact_id', $contact_id)->where('email',  $info[1])->first();
            if(!$data || $data == null) {
                //if the contact is not yet in the db
                $details = new UsersContactsDetails();
                $details->contact_id = $contact_id;
                $details->name = $info[0];
                $details->email = $info[1];
                $details->mobile_number = $info[2];
                $details->alias = $info[3];
                $details->planet = $info[4];
                $details->save();
            }else{
                //if the contact is already in the db, update contact info
                UsersContactsDetails::where('contact_id', $contact_id)->where('email',  $info[1])->update(
                    [   'name'=>$info[0], 
                        'mobile_number'=>$info[2],
                        'alias'=>$info[3], 
                        'planet'=>$info[4], 
                    ]
                );
            }
            
        }
        
    }

    public function saveState($babylon, $savePath)
    {
      
        $babylonFile = $babylon;
        $filename = $savePath;

        $isExisting = $this->storage->exists($filename);
        if($isExisting) $this->deleteSavedState($filename);

        if (isset($babylonFile) && !empty($babylonFile)) {
            $this->storage->put($this->upload_path.$filename, $babylonFile);
            return true;
        }else{
            return false;
        }
    
    }

    public function loadState($filename)
    {
       
        $isExisting = $this->storage->exists($this->upload_path.$filename);

        if ($isExisting) return true;
        else return false;
    
    }

    public function deleteSavedState($filename)
    {
        return $this->storage->delete($this->upload_path.$filename);
    }

}
