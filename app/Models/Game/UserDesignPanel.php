<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;

class UserDesignPanel extends Model
{
      public $timestamps = true;
      protected $table = 'game_user_design';

      public function panelFlowers()
      {
            return $this->hasMany('App\Models\Game\UserPanelFlowers', 'design_id');
      }
}
