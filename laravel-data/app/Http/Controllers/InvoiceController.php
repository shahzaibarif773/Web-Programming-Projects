<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $selectedCustomer = request()->integer('customer_id');

        $invoices = Invoice::query()
            ->with('customer')
            ->when($selectedCustomer > 0, function ($query) use ($selectedCustomer) {
                $query->where('customer_id', $selectedCustomer);
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        $customers = Customer::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('invoices.index', [
            'invoices' => $invoices,
            'customers' => $customers,
            'selectedCustomer' => $selectedCustomer,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $invoice = new Invoice(['status' => Invoice::STATUS_BILLED]);
        $customers = Customer::query()->orderBy('name')->get(['id', 'name']);

        return view('invoices.create', compact('invoice', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request): RedirectResponse
    {
        Invoice::create($this->normalizeDates($request->validated()));

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice): RedirectResponse
    {
        return redirect()->route('invoices.edit', $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice): View
    {
        $customers = Customer::query()->orderBy('name')->get(['id', 'name']);

        return view('invoices.edit', compact('invoice', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice): RedirectResponse
    {
        $invoice->update($this->normalizeDates($request->validated()));

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->delete();

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    /**
     * Ensure paid_date is only persisted for paid invoices.
     *
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    private function normalizeDates(array $data): array
    {
        if (($data['status'] ?? null) !== Invoice::STATUS_PAID) {
            $data['paid_date'] = null;
        }

        return $data;
    }
}
