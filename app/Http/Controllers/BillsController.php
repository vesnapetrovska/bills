<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Bills;

class BillsController extends Controller
{
  public function __construct()
  {
      $this->middleware('role');
  }
    public function index()
    {
      $user = Auth::user();
      $bills = Bills::where('user_id', $user->id)->get();


      return view('bills.index')->with('bills', $bills);

    }
}
