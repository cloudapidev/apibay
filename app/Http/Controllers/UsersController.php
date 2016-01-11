<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http;
class UsersController extends Controller
{
	
	/**
	 * @return Ambigous <\Illuminate\View\View, \Illuminate\Contracts\View\Factory>
	 */
	function index()
	{
		return view("users/listing",array(
				"active"=>"menu_user , menu_user_listing",
				"pagetitle"=>"Users Listing"
		)
		); 
	}
	function create()
	{
		$data = getData("user-listing");
		return view("users/newuser",array(
				"active"=>"menu_user , menu_user_new",
				"pagetitle"=>"Create  User",
				'data'=>$data
		)
		);
	}
}
