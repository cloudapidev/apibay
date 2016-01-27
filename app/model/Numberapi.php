<?php
namespace App\Model;
use Unirest;
use Config;
use App\Libraries\Classes\Ossbss;
class Numberapi{
	// 	protected $_baseurl="192.168.2.244";
	protected $_apiUrl="";
	protected $_authorization='';
	protected $_numberUrl="/v2/developer_numbers";
	protected $_headers=array();
	public function __construct()
	{
		if(empty($this->_authorization))
		{
			$ossbss=new Ossbss();
			$this->_authorization=$ossbss->getAuthorization();
		}
		if(empty($this->_apiUrl))
			$this->_apiUrl=Config("api.apiUrl");
		if(empty($this->_headers))
			$this->_headers=array(
				"Content-Type"	=>"application/json;charset=UTF-8",
// 				"Content-Type"	=>"application/X-WWW-form-urlencoded;charset=UTF-8",
				"Authorization"=>$this->_authorization
				);
	}
	
	
	public function numberlist($offset=0,$limit=10)
	{
		$apiUrl =$this->_apiUrl;
		$doUrl = $this->_numberUrl."?offset=".$offset
		."&limit=".$limit;
		$url = $apiUrl.$doUrl;
		$response = Unirest\Request::get($url,$this->_headers);
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
		$url=$this->_apiUrl."/v2/numbers/idle";
		$inputs['offset']=$offset;
		$inputs['limit']=$limit;
		$response=Unirest\Request::get($url,$this->_headers,$inputs);
		return $response;		
	}
	public function setNumberSelected($inputs)
	{
		$url=$this->_apiUrl.'/v2/numbers/'.$inputs['number'];
		$response=Unirest\Request::put($url,$this->_headers,$inputs);
		if($response->code == 200)
		{
			return 1;
		}
		return 0;
	}
	public function showSelectedNumbers($inputs)
	{
		$url=$this->_apiUrl."/v2/numbers/selected";
		$response=Unirest\Request::get($url,$this->_headers);
		if($response->code != 200)
			return 0;
		if(empty($response->body))
			return 0;
		return json_encode($response->body);
	
	}
	public function removeSeletectedNumber($inputs)
	{
		$url=$this->_apiUrl."/v2/numbers/".$inputs['number'];
		$response=Unirest\Request::delete($url,$this->_headers,$inputs);
		if($response->code != 200)
			return 0;
		return 1;
		
	}
	public function comfirmPurchase($inputs)
	{
		$url=$this->_apiUrl."/v2/developer_numbers";
		$respose=Unirest\Request::post($url,$this->_headers,json_encode($inputs));
		if($respose->code != 200)
		{
			return 0;
		}
		$body=$respose->body;
		if($body->failure) return $body->failed_list;
		return 1;
		
	}
	public function searchNumbers($inputs=array(),$offset=0,$limit=10)
	{
		$url=$this->_apiUrl."/v2/developer_numbers?offset=".$offset."&limit=".$limit;
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
	public function getInfo($url,$inputs=array())
	{
		$url=$this->_apiUrl.$url;
		$response=Unirest\Request::get($url,$this->_headers,$inputs);
		if($response->code == 200)
		{
			return $response->body;
		}
		return 0;
	}
	public function deleteInfo($doUrl,$inputs)
	{
		$url=$this->_apiUrl.$doUrl;
		$response=Unirest\Request::delete($url,$this->_headers,json_encode($inputs));
		if($response->code == 200)
		{
// 			return $response->body;
			return 1;
		}
		return 0;
	}
	public function putInfo($doUrl,$inputs)
	{
		$url=$this->_apiUrl.$doUrl;
		$response=Unirest\Request::put($url,$this->_headers,json_encode($inputs));
		if($response->code == 200)
		{
// 			return $response->body;
			return 1;
		}
		return 0;
	}
}