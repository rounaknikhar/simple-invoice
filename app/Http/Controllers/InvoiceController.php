<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the invoices for the logged in user.
        $invoices = Invoice::with(['status'])->where('user_id', Auth::user()->id)->get();
        
        return Inertia::render('Invoice/Index', ['invoices' =>  $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Invoice/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        // Pre-load related invoice creator data.
        $invoice->load(['createdBy', 'status']);

        return Inertia::render('Invoice/Show', [
            'invoice' =>  $invoice, 
            'statuses' => Status::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice): RedirectResponse
    {
        // Retrieve the validated input data.
        $validated = $request->validated();
        // Update validated data.
        $invoice->update($validated);
        
        return Redirect::route('invoice.show', ['invoice' => $invoice->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
