<?php
namespace App\Libraries\Classes;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use App\Libraries\Classes\Ossbss;
class Telaapi{
	
// 	protected $_baseurl="192.168.2.244";
	protected $_apiUrl="http://122.248.203.206:8080/RestCoreApi";
	protected $_authorization='';
	public function __construct()
	{
		$this->setAuthorization();
	}
	protected function setAuthorization()
	{
	
		$apikey="oS3W4emReR55Ie9XI0mIC1fehANMlHXx";
		$secretkey="9EdYm8_o3nJE1Ne4";
		$ts=date('Y-m-d H:i:s O',time());
		$str="abcdefghijklmnopqrstuvwxyz0123456789";
		$nonce=substr(str_shuffle($str),10);
		$hash=base64_encode(md5($apikey.$secretkey.$ts.$nonce));
		$this->_authorization="api_key=$apikey,ts=$ts,nonce=$nonce, X-Security-Sign=$hash";
	}
	public function getListData($doUrl="",$offset=0,$limit=1)
	{
		$apiUrl =$this->_apiUrl;
		$doUrl =!empty($doUrl)?$doUrl:"/v1/accounts";
		$doUrl .= "?offset=".$offset
		."&limit=".$limit;
		
		$url = $apiUrl.$doUrl;
		$header = array(
				"Content-Type"	=>"application/x-www-form-urlencoded;charset=UTF-8",
				"Authorization"=>$this->_authorization
		);
		$client = new Client();
		$res = $client->get($url,array('headers'=>$header));
		if($res->getStatusCode() == '200')
		{
			return $res->getBody();
		}
		return false;
	}
	public function getDataByID($doUrl,$id)
	{
		$apiUrl =$this->_apiUrl;
		$doUrl =!empty($doUrl)?$doUrl:"/v1/accounts";
		$doUrl .= "?id=".$id;
		
		$url = $apiUrl.$doUrl;
		$header = array(
				"Content-Type"	=>"application/x-www-form-urlencoded;charset=UTF-8",
				"Authorization"=>$this->_authorization
		);
		$client = new Client();
		$res = $client->get($url,array('headers'=>$header));
		if($res->getStatusCode() == '200')
		{
			return $res->getBody();
		}
		return false;
		
	}
	
}