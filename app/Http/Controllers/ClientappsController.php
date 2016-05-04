<?php
namespace App\Http\Controllers;
use App\Libraries\Classes\Ossbss;
use Illuminate\Http\Request;
use Validator;
use Log;
class ClientappsController extends Controller
{
	public function index()
	{
		return view('clientapps/listing',array(
				"active"=>"menu_clientapp , menu_clientapp_listing",
				"pagetitle"=>"Client App Listing")
				);
		
	}
	public function add()
	{

		return view('clientapps/newclientapp',array(
				"active"=>"menu_clientapp , menu_clientapp_new",
				"pagetitle"=>"Manage Client App",

		)
		);
	}

	/**
	 * create client app
	 * @param Request $request
	 * @return string
	 */
	public function create(Request $request)
	{
		$inputs=$request->except("_token");
		Log::info($inputs);
		$ossbss=new Ossbss();
		$response=$ossbss->postInfo("clientApps.create",$inputs);
		Log::info(json_encode($response));
		return json_encode($response);
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
	public  function getTable()
	{
		$draw = $_GET['draw'];
		$start = $_GET['start'];//从多少开始
		$length = $_GET['length'];//数据长度
		//总记录数 必要
		$recordsTotal = 0;


		$list=json_decode($this->showList());
		$data=isset($list->data)?$list->data:null;

	}
	public function showList()
	{
		$ossbss=new Ossbss();
		$start=$_GET['start'];
		$length=$_GET['length'];
		$inputs['offset']=0;
		$inputs['limit']=10;

		$result=$ossbss->getInfo('clientApps.showList',$inputs);


		$result=unsetParam($result,"msg");
		return json_encode($result);

	}
}