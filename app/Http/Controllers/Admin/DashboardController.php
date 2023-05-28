<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        // access user data use auth but it must be imported first

        // $user = (Auth::user());
        // dd(Auth::id());
        // dd($user->userDetail?->address);


        return view('admin.dashboard');
    }
}
