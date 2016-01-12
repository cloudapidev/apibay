<?php
namespace App\Http\Controllers;
class BillingController extends Controller
{
	public function calllogs()
	{
		return view('billing/calllogs',array(
				"active"=>"menu_serverapp , menu_serverapp_listing",
				"pagetitle"=>"Server App Listing")
				);
		
	}
	public function  smslogs()
	{
		return view('extras/sendsms',array(
				"active"=>"menu_serverapp , menu_serverapp_listing",
				"pagetitle"=>"Server App Listing")
		);
	}
	public function statements()
	{
		return view('extras/sendsms',array(
				"active"=>"menu_serverapp , menu_serverapp_listing",
				"pagetitle"=>"Server App Listing")
		);
	}
	public function topup()
	{
		return view('extras/sendsms',array(
				"active"=>"menu_serverapp , menu_serverapp_listing",
				"pagetitle"=>"Server App Listing")
		);
	}
}