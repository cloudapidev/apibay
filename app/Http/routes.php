<?php
// use Psr\Http\Message\ServerRequestInterface;
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


/* 	//Number
	Route::get('numbers/{page?}', 'NumbersController@index');
	Route::get('numbers/buy', 'NumbersController@buy');
	Route::get('numbers/edit/{id}', 'NumbersController@edit');
	
	//User
	Route::get('users','UsersController@index');
	Route::get('users/add','UsersController@create');
	Route::get('users/edit/{id}','UsersController@edit'); */
	
	Route::group(['middleware' => ['web']], function () {
	
		//Login
		Route::get('login', 'Auth\AuthController@getLogin');
		Route::post('/postlogin', 'Auth\AuthController@postLogin');
		Route::get('/logout', 'Auth\AuthController@getLogout');
		Route::get('/register', 'Auth\AuthController@getRegister');
		Route::post('/postregister', 'Auth\AuthController@postRegister');
			
		//Home
// 		 Route::get('/index.php', 'HomeController@index');
		 Route::get('/', 'HomeController@index');  

		//Number
		Route::get('numbers', 'NumbersController@index');
		Route::get('numbers/get', 'NumbersController@getTable');
		Route::post('numbers/search', 'NumbersController@searchNumbers');
		Route::get('numbers/list/{page}', 'NumbersController@getNumberList');
		
		Route::get('numbers/buy', 'NumbersController@buy');
		Route::post('numbers/sbuy', 'NumbersController@buySearch');
		Route::get('numbers/selected/{number}', 'NumbersController@setNumberSelected');
		Route::get('numbers/selectedlist', 'NumbersController@showSelectedNumbers');
		Route::get('numbers/remove/{number}', 'NumbersController@removeSelectedNumber');
		Route::post('numbers/purchase', 'NumbersController@comfirmPurchase');

		Route::get('numbers/edit/{number}', 'NumbersController@edit'); 
		Route::get('numbers/release/{number}/{type}', 'NumbersController@release');
		Route::post('numbers/release', 'NumbersController@releaseNum');
		Route::post('numbers/save', 'NumbersController@saveConfig');
		
		//User
		Route::get('users','UsersController@index');
		Route::get('users/add','UsersController@create');
		Route::get('users/edit/{id}','UsersController@edit');
		Route::get('users/get','UsersController@getTable');

		//Serverapps
		Route::get('serverapps','ServerappsController@index');
		Route::get('serverapps/add','ServerappsController@add');
		Route::post('serverapps/create','ServerappsController@create');
		Route::post('serverapps/update','ServerappsController@update');
		Route::get('serverapps/edit/{id}','ServerappsController@edit');
		Route::get('serverapps/get','ServerappsController@getTable');
		Route::get('serverapps/getnum','ServerappsController@getNum');
		Route::get('serverapps/remove','ServerappsController@removeApp');

		
		//Clientapps
		Route::get('clientapps','ClientappsController@index');
		Route::get('clientapps/add','ClientappsController@add');
		Route::post('clientapps/create','ClientappsController@create');
		Route::get('clientapps/edit','ClientappsController@edit');
		Route::get('clientapps/get','ClientappsController@getTable');

		//Siptrunk
		Route::get('siptrunk','SiptrunkController@index');
		Route::get('siptrunk/get','SiptrunkController@getTable');


		Route::get('siptrunk/add','SiptrunkController@add');
		Route::get('siptrunk/edit/{id}','SiptrunkController@edit');

		Route::post('siptrunk/search','SiptrunkController@searchTrunks');
		Route::post('siptrunk/create','SiptrunkController@create');
		Route::post('siptrunk/saveInfo','SiptrunkController@saveInfo');
		Route::post('siptrunk/searchNum','SiptrunkController@searchNum');
		Route::get('siptrunk/getNumTable','SiptrunkController@getNumTable');
		Route::post('siptrunk/assignedNum','SiptrunkController@assignedSelectedNum');
		Route::get('siptrunk/assignedNumlist/{sipTrunkId}','SiptrunkController@showAssignedSelectedNum');
		Route::post('siptrunk/deleteAssignedNum','SiptrunkController@deleteAssignedNum');

		 //auth
		Route::post('siptrunk/createauth','SiptrunkController@createAndAddAuthentication');

		Route::post('siptrunk/addtoauthlist','SiptrunkController@addToAuthList');
		Route::get('siptrunk/removeAuth/{sipTrunkId}/{sipTrunkAuthId}','SiptrunkController@removeAuthentication');
		Route::post('siptrunk/editeauth/{authId}','SiptrunkController@editAuthentication');
		Route::get('siptrunk/getauth/{authId}','SiptrunkController@getAuthentication');
		Route::get('siptrunk/selectedauthlist/{sipTrunkId}','SiptrunkController@showSelectedAuthList');
		Route::get('siptrunk/allauthlist','SiptrunkController@showAllAuthList');
		 //ip Access
		Route::get('siptrunk/removeip/{sipTrunkId}/{sipTrunkIpId}','SiptrunkController@removeIpAccess');
		Route::post('siptrunk/createTrunkIp','SiptrunkController@createIpAndAddIpToTrunks');
		Route::get('siptrunk/selectediplist','SiptrunkController@showSelectedIpAccessList');
		Route::get('siptrunk/alliplist','SiptrunkController@showAllIpAccessList');
		Route::post('siptrunk/editip/{id}','SiptrunkController@editIpAcess');
		Route::post('siptrunk/addtoiplist','SiptrunkController@addToIpList');
		
		 //orgination
		Route::post('siptrunk/createorigin','SiptrunkController@createOrigination');
		Route::post('siptrunk/editorigin/{trunkId}','SiptrunkController@editOrigination');
		
		
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

		//Test
		Route::resource('test','NewoneController');
		Route::resource('newone/edit','NewoneController@edit');

		//Test2
		Route::resource('test2','TestController@index');





});
