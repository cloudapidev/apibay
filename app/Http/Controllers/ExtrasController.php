<?php
namespace App\Http\Controllers;
class ExtrasController extends Controller
{
	public function callout()
	{
		return view('extras/callout',array(
				"active"=>"menu_serverapp , menu_serverapp_listing",
				"pagetitle"=>"Server App Listing")
				);
		
	}
	public function  sendsms()
	{
		return view('extras/sendsms',array(
				"active"=>"menu_serverapp , menu_serverapp_listing",
				"pagetitle"=>"Server App Listing")
		);
	}
}