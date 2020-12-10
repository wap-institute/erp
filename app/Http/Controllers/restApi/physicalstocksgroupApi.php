<?php

namespace App\Http\Controllers\restApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Physical_stock_group;
use Illuminate\Database\QueryException;
class physicalstocksgroupApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $error_code;
    private $response;
    public function index()
    {
        $this->response = Physical_stock_group::get();
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
            Physical_stock_group::create($request->all());

            return response(array("notice"=>"Group Created !"),200)->header('Content-Type','application/json');
        }
        catch(QueryException $error){
            $this->error_code = $error->errorInfo[1];
            if($this->error_code == '1062')
            {
               return response(array("notice"=>"Duplicate Entry !"),409)->header('Content-Type','application/json');
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
