<?php

namespace App\Http\Controllers\Frontend\User;

use Auth;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use App\Models\Game\UserDesignPanel;
use App\Models\Game\UserPanelFlowers;

use App\Repositories\Frontend\Game\GameRepository;
use App\Models\Access\User\Traits\Attribute\UserAttribute;

class GameController extends Controller
{
    //
    protected $game;

   
    public function __construct(GameRepository $game)
    {
        $this->game = $game;
    }


    public function showInstructions()
    {
        $userPhoto = Auth::user()->getProfilePicture();
        $userGender = Auth::user()->getGender();
       // dd($userGender);
        //return User::all();
        return view('frontend.user.instructions',["photo"=>$userPhoto, "gender"=>$userGender]);
    }

    function list(){
        return User::all();
    }

    public function showDesignPanelScene(){
        $userId = Auth::user()->id;
        $user_design_data = UserDesignPanel::where('user_id', $userId)->first();

        $design_id = UserDesignPanel::where('user_id', $userId)->first();
        if($design_id) $design_id = $design_id->id;
        $panels_from_db = UserPanelFlowers::where('design_id', $design_id)->pluck('panel_number')->toArray();
      

        $load_game = false;
        $filename = null;
        if(!$user_design_data|| $user_design_data === null){
            $filename = null;
        }else{
            $filename = $user_design_data->saved_panel_url;
            $load_game = $this->game->loadState($filename);
        }
        return view('frontend.game.designPanel',["userId"=>$userId, "filename"=>$filename, "has_load_game"=>$load_game,"user_panels"=> implode(",",$panels_from_db)]);
    }

    public function storeDesignPanel(Request $req){
        // dd($req);
        //store the 3d designed meshes to storage and to database
        $data = UserDesignPanel::where('user_id', $req->uid)->first();
        if(!$data || $data == null) {
            $data = new UserDesignPanel();
        }
        $saved_game = $this->game->saveState($req->except('_token'));
       
        $data->user_id = $req->uid; 
        $data->saved_panel_url = $req->designPath;
        $data->save();

        //check if designed panels of the user is in the db
        $design_id = UserDesignPanel::where('user_id', $req->uid)->first();
        if($design_id) $design_id = $design_id->id;

        //the flowers list from the page
        $panels_from_page = $req->flowersList;
    
        
        //if there's a list from the page
        if( $panels_from_page != null || $panels_from_page !='' ){
            //for each panel designed
            foreach ($panels_from_page as $panel=>$flowers){
                
                //check first if the panel is already in the db
                $panel_from_db = UserPanelFlowers::where('design_id', $design_id)->where('panel_number',  $panel)->first();
                //add as new entry if not yet in the db
                if((!$panel_from_db || $panel_from_db === null) && $flowers != 0){
                    $panel_data = new UserPanelFlowers();
                    $panel_data->design_id = $design_id;
                    $panel_data->panel_number = $panel; 
                    $panel_data->flowers_used = implode(",",$flowers); 
                    $panel_data->save();
                }else{
                    //if the panel dont have any flowers on it, delete it from db
                    if ($flowers == 0) {
                        $panel = UserPanelFlowers::where('design_id', $design_id)->where('panel_number',  $panel)->first();
                        if($panel) $panel->delete();
                    }else{ //update the list of flowers in db
                        UserPanelFlowers::where('design_id', $design_id)->where('panel_number',  $panel)->update(['flowers_used'=>implode(",",$flowers)]);
                    }
                    //else update the flowers list of this panel
                    // $sz = count($flowers);
                    // if($sz === 0 ) $flowers = "";
                    // else $flowers = implode(",",$flowers);
                    
                }
            }//end of foreach
        }


        if($data->user_id == $req->uid && $saved_game) {
            return array('status' => 'success', 'message' => 'Game progress saved successfully!', 'data' => "");
        }else{
            return array('status' => 'failed', 'message' => 'Error in saving the game progress!', 'data' => "");
        }
    }

    
}
