<?php
namespace App\Http\Controllers;
class ExtrasController extends Controller
{
	public function callout()
	{
		return view('extras/callout',array(
				"active"=>"menu_extra , menu_extra_call",
				"pagetitle"=>"Make a call")
				);
		
	}
	public function  sendsms()
	{
		return view('extras/sendsms',array(
				"active"=>"menu_extra , menu_extra_sms",
				"pagetitle"=>"Send a sms")
		);
	}
}