<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'amount' => ['required', 'integer', 'min:1', 'max:4294967295'],
            'status' => ['required', Rule::in([
                Invoice::STATUS_BILLED,
                Invoice::STATUS_PAID,
                Invoice::STATUS_VOID,
            ])],
            'billed_date' => ['required', 'date'],
            'paid_date' => ['nullable', 'required_if:status,' . Invoice::STATUS_PAID, 'date', 'after_or_equal:billed_date'],
        ];
    }

    /**
     * Normalize input before validation.
     */
    protected function prepareForValidation(): void
    {
        $customerId = $this->input('customer_id');
        $amount = $this->input('amount');

        $this->merge([
            'customer_id' => $customerId === null || $customerId === '' ? null : (int) $customerId,
            'amount' => $amount === null || $amount === '' ? null : (int) $amount,
            'status' => trim((string) $this->input('status', '')),
            'billed_date' => trim((string) $this->input('billed_date', '')),
            'paid_date' => trim((string) $this->input('paid_date', '')),
        ]);
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'customer_id.required' => 'Customer is required.',
            'amount.required' => 'Amount cannot be empty.',
            'amount.integer' => 'Amount must be a whole number.',
            'amount.min' => 'Amount must be at least 1.',
            'amount.max' => 'Amount is too large.',
            'billed_date.required' => 'Billed date is required.',
            'paid_date.required_if' => 'Paid date is required when status is paid.',
            'paid_date.after_or_equal' => 'Paid date must be on or after billed date.',
        ];
    }
}
