<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoatFuelingRequest;
use App\Http\Resources\BoatFuelingResource;
use App\Models\BoatFueling;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;

class BoatFuelingController extends Controller
{
    /** Get BoatFueling list */
    public function index(): AnonymousResourceCollection
    {
        return BoatFuelingResource::collection(BoatFueling::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get BoatFueling list admin */
    public function allBoatFuelings(): AnonymousResourceCollection
    {
        return BoatFuelingResource::collection(BoatFueling::all());
    }

    /**
     * Store BoatFueling.
     */
    public function store(BoatFuelingRequest $request): BoatFuelingResource
    {
        return new BoatFuelingResource(BoatFueling::create($request->validated()));
    }

    /**
     * Display a specified BoatFueling.
     */
    public function show(BoatFueling $BoatFueling)
    {
        return BoatFuelingResource::make($BoatFueling);
    }


    /**
     * Update BoatFueling.
     */
    public function update(BoatFuelingRequest $request, BoatFueling $BoatFueling): BoatFuelingResource
    {
        return new BoatFuelingResource($BoatFueling->update($request->validated()));
    }

    /**
     * Remove BoatFueling.
     */
    public function destroy(BoatFueling $BoatFueling): Response
    {
        $BoatFueling->delete();

        return response()->noContent();
    }
}
