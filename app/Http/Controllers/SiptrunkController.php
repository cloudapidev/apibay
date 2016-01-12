<?php
namespace App\Http\Controllers;
class SiptrunkController extends Controller
{
	
	public function  index()
	{
		return view('siptrunk/siptrunk',array(
				"active"=>"menu_siptrunk , menu_siptrunk_listing",
				"pagetitle"=>"Sip Trunk Listing")
		);
	}
	public function add()
	{
		return view('siptrunk/newsiptrunk',array(
				"active"=>"menu_siptrunk , menu_siptrunk_new",
				"pagetitle"=>"Create SIP Trunk")
		);
	}
	public function edit($id)
	{
		$data = @getData("siptrunk-listing",$id);
		return view('siptrunk/newsiptrunk',array(
				"active"=>"menu_siptrunk , menu_siptrunk_new",
				"pagetitle"=>"Manage SIP Trunk",
				'data'=>$data
		)
		);
		
	}
	
	
}