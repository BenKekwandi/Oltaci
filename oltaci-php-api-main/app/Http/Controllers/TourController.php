<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourRequest;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;



class TourController extends Controller
{
    /** Get Tour list */
    public function index(): AnonymousResourceCollection
    {
        return TourResource::collection(Tour::with('boat.pictures', 'boat.equipments','boat.trips','departure','destination')->sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Region list admin */
    public function allTours(): AnonymousResourceCollection
    {
        return TourResource::collection(Tour::with('boat.pictures', 'boat.equipments','boat.trips','departure','destination')->get());
    }
    /**
     * Store Tour.
     */
    public function store(TourRequest $request): TourResource
    {
        return new TourResource(Tour::create($request->validated()));
    }

    /**
     * Display a specified Tour.
     */
    public function show(Tour $Tour)
    {
        return TourResource::make($Tour);
    }

    public function tour($id)
    {
        return TourResource::make(Tour::with('boat.pictures','boat.equipments', 'boat.trips')->findOrFail($id));
    }


    /**
     * Update Tour.
     */
    public function update(TourRequest $request, Tour $tour): TourResource
    {
        $tour->update($request->validated());
        return new TourResource($tour);
    }

    /**
     * Remove Tour.
     */
    public function destroy(Tour $Tour): Response
    {
        $Tour->delete();

        return response()->noContent();
    }
}
