<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;

class PaymentController extends Controller
{
    /** Get Payment list */
    public function index(): AnonymousResourceCollection
    {
        return PaymentResource::collection(Payment::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Payment list admin */
    public function allPayments(): AnonymousResourceCollection
    {
        return PaymentResource::collection(Payment::all());
    }
    /**
     * Store Payment.
     */
    public function store(PaymentRequest $request): PaymentResource
    {
        return new PaymentResource(Payment::create($request->validated()));
    }

    /**
     * Display a specified Payment.
     */
    public function show(Payment $Payment)
    {
        return PaymentResource::make($Payment);
    }


    /**
     * Update Payment.
     */
    public function update(PaymentRequest $request, Payment $Payment): PaymentResource
    {
        return new PaymentResource($Payment->update($request->validated()));
    }

    /**
     * Remove Payment.
     */
    public function destroy(Payment $Payment): Response
    {
        $Payment->delete();

        return response()->noContent();
    }
}
