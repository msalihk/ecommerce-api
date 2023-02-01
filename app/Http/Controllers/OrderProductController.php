<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderProductResource;
use App\Http\Requests\StoreOrderProductRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderProductResource::collection(OrderProduct::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return OrderProductResource
     */
    public function store(StoreOrderProductRequest $request)
    {
        $newOP = OrderProduct::create($request->validated());
        return new OrderProductResource($newOP);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return OrderProductResource
     */
    public function show($id)
    {
        return new OrderProductResource(OrderProduct::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return OrderProductResource
     */
    public function update(Request $request, $id)
    {
        $existingOP = OrderProduct::find($id);
        $existingOP->update($request->all());
        return new OrderProductResource($existingOP);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        Order::destroy($id);
        return "Success";
    }
}
