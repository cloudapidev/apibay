<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/24
 * Time: 15:27
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http;
use App\Model\Numberapi;
use App\Libraries\Classes\Ossbss;

class TestController extends Controller{
    protected $_perNums=2;
    public function index(Request $request){
        $a= $request->only('page');

        if($a['page']==null)
        {
            $page=1;
        }else{
            $inputs=$request->only('page');//只获取页码数
            $page=$inputs['page'];
        }


        $offset=($page-1)*($this->_perNums);
        $data['offset']=$offset;

        $data['limit']=$this->_perNums;

        $ossbss=new Ossbss();
        $res=$ossbss->getInfo("numbers.showList",$data);


        $res['data']=isset($res['data'])?$res['data']:array();


        return view('test/testing',array(
                "active"=>"menu_number , menu_number_listing",
                "pagetitle"=>"Numbers Listing",
                'listDatas'=>$res['data']

            )
        );
    }
}