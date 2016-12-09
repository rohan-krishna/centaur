<?php

namespace centaur\Http\Controllers;

use Illuminate\Http\Request;

use centaur\Notebook;

class HomeController extends Controller
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
    public function index()
    {
        $notebooks = Notebook::all();
        return view('home',compact('notebooks'));
    }
}
