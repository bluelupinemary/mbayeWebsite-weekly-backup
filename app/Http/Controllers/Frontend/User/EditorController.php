<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    public function index(Request $request)
    {
      $user = Auth::user();
      return view('frontend.user.image-editor',compact('user'));
    }
}
