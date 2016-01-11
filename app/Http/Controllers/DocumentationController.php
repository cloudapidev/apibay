<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
    public function show($sec)
    {
        //

        if($sec == "phonenumber"){
            $active = "menu_documentation , menu_documentation_phonenumber";
            $pagetitle = "Phone Number - REST API & SDK";
        }

        if($sec == "serverapp"){
            $active = "menu_documentation , menu_documentation_serverapp";
            $pagetitle = "Server Apps - REST API & SDK";
        }

        if($sec == "clientapp"){
            $active = "menu_documentation , menu_documentation_clientapp";
            $pagetitle = "Client Apps - REST API & SDK";
        }

        if($sec == "billing"){
            $active = "menu_documentation , menu_documentation_billing";
            $pagetitle = "Billing & Reports - REST API & SDK";
        }

        if($sec == "setting"){
            $active = "menu_documentation , menu_documentation_setting";
            $pagetitle = "Settings - REST API & SDK";
        }

        return view('documentation.page',array(
            "sec"=>$sec,
            "active"=>$active,
            "pagetitle"=>$pagetitle
        ));

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
}
