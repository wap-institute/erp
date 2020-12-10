<?php

namespace App\Http\Controllers\restApi;
require_once("../vendor/autoload.php");

use Aws\S3\S3Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
class employeeApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $allFiles;
    private $alldata = [];
    private $file;
    private $fileName;
    private $path;
    private $url;
    private $index = 0;
    private $id;
    private $folderName;
    private $response;
    private $generateUrl;
    private $limit;
    private $allUrl = array(
        "employee_pic" => "",
        "residential_proof" => "",
        "qualification_proof" => "",
        "certification_proof" => "",
        "salary_sleep" => []
    );
    private $allData;
    private $key;
    private $pagination;
    private $column_name;
    public function index(Request $request)
    {
        if($request["fetch_type"] == "pagination")
        {
            $this->limit = $request['limit'];

            $this->response = Employee::paginate($this->limit);

            if(count($this->response) != 0)
            {
                $this->pagination = $this->response;

                foreach($this->response as $this->response){
                    $this->key = $this->response->employee_pic;

                    $this->generateUrl = generateUrl::url($this->key);

                    $this->response->employee_pic = $this->generateUrl;
                    
                    array_push($this->alldata,$this->response);


                }

                return response(array("data"=>$this->alldata,"pagination"=>$this->pagination),200)->header('Content-Type','application/json');

            }

            else{
                return response(array("notice"=>"Data not found !"),404)->header('Content-Type','application/json');
            }
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
        // find the id
        $this->id = Employee::orderBy("id","desc")->limit(1)->get();
        if(count($this->id) != 0)
        {
            foreach($this->id as $this->id)
            {
                $this->id = $this->id->id+1;
            }
        }
        
        else{
            $this->id = 1;
        }

        $this->allFiles = $request->file();

        if($request->hasFile("salary_sleep"))
        {
            foreach($request->file("salary_sleep") as $this->file)
            {
               $this->fileName = strtolower($this->file->getClientOriginalName());
               $this->folderName = "employees/".$this->id.". ".$request['employee_name'];

                $this->path = $this->file->storeAs($this->folderName,$this->fileName,"s3");

                $this->url = $this->path;

                $this->allUrl["salary_sleep"][$this->index] = $this->url;

                $this->index++;
            }

            unset($this->allFiles['salary_sleep']);

        }

        foreach($this->allFiles as $this->key => $this->file)
            {
                $this->fileName = strtolower($this->file->getClientOriginalName());

                $this->folderName = "employees/".$this->id.". ".$request['employee_name'];


                $this->path = $this->file->storeAs($this->folderName,$this->fileName,"s3");

                $this->url = $this->path;

                $this->allUrl[$this->key] = $this->url;
            }

            $this->allData = $request->all();
            $this->allData['employee_pic'] = $this->allUrl['employee_pic'];
            $this->allData['residential_proof'] = $this->allUrl['residential_proof'];
            $this->allData['qualification_proof'] = $this->allUrl['qualification_proof'];
            $this->allData['certification_proof'] = $this->allUrl['certification_proof'];

            if($request->hasFile("salary_sleep"))
            {
                 $this->allData['salary_sleep'] = json_encode($this->allUrl['salary_sleep']);
            }

            Employee::create($this->allData);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($keyword,Request $request)
    {
        $this->column_name = $request['findby'];

        if($request["fetch_type"] == "pagination")
        {
            $this->limit = $request['limit'];

        $this->response = Employee::where($this->column_name,'like','%'.$keyword.'%')->paginate($this->limit);

            if(count($this->response) != 0)
            {
                $this->pagination = $this->response;

                foreach($this->response as $this->response){
                    $this->key = $this->response->employee_pic;

                    $this->generateUrl = generateUrl::url($this->key);

                    $this->response->employee_pic = $this->generateUrl;
                    
                    array_push($this->alldata,$this->response);


                }

                return response(array("data"=>$this->alldata,"pagination"=>$this->pagination),200)->header('Content-Type','application/json');

            }

            else{
                return response(array("notice"=>"Data not found !"),404)->header('Content-Type','application/json');
            }
        }
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

class generateUrl{
    private static $s3;
    private static $securedAccess;
    private static $url;
    private static $signedUrl;
    private static $key;

    public static function url($key){
        self::$key = $key;

        self::$s3 = new S3Client(array(
    "version" => "latest",
    "region"  => "ap-south-1",
    "credentials" => array(
        "key" => "AKIAQDTJMFEFKDKDQULQ",
        "secret" => "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",
        ),
    ));

    self::$securedAccess = self::$s3->getCommand('GetObject',array(
        "Bucket" => "erp.wes.com",
        "Key"   => self::$key
    ));

    self::$url = self::$s3->createPresignedRequest(self::$securedAccess,"+10 minutes");

    self::$signedUrl = self::$url->getUri();

    return strval(self::$signedUrl);
    }
}