<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    // Private user dashboard (redirect here on login)
    public function index()
    {
        return view('profile.index');
    }

    // Public user profile information
    public function show($id) 
    {
        $user = User::find($id);

        return view('profile.show', compact('user'));
    }
}
