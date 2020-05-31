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
      
        // $tagsArray = $this->createTags($input['tags']);
        // unset($input['tags']);
        

        $data = UserContacts::where('user_id', $input['uid'])->first();
        if(!$data || $data == null) {
            $data = new UserContacts();
        }

       
        $data->user_id = $input['uid']; 
        $data->save_path = $input['savePath'];
        $data->save();

        $contactId = $this->getContactId($input['uid']);
       

        // $question = Question::create($request->except('answer_content'));

        // $data2 = UsersContactsDetails::create([
        //         'contact_id' => $question->id, // Don't forget to set the fillable fields in the Answer model, and include question_id with them
        //         'content' => $request->answer_content,
        //         'correct' => true
        // ]);

        // $input['content'] = $this->replaceContentFileLocation($input['content']);
        // $input['slug'] = Str::slug($input['name']);
        // $input['publish_datetime'] = ($input['status'] == 'Published' ? Carbon::now() : null);
        // $input['created_by'] = access()->user()->id;

        if(array_key_exists('savePath', $input)) {
            $saved_contacts = $this->saveState($input['babylonFile'],$input['savePath']);
        }

        if(array_key_exists('details', $input)) {
            $this->addContactDetails($contactId, $input['details']);
        }
        
        // if ($blog = Blog::create($input)) {
        //     // Inserting associated tag's id in mapper table
        //     if (count($tagsArray)) {
        //         $blog->tags()->sync($tagsArray);
        //     }

        //     // Inserting videos
        //     if(array_key_exists('videos', $input)) {
        //         $this->addVideos($blog->id, $input['videos']);
        //     }

        //     if($input['attachments'] != '[]') {
        //         $formatted_attachments = str_replace( array( '\'', '"', ';', '[', ']' ), '', $input['attachments']);
        //         $formatted_attachments = explode(',', $formatted_attachments);
        //         $this->backupBlogAttachments($formatted_attachments, $blog->id);

        //         if($blog->status == 'Published') {
        //             $this->deleteTrixAttachments($formatted_attachments);
        //         }
        //     }

          
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
        
        $json = json_decode($input,true);
        // var_dump($data);
    
        $data = UsersContactsDetails::where('contact_id', $contact_id)->first();
        if(!$data || $data == null) {
            
            $details = new UsersContactsDetails();
           
        }else{
            UsersContactsDetails::where('contact_id', $contact_id)->delete();
        }

        foreach ( $json as $item ){   
            $details->contact_id = $contact_id;
            $details->name = $item[0];
            $details->email = $item[1];
            $details->mobile_number = $item[2];
            $details->alias = $item[3];
            $details->planet = $item[4];
            $details->save();
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
