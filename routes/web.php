<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('notebooks','NotebookController');

Route::get('mailtest', function() {
	return \Mail::to("rohankrishna33@gmail.com")->send(new \centaur\Mail\TestMail());
});

Route::group(['prefix' => 'api'], function() {

	// Get Notebooks for the authenticated user
	Route::get('notebooks',function() {
		return Auth::user()->notebooks;
	});

	// Get notes for the authenticated user
	Route::get('allNotes', function() {
		return Auth::user()->notes;
	});

	// Get Notes from notebook
	Route::get('notes', function(Request $request) {

		// $user = Auth::user();
		$notebook = \centaur\Notebook::find($request->input('notebook'));

		return $notebook->notes;
	});

  // Update Notebook
  Route::post('notebook/{id}/edit', function(Request $request,$id) {

    $notebook = \centaur\Notebook::find($id);

    $notebook->title = $request->input('title');

    $user = Auth::user();


    $user->notebooks()->save($notebook);

  });

});
