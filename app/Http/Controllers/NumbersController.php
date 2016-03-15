<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http;
use App\Model\Numberapi;
use App\Libraries\Classes\Ossbss;
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
    	$data['offset']=$offset;
    	$data['limit']=$this->_perNums;
    	$ossbss=new Ossbss();
    	$res=$ossbss->getInfo("numbers.showList",$data);
    	$res=unsetParam($res,'paging');
    	$res['data']=isset($res['data'])?$res['data']:array();
    	$pagelist="";
    	if(isset($res['paging'])) $pagelist=pagesLink($res['paging']->total,$page,$this->_perNums);
        return view("number/listing",array(
                "active"=>"menu_number , menu_number_listing",
                "pagetitle"=>"Numbers Listing",
        		'listDatas'=>$res['data'],
        		'pagelist'=>$pagelist,
        		
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
    	$inputs['offset']=($page-1).$this->_perNums;
    	$inputs['limit']=$this->_perNums;
    	$ossbss=new Ossbss();
    	$res=$ossbss->getInfo("numbers.showList",$inputs);
    	if(isset($res['paging']))
	    	$res['pagelist']=pagesLink($res['paging']->total,$page,$this->_perNums);
    /*	$numberApi=new Numberapi();
    	$result=$numberApi->searchNumbers($inputs,$offset,$this->_perNums);*/
    	unset($res['paging']);
    	return $res;
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
    	$ossbss=new Ossbss();
    	$result=$ossbss->getInfo("numbers.showList",$inputs);
  /*  	$numberApi=new Numberapi();
    	$result=$numberApi->searchNumbers($inputs);*/
    	$result=unsetParam($result,'paging');
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
    	/*$details=array();
        $details=$this->showNumberDetails($number);*/
    	$ossbss=new Ossbss();
    	$details=$ossbss->getInfo("numbers.showDetails",null,$number);
        if( $details['flag']== 'error') return redirect('/numbers');
        $alltrunks=$this->getAllTrunks();
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
    	/*$numberApi=new Numberapi();
    	$response=$numberApi->getInfo("trunks.showList");*/
    	$ossbss=new Ossbss();
    	$response=$ossbss->getInfo("trunks.showList");
    	$response=unsetParam($response,'paging');
    	return json_encode($response);
    }
    protected function getAllServerApps()
    {
    	/*$numberApi=new Numberapi();
    	$response=$numberApi->getInfo("serverApps.showList");*/
    	$ossbss=new Ossbss();
    	$response=$ossbss->getInfo("serverApps.showList");
    	$response=unsetParam($response,'paging');
    	return json_encode($response);
    	
    }
    /**update the number's configure
     * @param Request $request
     * @return json
     */
    public function saveConfig(Request $request)
    {
    	$inputs=$request->except('_token');
//     	return json_encode($inputs);
    	$data=array();
    	$data['number']=$inputs['number'];
    	if($inputs['voice'] != null)  
    		$voice=$inputs['voice'];
    	$data['voice_bind_type']=(isset($voice['type']))?$voice['type']:null;
    	if(!empty($data['voice_bind_type']))
    	{
    		if($data['voice_bind_type'] == "SERVER_APP")
    		{
    			$data['voice_application_id']=$voice['setting']["SERVER_APP"];
    			if(empty($data['voice_application_id']))
    			{
    				unset($data['voice_application_id']);
    				unset($data['voice_bind_type']);
    			}
    		}
	    	if($data['voice_bind_type'] == "SIPTRUNK")
	    	{
	    		$data['sip_trunk_id']=$voice['setting']["SIPTRUNK"];
	    		if(empty($data['sip_trunk_id']))
	    		{
	    			unset($data['sip_trunk_id']);
	    			unset($data['voice_bind_type']);
	    		}
	    	}
    	}else
    	{
    		unset($data['bind_voice_type']);
    	}
    	
    	if($inputs['message'] != null)  
    		$message=$inputs['message'];
    	$data['message_bind_type']=(isset($message['type'] ))?$message['type']:null;
    	if(!empty($data['message_bind_type'] ))
    	{
    		if($data['message_bind_type'] == 'server_sms')
    		{
    			$data['message_bind_type']="SERVER_APP";
    			$data['message_application_id']=$message['setting']['server_sms'];
    		}
    		if(empty($data['message_application_id']))
    		{
    			unset($data['message_application_id']);
    			unset($data['message_bind_type']);
    		}
    	}else
    	{
    		unset($data['message_bind_type']);
    	}
    	if(count($data) <= 1) 
    		return json_encode(array("flag"=>'error','error'=>"Please choose config"));
    	
    	/*$numberApi=new Numberapi();
    	$response=$numberApi->putInfo("numbers.editNumber", $data,$data['number']);
*/
    	$ossbss=new Ossbss();
    	$response=$ossbss->putInfo("numbers.editNumber",$data,$data['number']);
    	$response=unsetParam($response,'paging','data');
    	if($response['flag'] == 'success')
    	{
	    	$response['msg']="Configure successfully";
    	}
		else
		{
			$response['msg']="Configure faild";
		}			
    	return json_encode($response);
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
//    	$url="/v2/PurchasedPhoneNumbers/".$number;
    	$inputs['number']=$number;
    	$inputs['capabilities']=$type;
//    	$numberApi=new Numberapi();
//    	$result=$numberApi->deleteInfo("numbers.doReleased",$inputs,$number);
    	$ossbss=new Ossbss();
    	$result=$ossbss->deleteInfo("numbers.doReleased",$inputs,$number);
    	$result=unsetParam($result,'data','paging');
    	return json_encode($result);
    }


     /**
      * show the buy numbers page
      * @return View
      */
     public function buy()
    {
    	$account_info=Session::get('account_info');
        $res=json_decode($this->showSelectedNumbers());
//        $selectedNumbers=$selectedNumbers->data;
        $selectedNumbers=($res->flag== 'success')?($res->data):array();
        $style=empty($selectedNumbers)?"style='display: none'":"";
//         dd($selectedNumbers);
        return view("number/buy",array(
                "active"=>"menu_number , menu_number_new",
                "pagetitle"=>"Buy new phone number",
        		"selectedNumbers"=>$selectedNumbers,
        		'style'=>$style,
        		"blance"=>$account_info->current_balance,
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

	/*	$numberApi=new Numberapi();
		$result=$numberApi->buySearch($inputs);
*/
		$ossbss=new Ossbss();
		$res=$ossbss->getInfo("numbers.showIdleList",$inputs);
		$res=unsetParam($res,'paging');
		return json_encode($res);
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
		$inputs['developer_id']=Session::get('account_sid');
		$ossbss=new Ossbss();
		$result=$ossbss->putInfo("numbers.doSelected",$inputs,$inputs['number']);
		$result=unsetParam($result,'data','paging');
		return json_encode($result);
	}
	/**
	 * get all selected numbers by ajax request
	 * @return json 
	 */
	public function showSelectedNumbers()
	{
		$inputs['developer_id']=Session::get('account_id');
	/*	$numberApi=new Numberapi();
		$result=$numberApi->showSelectedNumbers($inputs);*/
		$ossbss=new Ossbss();
		$result=$ossbss->getInfo("numbers.showSelectedList",$inputs);
		$result=unsetParam($result,'paging');
		return json_encode($result);
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
		$ossbss=new Ossbss();
		$result=$ossbss->deleteInfo("numbers.doRemoved",$inputs,$number);
		$result=unsetParam($result,'data','paging');
		return json_encode($result);
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
		$ossbss=new Ossbss();
		$result=$ossbss->postInfo("numbers.buyNumbers",$data);
		$result=unsetParam($result,'paging');
// 		return json_encode($result);
		$data=isset($result['data'])?$result['data']:array();
		if($data && $data->failure)
		{
			$result['flag']="error";
			$failed_list=json_encode($data->failed_list);
			$str="";
			foreach (json_decode($failed_list,true) as $key=>$v)
			{
				$str .=$key.",";
			}
			$result['msg']=$str."purchased Faild";
			unset($result['data']);
		}

		return json_encode($result);
	}
	protected function showNumberDetails($number)
	{
		$inputs['number']=$number;
		$inputs['developer_id']=Session::get('account_sid');
		$numberApi=new Numberapi();
		$result=$numberApi->getInfo("numbers.showDetails",$inputs,$number);
		$ossbss=new Ossbss();
		$res=$ossbss->getInfo("numbers.showDetails",$inputs,$number);
		$res=unsetParam($res,'paging');
		return json_encode($res);
	}
}
