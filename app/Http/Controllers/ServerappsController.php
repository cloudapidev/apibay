<?php
namespace App\Http\Controllers;
class ServerappsController extends Controller
{
	public function index()
	{
		return view('serverapps/listing',array(
				"active"=>"menu_serverapp , menu_serverapp_listing",
				"pagetitle"=>"Server App Listing")
				);
		
	}
	public function create()
	{
		$id=isset($_GET['id'])&& !empty($_GET['id'])?$_GET['id']:1;
		$data=getData("serverapp-listing",$id);
		return view('serverapps/newserverapp',array(
				"active"=>"menu_serverapp , menu_serverapp_new",
				"pagetitle"=>"Manage Server App",
				'data'=>$data
		)
		);
	}
}