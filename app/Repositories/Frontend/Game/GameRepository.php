<?php

namespace App\Repositories\Frontend\Game;

use App\Models\Game\UserDesignPanel;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;

/**
 * Class GameRepository.
 */
class GameRepository extends BaseRepository
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
        $this->upload_path = 'saveState'.DIRECTORY_SEPARATOR.'designPanel'.DIRECTORY_SEPARATOR;
        $this->upload_path_screenshot = 'saveState'.DIRECTORY_SEPARATOR.'designPanel'.DIRECTORY_SEPARATOR.'screenshots'.DIRECTORY_SEPARATOR;
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
    public function saveState(array $input)
    {
        $avatar = $input['babylonFile'];
        $babylonFile = $input['babylonFile'];
        $filename = $input['designPath'];

        $isExisting = $this->storage->exists($filename);
        if($isExisting) $this->deleteSavedState($filename);

        if (isset($babylonFile) && !empty($babylonFile)) {
            $this->storage->put($this->upload_path.$filename, $babylonFile);
            return true;
        }else{
            return false;
        }
    
    }

    public function saveScreenshot($filename, $imgData)
    {
        $base64 = str_replace('data:image/png;base64,', '', $imgData);
        $base64 = str_replace(' ', '+', $base64);
        $image = base64_decode($base64);

      
        $filename = $filename.'.jpg';
     
        if (isset($image) && !empty($image)) {
            $this->storage->put($this->upload_path_screenshot.$filename, $image);
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
