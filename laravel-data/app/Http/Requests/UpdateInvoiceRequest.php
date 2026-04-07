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
            'customer_id' => ['required', 'exists:customers,id'],
            'amount' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::in([
                Invoice::STATUS_BILLED,
                Invoice::STATUS_PAID,
                Invoice::STATUS_VOID,
            ])],
            'billed_date' => ['required', 'date'],
            'paid_date' => ['nullable', 'date', 'after_or_equal:billed_date'],
        ];
    }
}
