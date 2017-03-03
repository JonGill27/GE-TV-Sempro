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

	$videos = DB::table('videos')->get();

    return view('home', compact('videos'));
});

Route::get('/category/{category}', function ($category) {

	$videos = DB::table('videos')->where('category', $category)->get();

    return view('home', compact('videos'));
});

Route::get('/admin', function () {
	
    return view('admin');
});
