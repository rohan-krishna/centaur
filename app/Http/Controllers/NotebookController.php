<?php

namespace centaur\Http\Controllers;

use Illuminate\Http\Request;

use centaur\Notebook;

use Auth;

class NotebookController extends Controller
{
    //
    public function index()
    {
    	$notebooks = Notebook::all();
    	return view('notebooks.index',compact('notebooks'));
    }

    public function create()
    {
    	return view('notebooks.create');
    }

    public function edit($id)
    {
    	$notebook = Notebook::find($id);
    	return view('notebooks.edit',compact('notebook'));
    }

    public function update(Request $request,$id)
    {
    	$notebook = Notebook::find($id);

    	$notebook->title = $request->input('title');

    	$user = Auth::user();

    	$user->notebooks()->save($notebook);

    	return redirect('home');
    }

    public function store(Request $request)
    {
    	$user = Auth::user();

    	$notebook = new Notebook();

    	$notebook->title = $request->input('title');

    	$user->notebooks()->save($notebook);

    	return Notebook::all();
    }
}
