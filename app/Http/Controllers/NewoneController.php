<?php
namespace App\Http\Controllers;
use App\Libraries\Classes\Ossbss;
use Illuminate\Http\Request;
use Validator;
/**
 * Created by PhpStorm.
 * author: Jiang Yao
 * Date: 2016/3/22
 * Time: 9:48
 */
class NewoneController extends Controller{
    protected $_perNums=10;
    public function index(){
        $data['offset']=0;
        $data['limit']=10;
        $ossbss=new Ossbss();
        $response=$ossbss->getInfo("trunks.showList",$data);
        $allTrunks=(isset($response['data']) && !empty($response['data']))?$response['data']:array();
        return view('newone/test',array(
            "allTrunks"=>$allTrunks,
            "active"=>"menu_siptrunk , menu_siptrunk_listing",
            "pagetitle"=>"Test"
        ));
    }
    public  function edit($id){
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
        var_dump($ipAccess);

        //get all Ip Access
        $ipaccessAllListRes=json_decode($this->showAllTrunksIpAccessList($id));
        $ipAccessAllList=isset($ipaccessAllListRes->data)?$ipaccessAllListRes->data:null;


        $ossbss=new Ossbss();
        $result=$ossbss->getInfo("trunks.getInfo",$data,$id);
        print_r($result);

        $result=unsetParam($result,'paging','msg','flag');

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
    public function showAllAuthList()
    {
        $ossbss=new Ossbss();
        $inputs['offset']=0;
        $inputs['limit']=$this->_perNums;
        $result=$ossbss->getInfo('trunks.allAuthList',$inputs);
       // print_r($result);
     //  $result=unsetParam($result,"msg");//弹出msg
       // print_r($result);
        return json_encode($result);
    }

    public function showSelectedAuthList($sipTrunkId)
    {
        $inputs['sipTrunkId']=$sipTrunkId;
        $ossbss=new Ossbss();
        $result=$ossbss->getInfo('trunks.selectAuthList',$inputs,$sipTrunkId);
        return json_encode($result);
    }

    public function showSelectedIpAccessList($sipTrunkId)
    {
        $inputs['sipTrunkId']=$sipTrunkId;
        $params[0]=$sipTrunkId;
        $ossbss=new Ossbss();
        $result=$ossbss->getInfo('trunks.selectedIpList',$inputs,$params);
        $result=unsetParam($result,"msg");
        return json_encode($result);
    }

    public function showAllTrunksIpAccessList($trunkId)
    {
        $ossbss=new Ossbss();
        $inputs['sipTrunkId']=$trunkId;
        $result=$ossbss->getInfo("trunks.allTrunksIpList",$inputs,$trunkId);
        $result=unsetParam($result,'msg','paging','flag');
        return json_encode($result);
    }

    function unsetParam()
    {
        $params=func_get_args();
        $data=array_shift($params);
        if($data['flag'] == 'success')
        {
            if(empty($params)) return $data;
            foreach($params as $v)
            {
                if(isset($data[$v])) unset($data[$v]);
            }
        }
        return $data;
    }
}

