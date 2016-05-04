<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers;
use App\Libraries\Classes\Ossbss;
use Illuminate\Http\Request;
use Validator;
use Log;
class ServerappsController extends Controller
{
	protected $_perNums=10;
	public function index()
	{


		return view('serverapps/listing',array(
				"active"=>"menu_serverapp , menu_serverapp_listing",
				"pagetitle"=>"Server App Listing",
			  )
				);
		
	}
	public function getTable()
	{
		$draw = $_GET['draw'];
		$start = $_GET['start'];//从多少开始
		$length = $_GET['length'];//数据长度

		$list=json_decode($this->showList($start,$length));
		$paging=isset($list->paging)?$list->paging:null;

		$recordsTotal =$paging->total;

		$data=isset($list->data)?$list->data:null;
		$infos=$this->object_array($data);

		$datas = array();
		foreach($infos as $index =>$serverApps){
			$nserverApps = array();
			foreach($serverApps as $key=>$val)
			{
				$nserverApps['index']=$index+1;
				if($key=="name"){
					$nserverApps['name']=$val;
				}
				if($key=="create_on"){
					$nserverApps['create_on']=$val;
				}
				if($key=="description"){
					$nserverApps['description']=$val;
				}
				if($key=='id'){
					$nserverApps['edit']=$val;
				}
				if($key=='status'){
					$nserverApps['status']=$val;
				}


			}
			array_push($datas,$nserverApps);
		}
		//Log::info($datas);

		//Log::info($paging);
		//$recordsTotal =$paging->total;
		echo json_encode(
			array(
				"draw"=>intval($draw),
				"recordsTotal"=>intval($recordsTotal),
				"recordsFiltered"=>intval($recordsTotal),
				"data" => $datas
			),JSON_UNESCAPED_UNICODE
		);
	}
	/**show list page
	 * @return view
	 */
	public function showList($start=null,$length=null)
	{
		Log::info("offset".$start);

		Log::info($start);
		$inputs['offset']=$start;
		$inputs['limit']=$length;
		$ossbss=new Ossbss();
		$res=$ossbss->getInfo("serverApps.showList",$inputs);
		return json_encode($res);

	}

	/**
	 * show the create page.
	 * @return view
	 */
	public function add()
	{
		return view('serverapps/newserverapp',array(
				"active"=>"menu_serverapp , menu_serverapp_new",
				"pagetitle"=>"Create Server App",
			)
		);
	}

	public function create(Request $request)
	{

		$inputs=$request->except("_token");
		unset($inputs['uris']);
		$ossbss=new Ossbss();
		$response=$ossbss->postInfo("serverApps.createServerApp",$inputs);
		$result=unsetParam($response,'paging');
		Log::info(json_encode($result));
		return json_encode($result);
	}
	/**
	 * show the edit page
	 * @param string $id
	 * @return view
	 */
	public function edit($id)
	{
	/*	$authRes=json_decode($this->showAuthList($id));
		$authSelectedList=isset($authRes->data)?$authRes->data:null;*/
		$result=json_decode($this->showData($id));

		$result=isset($result->data)?$result->data:null;
		return view('serverapps/newserverapp',array(
				"active"=>"menu_serverapp , menu_serverapp_edit",
				"pagetitle"=>"Manage Server App",
				"edit"=>true,
				'id'=>$id,
				'data'=>$result
		)
		);
	}
	public function update(Request $request)
	{
		$inputs=$request->except("_token");

		$params[0]=$inputs['id'];
		unset($inputs['uris']);

		Log::info($inputs);

		$ossbss=new Ossbss();
		$result=$ossbss->putInfo('serverApps.editServerApp',$inputs,$params);
		Log::info($result);
		$result=unsetParam($result,"paging");

		return json_encode($result);

	}
	/**
	 * show the selected ServerApps
	 * @param string $id
	 * @return string
	 */
	public function showData($id)
	{

		$params[0]=$id;

		$inputs['id']=$id;
		$ossbss=new Ossbss();
		$result=$ossbss->getInfo('serverApps.editServerApp',$inputs,$params);
		$result=unsetParam($result,"msg");
		return json_encode($result);
	}



	public function getNum()
	{

		$draw = $_GET['draw'];
		$start = $_GET['start'];//从多少开始
		$length = $_GET['length'];//数据长度

		$list=json_decode($this->showList($start,$length));
		$paging=isset($list->paging)?$list->paging:null;

		$recordsTotal =$paging->total;

		$data=isset($list->data)?$list->data:null;
		$infos=$this->object_array($data);
		//Log::info($infos);
		$info=array();
		foreach($infos as $key=>$datas)
		{
			$info[$key]=$datas['sub_resources_urls'];
		}
		//Log::info($datas);

		//Log::info($paging);
		//$recordsTotal =$paging->total;
		echo json_encode(
			array(
				"draw"=>intval($draw),
				"recordsTotal"=>intval($recordsTotal),
				"recordsFiltered"=>intval($recordsTotal),
				"data" => $datas
			),JSON_UNESCAPED_UNICODE
		);

	}
		/*
		* remove the app from the trunk
		* @param Request $request
		* @param string $id
		* @return string
		*/
	public function removeApp(Request $request,$id)
	{
		$inputs['id']=$id;
		$params[0]=$id;
		$ossbss=new Ossbss();
		$result=$ossbss->deleteInfo('serverApps.removeApp',$inputs,$params);
		return json_encode($result);
	}



	public function  object_array($array) {
		if(is_object($array)) {$array =(array)$array;
		}
		if(is_array($array)) {
			foreach($array as $key=>$value) {
				$array[$key] = $this->object_array($value);
			}
		}
		return $array;
	}

}