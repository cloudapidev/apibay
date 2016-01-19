<?php
use Psr\Http\Message\ServerRequestInterface;
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
    

	//Login
	Route::resource('login', 'LoginController');
	Route::resource('register', 'LoginController@register');
	Route::post('postregister', 'LoginController@postregister');

	//Home
	Route::get('/index.php', 'HomeController@index');
	Route::get('/', 'HomeController@index');

	//Number
	Route::get('numbers', 'NumbersController@index');
	Route::get('numbers/buy', 'NumbersController@buy');
	Route::get('numbers/edit/{id}', 'NumbersController@edit');
	
	//User
	Route::get('users','UsersController@index');
	Route::get('users/add','UsersController@create');
	Route::get('users/edit/{id}','UsersController@edit');
	
	//Serverapps
	Route::get('serverapps','ServerappsController@index');
	Route::get('serverapps/add','ServerappsController@create');
	Route::get('serverapps/edit/{id}','ServerappsController@edit');
	
	//Clientapps
	Route::get('clientapps','ClientappsController@index');
	Route::get('clientapps/add','ClientappsController@create');
	Route::get('clientapps/edit','ClientappsController@edit');

	//Siptrunk
	Route::get('siptrunk','SiptrunkController@index');
	Route::get('siptrunk/add','SiptrunkController@add');
	Route::get('siptrunk/edit/{id}','SiptrunkController@edit');
	
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
