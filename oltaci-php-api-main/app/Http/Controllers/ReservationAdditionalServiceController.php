<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationAdditionalServiceRequest;
use App\Http\Resources\ReservationAdditionalServiceResource;
use App\Models\ReservationAdditionalService;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReservationAdditionalServiceController extends Controller
{
     /** Get ReservationAdditionalService list */
    public function index(): AnonymousResourceCollection
    {
        return ReservationAdditionalServiceResource::collection(ReservationAdditionalService::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get ReservationAdditionalService list admin */
    public function allReservationAdditionalServices(): AnonymousResourceCollection
    {
        return ReservationAdditionalServiceResource::collection(ReservationAdditionalService::all());
    }

    /**
     * Store ReservationAdditionalService.
     */
    public function store(ReservationAdditionalServiceRequest $request): ReservationAdditionalServiceResource
    {
        return new ReservationAdditionalServiceResource(ReservationAdditionalService::create($request->validated()));
    }

    /**
     * Display a specified ReservationAdditionalService.
     */
    public function show(ReservationAdditionalService $ReservationadditionalService)
    {
        return ReservationAdditionalServiceResource::make($ReservationadditionalService);
    }


    /**
     * Update ReservationAdditionalService.
     */
    public function update(ReservationAdditionalServiceRequest $request, ReservationAdditionalService $ReservationadditionalService): ReservationAdditionalServiceResource
    {
        $ReservationadditionalService->update($request->validated());
        return new ReservationAdditionalServiceResource($ReservationadditionalService);
    }

    /**
     * Remove ReservationAdditionalService.
     */
    public function destroy(ReservationAdditionalService $ReservationadditionalService): Response
    {
        $ReservationadditionalService->delete();

        return response()->noContent();
    }
}
