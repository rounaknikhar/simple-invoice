<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the invoices for the logged in user with status.
        $invoicesQuery = Invoice::with(['status'])->where('user_id', Auth::user()->id);
        
        // Search by client name or invoice id.
        if($request->search) {
            $invoicesQuery
                ->whereLike('client_name', '%'.$request->search.'%', caseSensitive: false)
                ->OrWhereLike('id', '%'.$request->search.'%');
        } else {
            $invoicesQuery;
        }

        $invoicesQuery->orderBy('id', 'desc');

        return Inertia::render('Invoice/Index', [
            'invoices' =>  $invoicesQuery->paginate(12),
        ]);
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
    public function store(InvoiceRequest $request)
    {
        // Retrieve the validated input data.
        $validated = $request->validated();

        // Defaults to status pending.
        $validated['status'] = 1;

        // Defaults to logged in user.
        $validated['user_id'] = Auth::user()->id;

        // Store validated data.
        $invoice = Invoice::create($validated);
        
        // Redirects to newly created invoice page.
        return Redirect::route('invoice.show', ['invoice' => $invoice->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        // Pre-load related invoice creator data.
        $invoice->load(['createdBy', 'status', 'items']);

        return Inertia::render('Invoice/Show', [
            'invoice' =>  $invoice, 
            'statuses' => Status::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceRequest $request, Invoice $invoice): RedirectResponse
    {
        // Retrieve the validated input data.
        $validated = $request->validated();

        // Update validated data.
        $invoice->update($validated);

        // Redirects to the updated invoice page.
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
