<?php

namespace App\Http\Controllers\restApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Physical_stock_product;
class physicalstocksproductApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $product_images;
    private $filename;
    private $url;
    private $all_data = [];
    private $formdata;
    private $count = 1;
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

        $this->response = Physical_stock_product::where("product_name",$request['product_name'])->get();

        if(count($this->response) == 0)
        {
            foreach($request->file("product_images") as $this->product_images)
            {
                $this->filename = $request['product_name'];
                $this->filename = str_replace(" ", "-", $this->filename);
                $this->filename = $this->filename."-".$this->count;

                $this->filename = $this->filename.".".pathinfo($this->product_images->getClientOriginalName())['extension'];

                $this->filename = strtolower($this->filename);

                $this->count++;

                $this->url = $this->product_images->storeAs("products/physical-products/",$this->filename,"s3");
                array_push($this->all_data, $this->url);
            }

            $this->formdata = $request->all();
            $this->formdata['product_images'] = json_encode($this->all_data);
            
            Physical_stock_product::create($this->formdata);

            return response(array("notice"=>"Entry Success !"),200)->header('Content-Type','application/json');
        }

        else{
            return response(array("notice"=>"Entry Failed ! Duplicate Product"),409)->header('Content-Type','application/json');
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
