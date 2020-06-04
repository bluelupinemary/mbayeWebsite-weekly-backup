<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\DashboardViewRequest;
use App\Models\Access\User\User;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(DashboardViewRequest $request)
    {
        return view('frontend.user.dashboard');
    }

    public function viewUserDashboard($user_id)
    {
        $user = User::find($user_id);

        if($user) {
            return view('frontend.user.public_dashboard', compact('user'));
        }
    }
}
