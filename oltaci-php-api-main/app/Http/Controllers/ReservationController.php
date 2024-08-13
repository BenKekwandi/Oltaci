<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class ReservationController extends Controller
{
    /** Get Reservation list */
    public function index(): AnonymousResourceCollection
    {
        return ReservationResource::collection(Reservation::with('additionalServices')->sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Reservation list admin */
    public function allReservations(): AnonymousResourceCollection
    {
        return ReservationResource::collection(Reservation::with('additionalServices')->get());
    }

    /**
     * Store Reservation.
     */
    public function store(ReservationRequest $request): ReservationResource
    {
        return new ReservationResource(Reservation::create($request->validated()));
    }

    /**
     * Display a specified Reservation.
     */
    public function show(Reservation $Reservation)
    {
        return ReservationResource::make($Reservation);
    }


    /**
     * Update Reservation.
     */
    public function update(ReservationRequest $request, Reservation $reservation): ReservationResource
    {
        $reservation->update($request->validated());
        return new ReservationResource($reservation);
    }

    /**
     * Remove Reservation.
     */
    public function destroy(Reservation $Reservation): Response
    {
        $Reservation->delete();

        return response()->noContent();
    }
}

