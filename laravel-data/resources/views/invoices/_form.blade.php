@csrf

<div class="form-grid">
    <div class="form-group">
        <label for="customer_id">Customer</label>
        <select id="customer_id" name="customer_id" required>
            <option value="">Select customer</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" @selected((int) old('customer_id', $invoice->customer_id) === $customer->id)>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('customer_id')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="amount">Amount</label>
        <input id="amount" name="amount" type="number" min="1" value="{{ old('amount', $invoice->amount) }}" required>
        @error('amount')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="B" @selected(old('status', $invoice->status) === 'B')>Billed (B)</option>
            <option value="P" @selected(old('status', $invoice->status) === 'P')>Paid (P)</option>
            <option value="V" @selected(old('status', $invoice->status) === 'V')>Void (V)</option>
        </select>
        @error('status')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="billed_date">Billed Date</label>
        <input id="billed_date" name="billed_date" type="date" value="{{ old('billed_date', optional($invoice->billed_date)->format('Y-m-d')) }}" required>
        @error('billed_date')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="paid_date">Paid Date (optional)</label>
        <input id="paid_date" name="paid_date" type="date" value="{{ old('paid_date', optional($invoice->paid_date)->format('Y-m-d')) }}">
        @error('paid_date')<div class="error">{{ $message }}</div>@enderror
    </div>
</div>

<div style="margin-top: 14px; display: flex; gap: 10px;">
    <button class="btn btn-primary" type="submit">{{ $buttonLabel }}</button>
    <a href="{{ route('invoices.index') }}">Cancel</a>
</div>
