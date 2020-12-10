<?php

namespace App\Http\Controllers\restApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Digital_stock_product;

class digitalstocksproductApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $image;
    private $alldata;
    private $filename;
    private $url;
    private $response;
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
        $this->response = Digital_stock_product::where("product_name",$request['product_name'])->get();

        if(count($this->response) == 0)
        {
            $this->image = $request->file('product_image');

            $this->filename = $request['product_name'];

            $this->filename = str_replace(" ", "-", $this->filename);

            $this->filename = $this->filename.".".pathinfo($this->image->getClientOriginalName())['extension'];

            $this->url = $this->image->storeAs("products/digital-products",$this->filename,"s3");
            $this->alldata = $request->all();
            $this->alldata['product_image'] = $this->url;
            Digital_stock_product::create($this->alldata);
            return response(array("notice"=>"Entry Success !"),200)->header('Content-Type','application/json');
        }

        else{
            return response(array("notice"=>"Duplicate Entry !"),409)->header('Content-Type','application/json');
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
