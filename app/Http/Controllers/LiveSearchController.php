<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Todo;
use App\Crud;
class LiveSearchController extends Controller
{
        public function index()
    {
      $data = Todo::paginate(3);
     return view('livesearch',compact('data'));
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('cruds')
         ->where('name', 'like', '%'.$query.'%')
         ->orWhere('description', 'like', '%'.$query.'%')
         ->orWhere('address', 'like', '%'.$query.'%')->get();

         
      }
      else
      {
        
       $data = DB::table('cruds')
         ->orderBy('name', 'desc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->name.'</td>
         <td>'.$row->description.'</td>
         <td>'.$row->address.'</td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
      );

      echo json_encode($data);
     }
    }

}
