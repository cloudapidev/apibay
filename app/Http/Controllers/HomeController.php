<?php namespace App\Http\Controllers;

use Redirect;
use Response;
use Session;
use Illuminate\Http\Request;
use App\Libraries\Classes\Mycurl;
use App\Libraries\Classes\Telapi;
use Illuminate\Http\Illuminate\Http;
use App\Libraries\Classes\Telaapi;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	/*
	public function __construct()
	{
		$this->middleware('auth');
	}*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		/* $tela=new Telaapi();
		$listData=$tela->getListData();
		var_dump($listData); */
		 return view('home',array(
			"active"=>"dashboard",
			"pagetitle"=>"Dashboard"
		)); 
	}

}
