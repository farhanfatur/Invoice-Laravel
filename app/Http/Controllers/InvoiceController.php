<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::with("product")->get();
        return response()->json($customer, 200);
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
        $customer;
        if($request->user_id) {
            $customerRelation = Customer::with("user")->where("user_id", $request->user_id)->first();
            $customer = Customer::find($customerRelation->id);
        }else {
            $customer = Customer::find($request->customer_id);
        }
        // 
    	$customer->product()->attach($request->product_id, ["total_price" => $request->totalPrice, "dateofentry" => $request->dateentry, "dateofissue" => $request->dateissue, "status" => "not return"]);
        Product::find($request->product_id)->decrement("stock");
    	return response()->json(["status" => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProduct($id) {
        $customer = Customer::with("product")->where("id", $id)->first();
        return response()->json($customer);
    }

    public function show($id)
    {
        $customer = Customer::with("user")->where("user_id", $id)->first();
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     	
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

    }

    public function paymentInvoice(Request $request, $id)
    {
        Product::find($id)->increment("stock");
        $customer = Customer::find($request->customer_id);
        $statusinvoices = $customer->product()->sync($request->product_id);
        dd($statusinvoices);
        foreach($statusinvoices as $statusinvoice) {
            if ($statusinvoice->pivot->status == "return") {
                return response()->json(["status" => false, "message" => "The Product has been return"]);
            }
        }
        $customer->product()->updateExistingPivot($request->product_id, ["status" => "return", "restofprice" => $request->remaincost]);
        // $customer->product()->detach($request->product_id);

        return response()->json(["status" => true], 200);
    }
}
