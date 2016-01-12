<?php
namespace App\Http\Controllers;
class PricingController extends Controller
{
	public function index()
	{
		return view('pricing/index',array(
				"active"=>"menu_pricing , menu_pricing_rate",
				"pagetitle"=>"Check pricing / rates")
				);
		
	}
	
}