<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoatLogRequest;
use App\Http\Resources\BoatLogResource;
use App\Models\BoatLog;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;

class BoatLogController extends Controller
{
    /** Get BoatLog list */
    public function index(): AnonymousResourceCollection
    {
        return BoatLogResource::collection(BoatLog::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get BoatLog list admin */
    public function allBoatLogs(): AnonymousResourceCollection
    {
        return BoatLogResource::collection(BoatLog::all());
    }

    /**
     * Store BoatLog.
     */
    public function store(BoatLogRequest $request): BoatLogResource
    {
        return new BoatLogResource(BoatLog::create($request->validated()));
    }

    /**
     * Display a specified BoatLog.
     */
    public function show(BoatLog $BoatLog)
    {
        return BoatLogResource::make($BoatLog);
    }


    /**
     * Update BoatLog.
     */
    public function update(BoatLogRequest $request, BoatLog $BoatLog): BoatLogResource
    {
        return new BoatLogResource($BoatLog->update($request->validated()));
    }

    /**
     * Remove BoatLog.
     */
    public function destroy(BoatLog $BoatLog): Response
    {
        $BoatLog->delete();

        return response()->noContent();
    }
}
