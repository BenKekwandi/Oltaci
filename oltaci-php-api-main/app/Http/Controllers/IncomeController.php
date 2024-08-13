<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use App\Http\Resources\IncomeResource;
use App\Models\Income;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;

class IncomeController extends Controller
{
    /** Get Income list */
    public function index(): AnonymousResourceCollection
    {
        return IncomeResource::collection(Income::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Income list admin */
    public function allIncomes(): AnonymousResourceCollection
    {
        return IncomeResource::collection(Income::all());
    }
    /**
     * Store Income.
     */
    public function store(IncomeRequest $request): IncomeResource
    {
        return new IncomeResource(Income::create($request->validated()));
    }

    /**
     * Display a specified Income.
     */
    public function show(Income $Income)
    {
        return IncomeResource::make($Income);
    }


    /**
     * Update Income.
     */
    public function update(IncomeRequest $request, Income $income): IncomeResource
    {
        return new IncomeResource($income->update($request->validated()));
    }

    /**
     * Remove Income.
     */
    public function destroy(Income $income): Response
    {
        $income->delete();

        return response()->noContent();
    }
}
