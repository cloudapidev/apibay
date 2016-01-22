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
	public function __construct()
	{
		if(empty($this->_authorization))
		{
			$ossbss=new Ossbss();
			$this->_authorization=$ossbss->getAuthorization();
		}
		if(empty($this->_apiUrl))
			$this->_apiUrl=Config("api.apiUrl");
	}
	
	
	public function numberlist($offset=0,$limit=10)
	{
		$apiUrl =$this->_apiUrl;
		$doUrl = $this->_numberUrl."?offset=".$offset
		."&limit=".$limit;
		$url = $apiUrl.$doUrl;
		$header = array(
				"Content-Type"	=>"application/x-www-form-urlencoded;charset=UTF-8",
				"Authorization"=>$this->_authorization
		);
		
		$response = Unirest\Request::get($url,$header);
		if($response->code == '200')
		{
			
			$result['paging']=$response->body->paging;
			$result['data']=empty($response->body->data)?array():$response->body->data;
			return $result;
		}
		return false;
	}
}