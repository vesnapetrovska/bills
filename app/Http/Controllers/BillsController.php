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

    public function create()
    {
      return view('bills.create');
    }
    public function store(Request $request)
    {
        $bill = new Bills;
        $bill->status = 1;
        $bill->user_id = $request->user_id;
        $bill->month = $request->month;
        $bill->price = $request->price;
        $bill->description = $request->description;
        $bill->save();

        return route('admin');
    }

    public function showPayForm($id)
    {
      $user = Auth::user();
      $bill = Bills::where('user_id', $user->id)->where('id', $id)->first();

      if($bill != null)
      {
        return view('bills.pay')->with('bill', $bill);
      }
      else
      {
          return response("Access Denied", 403);
      }
    }

    public function pay($id)
    {
      $user = Auth::user();
      $bill = Bills::where('user_id', $user->id)->where('id', $id)->first();
      $bill->status = 2;
      $bill->save();
      return view('home');
    }
}
