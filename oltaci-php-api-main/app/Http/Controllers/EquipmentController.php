<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;

class EquipmentController extends Controller
{
    /** Get Equipment list */
    public function index(): AnonymousResourceCollection
    {
        return EquipmentResource::collection(Equipment::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Equipment list admin */
    public function allEquipments(): AnonymousResourceCollection
    {
        return EquipmentResource::collection(Equipment::all());
    }

    /**
     * Store Equipment.
     */
    public function store(EquipmentRequest $request): EquipmentResource
    {
        return new EquipmentResource(Equipment::create($request->validated()));
    }

    /**
     * Display a specified Equipment.
     */
    public function show(Equipment $Equipment)
    {
        return EquipmentResource::make($Equipment);
    }


    /**
     * Update Equipment.
     */
    public function update(EquipmentRequest $request, Equipment $Equipment): EquipmentResource
    {
        return new EquipmentResource($Equipment->update($request->validated()));
    }

    /**
     * Remove Equipment.
     */
    public function destroy(Equipment $Equipment): Response
    {
        $Equipment->delete();

        return response()->noContent();
    }
}
