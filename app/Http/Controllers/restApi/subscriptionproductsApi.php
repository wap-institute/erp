<?php

namespace App\Http\Controllers\restApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscription_product;
use Illuminate\Database\QueryException;
class subscriptionproductsApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $response;
    private $errorCode;
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
        try{
            $this->response = $request->all();
            $this->response['ins_no'] = json_encode($this->response['ins_no']);

            $this->response['each_ins'] = json_encode($this->response['each_ins']);

            $this->response['amount'] = json_encode($this->response['amount']);
            
            Subscription_product::create($this->response);

            return response(array("notice"=>"Entry Success !"),200)->header('Content-Type','application/json');
        }
        catch(QueryException $error){
            $this->errorCode = $error->errorInfo[1];
            if($this->errorCode == '1062')
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
