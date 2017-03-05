<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;

class AdminController extends Controller
{	
	public function addVideo(){

		$message = "";

		return view('addvideo', compact('message'));
	}


	public function addVideotoDB(Request $request) {

		$name = $request->input('name');
		$description = $request->input('description');
		$url = $request->input('url');
		$category = $request->input('category');
		$year = $request->input('year');

		$video = new Video;
		$video->name = $name;
		$video->description = $description;
		$video->url = $url;
		$video->category = $category;
		$video->year = $year;
		$video->save();

		$message = "Video lagt til";

		return view('addvideo', compact('message'));
	}
}
