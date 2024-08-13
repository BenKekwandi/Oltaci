<?php

namespace App\Http\Controllers;
use App\Http\Requests\TripRequest;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;

class TripController extends Controller
{
    /** Get Trip list */
    public function index(): AnonymousResourceCollection
    {
        return TripResource::collection(Trip::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Trip list admin */
    public function allTrips(): AnonymousResourceCollection
    {
        return TripResource::collection(Trip::all());
    }

    /**
     * Store Trip.
     */
    public function store(TripRequest $request): TripResource
    {
        return new TripResource(Trip::create($request->validated()));
    }

    /**
     * Display a specified Trip.
     */
    public function show(Trip $Trip)
    {
        return TripResource::make($Trip);
    }


    /**
     * Update Trip.
     */
    public function update(TripRequest $request, Trip $Trip): TripResource
    {
        return new TripResource($Trip->update($request->validated()));
    }

    /**
     * Remove Trip.
     */
    public function destroy(Trip $Trip): Response
    {
        $Trip->delete();

        return response()->noContent();
    }
}
