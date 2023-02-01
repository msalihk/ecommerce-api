<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return AddressResource::collection(Address::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAddressRequest $request
     * @return AddressResource
     */
    public function store(StoreAddressRequest $request)
    {
        $validated = $request->validated();
        $newAddress = Address::create($validated);
        return new AddressResource($newAddress);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AddressResource
     */
    public function show($id)
    {
        return new AddressResource(Address::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAddressRequest $request
     * @param int $id
     * @return AddressResource
     */
    public function update(UpdateAddressRequest $request, $id)
    {
        $address = Address::find($id);
        $address->update($request->all());
        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        Address::destroy($id);
        if (! Address::find($id)) {
            return 'Address deleted successfully';
        } else {
            return 'Address not found';
        }
    }
}
