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
		$id=isset($_GET['id'])&& !empty($_GET['id'])?$_GET['id']:1;
		$data=getData("serverapp-listing",$id);
		
		$array = array();
		$array["Singapore"] = "+65";
		$array["Malaysia"] = "+60";
		$array["China"] = "+86";
		$array["India"]= "+91";
		return view('clientapps/newclientapp',array(
				"active"=>"menu_clientapp , menu_clientapp_new",
				"pagetitle"=>"Manage Client App",
				'data'=>$data,
				'array'=>$array
		)
		);
	}
}