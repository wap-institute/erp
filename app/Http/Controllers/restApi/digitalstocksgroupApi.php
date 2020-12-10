<?php

namespace App\Http\Controllers\restApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Digital_stock_group;
use Illuminate\Database\QueryException;
class digitalstocksgroupApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $error;
    private $response;
    public function index()
    {
        $this->response = Digital_stock_group::get();
        if(count($this->response) != 0)
        {
            return response(array("data"=>$this->response),200)->header('Content-Type','application/json');
        }

        else{
            return response(array("notice"=>"Data Not Found !"),404)->header('Content-Type','application/json');
        }
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
        try{
            Digital_stock_group::create($request->all());
            return response(array("notice"=>"Entry Success !"),200)->header('COntent-Type','application/json');
        }
        catch(QueryException $error){
            $this->error = $error->errorInfo[1];
            if($this->error == '1062')
            {
                return response(array("notice"=>"Duplicate Entry !"),409)->header('COntent-Type','application/json');
            }
        }
        
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
