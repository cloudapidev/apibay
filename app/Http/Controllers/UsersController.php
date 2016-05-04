<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Classes\Ossbss;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http;
use Log;
class UsersController extends Controller
{
	
	/**
	 * @return Ambigous <\Illuminate\View\View, \Illuminate\Contracts\View\Factory>
	 */
	public function index()
	{
		return view("users/listing",array(
				"active"=>"menu_user , menu_user_listing",
				"pagetitle"=>"Users Listing"
		)
		); 
	}
	public function create()
	{
// 		$data = getData("user-listing");
		return view("users/newuser",array(
				"active"=>"menu_user , menu_user_new",
				"pagetitle"=>"Create  User",
// 				'data'=>$data
		)
		);
	}
	public function edit($id)
	{
		$data = getData("user-listing",$id);
		return view("users/newuser",array(
				"active"=>"menu_user , menu_user_new",
				"pagetitle"=>"Create  User",
				'data'=>$data
		)
		);
	}
	/*get  tableInfo for Datatables
	@return string
	*/
	public function getTable()
	{
		$draw = $_GET['draw'];
		$start = $_GET['start'];//从多少开始
		$length = $_GET['length'];//数据长度
		$recordsTotal = 0;
		$list=json_decode($this->showList());
	}
	public function showList()
	{
		$ossbss=new Ossbss();
		$start=$_GET['start'];
		$length=$_GET['length'];
		$inputs['offset']=$start;
		$inputs['limit']=$length;
		$result=$ossbss->getInfo('',$inputs);
		$result=unsetParam($result,"msg");
		return json_encode($result);
	}
}
