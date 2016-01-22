<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http;
use App\Model;
use App\Model\Numberapi;
use App\Libraries\Classes\Ossbss;
class NumbersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	protected $_perNums=1;
    public function index(Request $request,$page=1)
    {
    	$numberapi=new Numberapi();
    	$res=$numberapi->numberlist($page-1,$this->_perNums);
    	$Ossbss=new Ossbss();
    	$pagelist=$Ossbss->createPage("/numbers",$res['paging']->total,$page,$this->_perNums);
        return view("number/listing",array(
                "active"=>"menu_number , menu_number_listing",
                "pagetitle"=>"Numbers Listing",
        		'listDatas'=>$res['data'],
        		'pagelist'=>$pagelist
            )
        ); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view("number/edit",array(
                "active"=>"menu_number , menu_number_listing",
                "pagetitle"=>"Manage Number",
                "id"=>$id
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


     public function buy()
    {
        //
        return view("number/buy",array(
                "active"=>"menu_number , menu_number_new",
                "pagetitle"=>"Buy new phone number"
            )
        );
    }

	
}
