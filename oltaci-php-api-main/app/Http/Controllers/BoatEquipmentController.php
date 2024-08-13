<?php

namespace App\Http\Controllers;


use App\Http\Requests\BoatEquipmentRequest;
use App\Http\Resources\BoatEquipmentResource;
use App\Models\BoatEquipment;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;

class BoatEquipmentController extends Controller
{
    /** Get BoatEquipment list */
    public function index(): AnonymousResourceCollection
    {
        return BoatEquipmentResource::collection(BoatEquipment::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get BoatEquipment list admin */
    public function allBoatEquipments(): AnonymousResourceCollection
    {
        return BoatEquipmentResource::collection(BoatEquipment::all());
    }

    /**
     * Store BoatEquipment.
     */
    public function store(BoatEquipmentRequest $request): BoatEquipmentResource
    {
        return new BoatEquipmentResource(BoatEquipment::create($request->validated()));
    }

    /**
     * Display a specified BoatEquipment.
     */
    public function show(BoatEquipment $BoatEquipment)
    {
        return BoatEquipmentResource::make($BoatEquipment);
    }


    /**
     * Update BoatEquipment.
     */
    public function update(BoatEquipmentRequest $request, BoatEquipment $BoatEquipment): BoatEquipmentResource
    {
        return new BoatEquipmentResource($BoatEquipment->update($request->validated()));
    }

    /**
     * Remove BoatEquipment.
     */
    public function destroy(BoatEquipment $BoatEquipment): Response
    {
        $BoatEquipment->delete();

        return response()->noContent();
    }
}
