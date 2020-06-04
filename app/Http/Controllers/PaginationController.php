<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PaginationController extends Controller
{
   public function index()
    {
     $data = DB::table('todos')->paginate(2);
     return view('pagination', compact('data'));
    }

    public function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $data = DB::table('todos')->paginate(2);
      return view('pagination_data', compact('data'));
     }
    }
}
