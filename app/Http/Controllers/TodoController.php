<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
class TodoController extends Controller
{
    public function index()
    {
      $tasks=Todo::paginate(3);
      return view('ajax.index',compact('tasks'));
    }
    public function create()
    {
    	return view('ajax.add');
    }
    public function save(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:10|max:20',
        ]);
    	$task=Todo::create($request->all());
    	$tasks=Todo::all();
      return view('ajax.index',compact('tasks'));
    }
    public function edit($id)
    {
    	$task=Todo::findOrFail($id);
    	return view('ajax.edit',compact('task'));
    }
    public function update(Request $request)
    {
         $this->validate($request,[
            'name'=>'required|min:10|max:20',
        ]);
    	$task=Todo::findOrFail($request->id);
    	$task->name=$request->name;
    	$task->save();
      $tasks=Todo::all();
      return view('ajax.index',compact('tasks'));
    }
    public function destroy($id)
    {
    	$task=Todo::findOrFail($id);
    	$task->delete();
      $tasks=Todo::all();
      return view('ajax.index',compact('tasks'));
    }
    public function search(Request $request)
    {
        $terms=Todo::where('name','LIKE',"%$request->term%")->pluck('name');
        if(empty($terms->all()))
        {
            return ['no record found'];
        }
        else
        {
            //return view('ajax.search')->with('Todos', json_decode($terms));

            //return view('ajax.search')->with('terms', json_decode($terms, true));
            return $terms;
            //return view('ajax.search',compact('terms'));
        }
    }
}
