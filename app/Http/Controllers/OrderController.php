<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     * @return OrderResource
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());
        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return OrderResource
     */
    public function show($id)
    {
        return new OrderResource(Order::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return OrderResource
     */
    public function update(Request $request, $id)
    {
        $existingOrder = Order::find($id);
        $existingOrder->update($request->all());
        return new OrderResource($existingOrder);
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
        if (! Order::find($id)) {
            return 'Order deleted successfully';
        } else {
            return 'Order not found';
        }

    }
}
