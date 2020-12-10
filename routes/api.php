<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('/company','restApi\company');

Route::apiResource('/team','restApi\teamApi');

Route::apiResource('/jobrole','restApi\jobroleApi');

Route::apiResource('/employee','restApi\employeeApi');

Route::apiResource('/physical-stocks-group','restApi\physicalstocksgroupApi');

Route::apiResource('/physical-stocks-product','restApi\physicalstocksproductApi');

Route::apiResource('/digital-stocks-group','restApi\digitalstocksgroupApi');

Route::apiResource('/digital-stocks-product','restApi\digitalstocksproductApi');

Route::apiResource('/subscription-stocks-product','restApi\subscriptionproductsApi');

Route::apiResource('/installment-increment','restApi\installmentincrementApi');