<?php
namespace App\Http\Controllers;
use App\Libraries\Classes\Ossbss;
use Illuminate\Http\Request;
use Validator;
/**
 * @author Wang Ying
 *
 */
class SiptrunkController extends Controller
{
	protected $_perNums=10;
	
	/**show list page
	 * @return view
	 */
	public function  index(Request $request)
	{
		$data['offset']=0;
		$data['limit']=10;
		$ossbss=new Ossbss();
		$response=$ossbss->getInfo("trunks.showList",$data);
		$allTrunks=(isset($response['data']) && !empty($response['data']))?$response['data']:array();
		return view('siptrunk/siptrunk',array(
				"active"=>"menu_siptrunk , menu_siptrunk_listing",
				"pagetitle"=>"Sip Trunk Listing",
				"allTrunks"=>$allTrunks
				)
		);
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
		//get selected auth list
		$authRes=json_decode($this->showSelectedAuthList($id));
		$authSelectedList=isset($authRes->data)?$authRes->data:null;
		//get all auth list
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
// 		dd($result);
		if(!$result['data'])
		{
			return redirect()->back();
		}
		return view('siptrunk/newsiptrunk',array(
				"active"=>"menu_siptrunk , menu_siptrunk_new",
				"pagetitle"=>"Manage SIP Trunk",
				'trunkInfo'=>$result['data'],
				'selectedAuthList'=>$authSelectedList,
				'allAuthList'=>$allAuthList,
				'selectedIpAccess'=>$ipAccess,
				"allIpAccess"=>$ipAccessAllList,
				"trunkId"=>$id
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
	public function addAuthentication($inputs)
	{
		$params[0]=$inputs['sipTrunkId'];
		$params[1]=$inputs['sipTrunkAuthId'];
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
	public function showSelectedAuthList($sipTrunkId)
	{
		$inputs['sipTrunkId']=$sipTrunkId;
		$ossbss=new Ossbss();
		$result=$ossbss->getInfo('trunks.selectAuthList',$inputs,$sipTrunkId);
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
		$params[0]=$sipTrunkId;
		$params[1]=$sipTrunkAuthId;
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
		unset($inputs['trunkId']);		
		$ossbss=new Ossbss();
		$result=$ossbss->postInfo('trunks.createAuth',$inputs);
		$result=unsetParam($result,"paging");
		if($result['flag'] == 'error') return json_encode($result);
		$data['sipTrunkAuthId']=$result['data']->id;
		$result=$this->addAuthentication($data);
		return $result;
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
	/**
	 * edit the Authentication
	 * @param Request $request
	 * @return string
	 */
	public function editAuthentication(Request $request)
	{
// 		return json_encode(11);
		$inputs=$request->except('_token');
		$ossbss=new Ossbss();
		$result=$ossbss->putInfo('trunks.editAuth',$inputs,$inputs['id']);
		$result=unsetParam($result,"paging",'data');
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
		$result=$ossbss->getInfo('trunks.allAuthList',$inputs);
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
	/**
	 * show the selected Ip Access of trunk
	 * @param Request $request
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
		$inputs['sipTrunkIpId']=sipTrunkIpId;
		$params[0]=$sipTrunkId;
		$params[1]=sipTrunkIpId;
		$ossbss=new Ossbss();
		$result=$ossbss->deleteInfo("trunks.removeIpAccess",$inputs,$params);
		$result=unsetParam($params,"paging","data");
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
	public function editIpAcess(Request $request)
	{
		
		$inputs=$request->except('_token');
		$ossbss=new Ossbss();
		$result=$ossbss->putInfo('trunks.editIp',$inputs,$inputs['id']);
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
	public function showAllOrigination(Request $request,$trunkId)
	{
		$params[0]=$trunkId;
		$inputs['offset']=0;
		$inputs['limit']=10;
		$ossbss=new Ossbss();
		$result=$ossbss->getInfo("trunks.showAllOriginList",$inputs,$params);
		return json_encode($result);
	}
	
	
	
	
	
	
	
}