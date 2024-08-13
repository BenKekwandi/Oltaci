<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;


class ExpenseController extends Controller
{
    /** Get Expense list */
    public function index(): AnonymousResourceCollection
    {
        return ExpenseResource::collection(Expense::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Expense list admin */
    public function allExpenses(): AnonymousResourceCollection
    {
        return ExpenseResource::collection(Expense::all());
    }

    /**
     * Store Expense.
     */
    public function store(ExpenseRequest $request): ExpenseResource
    {
        return new ExpenseResource(Expense::create($request->validated()));
    }

    /**
     * Display a specified Expense.
     */
    public function show(Expense $Expense)
    {
        return ExpenseResource::make($Expense);
    }


    /**
     * Update Expense.
     */
    public function update(ExpenseRequest $request, Expense $Expense): ExpenseResource
    {
        return new ExpenseResource($Expense->update($request->validated()));
    }

    /**
     * Remove Expense.
     */
    public function destroy(Expense $Expense): Response
    {
        $Expense->delete();

        return response()->noContent();
    }
}
