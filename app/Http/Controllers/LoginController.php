<?php namespace App\Http\Controllers;



use Redirect;
use Response;
use Session;

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


	//store
	public function store()
	{
		Session::set('variableName', "aaa");
		

        return redirect()->action('HomeController@index')->with("success","value");
	}

}
