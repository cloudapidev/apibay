<?php
namespace App\Libraries\Classes;
use Config,Session,Log;
use Unirest;
use App\Libraries\Functions;
class Ossbss {
	/**
	 * create the authorizataion
	 * @return string
	 */
	protected $_pageLimit=10;
	protected $_showpage=5;
	protected $_headers=array();
	public function __construct()
	{
		if(empty($this->_authorization))
		{
			$this->_authorization=getAuthorization();
		}
		if(empty($this->_headers))
			$this->_headers=array(
					"Content-Type"	=>"application/json;charset=UTF-8",
					"Authorization"=>$this->_authorization
			);
		//Log::info($this->_headers['Authorization']);
	}
	public function getInfo($url,$inputs=null,$param=null)
	{
		$url=setApiUrl($url,$param);
		//Log::info($url."\n");

		$response=Unirest\Request::get($url,$this->_headers,$inputs);
		//Log::info(json_encode($response)."\n");

		return dealResponse($response);
	}
	public function deleteInfo($url,$inputs=null,$param=null)
	{
		$url=setApiUrl($url,$param);
		//Log::info($url);

		$response=Unirest\Request::delete($url,$this->_headers,json_encode($inputs));
		//Log::info(json_encode($response));
		return dealResponse($response);
	}
	public function postInfo($url,$inputs=null,$param=null)
	{

		$url=setApiUrl($url,$param);
		//Log::info($url);
		$response=Unirest\Request::post($url,$this->_headers,json_encode($inputs));
	//Log::info(json_encode($response));
		return dealResponse($response);
	}
	public function putInfo($url,$inputs=null,$param=null)
	{
		$url=setApiUrl($url,$param);

		$response=Unirest\Request::put($url,$this->_headers,json_encode($inputs));

		return dealResponse($response);
	}
}
