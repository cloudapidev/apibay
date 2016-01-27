<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http;
use App\Model\Numberapi;
use App\Libraries\Classes\Ossbss;
use Psy\Util\Json;
/**
 * @author WY
 *
 */
class NumbersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	protected $_perNums=2;
    public function index(Request $request)
    {
    	if(null == $request->only('page'))
    	{
    		$inputs=$request->only('page');
    		$page=$inputs['page'];
    		
    	}
    	else
    	{
    		$page=1;
    	}
    	$offset=($page-1)*$this->_perNums;
    	$numberapi=new Numberapi();
    	$res=$numberapi->numberlist($offset,$this->_perNums);
    	$pagelist="";
    	if($res) $pagelist=pagesLink($res['paging']->total,$page,$this->_perNums);
        return view("number/listing",array(
                "active"=>"menu_number , menu_number_listing",
                "pagetitle"=>"Numbers Listing",
        		'listDatas'=>$res['data'],
        		'pagelist'=>$pagelist
            )
        ); 
    }
    /**
     * display the numbers list by ajax request.
     * @param integer $page
     * @return json 
     * {[data:...],[pagelist:...]}
     */
    public function getNumberList($page)
    {
    	$inputs=array();
    	$offset=($page-1).$this->_perNums;
    	$numberApi=new Numberapi();
    	$result=$numberApi->searchNumbers($inputs,$offset,$this->_perNums);
    	$result['pagelist']=pagesLink($result['paging']->total,$page,$this->_perNums);
    	unset($result['paging']);
    	return json_encode($result);
    }
   /**
    * display the search numbers list by ajax request
    * @param Request $request
    * @return Json
    * {[data:...]}
    */
   public function searchNumbers(Request $request)
    {
    	$inputs=$request->except('_token');
//     	return json_encode($inputs);
    	foreach ($inputs as $key => $value)
    	{
    		if(empty($value)) unset($inputs[$key]);
    	}
    	if(!isset($inputs['limit'])) $inputs['limit']=10;
    	if(isset($inputs['expiredDate']))
    	{
    		$time=trim($inputs['expiredDate'])." 00:00:00";
    		$inputs['expiredDate']=date("Y-m-d H:i:s",strtotime($time));
    	}
    	if(isset($inputs['purchasedDate']))
    	{
    		$time=trim($inputs['purchasedDate'])." 00:00:00";
    		$inputs['purchasedDate']=date("Y-m-d H:i:s",strtotime($time));
    	}
    	$numberApi=new Numberapi();
    	$result=$numberApi->searchNumbers($inputs);
    	unset($result['paging']);
    	return json_encode($result);
    	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($number)
    {
    	
        $details=$this->showNumberDetails($number);
        $alltrunks=$this->getAllTrunks();
//         dd($alltrunks);
        $allserverapps=$this->getAllServerApps();
        return view("number/edit",array(
                "active"=>"menu_number , menu_number_listing",
                "pagetitle"=>"Manage Number",
//                 "id"=>4820,
        		"details"=>$details,
        		"siptrunks"=>$alltrunks,
        		"serverapps"=>$allserverapps
            )
        );
    }
    /**
     * return all siptrunks
     * @return json [{},{}]
     */
    protected function getAllTrunks()
    {
    	$url="/v2/sip_trunks";
    	$numberApi=new Numberapi();
    	$response=$numberApi->getInfo($url);
    	if($response)
    		return $response->data;
    	return json_encode(array());
    }
    protected function getAllServerApps()
    {
    	$url="/v2/server_apps";
    	$numberApi=new Numberapi();
    	$response=$numberApi->getInfo($url);
    	if($response)
    		return $response->data;
    	return json_encode(array());
    	
    }
    /**update the number's configure
     * @param Request $request
     * @return json
     */
    public function saveConfig(Request $request)
    {
    	$inputs=$request->except('_token');
    	$data=array();
    	$data['number']=$inputs['number'];
    	if($inputs['voice'] != null)  
    		$voice=$inputs['voice'];
    	$data['bind_voice_type']=(isset($voice['type']))?$voice['type']:null;
    	if(!empty($data['bind_voice_type']))
    	{
    		if($data['bind_voice_type'] == "SERVER_APP")
    		{
    			$data['voice_servapp']=$voice['setting']["SERVER_APP"];
    			if(empty($data['voice_servapp']))
    			{
    				unset($data['voice_servapp']);
    				unset($data['bind_voice_type']);
    			}
    		}
	    	if($data['bind_voice_type'] == "SIPTRUNK")
	    	{
	    		$data['siptrunk_id']=$voice['setting']["SIPTRUNK"];
	    		if(empty($data['siptrunk_id']))
	    		{
	    			unset($data['siptrunk_id']);
	    			unset($data['bind_voice_type']);
	    		}
	    	}
    	}else
    	{
    		unset($data['bind_voice_type']);
    	}
    	
    	if($inputs['message'] != null)  
    		$message=$inputs['message'];
    	$data['bind_msg_type']=(isset($message['type'] ))?$message['type']:null;
    	if(!empty($data['bind_msg_type']))
    	{
    		if($data['bind_msg_type'] == 'server_sms')
	    		$data['msg_servapp']=$message['setting']["server_sms"];
    		$data['bind_msg_type']=="SERVER_APP";
    		if(empty($data['msg_servapp']))
    		{
    			unset($data['msg_servapp']);
    			unset($data['bind_msg_type']);
    		}
    	}else
    	{
    		unset($data['bind_msg_type']);
    	}
    	if(count($data) <= 1) 
    		return json_encode(array("flag"=>'error','error'=>"Please choose config"));
    	$url="/v2/developer_numbers/".$data['number'];
    	$numberApi=new Numberapi();
    	$response=$numberApi->putInfo($url, $data);
    	if($response)
    		return json_encode(array("flag"=>'success','success'=>"Configure successfully"));
    	return json_encode(array("flag"=>'error','error'=>"Configure faild"));
    }
	
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    
    /**
     * @param Request $request
     * @param integer $number
     */
    public function release(Request $request,$number,$type)
    {
    	$url="/v2/developer_numbers/".$number;
    	$numberApi=new Numberapi();
    	$inputs['number']=$number;
    	$inputs['capabilities']=$type;
    	$result=$numberApi->deleteInfo($url,$inputs);
    	return $result;
    }


     /**
      * show the buy numbers page
      * @return View
      */
     public function buy()
    {
        $selectedNumbers=$this->showSelectedNumbers();
        $selectedNumbers=!empty($selectedNumbers)?json_decode($selectedNumbers):array();
        $style=empty($selectedNumbers)?"style='display: none'":"";
        return view("number/buy",array(
                "active"=>"menu_number , menu_number_new",
                "pagetitle"=>"Buy new phone number",
        		"selectedNumbers"=>$selectedNumbers,
        		'style'=>$style,
            )
        );
    }
	/**
	 * result the searching numberlist by ajax request
	 * @param Request $requst
	 * @json
	 * {[data:...]}
	 */
	public function buySearch(Request $requst)
	{
		$inputs=$requst->except("_token");
		if(empty($inputs['number'])) unset($inputs['number']);
		$numberApi=new Numberapi();
		$result=$numberApi->buySearch($inputs);
		$data=$result->body->data;
		return json_encode($data);
	}
	
	/**
	 * chang the number's status  to be selected by ajax request
	 * @param Request $requst
	 * @param integer $number
	 * @return integer 0|1
	 */
	public function setNumberSelected(Request $requst,$number)
	{
		
		$inputs['number']=$number;
		if(empty($inputs['number'])) return false;
		$inputs['developer_id']=Session::get('account_id');
		$numberApi=new Numberapi();
		$result=$numberApi->setNumberSelected($inputs);
		return $result;
		
	}
	/**
	 * get all selected numbers by ajax request
	 * @return integer|json 0|json
	 */
	public function showSelectedNumbers()
	{
		$numberApi=new Numberapi();
		$inputs['developer_id']=Session::get('account_id');
		$result=$numberApi->showSelectedNumbers($inputs);
		return $result;
	}
	/**
	 * remove the number's  selected status  
	 * @param Request $request
	 * @param integer $number
	 * @return integer 0|1
	 */
	public function removeSelectedNumber(Request $request,$number)
	{
		$inputs['number']=$number;
		if(empty($inputs['number'])) return false;
		$inputs['developer_id']=Session::get('account_sid');
		$numberApi=new Numberapi();
		$result=$numberApi->removeSeletectedNumber($inputs);
		return $result;
	}
	/**
	 * pay for selected numbers.
	 * @param Request $request
	 * @return integer|json
	 */
	public function comfirmPurchase(Request $request)
	{
		$input=$request->all();
		$month=$input['month'];
		$type=$input['type'];
		$developer_id=Session::get('account_sid');
		$data=array();
		$i=0;
		foreach($month as $key=>$value)
		{
			$data[$i]['number']=$key;
			$data[$i]['developer_id']=$developer_id;
			$data[$i]['capabilities']=$type[$key];
			$data[$i]['period']=$value;
			$data[$i]['period_type']="MONTH";
			$i++;
		}
// 		return json_encode($data);
		$numberApi=new Numberapi();
		$result=$numberApi->comfirmPurchase($data);
		return $result;
	}
	protected function showNumberDetails($number)
	{
		$numberApi=new Numberapi();
		$inputs['number']=$number;
		$inputs['developer_id']=Session::get('account_sid');
		$result=$numberApi->getInfo("/v2/developer_numbers/".$number,$inputs);
		if($result)
		{
			return $result;
		}
		return false;
		
	}
}
