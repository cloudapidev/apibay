<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

use Redirect;
use App\Model;
use App\Model\Gauth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
		
		
		//perforrm check on custom user login
		 public function __construct()
		{
			
			if(!Gauth::check()){
				/* dd(Session::all()); */
				
				Redirect::to('login')->send();
				
			}
	
			//$this->middleware('auth');

		}  
		
}
