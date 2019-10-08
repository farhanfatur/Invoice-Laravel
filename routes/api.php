<?php

use Illuminate\Http\Request;

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
Route::resource("customer", "CustomerController");
Route::resource("chart", "ChartController");
Route::resource("product", "ProductController");
Route::resource("invoice", "InvoiceController");
Route::get("/oneinvoice/{id}", "InvoiceController@showProduct");
Route::get("/oneproduct/{id}", "ProductController@showPivot");
Route::delete("/returninvoice/{id}", "InvoiceController@paymentInvoice");
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
