<?php

use \Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $links = \App\Link::all();
	return view('welcome', ['links' => $links]);
	/* possible variants:
	// with()
	return view('welcome')->with('links', $links);

	// dynamic method to name the variable
	return view('welcome')->withLinks($links);
	*/
});

Route::get('/submit', function () {
    return view('submit');
});

Route::post('/submit', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'url' => 'required|url|max:255',
        'description' => 'required|max:255',
    ]);
	$link = tap(new App\Link($data))->save();
	/*	using tap() is shorter then 
	$link = new App\Link($data);
	$link->save();
	... and allows to use chains with methods, witch do not return initial object
	*/
    return redirect('/');
});


Route::get('users', function()
{
	// both ways work
    return View::make('users');
    // return view('users');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

