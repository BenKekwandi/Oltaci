<?php

namespace App\Http\Controllers;
use App\Http\Requests\CatchRecordRequest;
use App\Http\Resources\CatchRecordResource;
use App\Models\CatchRecord;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;

class CatchRecordController extends Controller
{
    /** Get CatchRecord list */
    public function index(): AnonymousResourceCollection
    {
        return CatchRecordResource::collection(CatchRecord::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get CatchRecord list admin */
    public function allCatchRecords(): AnonymousResourceCollection
    {
        return CatchRecordResource::collection(CatchRecord::all());
    }

    /**
     * Store CatchRecord.
     */
    public function store(CatchRecordRequest $request): CatchRecordResource
    {
        return new CatchRecordResource(CatchRecord::create($request->validated()));
    }

    /**
     * Display a specified CatchRecord.
     */
    public function show(CatchRecord $CatchRecord)
    {
        return CatchRecordResource::make($CatchRecord);
    }


    /**
     * Update CatchRecord.
     */
    public function update(CatchRecordRequest $request, CatchRecord $CatchRecord): CatchRecordResource
    {
        return new CatchRecordResource($CatchRecord->update($request->validated()));
    }

    /**
     * Remove CatchRecord.
     */
    public function destroy(CatchRecord $CatchRecord): Response
    {
        $CatchRecord->delete();

        return response()->noContent();
    }
}
