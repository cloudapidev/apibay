<?php
namespace App\Libraries\Classes;
use Log;

class Mycurl {
	protected $_useragent = 'Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.1';
	protected $_url;
	protected $_baseurl;
	protected $_followlocation;
	protected $_timeout;
	protected $_maxRedirects;
	protected $_cookieFileLocation = './cookie.txt';
	protected $_post;
	protected $_postFields;
	protected $_referer ="http://www.midnightvip.com";
	protected $_put;
	protected $_get;
	protected $_delete;
	protected $_session;
	protected $_webpage;
	protected $_includeHeader;
	protected $_noBody;
	protected $_status;
	protected $_binaryTransfer;
	Protected $_secretkey="H92-VNN11!mmu7Zz";
	Protected $_apikey="D3pNjr5R010E6Gi6L1z9v11ox33KzpjI";
	protected $_authorization='';
	public    $authentication = 0;
	public    $auth_name      = '';
	public    $auth_pass      = '';
	
	protected $_accept = "text/xml";
// 	protected $_accept = "*/*";
	protected $content_type = "text/html; charset=utf-8";
	protected $_token ;
	
	public function useAuth($use){
		$this->authentication = 0;
		if($use == true) $this->authentication = 1;
	}

	public function setName($name){
		$this->auth_name = $name;
	}
	public function setPass($pass){
		$this->auth_pass = $pass;
	}

	public function __construct($url,$followlocation = true,$timeOut = 30,$maxRedirecs = 4,$binaryTransfer = false,$includeHeader = false,$noBody = false)
	{
		$this->_url = $url;
		$this->_followlocation = $followlocation;
		$this->_timeout = $timeOut;
		$this->_maxRedirects = $maxRedirecs;
		$this->_noBody = $noBody;
		$this->_includeHeader = $includeHeader;
		$this->setAuthorization();
	//	$this->_binaryTransfer = $binaryTransfer;
	//	$this->_cookieFileLocation = dirname(__FILE__).'/cookie.txt';

	}
	public function setAuthorization()
	{
	
		$apikey="oS3W4emReR55Ie9XI0mIC1fehANMlHXx";
		$secretkey="9EdYm8_o3nJE1Ne4";
		$ts=date('Y-m-d H:i:s O',time());
		$str="abcdefghijklmnopqrstuvwxyz0123456789";
		$nonce=substr(str_shuffle($str),10);
		$hash=base64_encode(md5($apikey.$secretkey.$ts.$nonce));
		$this->_authorization="api_key=$apikey,ts=$ts,nonce=$nonce, X-Security-Sign=$hash";
	}
	
	public function setReferer($referer){
		$this->_referer = $referer;
	}
	//set head info 
	public function setAccept($accept){
		$this->_accept = $accept;
	}
	public function setContentType($contentType){
		$this->content_type = $contentType;
	}
	public function setToken($token){
		$this->_token = $token;
	}
	public function getToken(){
		$this->_token;
	}
	public function setCookiFileLocation($path)
	{
		$this->_cookieFileLocation = $path;
	}

	public function setPost ($postFields)
	{
		$this->_post = true;
		$this->_postFields = $postFields;
	}

	public function setUserAgent($userAgent)
	{
		$this->_useragent = $userAgent;
	}

	public function setPut($postFields)
	{
		$this->_put = true;
		$this->_postFields = $postFields;
	}
	public function setGet()
	{
		$this->_get = true;
	}
	public functiOn setDelete()
	{
		$this->_delete=true;
	}
	public function createCurl($url = 'nul')
	{
		if($url != 'nul'){
			$this->_url = $url;
		}

		$s = curl_init();
		curl_setopt($s,CURLOPT_URL,$this->_url);
		$headers = array('Accept:'.$this->_accept,"Content-Type: ".$this->content_type);
		if($this->_authorization)
		{
			echo $this->_authorization."<br>";
			$headers[]='Authorization :'.$this->_authorization;
		}
		curl_setopt($s,CURLOPT_HTTPHEADER,$headers);
		$this->_webpage = curl_exec($s);
		$this->_status = curl_getinfo($s,CURLINFO_HTTP_CODE);
		var_dump($this->_status);
		curl_close($s);die;
		
		
		
		
		
		
		curl_setopt($s,CURLOPT_TIMEOUT,$this->_timeout);
		curl_setopt($s,CURLOPT_MAXREDIRS,$this->_maxRedirects);
		curl_setopt($s,CURLOPT_RETURNTRANSFER,1);
		//curl_setopt($s,CURLOPT_FOLLOWLOCATION,$this->_followlocation);		
		curl_setopt($s,CURLOPT_COOKIEJAR,$this->_cookieFileLocation);
		curl_setopt($s,CURLOPT_COOKIEFILE,$this->_cookieFileLocation);

		if($this->authentication == 1){
			curl_setopt($s, CURLOPT_USERPWD, $this->auth_name.':'.$this->auth_pass);
		}
		
		if($this->_put){
			curl_setopt($s,CURLOPT_CUSTOMREQUEST,'PUT');
			curl_setopt($s,CURLOPT_POSTFIELDS,$this->_postFields);
		}
		if($this->_post)
		{
			curl_setopt($s,CURLOPT_CUSTOMREQUEST,'POST');
			curl_setopt($s,CURLOPT_POSTFIELDS,$this->_postFields);
		}

		if($this->_includeHeader)
		{
			curl_setopt($s,CURLOPT_HEADER,true);
		}
		if($this->_get){
			curl_setopt($s,CURLOPT_CUSTOMREQUEST,'GET');
		}
		if($this->_delete){
			curl_setopt($s,CURLOPT_CUSTOMREQUEST,'DELETE');
		}

		if($this->_noBody)
		{
			curl_setopt($s,CURLOPT_NOBODY,true);
		}
		/*
		 if($this->_binary)
		 {
		curl_setopt($s,CURLOPT_BINARYTRANSFER,true);
		}
		*/
		curl_setopt($s,CURLOPT_USERAGENT,$this->_useragent);
		//curl_setopt($s,CURLOPT_REFERER,$this->_referer);

		$this->_webpage = curl_exec($s);
		$this->_status = curl_getinfo($s,CURLINFO_HTTP_CODE);
		curl_close($s);

	}

	public function getHttpStatus()
	{
		return $this->_status;
	}

	public function __tostring(){
		return $this->_webpage;
	}
	public function getRespose()
	{
		return $this->_webpage;
	}
	
	
	
}