<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return  BrandResource::collection(Brand::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBrandRequest $request
     * @return BrandResource
     */
    public function store(StoreBrandRequest $request)
    {
        $newBrand = Brand::create($request->validated());
        return new BrandResource($newBrand);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return BrandResource
     */
    public function show($id)
    {
        return new BrandResource(Brand::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBrandRequest $request
     * @param int $id
     * @return BrandResource
     */
    public function update(StoreBrandRequest $request, $id)
    {
        $existingBrand = Brand::find($id);
        $existingBrand->update($request->all());
        return new BrandResource($existingBrand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        Brand::destroy($id);
        if (! Brand::find($id)) {
            return "Brand deleted successfuly";
        } else {
            return "Brand not found";
        }
    }
}
