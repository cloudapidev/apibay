<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home',array(
		"active"=>"dashboard",
		"pagetitle"=>"Dashboard"
	));
});



Route::get('documentation/{sec}', function ($sec) {

	if($sec == "phonenumber"){
		$active = "menu_documentation , menu_documentation_phonenumber";
		$pagetitle = "Phone Number - REST API & SDK";
	}

	if($sec == "serverapp"){
		$active = "menu_documentation , menu_documentation_serverapp";
		$pagetitle = "Server Apps - REST API & SDK";
	}

	if($sec == "clientapp"){
		$active = "menu_documentation , menu_documentation_clientapp";
		$pagetitle = "Client Apps - REST API & SDK";
	}

	if($sec == "billing"){
		$active = "menu_documentation , menu_documentation_billing";
		$pagetitle = "Billing & Reports - REST API & SDK";
	}

	if($sec == "setting"){
		$active = "menu_documentation , menu_documentation_setting";
		$pagetitle = "Settings - REST API & SDK";
	}

	return view('documentation.page',array(
		"sec"=>$sec,
		"active"=>$active,
		"pagetitle"=>$pagetitle
	));
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
