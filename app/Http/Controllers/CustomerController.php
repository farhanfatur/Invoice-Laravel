<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    // public function __construct() {
    //     $this->middleware("authAdmin");
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::all();
        return response()->json($customer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $customer = Customer::create([
            "name" => $request->name,
            "age" => $request->age,
            "phone" => $request->phone,
            "address" => $request->address,
            "identity_card" => $request->idcard,
        ]);
        
        $user->customer()->save($customer);

        return response()->json(["status" => true], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $customer = Customer::find($id);
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
        $customer = Customer::with("user")->where("id", $id)->first();
        return response()->json($customer);
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
        $customer = Customer::with("user")->where("id", $id)->first();
        $customer->name = $request->name;
        $customer->age = $request->age;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->identity_card = $request->idcard;
        $customer->save();

        $customer->user->update([
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        return response()->json(["status" => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::with("user")->where("id", $id)->first();
        $customer->user->delete();

        return response()->json(["status" => true], 200);
    }
}
