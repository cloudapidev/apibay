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
				"Content-Type"	=>"application/x-www-form-urlencoded;charset=UTF-8",
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
}