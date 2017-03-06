<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

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
		$highlighted = $request->input('highlighted');

		if($description == null) {
			$description = "";
		}

		$rules = array(
			'name'             => 'required',                        
			'url'            => 'required|unique:videos',     
			'category'         => 'required',  
			'year'         => 'required|regex:[[0-9]{4}]',  
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {

			$messages = array(
				'required' => 'Dette feltet må fylles ut',
				'unique'  => 'Denne videoen finnes allerede i biblioteket',
				'year.regex' => 'Ugyldig årstall'
				);

			return Redirect::to('/admin/add')->withErrors($validator);

		} else {

			$video = new Video;
			$video->name = $name;
			$video->description = $description;
			$video->url = $url;
			$video->category = $category;
			$video->year = $year;

			if($highlighted != null) {

				DB::table('videos')->update(array('highlighted' => 0));
				$video->highlighted = 1;
			}
			else {
				$video->highlighted = 0;
			}

			$video->save();

			$message = "Video lagt til";

			return view('addvideo', compact('message'));
		}
	}

	public function editVideo($id) {

		$message = "";

		$video = DB::table('videos')->where('id', $id)->first();

		$highlighted = $video->highlighted;

		if ($highlighted === 1) {

			$highlighted = "checked";
		}
		else {
			$highlighted = "";
		}

		return view('editvideo', compact('video', 'message', 'highlighted'));
	}

	public function updateVideo(Request $request, $id) {

		$name = $request->input('name');
		$description = $request->input('description');
		$url = $request->input('url');
		$category = $request->input('category');
		$year = $request->input('year');
		$highlighted = $request->input('highlighted');

		if($description == null) {
			$description = "";
		}

		$video = new Video;	
		$video->exists = true;
		$video->id = $id;
		$video->name = $name;
		$video->description = $description;
		$video->url = $url;
		$video->category = $category;
		$video->year = $year;

		if($highlighted != null) {

			DB::table('videos')->update(array('highlighted' => 0));
			$video->highlighted = 1;
		}
		else {
			$video->highlighted = 0;
		}

		$video->save();

		$message = "Video endret";

		$videos = DB::table('videos')->get();

		return view('admin', compact('message', 'videos'));
	}

	public function deleteVideo($id) {

		DB::table('videos')->delete($id);

		$message = "Video slettet";

		$videos = DB::table('videos')->get();

		return view('admin', compact('videos', 'message'));
	}
}
