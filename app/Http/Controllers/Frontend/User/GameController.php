<?php

namespace App\Http\Controllers\Frontend\User;

use Auth;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use App\Models\Game\UserDesignPanel;

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
        $load_game = false;
        $filename = null;
        if(!$user_design_data|| $user_design_data === null){
            $filename = null;
        }else{
            $filename = $user_design_data->saved_panel_url;
            $load_game = $this->game->loadState($filename);
        }
       
        return view('frontend.game.designPanel',["userId"=>$userId, "filename"=>$filename, "has_load_game"=>$load_game]);
    }

    public function storeDesignPanel(Request $req){
        // dd($req);
        $data = UserDesignPanel::where('user_id', $req->uid)->first();
        if(!$data || $data == null) {
            $data = new UserDesignPanel();
        }
        $saved_game = $this->game->saveState($req->except('_token'));
       
        $data->user_id = $req->uid; 
        $data->saved_panel_url = $req->designPath;
        $data->save();

        if($data->user_id == $req->uid && $saved_game) {
            return array('status' => 'success', 'message' => 'Game progress saved successfully!', 'data' => "");
        }else{
            return array('status' => 'failed', 'message' => 'Error in saving the game progress!', 'data' => "");
        }
    }

    
}
