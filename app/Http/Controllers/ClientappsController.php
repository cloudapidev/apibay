<?php
namespace App\Http\Controllers;
class ClientappsController extends Controller
{
	public function index()
	{
		return view('clientapps/listing',array(
				"active"=>"menu_clientapp , menu_clientapp_listing",
				"pagetitle"=>"Client App Listing")
				);
		
	}
	public function create()
	{
		
		
		$array = array();
		$array["Singapore"] = "+65";
		$array["Malaysia"] = "+60";
		$array["China"] = "+86";
		$array["India"]= "+91";
		return view('clientapps/newclientapp',array(
				"active"=>"menu_clientapp , menu_clientapp_new",
				"pagetitle"=>"Manage Client App",
				'array'=>$array
		)
		);
	}
	public function edit()
	{
// 		$data=getData("serverapp-listing",$id);
		$array = array();
		$array["Singapore"] = "+65";
		$array["Malaysia"] = "+60";
		$array["China"] = "+86";
		$array["India"]= "+91";
		return view('clientapps/newclientapp',array(
				"active"=>"menu_clientapp , menu_clientapp_new",
				"pagetitle"=>"Manage Client App",
				'edit'=>true,
				'array'=>$array
		)
		);
	}
}