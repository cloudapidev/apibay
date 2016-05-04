<?php
namespace App\Http\Controllers;
use App\Libraries\Classes\Ossbss;
use Illuminate\Http\Request;
use Validator;
use Log;
use Session;
//use Symfony\Component\HttpFoundation\Session\Session;
/**
 * @author Wang Ying
 *
 */
class SiptrunkController extends Controller
{
	protected $_perNums=10;
	

	public function  index(Request $request)
	{
		//$data['offset']=0;
		//$data['limit']=10;
		//print_r($allTrunks);
		return view('siptrunk/siptrunk',array(
				"active"=>"menu_siptrunk , menu_siptrunk_listing",
				"pagetitle"=>"Sip Trunk Listing",


				)
		);
	}
	/**get tableInfo for Datatables
	 * @return string
	 */
	public function getTable()
	{
		//获取Datatables发送的参数 必要
		$draw = $_GET['draw'];
		/*//排序
		$order_column = $_GET['order']['0']['column'];//那一列排序，从0开始

		$order_dir = $_GET['order']['0']['dir'];//ase desc 升序或者降序
		//拼接排序sql
		$orderSql = "";
		if(isset($order_column)){
			$i = intval($order_column);
			switch($i){
				case 0;$orderSql = " order by # ".$order_dir;break;
				case 1;$orderSql = " order by Name ".$order_dir;break;
				case 2;$orderSql = " order by Termination URI ".$order_dir;break;
				case 3;$orderSql = " order by Origination URI  ".$order_dir;break;
				case 4;$orderSql = " order by No. of Channel ".$order_dir;break;
				default;$orderSql = '';
			}
		}*/
		//搜索
		$search = $_GET['search']['value'];//获取前台传过来的过滤条件
		//分页
		$start = $_GET['start'];//从多少开始
		$length = $_GET['length'];//数据长度
		$limitSql = '';
		$limitFlag = isset($_GET['start']) && $length != -1 ;
		if ($limitFlag ) {
			$limitSql = " LIMIT ".intval($start).", ".intval($length);
		}
		//总记录数 必要
		$recordsTotal = 0;
		$list=json_decode($this->showList());
		$data=isset($list->data)?$list->data:null;
	   // Log::info($data);
	    $infos=$this->object_array($data);
		//Log::info($infos);
		$datas = array();
		foreach($infos as $index =>$siptruk){
			$nSipTrunk = array();
			foreach($siptruk as $key=>$val)
			{
				$nSipTrunk['index']=$index+1;
				if($key=="name"){
					$nSipTrunk['name']=$val;
				}
				if($key=="termination_uri"){
					$nSipTrunk['termination_uri']=$val;
				}
				$nSipTrunk['origination_uri']="";
				$nSipTrunk['number']="";
				$nSipTrunk['channel']="";

				if($key=='id'){
					$nSipTrunk['edit']=$val;
				}

			}
			array_push($datas,$nSipTrunk);
		}




		$paging=isset($list->paging)?$list->paging:null;
		$recordsTotal =$paging->total;
		echo json_encode(
			array(
				"draw"=>intval($draw),
				"recordsTotal"=>intval($recordsTotal),
				"recordsFiltered"=>intval($recordsTotal),
				"data" => $datas
			),JSON_UNESCAPED_UNICODE
		);



	}
	public function showList()
	{
		$ossbss=new Ossbss();
		$inputs['offset']=$_GET['start'];
		$inputs['limit']=$_GET['length'];
		$result=$ossbss->getInfo('trunks.showList',$inputs);

		$result=unsetParam($result,"msg");

		return json_encode($result);

	}

	/**
	 * show creat new page
	 * @return view
	 */
	public function add()
	{
		return view('siptrunk/newsiptrunk',array(
				"active"=>"menu_siptrunk , menu_siptrunk_new",
				"pagetitle"=>"Create SIP Trunk")
		);
	}	
	/**show edit page
	 * @param integer $id
	 * @return view
	 */
	public function edit($id)
	{


		$data['sipTrunkId']=$id;

		//get sip trunk auth list
		$authRes=json_decode($this->showAuthList($id));
		$authSelectedList=isset($authRes->data)?$authRes->data:null;

		//get selection auth list
		$allAuthListRes=json_decode($this->showAllAuthList());
		$allAuthList=isset($allAuthListRes->data)?$allAuthListRes->data:null;

		//get selected ip Access		
		$ipaccessRes=json_decode($this->showSelectedIpAccessList($id));
		$ipAccess=isset($ipaccessRes->data)?$ipaccessRes->data:null;



		//get all Ip Access
		$ipaccessAllListRes=json_decode($this->showAllTrunksIpAccessList($id));
		$ipAccessAllList=isset($ipaccessAllListRes->data)?$ipaccessAllListRes->data:null;
		$ossbss=new Ossbss();
		$result=$ossbss->getInfo("trunks.getInfo",$data,$id);
		$result=unsetParam($result,'paging','msg','flag');

		//get one origination
		$originationListRes=json_decode($this->showAllOrigination($id));
		$originationList=isset($originationListRes->data)?$originationListRes->data:null;



		//get Assigned Numbers
		$AssignedListRes=json_decode($this->showAssignedList($id));

		$AssignedListRes=isset($AssignedListRes->data)?$AssignedListRes->data:null;

      // dd($result);
		if(!$result['data'])
		{
			return redirect()->back();
		}
		return view('siptrunk/newsiptrunk',array(
				"active"=>"menu_siptrunk , menu_siptrunk_new",
				"pagetitle"=>"Manage SIP Trunk",
				'trunkInfo'=>$result['data'],
				'AuthList'=>$authSelectedList,
				'allAuthList'=>$allAuthList,
				'selectedIpAccess'=>$ipAccess,
				"allIpAccess"=>$ipAccessAllList,
				"trunkId"=>$id,
				"originationList"=>$originationList,
				"assignedNumber"=>$AssignedListRes,


		)
		);
		
	}
	/**search trunks according to name by ajax request
	 * @param Request $request
	 */
	public function searchTrunks(Request $request)
	{
		$inputs=$request->except('_token');
		$page=(isset($inputs['page']) && $inputs['page'] != null)?$inputs['page']:1;
		$inputs['limit']=(isset($inputs['limit']) && !empty($inputs['limit'])) ?$inputs['limit']:$this->_perNums;
		$inputs['offset']=($page-1)*$inputs['limit'];
		if(empty($inputs['name'])) unset($inputs['name']);
		$ossbss=new Ossbss();
		$response=$ossbss->getInfo("trunks.showList",$inputs);
		return json_encode($response);
	}
	
	/**
	 * create trunk
	 * @param Request $request
	 * @return string
	 */
	public function create(Request $request)
	{
		$inputs=$request->only('name');
		if(empty($inputs['name']))		
		{
			$data['flag']='error';
			$data['msg']="name is required";
			return json_encode($data);
		}
		$ossbss=new Ossbss();
		$response=$ossbss->postInfo("trunks.create",$inputs);
		return json_encode($response);
		
	}
	public function saveInfo(Request $request)
	{
		$inputs=$request->except("_token");
		if(isset($inputs['general']))
		{
			unset($inputs['general']);
			return $this->saveTrunkInfo($inputs);
		}
		if(isset($inputs['termination']))
		{
			unset($inputs['termination']);
			return $this->saveTerminationInfo($inputs);
		}
		if(isset($inputs['origination']))
		{
			unset($inputs['origination']);
			return $this->saveOriginationInfo($inputs);
		}
	}

	/**
	 * save info of Originationl tab
	 * @param array $inputs
	 * @return string
	 */
	protected function saveOriginationInfo($inputs)
	{
		foreach ($inputs as $v)
		{
			if(empty($v)){
				$data['flag']='error';
				$data['msg']="Name or Termination URI is required";
				return json_encode($data);
			}
			$trunkId=$inputs['sipTrunkId'];
			$params[0]=$trunkId;

			unset($inputs['sipTrunkId']);
			$ossbss=new Ossbss();
			$result=$ossbss->getInfo("trunks.createOrigin",$inputs,$params);
			$result=$this->object_array($result);// turn object to array
			if(empty($result['data'])){
				$result=$ossbss->postInfo("trunks.createOrigin",$inputs,$params);
			}else
			{
				$params[1]=$inputs['id'];
				$result=$ossbss->putInfo("trunks.editOrigin",$inputs,$params);

			}
			$result=unsetParam($result,'pagging');
			return json_encode($result);
		}
	}

	/**
	 * save info of general tab 
	 * @param array $inputs
	 * @return string
	 */
	protected function saveTrunkInfo($inputs)
	{
		 foreach ($inputs as $v)
		{
			if(empty($v)) 
			{
				$data['flag']='error';
				$data['msg']="Name or Termination URI is required";
				return json_encode($data);
			}
		} 
		$trunkId=$inputs['TrunkId'];
		unset($inputs['TrunkId']);
		$ossbss=new Ossbss();
		$result=$ossbss->putInfo("trunks.editInfo",$inputs,$trunkId);
// 		$result=unsetParam($result,'paging','data');
		$result=unsetParam($result,'paging');
		return json_encode($result);
		
	}
	/**
	 * save info of termination tab
	 * @param array $inputs
	 * @return string
	 */
	protected function saveTerminationInfo($inputs)
	{
		return json_encode($inputs);
		$authInputs=$inputs;
		unset($authInputs['sipTrunkIpId']);
		$authRes=$this->addAuthentication($authInputs);
		$authRes=unsetParam($authRes,'pagging');
		unset($inputs['sipTrunkAuthId']);
		$ipRes=$this->addIpAccess($inputs);
		$ipRes=unsetParam($ipRes,'pagging');
		$data=array();
		if($authRes['flag'] == 'error')
		{
			$data['flag']='error';
			$data['msg'] ="Authentication add failed.";
		}
		if($ipRes['flag'] == 'error')
		{
			$data['flag']='error';
			$data['msg'] .="Ip Access add failed";
		}
		if($ipRes['flag'] == 'success' && $authRes['flag'] == 'success')
		{
			$data['flag']='success';
			$data['msg']='Add Successfully';
		}
		return json_encode($data);
	}
	/**
	 * add Authentication to the trunk.
	 * @param Request $request
	 * @return string
	 */
	public function addAuthentication($data)
	{
		$params['sipTrunkId']=$data['sipTrunkId'];
		$params['sipTrunkAuthId']=$data['sipTrunkAuthId'];

		$ossbss=new Ossbss();
		$result=$ossbss->postInfo("trunks.addAuth",array(),$params);

		$result=unsetParam($result,'data','paging');

		return json_encode($result);
	}



	/**
	 * show the auth list of selected trunk.
	 * @param Request $request
	 * @return string
	 */

	public function showAuthList($sipTrunkId)
	{
		$inputs['sipTrunkId']=$sipTrunkId;
		$params['sipTrunkId']=$sipTrunkId;

		$ossbss=new Ossbss();
		$result=$ossbss->getInfo('trunks.showAuthList',$inputs,$params);

		return json_encode($result);
	}
	/**
	 * remove the auth from the trunk
	 * @param Request $request
	 * @param string $sipTrunkId
	 * @param string $sipTrunkAuthId
	 * @return string
	 */
	public function removeAuthentication(Request $request,$sipTrunkId,$sipTrunkAuthId)
	{
		$inputs['sipTrunkId']=$sipTrunkId;
		$inputs['sipTrunkAuthId']=$sipTrunkAuthId;

		$params['sipTrunkId']=$sipTrunkId;
		$params['sipTrunkAuthId']=$sipTrunkAuthId;
		$ossbss=new Ossbss();
		$result=$ossbss->deleteInfo('trunks.removeAuth',$inputs,$params);
		$result=unsetParam($result,'paging','data');
		return json_encode($result);
	}
	public function createAndAddAuthentication(Request $request)
	{
		$inputs=$request->except('_token');
		$data['sipTrunkId']=$inputs['trunkId'];
		$inputs['password']=md5($inputs['password']);

		unset($inputs['authId']);
		unset($inputs['trunkId']);
		$ossbss=new Ossbss();
		$result=$ossbss->postInfo('trunks.createAuth',$inputs);
		$result=unsetParam($result,"paging");


		if($result['flag'] == 'error') {
			return json_encode($result);
		}else {
			$data['sipTrunkAuthId'] = $result['data']->id;
			$result = $this->addAuthentication($data);


			return $result;
		}
	}
	/**
	 * add auth to sip trunk authList
	 * @param Request $request
	 * @return string
	 */
	public function  addToAuthList(Request $request){

		$inputs=$request->except('_token');
		$params['sipTrunkId']=$inputs['trunkId'];
		$params['sipTrunkAuthId']=$inputs['authId'];
		unset($inputs['authId']);
		unset($inputs['trunkId']);
		$ossbss=new Ossbss();
		$result=$ossbss->postInfo("trunks.addAuth",array(),$params);
		$result=unsetParam($result,"paging",'data');
		return json_encode($result);
	}

	/**
	 * creat authentication
	 * @param Request $request
	 * @return string
	 */
	public function createAuthentication(Request $request)
	{
		$inputs=$request->except('_token');
		$ossbss=new Ossbss();
		$result=$ossbss->postInfo('trunks.createAuth',$inputs);
		$result=unsetParam($result,"paging",'data');
		return json_encode($result);
	}

	public  function getIp($id){
		$ossbss=new Ossbss();
		$result=$ossbss->getInfo('trunks.editIp',$id);
		return json_encode($result);
	}



	/**
	 * edit the Authentication
	 * @param Request $request
	 * @return string
	 */
	public function editAuthentication(Request $request,$id)
	{
		$inputs=$request->except('_token');
		$inputs['password']=md5($inputs['password']);
		unset($inputs['trunkId']);
		unset($inputs['authId']);
	   $params['id']=$id;
		$ossbss=new Ossbss();
		$result=$ossbss->putInfo('trunks.editAuth',$inputs,$params);
		$result=unsetParam($result,"paging");
		return json_encode($result);
	}
	/**
	 * show all Auth list
	 * @param Request $request
	 * @return string
	 */
	public function showAllAuthList()
	{
		$ossbss=new Ossbss();
		$inputs['offset']=0;
		$inputs['limit']=$this->_perNums;
		$result=$ossbss->getInfo('trunks.selectAuthList',$inputs);
		$result=unsetParam($result,"msg");
		return json_encode($result);
	}
	/**
	 * add Ip Access to the trunk
	 * @param Request $request
	 * @return string
	 */
	public function addIpAccess($data)
	{
		$params[0]=$data['sipTrunkId'];
		$params[1]=$data['sipTrunkIpId'];
		$ossbss=new Ossbss();
		$result=$ossbss->postInfo('trunks.addIpAccess',array(),$params);
		$result=unsetParam($result,"paging");
		return json_encode($result);
	}
	public function addToIpList(Request $request)
	{
		$inputs=$request->except('_token');

		$params[0]=$inputs['trunkId'];
		$params[1]=$inputs['id'];
		unset($inputs['trunkId']);
		unset($inputs['id']);
		$ossbss=new Ossbss();
		$result=$ossbss->postInfo("trunks.addIpAccess",array(),$params);
		$result=unsetParam($result,"paging",'data');
		return json_encode($result);
	}
	/**
	 * show the selected Ip Access of trunk

	 * @param string $sipTrunkId
	 * @return string
	 */
	public function showSelectedIpAccessList($sipTrunkId)
	{
		$inputs['sipTrunkId']=$sipTrunkId;
		$params[0]=$sipTrunkId;
		$ossbss=new Ossbss();
		$result=$ossbss->getInfo('trunks.selectedIpList',$inputs,$params);
		$result=unsetParam($result,"msg");
		return json_encode($result);
	}
	/**
	 * remove the Ip Access from trunk
	 * @param Request $request
	 * @param string $sipTrunkId
	 * @param string $sipTrunkIpId
	 * @return string
	 */
	public function removeIpAccess(Request $request,$sipTrunkId,$sipTrunkIpId)
	{
		$inputs['sipTrunkId']=$sipTrunkId;
		$inputs['sipTrunkIpId']=$sipTrunkIpId;

		$params[0]=$sipTrunkId;
		$params[1]=$sipTrunkIpId;
		$ossbss=new Ossbss();
		$result=$ossbss->deleteInfo("trunks.removeIpAccess",array(),$params);
		$result=unsetParam($result,"paging","data");
		return json_encode($result);
		
	}
	/**
	 * create new Ip Access and then add it to the trunk.
	 * @param Request $request
	 * @return json
	 */
	public function createIpAndAddIpToTrunks(Request $request)
	{
		$inputs=$request->except('_token');
		$data['sipTrunkId']=$inputs['trunkId'];
		unset($inputs['trunkId']);
		$ossbss=new Ossbss();
		$result=$ossbss->postInfo('trunks.createIp',$inputs);
		$result=unsetParam($result,"paging");
		if($result['flag'] == 'error') return json_encode($result);
		$data['sipTrunkIpId']=$result['data']->id;
		$result=$this->addIpAccess($data);
		return $result;
	}
	/**
	 * create new Ip Access
	 * @param Request $request
	 * @return json
	 */
	public function creatIpAccess(Request $request)
	{
		$inputs=$request->except('_token');
		$ossbss=new Ossbss();
		$result=$ossbss->postInfo('trunks.createIp',$inputs);
		$result=unsetParam($result,"paging");
		return json_encode($result);
	}
	/**
	 * edit the ipAccess
	 * @param Request $request
	 * @return string
	 */
	public function editIpAcess(Request $request,$id)
	{
		$inputs=$request->except('_token');
		unset($inputs['trunkId']);

		$params['id']=$id;
		$ossbss=new Ossbss();
		$result=$ossbss->putInfo('trunks.editIp',$inputs,$params);
		$result=unsetParam($result,"paging",'data');
		return json_encode($result);
	}
	/**
	 * show all Ip Access List
	 * @param Request $request
	 * @return string
	 */
	public function showAllTrunksIpAccessList($trunkId)
	{
		$ossbss=new Ossbss();
		$inputs['sipTrunkId']=$trunkId;
		$result=$ossbss->getInfo("trunks.allTrunksIpList",$inputs,$trunkId);
		$result=unsetParam($result,'msg','paging','flag');
		return json_encode($result);
	}


	/**
	 * create new Origination
	 * @param Request $request
	 * @return string
	 */
	public function createOrigination(Request $request)
	{
		$inputs=$request->except('_token');
		$parmas[0]=$inputs['trunkId'];
		unset($parmas['trunkId']);
		$ossbss=new Ossbss();
		$result=$ossbss->postInfo("trunks.createOrigin",$inputs,$parmas);
		$result=unsetParam($result,'paging','data');
		return json_encode($result);
	}
	/**
	 * edit the Origination
	 * @param Request $request
	 * @return string
	 */
	public function editOrigination(Request $request)
	{
		$inputs=$request->except('_token');
		$params[0]=$inputs['trunkId'];
		$params[1]=$inputs['id'];
		unset($inputs['trunkId']);
		$ossbss=new Ossbss();
		$result=$ossbss->putInfo('trunks.editOrigin',$inputs,$params);
		$result=unsetParam($result,'paging');
		return json_encode($result);
	}
	
	/**
	 * show all Origination of trunk
	 * @param Request $request
	 * @param string $trunkId
	 * @return string
	 */
	public function showAllOrigination($trunkid)
	{
		$params[0]=$trunkid;
		$inputs['offset']=0;
		$inputs['limit']=10;
		$ossbss=new Ossbss();
		$result=$ossbss->getInfo("trunks.showAllOriginList",$inputs,$params);
		return json_encode($result);
	}

	/**
	 * show all Assigned Numbers List
	 * @param string $trunkId
	 * @return string
	 */
	public function showAssignedList($trunkId)
	{
		$ossbss=new Ossbss();
		$inputs['sipTrunkId']=$trunkId;

		$result=$ossbss->getInfo("trunks.AssignedPhoneNumbers",$inputs);
		$result=unsetParam($result,'msg','paging','flag');
		return json_encode($result);

	}


	public function getNumTable()
	{
		$inputs['country']=$_GET['country'];
		$inputs['capabilities']=$_GET['capabilities'];
		$inputs['offset']=$_GET['start'];
		$inputs['limit']=$_GET['length'];
		$draw = $_GET['draw'];
		$list=json_decode($this->showIdleNumList($inputs));
		$data=isset($list->data)?$list->data:null;
		$infos=$this->object_array($data);
		$datas = array();
		foreach($infos as $index =>$number){
			$nNumber = array();
			foreach($number as $key=>$val)
			{
				$nNumber['index']=$index+1;
				if($key=="country"){
					$nNumber['country']=$val;

				}
				if($key=="number"){
					$nNumber['number']=$val;
					$nNumber['check']=$val;
				}
				if($key=="capabilities"){
					$nNumber['capabilities']=$val;
				}
				$nNumber['area']="";



			}
			array_push($datas,$nNumber);
		}

		//$infos=$this->object_array($data);
		$paging=isset($list->paging)?$list->paging:null;
		$recordsTotal =$paging->total;
		echo json_encode(
			array(
				"draw"=>intval($draw),
				"recordsTotal"=>intval($recordsTotal),
				"recordsFiltered"=>intval($recordsTotal),
				"data" => $datas
			),JSON_UNESCAPED_UNICODE
		);

	}

	/**
	 * show all Idle Numbers List
	 * @param array $inputs
	 * @return string
	 */
	public function showIdleNumList($inputs)
	{
		$ossbss=new Ossbss();
		$result=$ossbss->getInfo("numbers.showList",$inputs);
		$result=unsetParam($result,"msg");
		return json_encode($result);

	}

	/**
	 * Assigned new number from existing
	 * @param Request $request
	 * @return string
	 */

	public function assignedSelectedNum(Request $request)
	{
			$inputs=$request->except('_token');
			$numbers=$inputs['data'];
			$data=array();
			$data['sip_trunk_id']=$inputs['sip_trunk_id'];
			foreach($numbers as $num)
			{
				$data['number']=$num;
				$data['voice_bind_type']="SIPTRUNK";
				$data['message_bind_type']="SERVER_APP";
				$data['developer_id']=Session::get('account_sid');
				Log::info($data);
				$params['number']=$num;
				$ossbss=new Ossbss();
				$result=$ossbss->putInfo("numbers.doReleased",$data,$params);
				return json_encode($result);
			}
	}
	public function showAssignedSelectedNum($sipTrunkId)
	{
		$draw = $_GET['draw'];
		$inputs['sip_trunk_id']=$sipTrunkId;

		$list=json_decode($this->showAssignedSelectedNumList($inputs));
		$data=isset($list->data)?$list->data:null;
		$infos=$this->object_array($data);
		$datas = array();
		foreach($infos as $index =>$number){
			$nNumber = array();
			foreach($number as $key=>$val)
			{
				$nNumber['index']=$index+1;
				if($key=="country"){
					$nNumber['country']=$val;

				}
				if($key=="number"){
					$nNumber['number']=$val;
					$nNumber['check']=$val;
				}
				if($key=="capabilities"){
					$nNumber['capabilities']=$val;
				}
				$nNumber['area']="";
			}
			array_push($datas,$nNumber);
		}
		$paging=isset($list->paging)?$list->paging:null;
		$recordsTotal =$paging->total;
		echo json_encode(
			array(
				"draw"=>intval($draw),
				"recordsTotal"=>intval($recordsTotal),
				"recordsFiltered"=>intval($recordsTotal),
				"data" => $datas
			),JSON_UNESCAPED_UNICODE
		);

	}

	public function showAssignedSelectedNumList($inputs)
	{
		$ossbss=new Ossbss();
		$params['sipTrunkId']=$inputs['sip_trunk_id'];
		$result=$ossbss->getInfo("trunks.AssignedPhoneNumbers",$inputs,$params);
		$result=unsetParam($result,"msg");
		return json_encode($result);
	}

	public function deleteAssignedNum(Request $request)
	{
		$inputs=$request->except('_token');
		$numbers=$inputs['number'];
		$data=array();
		foreach($numbers as $num)
		{
			$data['number']=$num;
			$data['sip_trunk_id']="";
			$data['voice_bind_type']="";
			$data['message_bind_type']="";
			$data['developer_id']=Session::get('account_sid');
			Log::info($data);
			$params['number']=$num;
			$ossbss=new Ossbss();
			$result=$ossbss->putInfo("numbers.doReleased",$data,$params);
			return json_encode($result);
		}

	}

	/**
	 *  Turn stdClass Object to array
	 * @param object
	 * @return array
	 */
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