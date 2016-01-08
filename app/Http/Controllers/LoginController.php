<?php namespace App\Http\Controllers;

class LoginController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	|
	*/



	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('login');
	}
	
	public function store()
	{
		echo "a";
	}
	
	
}
