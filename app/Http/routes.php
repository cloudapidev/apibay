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
    

	Route::get('/index.php', 'HomeController@index');
	Route::get('/', 'HomeController@index');

	//Login
	Route::resource('login', 'LoginController');

	//Number
	Route::resource('numbers/buy', 'NumbersController@buy');
	Route::resource('numbers', 'NumbersController');
	
	//User
	Route::get('users','UsersController@index');
	Route::get('users/add','UsersController@create');
	
	//Serverapps
	Route::get('serverapps','ServerappsController@index');
	Route::get('serverapps/add','ServerappsController@create');
	
	//Clientapps
	Route::get('clientapps','ClientappsController@index');
	Route::get('clientapps/add','ClientappsController@create');

	//Pricing
	Route::get('pricing','PricingController@index');
	
	//Extras
	Route::get('callout','ExtrasController@callout');
	Route::get('sendsms','ExtrasController@sendsms');
	
	//Billing
	Route::get('calllogs','BillingController@calllogs');
	Route::get('smslogs','BillingController@smslogs');
	Route::get('statements','BillingController@statements');
	Route::get('topup','BillingController@topup');
	
	//Settings
	Route::get('account','SettingsController@account');
	Route::get('siptrunk','SettingsController@siptrunk');
	Route::get('channel','SettingsController@channel');
	
	//System
	Route::get('managenumber','SystemController@managenumber');
	Route::get('manageaccount','SystemController@manageaccount');
	Route::get('manageadmin','SystemController@manageadmin');
	Route::get('managecountry','SystemController@managecountry');
	Route::get('managetopup','SystemController@managetopup');
	Route::get('managesiptrunk','SystemController@managesiptrunk');
	Route::get('managerate','SystemController@managerate');
	
	//Documentation
	Route::resource('documentation', 'DocumentationController');


});
