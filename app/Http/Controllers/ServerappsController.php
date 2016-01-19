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
	/**
	 * show the create page.
	 * @return view
	 */
	public function create()
	{
		return view('serverapps/newserverapp',array(
				"active"=>"menu_serverapp , menu_serverapp_new",
				"pagetitle"=>"Create Server App",
		)
		);
	}
	/**
	 * show the edit page
	 * @param string $id
	 * @return view
	 */
	public function edit($id)
	{
		$data=getData("serverapp-listing",$id);
		return view('serverapps/newserverapp',array(
				"active"=>"menu_serverapp , menu_serverapp_edit",
				"pagetitle"=>"Manage Server App",
				"edit"=>true,
				'id'=>$id,
				'data'=>$data
		)
		);
	}
}