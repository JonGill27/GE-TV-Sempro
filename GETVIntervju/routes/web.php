<?php

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

	$categories = DB::table('videos')->distinct()->pluck('category');

	$years = DB::table('videos')->distinct()->pluck('year');

	$videos = DB::table('videos')->where('highlighted', 0)->paginate(9);

	$highlighted = DB::table('videos')->where('highlighted', 1)->first();

	if ($highlighted != null && (!str_contains(Request::fullUrl(), '/?page=') || (str_contains(Request::fullUrl(), '/?page=1')))) {	

		return view('home', compact('videos', 'categories', 'years', 'message', 'highlighted'));
	} else {

		return view('home', compact('videos', 'categories', 'years', 'message'));
	}
});

Route::get('/category/{category}', function ($category) {

	$categories = DB::table('videos')->distinct()->pluck('category');

	$years = DB::table('videos')->distinct()->pluck('year');

	$videos = DB::table('videos')->where('category', $category)->paginate(9);

	$message = "Videoer i kategorien $category";

	return view('home', compact('videos', 'categories', 'years', 'message')); 
});

Route::get('/arkiv/{year}', function ($year) {

	$categories = DB::table('videos')->distinct()->where('year', $year)->pluck('category');

	$years = DB::table('videos')->distinct()->pluck('year');

	$videos = DB::table('videos')->where('year', $year)->paginate(9);

	$message = "Videoarkiv fra $year";

	return view('home', compact('videos', 'categories', 'years', 'message'));
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {

	Route::get('/admin', 'AdminController@admin');

	Route::get('/admin/add', 'AdminController@addVideo');

	Route::post('/admin/add','AdminController@addVideotoDB');

	Route::get('/admin/edit/{id}','AdminController@editVideo');

	Route::post('/admin/edit/{id}','AdminController@updateVideo');

	Route::get('/admin/delete/{id}', 'AdminController@deleteVideo');

	Route::get('/admin/changepassword','AdminController@changePassword');

	Route::post('/admin/changepassword','AdminController@updatePassword');
});

Route::get('/login', 'AdminController@login');

Route::post('/login','AdminController@AdminLogin');

Route::get('/logout', 'AdminController@logout');

