@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="toolbar">
            <h1>Invoices</h1>
            <a class="btn btn-primary" href="{{ route('invoices.create') }}">Add Invoice</a>
        </div>

        <form method="GET" action="{{ route('invoices.index') }}" style="margin-bottom: 12px;">
            <div class="toolbar" style="justify-content: flex-start;">
                <div class="form-group" style="min-width: 260px; margin: 0;">
                    <label for="customer_id">Filter by customer</label>
                    <select id="customer_id" name="customer_id">
                        <option value="">All customers</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" @selected($selectedCustomer === $customer->id)>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Apply Filter</button>
                <a href="{{ route('invoices.index') }}">Reset</a>
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Billed Date</th>
                    <th>Paid Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->customer?->name }}</td>
                        <td>{{ number_format($invoice->amount) }}</td>
                        <td>
                            <span class="status status-{{ strtolower($invoice->status) }}">{{ $invoice->status_label }}</span>
                        </td>
                        <td>{{ $invoice->billed_date?->format('Y-m-d') }}</td>
                        <td>{{ $invoice->paid_date?->format('Y-m-d') ?? '-' }}</td>
                        <td>
                            <a href="{{ route('invoices.edit', $invoice) }}">Edit</a>
                            <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" style="display: inline-block; margin-left: 8px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this invoice?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No invoices found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-wrap">{{ $invoices->links() }}</div>
    </div>
@endsection
