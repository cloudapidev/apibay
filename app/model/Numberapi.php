<?php
namespace App\Model;
use Unirest;
use Config;
use App\Libraries\Classes\Ossbss;
class Numberapi{
	protected $_headers=array();
	public function __construct()
	{
		if(empty($this->_authorization))
		{
			$this->_authorization=getAuthorization();
		}
		if(empty($this->_headers))
			$this->_headers=array(
// 				"Content-Type"	=>"application/X-WWW-form-urlencoded;charset=UTF-8",
				"Content-Type"	=>"application/json;charset=UTF-8",
				"Authorization"=>$this->_authorization
				);
	}
	

	public function numberlist($offset=0,$limit=10)
	{
		$url=setApiUrl("numbers.showList");
		$inputs['offset']=$offset;
		$inputs['limit']=$limit;
		$response = Unirest\Request::get($url,$this->_headers,$inputs);
		if($response->code == '200')
		{
			
			$result['paging']=$response->body->paging;
			$result['data']=empty($response->body->data)?array():$response->body->data;
			return $result;
		}
		return 0;
	}
	public function buySearch($inputs,$offset=0,$limit=10)
	{
		$url=setApiUrl("numbers.showIdleList");
		$inputs['offset']=$offset;
		$inputs['limit']=$limit;
		$response=Unirest\Request::get($url,$this->_headers,$inputs);
		return $response;		
	}
	public function setNumberSelected($inputs)
	{
		$url=setApiUrl("numbers.doSelected",$inputs['number']);
		$response=Unirest\Request::put($url,$this->_headers,$inputs);
		if($response->code == 200)
		{
			return 1;
		}
		return 0;
	}
	public function showSelectedNumbers($inputs)
	{
		$url=setApiUrl("numbers.showSelectedList");
		$response=Unirest\Request::get($url,$this->_headers,$inputs);
		$response=dealResponse($response);
		if($response['flag'] == "success")
		{
			unset($response['paging']);
		}
		return json_encode($response);
		
		/* 
		if($response->code != 200)
			return 0;
		if(empty($response->body))
			return 0;
		return json_encode($response->body); */
	
	}
	public function removeSeletectedNumber($inputs)
	{
		$url=setApiUrl("numbers.doRemoved",$inputs['number']);
		$response=Unirest\Request::delete($url,$this->_headers,$inputs);
		if($response->code != 200)
			return 0;
		return 1;
		
	}
	public function comfirmPurchase($inputs)
	{
		$url=setApiUrl("numbers.buyNumbers");
		$response=Unirest\Request::post($url,$this->_headers,json_encode($inputs));
// 		return json_encode($response);
		$response=dealResponse($response);
		if($response['flag'] == 'success')
		{
			$data=$response['data'];
			if($data->total != $data->succeed)
			{
				$response['flag']='error';
				$response['msg']=$data->failed_list;
				unset($response['pagging']);
				return json_encode($response);
			}else
			{
				$response['msg']='Buy numbers successfully';
			}
		}
		return json_encode($response);
		
	}
	public function searchNumbers($inputs=array(),$offset=0,$limit=10)
	{
		$url=setApiUrl("numbers.showList");
		$inputs['offset']=$offset;
		$inputs['limit']=$limit;
		$response=Unirest\Request::get($url,$this->_headers,$inputs);
		if($response->code == 200)
		{
			$data=array();
			$data['data']=$response->body->data;
			$data['paging']=$response->body->paging;
			return $data;
		}
		return 0;
	}
	/**
	 * @param integer $number
	 */
	public function getInfo($url,$inputs=array(),$number=null)
	{
		$url=setApiUrl($url,$number);
		$response=Unirest\Request::get($url,$this->_headers,$inputs);
// 		return $response;
		if($response->code == 200)
		{
			return $response->body;
		}
		return 0;
	}
	public function deleteInfo($doUrl,$inputs,$number=null)
	{
		$url=setApiUrl($doUrl,$number);
		$response=Unirest\Request::delete($url,$this->_headers,json_encode($inputs));
		if($response->code == 200)
		{
// 			return $response->body;
			return 1;
		}
		return 0;
	}
	public function putInfo($doUrl,$inputs,$number=null)
	{
		$url=setApiUrl($doUrl,$number);
		$response=Unirest\Request::put($url,$this->_headers,json_encode($inputs));
		return json_encode($response);
		if($response->code == 200)
		{
// 			return $response->body;
			return 1;
		}
		return 0;
	}
}