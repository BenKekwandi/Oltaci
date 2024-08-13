<?php

namespace App\Http\Controllers;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Log;


class InvoiceController extends Controller
{
    /** Get Invoice list */
    public function index(): AnonymousResourceCollection
    {
        return InvoiceResource::collection(Invoice::sort()->filter()->paginate(Request::get('per_page')));
    }

    /** Get Invoice list admin */
    public function allInvoices(): AnonymousResourceCollection
    {
        return InvoiceResource::collection(Invoice::all());
    }
    /**
     * Store Invoice.
     */
    public function store(InvoiceRequest $request): InvoiceResource
    {
        $path = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('invoices', $fileName, 'public');
        }
        $validatedData = $request->validated();
        $validatedData['invoice_file'] = $path;
        $invoice =Invoice::create($validatedData);

        return new InvoiceResource($invoice);
    }

    /**
     * Display a specified Invoice.
     */
    public function show(Invoice $Invoice)
    {
        return InvoiceResource::make($Invoice);
    }


    /**
     * Update Invoice.
     */
    public function update(InvoiceRequest $request, Invoice $Invoice): InvoiceResource
    {
        $path = null;
        if ($request->picture) {
            $parsedUrl = parse_url($request->picture);
            $paths = $parsedUrl['path'];
            $path = substr($paths, strpos($paths, '/storage/') + strlen('/storage/'));
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('invoices', $fileName, 'public');
        }

        if (!is_string($request->file('file')) && $path && $Invoice->invoice_file != $path) {
            Storage::disk('public')->delete($Invoice->invoice_file);
            $Invoice->update(['invoice_file' => $path]);
        }

        $Invoice->update($request->validated());

        return new InvoiceResource($Invoice);
    }

    /**
     * Remove Invoice.
     */
    public function destroy(Invoice $Invoice): Response
    {
        $Invoice->delete();

        return response()->noContent();
    }
}
