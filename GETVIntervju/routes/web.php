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

	$videos = DB::table('videos')->paginate(9);

    return view('home', compact('videos', 'categories'));
});

Route::get('/category/{category}', function ($category) {

	$categories = DB::table('videos')->distinct()->pluck('category');

	$videos = DB::table('videos')->where('category', $category)->paginate(9);

    return view('home', compact('videos', 'categories'));
});

Route::get('/admin', function () {
	
    return view('admin');
});
