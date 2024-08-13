<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TransactionController extends Controller
{
    /** Get Transaction list */
    public function index(): AnonymousResourceCollection
    {
        return TransactionResource::collection(Transaction::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Region list admin */
    public function allTransactions(): AnonymousResourceCollection
    {
        return TransactionResource::collection(Transaction::all());
    }
    /**
     * Store Transaction.
     */
    public function store(TransactionRequest $request): TransactionResource
    {
        return new TransactionResource(Transaction::create($request->validated()));
    }

    /**
     * Display a specified Transaction.
     */
    public function show(Transaction $transaction)
    {
        return TransactionResource::make($transaction);
    }


    /**
     * Update Transaction.
     */
    public function update(TransactionRequest $request, Transaction $transaction): TransactionResource
    {
        return new TransactionResource($transaction->update($request->validated()));
    }

    /**
     * Remove Transaction.
     */
    public function destroy(Transaction $transaction): Response
    {
        $transaction->delete();

        return response()->noContent();
    }
}
