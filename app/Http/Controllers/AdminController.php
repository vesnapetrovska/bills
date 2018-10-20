<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin')->with('users', $users);
    }

    public function makeAdmin($id)
    {
        $user = User::find($id);
        $user->role_id = 2;
        $user->save();
        return redirect()->route('admin');
    }
}
//maximilian nesho germanec role badge-secondary
