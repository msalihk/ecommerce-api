<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartProductResource;
use App\Http\Requests\StoreCartProductRequest;
use App\Models\CartProduct;
use Illuminate\Http\Request;

class CartProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CartProductResource::collection(CartProduct::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CartProductResource
     */
    public function store(StoreCartProductRequest $request)
    {
        $newcp = CartProduct::create($request->validated());
        return new CartProductResource($newcp);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CartProductResource
     */
    public function show($id)
    {
        return new CartProductResource(CartProduct::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return CartProductResource
     */
    public function update(Request $request, $id)
    {
        $existingCp = CartProduct::find($id);
        $existingCp->update($request->all());
        return new CartProductResource($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        CartProduct::destroy($id);
        return "Success";
    }
}
