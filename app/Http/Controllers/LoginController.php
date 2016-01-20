<?php namespace App\Http\Controllers;
use Redirect;
use Response;
use Session;
use Illuminate\Http\Request;
use Unirest;
use Validator;


class LoginController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	protected $_apiUrl="http://122.248.203.206:8080/RestCoreApi";

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('login/login');
	}


	//store
	public function store()
	{
		//Session::set('variableName', "aaa");
        return redirect()->action('HomeController@index')->with("success","You have logged in succcessfully.");
	}
	public function postLogin(Request $request)
	{
		$inputs=$request->only("loginId","password");
		$validator = Validator::make($inputs, [
            'loginId' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }
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
			$request->session()->put("userInfo", $res);
			return redirect('/');
		}else 
		{
			return redirect("/login")->withInput();
		}
	}
	public function register()
	{
		return view("login.register");
	}
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
	 * @param string $doUrl
	 * @param string $method
	 * @param string $content
	 * @return boolean or object
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

}
