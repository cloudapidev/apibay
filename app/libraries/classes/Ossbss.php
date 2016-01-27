<?php
namespace App\Libraries\Classes;
use Config,Session,Log;
class Ossbss {
	/**
	 * create the authorizataion
	 * @return string
	 */
	protected $_pageLimit=10;
	protected $_showpage=5;
	public function getAuthorization()
	{
		$apikey="D3pNjr5R010E6Gi6L1z9v11ox33KzpjI";
		$secretkey="H92-VNN11!mmu7Zz";
		$ts=date('Y-m-d H:i:s O',time());
		$str="abcdefghijklmnopqrstuvwxyz0123456789";
		$nonce=substr(str_shuffle($str),10);
		$hash=base64_encode(md5($apikey.$secretkey.$ts.$nonce));
		return "api_key=$apikey,ts=$ts,nonce=$nonce, X-Security-Sign=$hash";
	}
	
}
