<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crud;
use DB;
class CrudController extends Controller
{
    public function index()
    {
    	$crud=Crud::all();
    	return view('crud.index',compact('crud'));
    }
    public function store(Request $request)
    {
       $input=$request->all();
       $input['name']=$request->name;
       $input['description']=$request->description;
       $input['address']=$request->address;
       Crud::create($input);
      $crud=Crud::all();
      return view('crud.index',compact('crud'));
    }
    public function edit($id)
    {
        $crud=Crud::findOrFail($id);
        return view('crud.edit',compact('crud'));
    }
    public function update(Request $request)
    {
        $crud=Crud::findOrFail($request->id);
        $crud->name=$request->name;
        $crud->description=$request->description;
        $crud->address=$request->address;
        $crud->save();
        $crud=Crud::all();
      return view('crud.index',compact('crud'));
    }
    public function destroy($id)
    {
        $crud=Crud::findOrFail($id);
        $crud->delete();
      $crud=Crud::all();
      return view('crud.index',compact('crud'));
    }

     public function action(Request $request)
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
     // return redirect()->back();
        
       // $data = DB::table('cruds')
       //   ->orderBy('name', 'desc')
       //   ->get();
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
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }

}
