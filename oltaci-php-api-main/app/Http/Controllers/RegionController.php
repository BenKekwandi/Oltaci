<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionRequest;
use App\Http\Resources\RegionResource;
use App\Models\Region;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class RegionController extends Controller
{
    /** Get Region list */
    public function index(): AnonymousResourceCollection
    {
        return RegionResource::collection(Region::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Region list admin */
    public function allRegions(): AnonymousResourceCollection
    {
        return RegionResource::collection(Region::all());
    }
    /**
     * Store a Region.
     */
    public function store(RegionRequest $request): RegionResource
    {
        return new RegionResource(Region::create($request->validated()));
    }

    /**
     * Display a specified Region.
     */
    public function show(Region $Region)
    {
        return RegionResource::make($Region);
    }


    /**
     * Update Region.
     */
    public function update(RegionRequest $request, Region $region): RegionResource
    {
        $region->update($request->validated());
        return new RegionResource($region);
    }

    /**
     * Remove Region.
     */
    public function destroy(Region $Region): Response
    {
        $Region->delete();

        return response()->noContent();
    }
}
