<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Admin;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;

class AdminController extends Controller
{	

	public function login() { // Henter innloggingssiden

		return view('adminlogin');
	}

	public function AdminLogin(Request $request) { // Utfører innlogging og returnerer administratorsiden

		$rules = array(
			'email' => 'required|email', 
			'password' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {

			return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password')); 
		} else {

			$logindata = array(
				'email' => Input::get('email'),
				'password' => Input::get('password')
				);

			if (Auth::attempt($logindata)) {

				return Redirect::to('admin');

			} else {        

				return Redirect::to('login');
			}
		}
	}

	public function logout() { // Logger ut en innlogget administrator

		Auth::logout(); 
		return Redirect::to('');
	}

	public function addVideo() { // Henter legg til video siden

		return view('addvideo');
	}

	public function admin() { // Henter administratorsiden

		$videos = DB::table('videos')->get();

		return view('admin', compact('videos'));
	}

	public function addVideotoDB(Request $request) { // Utfører koden for å legge til en video til databasen

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
			'name' => 'required',                        
			'url' => 'required|unique:videos',     
			'category' => 'required',  
			'year' => 'required|regex:[[0-9]{4}]',  
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {

			$messages = array(
				'required' => 'Dette feltet må fylles ut',
				'unique'  => 'Denne videoen finnes allerede i biblioteket',
				'year.regex' => 'Ugyldig årstall'
				);

			return Redirect::back()->withInput()->withErrors($validator->messages());

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

	public function editVideo($id) { // Henter siden for å endre en gitt video

		$video = DB::table('videos')->where('id', $id)->first();

		$highlighted = $video->highlighted;

		if ($highlighted === 1) {

			$highlighted = "checked";
		}
		else {
			$highlighted = "";
		}

		return view('editvideo', compact('video', 'highlighted'));
	}

	public function updateVideo(Request $request, $id) { // Utfører endringen av en video og oppdaterer databasen

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
			'name' => 'required',                        
			'url' => 'required',     
			'category' => 'required',  
			'year' => 'required|regex:[[0-9]{4}]',  
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {

			$messages = array(
				'required' => 'Dette feltet må fylles ut',
				'unique'  => 'Denne videoen finnes allerede i biblioteket',
				'year.regex' => 'Ugyldig årstall'
				);

			return Redirect::back()->withInput()->withErrors($validator->messages());

		} else {

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

			return Redirect::to('/admin');
		}	
	}

	public function deleteVideo($id) { // Sletter en gitt video fra databasen

		DB::table('videos')->delete($id);

		$message = "Video slettet";

		$videos = DB::table('videos')->get();

		return Redirect::to('/admin');
	}

	public function changePassword(Request $request) { // Henter ut siden for passordendring

		return view('changepassword');
	}

	public function updatePassword() { // Utfører endringen av passordet til en admin og oppdaterer databasen

		// Endre passord i DB
	}

	// Glemt passord
}
