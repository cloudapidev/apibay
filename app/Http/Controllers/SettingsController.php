<?php
namespace App\Http\Controllers;
class SettingsController extends Controller
{
	public function account()
	{
		return view('settings/account',array(
				"active"=>"menu_setting , menu_account",
				"pagetitle"=>"My Account")
				);
		
	}

	public function channel()
	{
		
		return view('settings/channel',array(
				"active"=>"menu_setting , menu_channel_listing",
				"pagetitle"=>"Channel Listing"
		)
		); 
	}
	
}