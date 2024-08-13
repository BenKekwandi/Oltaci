<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdditionalServiceRequest;
use App\Http\Resources\AdditionalServiceResource;
use App\Models\AdditionalService;
use Barryvdh\Reflection\DocBlock\Type\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdditionalServiceController extends Controller
{
     /** Get AdditionalService list */
    public function index(): AnonymousResourceCollection
    {
        return AdditionalServiceResource::collection(AdditionalService::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get AdditionalService list admin */
    public function allAdditionalServices(): AnonymousResourceCollection
    {
        return AdditionalServiceResource::collection(AdditionalService::all());
    }

    /**
     * Store AdditionalService.
     */
    public function store(AdditionalServiceRequest $request): AdditionalServiceResource
    {
        return new AdditionalServiceResource(AdditionalService::create($request->validated()));
    }

    /**
     * Display a specified AdditionalService.
     */
    public function show(AdditionalService $additionalService)
    {
        return AdditionalServiceResource::make($additionalService);
    }


    /**
     * Update AdditionalService.
     */
    public function update(AdditionalServiceRequest $request, AdditionalService $additionalService): AdditionalServiceResource
    {
        $additionalService->update($request->validated());
        return new AdditionalServiceResource($additionalService);
    }

    /**
     * Remove AdditionalService.
     */
    public function destroy(AdditionalService $additionalService): Response
    {
        $additionalService->delete();

        return response()->noContent();
    }
}
