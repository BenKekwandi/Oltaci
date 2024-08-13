<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoatMaintenanceRequest;
use App\Http\Resources\BoatMaintenanceResource;
use App\Models\BoatMaintenance;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;

class BoatMaintenanceController extends Controller
{
    /** Get BoatMaintenance list */
    public function index(): AnonymousResourceCollection
    {
        return BoatMaintenanceResource::collection(BoatMaintenance::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get BoatMaintenance list admin */
    public function allBoatMaintenances(): AnonymousResourceCollection
    {
        return BoatMaintenanceResource::collection(BoatMaintenance::all());
    }

    /**
     * Store BoatMaintenance.
     */
    public function store(BoatMaintenanceRequest $request): BoatMaintenanceResource
    {
        return new BoatMaintenanceResource(BoatMaintenance::create($request->validated()));
    }

    /**
     * Display a specified BoatMaintenance.
     */
    public function show(BoatMaintenance $BoatMaintenance)
    {
        return BoatMaintenanceResource::make($BoatMaintenance);
    }


    /**
     * Update BoatMaintenance.
     */
    public function update(BoatMaintenanceRequest $request, BoatMaintenance $BoatMaintenance): BoatMaintenanceResource
    {
        return new BoatMaintenanceResource($BoatMaintenance->update($request->validated()));
    }

    /**
     * Remove BoatMaintenance.
     */
    public function destroy(BoatMaintenance $BoatMaintenance): Response
    {
        $BoatMaintenance->delete();

        return response()->noContent();
    }
}
