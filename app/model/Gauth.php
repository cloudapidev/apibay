<?php

namespace App\Model;

use Redirect;
use Response;
use Illuminate\Http\Request;
use Unirest;
use Illuminate\Http\Illuminate\Http;
use Session;

class Gauth 
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
//     protected $redirectTo = '/home';
    protected $redirectPath="/";
    protected $loginPath = '/login';
    protected $_apiUrl="http://122.248.203.206:8080/RestCoreApi";
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
 /*    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    } */
    public function register()
    {
    	return view("auth/register");
    }
    public function getLogin()
    {
    	return view('auth/login');
    }
    public function postLogin(Request $request)
    {
    	$inputs=$request->only("loginId","password");
    	$validator = Validator::make($inputs, [
    			'loginId' => 'required',
    			'password' => 'required',
    	]);
    
    	if($validator->fails())
    	{
    		return redirect('/login')
    		->withErrors($validator)
    		->withInput();
    
    	}
    	$inputs['password']=md5($inputs['password']);
    	$inputs['loginMode']='WEB';
    	$res=$this->UnirestapiLogin($inputs);
    	if($res)
    	{
			Session::put('account_sid', $res->id);
    		return redirect('/'); 
    	}else
    	{
    		return redirect("/login")->withInput()->with('error','email or password is error');
    	}
    }
    public function getRegister()
    {
    	return view("auth.register");
    }
    /**
     * @param Request $request
     * @return Ambigous
     */
    public function postregister(Request $request)
    {
    	$inputs=$request->all();
    	$inputs=$request->only("full_name","email","password");
    	$inputs['password']=md5($inputs['password']);
    	$doUrl="/register";
    	$res=$this->UnirestapiRegister($inputs);
    	if($res)
    	{
    		return redirect("/login");
    	}else
    	{
    		return redirect("/register")->withInput();
    	}
    }
  
    /**
     * @param array $content
     * @return object|boolean
     */
    protected function UnirestapiRegister($content)
    {
    
    	$apiUrl =$this->_apiUrl;
    	$url = $apiUrl."/register";
    	$headers=array( "Content-Type" => "application/json",
    			"Accept" => "application/json");
    	$response = Unirest\Request::post($url,$headers,json_encode($content));
    	if($response->code == '201')
    	{
    		$res['code']=200;
    		$res['body']=$response->body;
    		return $res;
    	}elseif($response->code == '403')
    	{
    		$res['code']=403;
    		$res['body']="This email has exist.";
    		return $res;
    	}
    	return false;
    
    }
    /**
     * 
     * @param array $content
     * @return boolean or object
     */
    protected function UnirestapiLogin($content)
    {
    
    	$apiUrl =$this->_apiUrl;
    	$url = $apiUrl."/login";
    	$headers=array( "Content-Type" => "application/x-www-form-urlencoded;",
    			"Accept" => "application/json");
    	$response = Unirest\Request::get($url,$headers,$content);
    	if($response->code == '200')
    		return $response->body;
    	return false;
    
    }
    /**
     * 检测用户是否登录
     * @return integer 0-未登录，大于0-当前登录用户ID
     * @author Abyssh <huyangin2006@126.com>
     */
    public static function check(){
    	$user = Session::get('account_sid');
		
    	if (empty($user)) {
    		return 0;
    	} else {
    		return 1;
    	}
    }
}
