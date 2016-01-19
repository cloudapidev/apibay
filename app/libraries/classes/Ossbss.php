<?php
namespace App\Libraries\Classes;
use Config,Session,Log;
class Ossbss {
	
	/**
	 * 
	 * @author abyssh <yingchun@globalroam.com>
	 */
	public static function setBaseConfig(){				
		$file = "public/app/base/config.txt";
		if(is_file($file) !== false){
			$baseConfig = file_get_contents($file);	
			$config = json_decode($baseConfig,true);
			Config::set('base::app',$config);
		}
	}
	
	public static function setConfig(){			
		$config = self::getConfigFiles();
		//$config list
		Log::info("set config");
		
		foreach ($config as $key=>$val){
			$ones = json_decode($val,true);
			if(is_array($ones)){
				foreach ($ones as $k=>$one){
					Config::set(strtolower($ones['name']).'::app.'.$k,$one);
				}
			}
		}		
		//var_dump(Config::get('sms::channels'));
	}
	
	public static function getConfigFiles(){

		$config = array();
		$dir = "public/app/config/";
		//$dir = "/www/UserFiles/caas/script-php/PhpAppSample/public/app/config/";
		// Open a known directory, and proceed to read its contents
		$files=@scandir($dir);		
		if(is_array($files)){
			foreach ($files as $key=>$val){
				if(is_file($dir.$val) !== false)
				{
					$config[count($config)] = file_get_contents($dir.$val);
				}
			}
		}		
		return $config;		
	}

	/**
	 * 检测用户是否登录
	 * @return integer 0-未登录，大于0-当前登录用户ID
	 * @author Abyssh <huyangin2006@126.com>
	 */
	public static function isLogin(){
		$user = Session::get('account_sid');
		if (empty($user)) {
			return 0;
		} else {
			return 1;
		}
	}
	
	public static function getValidate($user){
		
		//$apiUrl = "http://api.cloudapi.com/";
		$apiUrl = Config::get("usages::app.apiurl");
		$doUrl = "/v1/login/?login_id=".$user['username']."&password=".$user['password'];
		$url = $apiUrl.$doUrl;
		
		//Log::info("login url :".$url);
		$Authorization = self::getAuthorization();
		//var_dump($Authorization);
		
		$header = array(
			"Authorization"=> $Authorization,
			"Content-Type" =>"application/json",		
		);		

		
		$browser = new \Buzz\Browser();
		$response = $browser->get($url,$header);
		$content = $response->getContent();		
		$res = self::dealContent($content);
		return $res;
		
	}
	
	public static function dealContent($content){
		Log::info("in the dealContent,the content is :".$content);
		$pattern="/<pre>(.*?)<\/pre>/si";
		preg_match_all ($pattern, $content, $matches);
		//Log::info("matches is ".json_encode($matches));
		//Log::info("mathches[1][0] is :".$matches[1][0]);
		Log::info("in the dealContent,the matches is ".json_encode($matches));
		Log::info("in the dealContent,the matches is ".$matches[1][0]);
		return $matches[1][0];
	}
	
	public static function getAuthorization(){
		
		$api_key =  "D3pNjr5R010E6Gi6L1z9v11ox33KzpjI";
		$secret_key = "H92-VNN11!mmu7Zz";
		$time = date('Y-m-d H:i:s O',time());
		var_dump($time);
		$randStr = str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz');
		$random = substr($randStr,0,6);
		$str = $api_key.$secret_key.$time.$random;
		$x_security_sign = base64_encode(md5($str));
		
		$Authorization = "api_key=".$api_key.",ts=".$time.",nonce=".$random.",x_security_sign=".$x_security_sign;
		var_dump($Authorization);
		return $Authorization;
	}
	public static function objectToArray($stdclassobject)
	{
		$_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
		foreach ($_array as $key => $value) {
			$value = (is_array($value) || is_object($value)) ? std_class_object_to_array($value) : $value;
			$array[$key] = $value;
		}
		return $array;
	}

	public static function localtime($time){		
		date_default_timezone_set("PRC");
		return $time;
	}
	public static function gmtime($time){
		date_default_timezone_set("UTC");
		return $time;
	}
	
}
