<?php

namespace App\Http\Controllers\Frontend\User;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Access\User\User;

class StoryCareController extends Controller
{
    //
    public function index()
    {   
        return view('frontend.game.story_care');
    }
}
