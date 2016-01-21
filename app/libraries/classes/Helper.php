<?php
namespace App\Libraries\Classes;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
class Helper{
	
// 	protected $_baseurl="192.168.2.244";
	protected $_apiUrl="http://122.248.203.206:8080/RestCoreApi";
	protected $_authorization='';
	
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
		$this->setAuthorization();
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
		$this->setAuthorization();
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
	public function postData($doUrl,$content=array())
	{
		$apiUrl =$this->_apiUrl;
		$doUrl =!empty($doUrl)?$doUrl:"/v1/accounts";
		$url = $apiUrl.$doUrl;
		$header = array(
				"Content-Type"	=>"application/x-www-form-urlencoded;charset=UTF-8",
				"Authorization"=>$this->_authorization
		);
		$client = new Client();
		$res = $client->post($url,array('headers'=>$header,"form_params"=>$content));
		if($res->getStatusCode() == '200')
		{
			return true;
		}
		return false;
		
	}
	
	public function register($doUrl,$content=array())
	{
		$apiUrl =$this->_apiUrl;
		$doUrl =!empty($doUrl)?$doUrl:"/register";
		$url = $apiUrl.$doUrl;
		$client=new Client();
		$header = array(
				"Content-Type"	=>"application/x-www-form-urlencoded;charset=UTF-8"
		);
// 		$content =  Psr7\stream_for("",$content);
		$res=$client->request('POST',$url,array('form_params'=>$content));
		if($res->getStatusCode == '200')
		return true;
		return false;
		
	}
	public function login($doUrl,$content=array())
	{
		$apiUrl =$this->_apiUrl;
		$doUrl =!empty($doUrl)?$doUrl:"/login";
		$url = $apiUrl.$doUrl;
		$client=new Client();
		$header = array(
				"Content-Type"	=>"application/x-www-form-urlencoded;charset=UTF-8"
		);
		$content['providerId']='GLOBALROAM';
		$content['loginMode']='WEB';
		echo "<pre>";
		var_dump($content);
		$res=$client->request('GET',$url,array('form_params'=>$content));
		$body=$res->getBody();
		var_dump($body);
		if($res->getStatusCode == '200')
			return $body;
		return false;
	}
}